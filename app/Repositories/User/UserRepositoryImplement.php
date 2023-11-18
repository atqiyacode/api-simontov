<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

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
        return $this->model->canDelete()->useFilters()->get();
    }

    public function getPaginate()
    {
        return $this->model->canDelete()->useFilters()->dynamicPaginate();
    }

    public function findById($id)
    {
        return $this->model->canDelete()->findOrFail($id);
    }

    public function create($data)
    {
        $query =  $this->model->create($data);
        $query->locations()->sync($data['locations']);
        $query->dashboardCharts()->sync($data['dashboardCharts']);
        return $query;
    }

    public function update($id, $data)
    {
        $query = $this->model->findOrFail($id);
        if (!$data['password']) {
            $data['password'] = $query->password;
        }
        $query->update($data);
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
        $query = $this->model->destroy($ids);
        return $query;
    }

    public function restoreMultiple($ids)
    {
        $query = $this->model->onlyTrashed()->whereIn('id', $ids)->restore();
        return $query;
    }

    public function forceDeleteMultiple($ids)
    {
        $query = $this->model->onlyTrashed()->whereIn('id', $ids)->forceDelete();
        return $query;
    }
}
