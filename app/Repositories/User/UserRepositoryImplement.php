<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->canDelete()
            ->with(['dashboardCharts', 'locations'])
            ->useFilters()->get();
    }

    public function getPaginate()
    {
        return $this->model->canDelete()
            ->with(['dashboardCharts', 'locations'])
            ->useFilters()->dynamicPaginate();
    }

    public function findById($id)
    {
        return $this->model->canDelete()
            ->with(['dashboardCharts', 'locations'])
            ->findOrFail($id);
    }

    public function create($data)
    {
        $query =  $this->model->create($data);
        $query->roles()->attach($data['roles']);
        $query->permissions()->attach($data['permissions']);
        $query->locations()->attach($data['locations']);
        $query->dashboardCharts()->attach($data['dashboardCharts']);
        return $query;
    }

    public function update($id, $data)
    {
        $query = $this->model->findOrFail($id);
        // If the password is provided, hash it; otherwise, keep the existing password
        if (!empty($data['password'])) {
            $data['password'] = $data['password'];
        } else {
            // Remove the password from the data array to prevent it from being updated to null
            unset($data['password']);
        }
        $query->update($data);
        $query->roles()->sync($data['roles']);
        $query->permissions()->sync($data['permissions']);
        $query->locations()->sync($data['locations']);
        $query->dashboardCharts()->sync($data['dashboardCharts']);
        return $query;
    }

    public function delete($id)
    {
        $query = $this->model->findOrFail($id)->delete();
        return $query;
    }

    public function restore($id)
    {
        $query = $this->model->onlyTrashed()->findOrFail($id)->restore();
        return $query;
    }

    public function forceDelete($id)
    {
        $query = $this->model->withTrashed()->findOrFail($id)->forceDelete();
        return $query;
    }

    public function destroyMultiple($ids)
    {
        $query = $this->model->whereIn('id', $ids)->delete();
        return $query;
    }

    public function restoreMultiple($ids)
    {
        $query = $this->model->onlyTrashed()->whereIn('id', $ids)->restore();
        return $query;
    }

    public function forceDeleteMultiple($ids)
    {
        $query = $this->model->whereIn('id', $ids)->forceDelete();
        return $query;
    }

    public function export($format)
    {
        if ($format === 'json') {
            $jsonData = $this->model->canDelete()->get();
            return response()->jsonDownload($jsonData, 'data.json');
        } elseif ($format === 'csv') {
            return $this->downloadExcel('CSV');
        } elseif ($format === 'xlsx') {
            return $this->downloadExcel('XLSX');
        } elseif ($format === 'xls') {
            return $this->downloadExcel('XLS');
        } else {
            return response()->json(['errors' => __('validation.regex', ['attribute' => 'File'])], 400);
        }
    }

    private function downloadExcel($format)
    {
        $modelName = class_basename($this->model);
        $exportClassName = "App\\Exports\\{$modelName}Export";
        $export = App::make($exportClassName);

        switch (strtolower($format)) {
            case 'csv':
                return Excel::download($export, 'Data.csv', \Maatwebsite\Excel\Excel::CSV);
            case 'xlsx':
                return Excel::download($export, 'Data.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            case 'xls':
                return Excel::download($export, 'Data.xls', \Maatwebsite\Excel\Excel::XLS);
            default:
                // Handle unsupported format or throw an exception
        }
    }
}
