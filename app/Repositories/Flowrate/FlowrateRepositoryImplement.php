<?php

namespace App\Repositories\Flowrate;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Flowrate;

class FlowrateRepositoryImplement extends Eloquent implements FlowrateRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Flowrate $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->canDelete()
            ->with('location')
            ->useFilters()->get();
    }

    public function getPaginate()
    {
        return $this->model->canDelete()
            ->with('location')
            ->useFilters()->dynamicPaginate();
    }

    public function findByLocation($locationId, $start, $end)
    {
        return $this->model->canDelete()
            ->with('location')
            ->where('location_id', $locationId)
            ->whereBetween('mag_date', [$start, $end])
            ->get();
    }

    public function findById($id)
    {
        return $this->model->canDelete()
            ->with('location')
            ->findOrFail($id);
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
