<?php

namespace App\Http\Controllers\API;

use App\Events\RangeTypeEvent;
use App\Exports\RangeTypeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\RangeType\CreateRangeTypeRequest;
use App\Http\Requests\RangeType\UpdateRangeTypeRequest;
use App\Services\RangeType\RangeTypeService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RangeTypeController extends Controller
{
    protected $service;

    public function __construct(RangeTypeService $service)
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
    public function store(CreateRangeTypeRequest $request)
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
    public function update(UpdateRangeTypeRequest $request, $id)
    {
        $query = $this->service->update($id, $request->all());
        RangeTypeEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $query = $this->service->delete($id);
        RangeTypeEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restore($id)
    {
        $query = $this->service->restore($id);
        RangeTypeEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDelete($id)
    {
        $query = $this->service->forceDelete($id);
        RangeTypeEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function destroyMultiple(Request $request)
    {
        $query = $this->service->destroyMultiple($request->ids);
        RangeTypeEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restoreMultiple(Request $request)
    {
        $query = $this->service->restoreMultiple($request->ids);
        RangeTypeEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDeleteMultiple(Request $request)
    {
        $query = $this->service->forceDeleteMultiple($request->ids);
        RangeTypeEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function exportCsv()
    {
        return Excel::download(new RangeTypeExport, 'RangeType.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPdf()
    {
        return Excel::download(new RangeTypeExport, 'RangeType.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportExcel()
    {
        return Excel::download(new RangeTypeExport, 'RangeType.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
