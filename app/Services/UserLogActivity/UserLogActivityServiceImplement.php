<?php

namespace App\Services\UserLogActivity;

use App\Http\Resources\UserLogActivity\UserLogActivityResource;
use LaravelEasyRepository\ServiceApi;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserLogActivity\UserLogActivityRepository;

class UserLogActivityServiceImplement extends ServiceApi implements UserLogActivityService
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

    public function __construct(UserLogActivityRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getPaginate()
    {
        $response = $this->mainRepository->getPaginate();
        return $this->setMessage(__('alert.success-found'))
            ->setStatus(true)
            ->setCode(200)
            ->setResult(UserLogActivityResource::collection($response));
    }

    public function getAll()
    {
        $response = $this->mainRepository->getAll();
        return $this->setMessage(__('alert.success-found'))
            ->setStatus(true)
            ->setCode(200)
            ->setResult(UserLogActivityResource::collection($response));
    }

    public function findById($id)
    {
        $response = $this->mainRepository->findById($id);
        return $this->setMessage(__('alert.success-found'))
            ->setStatus(true)
            ->setCode(200)
            ->setResult(new UserLogActivityResource($response));
    }

    public function create($data)
    {
        $response = DB::transaction(function () use ($data) {
            return $this->mainRepository->create($data);
        });
        $count = $response ? 1 : 0;
        $message = trans_choice('alert.success-save', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(201)
            ->setResult(new UserLogActivityResource($response));
    }

    public function update($id, $data)
    {
        $response = DB::transaction(function () use ($id, $data) {
            return $this->mainRepository->update($id, $data);
        });
        $count = $response ? 1 : 0;
        $message = trans_choice('alert.success-update', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult(new UserLogActivityResource($response));
    }

    public function delete($id)
    {
        $response = DB::transaction(function () use ($id) {
            return $this->mainRepository->delete($id);
        });
        $count = $response;
        $message = trans_choice('alert.success-delete', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function restore($id)
    {
        $response = DB::transaction(function () use ($id) {
            return $this->mainRepository->restore($id);
        });
        $count = $response;
        $message = trans_choice('alert.success-restored', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function forceDelete($id)
    {
        $response = DB::transaction(function () use ($id) {
            return $this->mainRepository->forceDelete($id);
        });
        $count = $response;
        $message = trans_choice('alert.success-deleted-permanent', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function destroyMultiple($ids)
    {
        $response = DB::transaction(function () use ($ids) {
            return $this->mainRepository->destroyMultiple($ids);
        });
        $count = $response;
        $message = trans_choice('alert.success-delete', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function restoreMultiple($ids)
    {
        $response = DB::transaction(function () use ($ids) {
            return $this->mainRepository->restoreMultiple($ids);
        });
        $count = $response;
        $message = trans_choice('alert.success-restored', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function forceDeleteMultiple($ids)
    {
        $response = DB::transaction(function () use ($ids) {
            return $this->mainRepository->forceDeleteMultiple($ids);
        });
        $count = $response;
        $message = trans_choice('alert.success-deleted-permanent', $count, ['count' => $count]);
        return $this->setMessage($message)
            ->setStatus(true)
            ->setCode(200)
            ->setResult($response);
    }

    public function export($format)
    {
        return $this->mainRepository->export($format);
    }
}
