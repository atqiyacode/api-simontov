<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationNotification\CreateLocationNotificationRequest;
use App\Http\Requests\LocationNotification\UpdateLocationNotificationRequest;
use App\Services\LocationNotification\LocationNotificationService;
use Illuminate\Http\Request;

class LocationNotificationController extends Controller
{
    protected $service;

    public function __construct(LocationNotificationService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = $request->has('all') ? $this->service->getAll() : $this->service->getPaginate();
        return $response->getResult();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLocationNotificationRequest $request)
    {
        $query = $this->service->create($request->all());
        return $query->toJson();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->service->findById($id)->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationNotificationRequest $request, $id)
    {
        $query = $this->service->update($id, $request->all());
        return $query->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $query = $this->service->delete($id);
        return $query->toJson();
    }

    public function restore($id)
    {
        $query = $this->service->restore($id);
        return $query->toJson();
    }

    public function forceDelete($id)
    {
        $query = $this->service->forceDelete($id);
        return $query->toJson();
    }

    public function destroyMultiple(Request $request)
    {
        $query = $this->service->destroyMultiple($request->ids);
        return $query->toJson();
    }

    public function restoreMultiple(Request $request)
    {
        $query = $this->service->restoreMultiple($request->ids);
        return $query->toJson();
    }

    public function forceDeleteMultiple(Request $request)
    {
        $query = $this->service->forceDeleteMultiple($request->ids);
        return $query->toJson();
    }

    public function export($format)
    {
        return $this->service->export($format);
    }

    public function count($locationId)
    {
        $query = $this->service->countByLocation($locationId);
        return $query->toJson();
    }
}