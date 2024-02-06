<?php

namespace App\Repositories\LocationNotification;

use LaravelEasyRepository\Implementations\Eloquent;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use App\Models\LocationNotification;

class LocationNotificationRepositoryImplement extends Eloquent implements LocationNotificationRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(LocationNotification $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with(['location', 'alertNotificationType'])->useFilters()->get();
    }

    public function getPaginate()
    {
        return $this->model->with(['location', 'alertNotificationType'])->useFilters()->dynamicPaginate();
    }

    public function findById($id)
    {
        return $this->model->with(['location', 'alertNotificationType'])->findOrFail($id);
    }

    public function countByLocation($locationId)
    {
        return $this->model->with(['location', 'alertNotificationType'])->where('location_id', $locationId)->get()->count();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $query = $this->model->findOrFail($id);
        $query->update($data);
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
            $jsonData = $this->model->get();
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
