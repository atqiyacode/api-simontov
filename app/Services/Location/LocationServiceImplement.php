<?php

namespace App\Services\Location;

use App\Http\Resources\Location\LocationResource;
use LaravelEasyRepository\ServiceApi;
use Illuminate\Support\Facades\DB;
use App\Repositories\Location\LocationRepository;

class LocationServiceImplement extends ServiceApi implements LocationService
{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     * @param string $restore_message
     * @param string $destroy_message
     * @param string $found_message
     */
    protected $title = "";
    protected $create_message = "";
    protected $update_message = "";
    protected $delete_message = "";
    protected $restore_message = "";
    protected $destroy_message = "";
    protected $found_message = "";

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(LocationRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->create_message = trans('alert.success-save');
        $this->update_message = trans('alert.success-update');
        $this->delete_message = trans('alert.success-delete');
        $this->restore_message = trans('alert.success-restored');
        $this->destroy_message = trans('alert.success-deleted-permanent');
        $this->found_message = trans('alert.success-found');
    }

    public function getPaginate()
    {
        $response = $this->mainRepository->getPaginate();
        return $this->setMessage($this->found_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult(LocationResource::collection($response));
    }

    public function getAll()
    {
        $response = $this->mainRepository->getAll();
        return $this->setMessage($this->found_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult(LocationResource::collection($response));
    }

    public function findById($id)
    {
        $response = $this->mainRepository->findById($id);
        return $this->setMessage($this->found_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult(new LocationResource($response));
    }

    public function create($data)
    {
        $response = DB::transaction(function () use ($data) {
            return $this->mainRepository->create($data);
        });
        return $this->setMessage($this->create_message)
            ->setStatus(true)
            ->setCode(201)
            ->setResult(new LocationResource($response));
    }

    public function update($id, $data)
    {
        $response = DB::transaction(function () use ($id, $data) {
            return $this->mainRepository->update($id, $data);
        });
        return $this->setMessage($this->update_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult(new LocationResource($response));
    }

    public function delete($id)
    {
        $response = DB::transaction(function () use ($id) {
            return $this->mainRepository->delete($id);
        });
        return $this->setMessage($this->delete_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function restore($id)
    {
        $response = DB::transaction(function () use ($id) {
            return $this->mainRepository->restore($id);
        });
        return $this->setMessage($this->restore_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function forceDelete($id)
    {
        $response = DB::transaction(function () use ($id) {
            return $this->mainRepository->forceDelete($id);
        });
        return $this->setMessage($this->destroy_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function destroyMultiple($ids)
    {
        $response = DB::transaction(function () use ($ids) {
            return $this->mainRepository->destroyMultiple($ids);
        });
        return $this->setMessage($this->destroy_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function restoreMultiple($ids)
    {
        $response = DB::transaction(function () use ($ids) {
            return $this->mainRepository->restoreMultiple($ids);
        });
        return $this->setMessage($this->restore_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function forceDeleteMultiple($ids)
    {
        $response = DB::transaction(function () use ($ids) {
            return $this->mainRepository->forceDeleteMultiple($ids);
        });
        return $this->setMessage($this->destroy_message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }
}
