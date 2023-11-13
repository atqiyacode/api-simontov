<?php

namespace App\Http\Controllers\API;

use App\Events\StatusAlarmEvent;
use App\Exports\StatusAlarmExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusAlarm\CreateStatusAlarmRequest;
use App\Http\Requests\StatusAlarm\UpdateStatusAlarmRequest;
use App\Services\StatusAlarm\StatusAlarmService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StatusAlarmController extends Controller
{
    protected $service;

    public function __construct(StatusAlarmService $service)
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
    public function store(CreateStatusAlarmRequest $request)
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
    public function update(UpdateStatusAlarmRequest $request, $id)
    {
        $query = $this->service->update($id, $request->all());
        StatusAlarmEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $query = $this->service->delete($id);
        StatusAlarmEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restore($id)
    {
        $query = $this->service->restore($id);
        StatusAlarmEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDelete($id)
    {
        $query = $this->service->forceDelete($id);
        StatusAlarmEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function destroyMultiple(Request $request)
    {
        $query = $this->service->destroyMultiple($request->ids);
        StatusAlarmEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restoreMultiple(Request $request)
    {
        $query = $this->service->restoreMultiple($request->ids);
        StatusAlarmEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDeleteMultiple(Request $request)
    {
        $query = $this->service->forceDeleteMultiple($request->ids);
        StatusAlarmEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function exportCsv()
    {
        return Excel::download(new StatusAlarmExport, 'StatusAlarm.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPdf()
    {
        return Excel::download(new StatusAlarmExport, 'StatusAlarm.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportExcel()
    {
        return Excel::download(new StatusAlarmExport, 'StatusAlarm.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
