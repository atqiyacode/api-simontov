<?php

namespace App\Http\Controllers\API;

use App\Events\FlowrateEvent;
use App\Exports\FlowrateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Flowrate\CreateFlowrateRequest;
use App\Http\Requests\Flowrate\UpdateFlowrateRequest;
use App\Services\Flowrate\FlowrateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FlowrateController extends Controller
{
    protected $service;

    public function __construct(FlowrateService $service)
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
    public function store(CreateFlowrateRequest $request)
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
    public function update(UpdateFlowrateRequest $request, $id)
    {
        $query = $this->service->update($id, $request->all());
        FlowrateEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $query = $this->service->delete($id);
        FlowrateEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restore($id)
    {
        $query = $this->service->restore($id);
        FlowrateEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDelete($id)
    {
        $query = $this->service->forceDelete($id);
        FlowrateEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function destroyMultiple(Request $request)
    {
        $query = $this->service->destroyMultiple($request->ids);
        FlowrateEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restoreMultiple(Request $request)
    {
        $query = $this->service->restoreMultiple($request->ids);
        FlowrateEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDeleteMultiple(Request $request)
    {
        $query = $this->service->forceDeleteMultiple($request->ids);
        FlowrateEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(new FlowrateExport($request->location_id), 'Flowrate.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPdf(Request $request)
    {
        return Excel::download(new FlowrateExport($request->location_id), 'Flowrate.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new FlowrateExport($request->location_id), 'Flowrate.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function range($id)
    {
        $start = request()->start . ' 00:00:00';
        $end = request()->end . ' 23:59:59';
        $response = $this->service->getDataRange($id, $start, $end);
        return [
            'title' => Carbon::parse($start)->isoFormat('LL') . ' - ' . Carbon::parse($end)->isoFormat('LL'),
            'start_date' => $start,
            'end_date' => $end,
            'result' => $response->getResult(),
            'total' => $response->getResult()->count(),
        ];
    }
}
