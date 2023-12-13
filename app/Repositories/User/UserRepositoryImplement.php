<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
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
