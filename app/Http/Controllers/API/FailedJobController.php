<?php

namespace App\Http\Controllers\API;

use App\Events\FailedJobEvent;
use App\Exports\FailedJobExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\FailedJob\CreateFailedJobRequest;
use App\Http\Requests\FailedJob\UpdateFailedJobRequest;
use App\Services\FailedJob\FailedJobService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FailedJobController extends Controller
{
    protected $service;

    public function __construct(FailedJobService $service)
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
    public function store(CreateFailedJobRequest $request)
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
    public function update(UpdateFailedJobRequest $request, $id)
    {
        $query = $this->service->update($id, $request->all());
        FailedJobEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $query = $this->service->delete($id);
        FailedJobEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restore($id)
    {
        $query = $this->service->restore($id);
        FailedJobEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDelete($id)
    {
        $query = $this->service->forceDelete($id);
        FailedJobEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function destroyMultiple(Request $request)
    {
        $query = $this->service->destroyMultiple($request->ids);
        FailedJobEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restoreMultiple(Request $request)
    {
        $query = $this->service->restoreMultiple($request->ids);
        FailedJobEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDeleteMultiple(Request $request)
    {
        $query = $this->service->forceDeleteMultiple($request->ids);
        FailedJobEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function exportCsv()
    {
        return Excel::download(new FailedJobExport, 'FailedJob.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPdf()
    {
        return Excel::download(new FailedJobExport, 'FailedJob.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportExcel()
    {
        return Excel::download(new FailedJobExport, 'FailedJob.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
