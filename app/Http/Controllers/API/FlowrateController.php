<?php

namespace App\Http\Controllers\API;

use App\Events\FlowrateEvent;
use App\Exports\FlowrateExportByDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Flowrate\CreateFlowrateRequest;
use App\Http\Requests\Flowrate\UpdateFlowrateRequest;
use App\Http\Resources\Flowrate\FlowrateDataResource;
use App\Models\Flowrate;
use App\Repositories\Flowrate\FlowrateRepository;
use App\Services\Flowrate\FlowrateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FlowrateController extends Controller
{
    protected $service, $repository;

    public function __construct(FlowrateService $service, FlowrateRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
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

    public function export($format)
    {
        return $this->service->export($format);
    }

    public function findByLocation($locationId, $start, $end)
    {
        return Flowrate::canDelete()
            ->with('location')
            ->where('location_id', $locationId)
            ->whereBetween('mag_date', [$start, $end])
            ->selectRaw('AVG(ph) as avg_ph, AVG(cod) as avg_cod')
            ->first();
    }

    public function range(Request $request, $id)
    {
        $start = $request->start . ' 00:00:00';
        $end = $request->end . ' 23:59:59';
        // $response = $this->service->getDataRange($id, $start, $end);
        $response = $this->filterQuery($request, $id)->get();
        $avg = $this->findByLocation($id, $start, $end);
        return [
            'title' => Carbon::parse($start)->isoFormat('LL') . ' - ' . Carbon::parse($end)->isoFormat('LL'),
            'start_date' => $start,
            'end_date' => $end,
            'result' => FlowrateDataResource::collection($response),
            'avg_ph' => $avg->avg_ph,
            'avg_cod' => $avg->avg_cod,
        ];
    }

    public function billing(Request $request)
    {
        $total = $request->total;
        $shippingCost = 0;
        if ($total >= 0 && $total <= 50) {
            $shippingCost = config('app.flat_price');
        }
        // > 50: calculate based on a rate of 8.000 per unit
        else {
            $additionalUnits = $total - 50;
            $shippingCost = config('app.flat_price') + ($additionalUnits * config('app.main_price'));
        }


        return response()->json(floatval($shippingCost));
    }

    // public function backup_billing()
    // {
    //     $total = request()->total;
    //     $maxLimit = RangeType::orderBy('upper_limit', 'desc')->first();
    //     if ($total >= $maxLimit->upper_limit) {
    //         $type = $maxLimit;
    //     } else {
    //         $type = RangeType::where('upper_limit', '>', $total)
    //             ->where('lower_limit', '<', $total)
    //             ->orderBy('upper_limit', 'desc')
    //             ->firstOrFail();
    //     }

    //     $data = RangeCost::with(['rangeType'])->where('range_type_id', $type->id)->first();

    //     return response()->json(
    //         [
    //             'data' => new RangeCostResource($data),
    //             'total' => floatval($data->value) * $total,
    //             'price' => $data->value
    //         ]
    //     );
    // }


    public function filterDate(Request $request, $id)
    {
        return FlowrateDataResource::collection($this->filterQuery($request, $id)->get());
    }


    public function exportFilterDate(Request $request, $id, $format)
    {
        $interval = $request->interval;
        $start = $request->start . ' 00:00:00';
        $end = $request->end . ' 23:59:59';

        $month_start = $request->month_start;
        $month_end = $request->month_end;

        if ($format === 'json') {
            $jsonData = $this->filterQuery($request, $id)->get();
            return response()->jsonDownload($jsonData, 'data.json');
        } elseif ($format === 'csv') {
            return $this->downloadExcel('CSV', $id, $start, $end, $month_start, $month_end, $interval);
        } elseif ($format === 'xlsx') {
            return $this->downloadExcel('XLSX', $id, $start, $end, $month_start, $month_end, $interval);
        } elseif ($format === 'xls') {
            return $this->downloadExcel('XLS', $id, $start, $end, $month_start, $month_end, $interval);
        } else {
            return response()->json(['errors' => __('validation.regex', ['attribute' => 'File'])], 400);
        }
    }

    private function downloadExcel($format, $locationId, $start, $end, $month_start, $month_end, $interval)
    {
        switch (strtolower($format)) {
            case 'csv':
                return Excel::download(new FlowrateExportByDate($locationId, $start, $end, $month_start, $month_end, $interval), 'Data.csv', \Maatwebsite\Excel\Excel::CSV);
            case 'xlsx':
                return Excel::download(new FlowrateExportByDate($locationId, $start, $end, $month_start, $month_end, $interval), 'Data.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            case 'xls':
                return Excel::download(new FlowrateExportByDate($locationId, $start, $end, $month_start, $month_end, $interval), 'Data.xls', \Maatwebsite\Excel\Excel::XLS);
            default:
                // Handle unsupported format or throw an exception
        }
    }

    public function filterQuery(Request $request, $id)
    {
        $interval = $request->interval;
        $start = $request->start . ' 00:00:00';
        $end = $request->end . ' 23:59:59';

        $month_start = $request->month_start;
        $month_end = $request->month_end;

        if ($interval === 'month') {
            $results = DB::table(DB::raw('(
        SELECT
            id,
            location_id,

            mag_date,

            totalizer_1,
            totalizer_2,
            totalizer_3,

            unit_flowrate,
            unit_totalizer,

            flowrate,
            pressure,

            analog_1,
            status_battery,
            alarm,

            bin_alarm,

            file_name,

            ph,
            cod,
            cond,
            level,
            do,

            do_alarm_hi,
            do_alarm_lo,
            pres_alarm_hi,
            pres_alarm_lo,
            ph_alarm_hi,
            ph_alarm_lo,

            fm_status,
            fm_err_code,

            pln_stat,
            panel_stat,

            created_at,
            updated_at,


            DATE_FORMAT(mag_date, "%Y-%m") as `interval`,
            ROW_NUMBER() OVER (PARTITION BY DATE_FORMAT(mag_date, "%Y-%m") ORDER BY mag_date DESC) as row_num
            FROM flowrates where location_id = ' . $id . '
    ) as ranked'))
                ->select(
                    'id',
                    'location_id',

                    'mag_date',

                    'totalizer_1',
                    'totalizer_2',
                    'totalizer_3',

                    'unit_flowrate',
                    'unit_totalizer',

                    'flowrate',
                    'pressure',

                    'analog_1',
                    'status_battery',
                    'alarm',

                    'bin_alarm',

                    'file_name',

                    'ph',
                    'cod',
                    'cond',
                    'level',
                    'do',

                    'do_alarm_hi',
                    'do_alarm_lo',
                    'pres_alarm_hi',
                    'pres_alarm_lo',
                    'ph_alarm_hi',
                    'ph_alarm_lo',

                    'fm_status',
                    'fm_err_code',

                    'pln_stat',
                    'panel_stat',

                    'created_at',
                    'updated_at',


                )
                ->where('row_num', 1)

                ->whereBetween('mag_date', [$month_start, $month_end])
                ->orderBy('interval', 'ASC');
        } elseif ($interval === 'day') {
            $results = DB::table(DB::raw('(
        SELECT
            id,
            location_id,

            mag_date,

            totalizer_1,
            totalizer_2,
            totalizer_3,

            unit_flowrate,
            unit_totalizer,

            flowrate,
            pressure,

            analog_1,
            status_battery,
            alarm,

            bin_alarm,

            file_name,

            ph,
            cod,
            cond,
            level,
            do,

            do_alarm_hi,
            do_alarm_lo,
            pres_alarm_hi,
            pres_alarm_lo,
            ph_alarm_hi,
            ph_alarm_lo,

            fm_status,
            fm_err_code,

            pln_stat,
            panel_stat,

            created_at,
            updated_at,


            DATE_FORMAT(mag_date, "%Y-%m-%d") as `interval`,
            ROW_NUMBER() OVER (PARTITION BY DATE_FORMAT(mag_date, "%Y-%m-%d") ORDER BY mag_date DESC) as row_num
        FROM flowrates where location_id = ' . $id . '
    ) as ranked'))
                ->select(
                    'id',
                    'location_id',

                    'mag_date',

                    'totalizer_1',
                    'totalizer_2',
                    'totalizer_3',

                    'unit_flowrate',
                    'unit_totalizer',

                    'flowrate',
                    'pressure',

                    'analog_1',
                    'status_battery',
                    'alarm',

                    'bin_alarm',

                    'file_name',

                    'ph',
                    'cod',
                    'cond',
                    'level',
                    'do',

                    'do_alarm_hi',
                    'do_alarm_lo',
                    'pres_alarm_hi',
                    'pres_alarm_lo',
                    'ph_alarm_hi',
                    'ph_alarm_lo',

                    'fm_status',
                    'fm_err_code',

                    'pln_stat',
                    'panel_stat',

                    'created_at',
                    'updated_at',


                )
                ->where('row_num', 1)

                ->whereBetween('mag_date', [$start, $end])
                ->orderBy('interval', 'ASC');
        } else {
            $results = DB::table(DB::raw('(
        SELECT
            id,
            location_id,

            mag_date,

            totalizer_1,
            totalizer_2,
            totalizer_3,

            unit_flowrate,
            unit_totalizer,

            flowrate,
            pressure,

            analog_1,
            status_battery,
            alarm,

            bin_alarm,

            file_name,

            ph,
            cod,
            cond,
            level,
            do,

            do_alarm_hi,
            do_alarm_lo,
            pres_alarm_hi,
            pres_alarm_lo,
            ph_alarm_hi,
            ph_alarm_lo,

            fm_status,
            fm_err_code,

            pln_stat,
            panel_stat,

            created_at,
            updated_at,


            DATE_FORMAT(mag_date, "%Y-%m-%d %H:00:00") as `interval`,
            ROW_NUMBER() OVER (PARTITION BY DATE_FORMAT(mag_date, "%Y-%m-%d %H:00:00") ORDER BY mag_date DESC) as row_num
            FROM flowrates where location_id = ' . $id . '
    ) as ranked'))
                ->select(
                    'id',
                    'location_id',

                    'mag_date',

                    'totalizer_1',
                    'totalizer_2',
                    'totalizer_3',

                    'unit_flowrate',
                    'unit_totalizer',

                    'flowrate',
                    'pressure',

                    'analog_1',
                    'status_battery',
                    'alarm',

                    'bin_alarm',

                    'file_name',

                    'ph',
                    'cod',
                    'cond',
                    'level',
                    'do',

                    'do_alarm_hi',
                    'do_alarm_lo',
                    'pres_alarm_hi',
                    'pres_alarm_lo',
                    'ph_alarm_hi',
                    'ph_alarm_lo',

                    'fm_status',
                    'fm_err_code',

                    'pln_stat',
                    'panel_stat',

                    'created_at',
                    'updated_at',


                )
                ->where('row_num', 1)
                ->whereBetween('mag_date', [$start, $end])
                ->orderBy('interval', 'ASC');
        }

        return $results;
    }
}
