<?php

namespace App\Http\Controllers\API;

use App\Events\LocationEvent;
use App\Exports\LocationExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Location\CreateLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Services\Location\LocationService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LocationController extends Controller
{
    protected $service;

    public function __construct(LocationService $service)
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
    public function store(CreateLocationRequest $request)
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
    public function update(UpdateLocationRequest $request, $id)
    {
        $query = $this->service->update($id, $request->all());
        LocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $query = $this->service->delete($id);
        LocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restore($id)
    {
        $query = $this->service->restore($id);
        LocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDelete($id)
    {
        $query = $this->service->forceDelete($id);
        LocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function destroyMultiple(Request $request)
    {
        $query = $this->service->destroyMultiple($request->ids);
        LocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restoreMultiple(Request $request)
    {
        $query = $this->service->restoreMultiple($request->ids);
        LocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDeleteMultiple(Request $request)
    {
        $query = $this->service->forceDeleteMultiple($request->ids);
        LocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function exportCsv()
    {
        return Excel::download(new LocationExport, 'Location.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPdf()
    {
        return Excel::download(new LocationExport, 'Location.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportExcel()
    {
        return Excel::download(new LocationExport, 'Location.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
