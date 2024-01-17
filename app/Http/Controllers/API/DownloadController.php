<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RangeCost\RangeCostResource;
use App\Models\RangeCost;
use App\Models\RangeType;
use App\Models\Tax;
use App\Services\Flowrate\FlowrateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;

class DownloadController extends Controller
{


    public $pathInvoice, $flowrateService;

    public function __construct(FlowrateService $flowrateService)
    {
        $this->pathInvoice = storage_path('app/public/invoice');
        $this->flowrateService = $flowrateService;
    }

    public function invoice($id)
    {
        $token = Str::uuid();
        $start = request()->start . ' 00:00:00';
        $end = request()->end . ' 23:59:59';

        $response = $this->filterQuery($id, $start, $end);

        $data = [
            'title' => Carbon::parse($start)->isoFormat('LL') . ' - ' . Carbon::parse($end)->isoFormat('LL'),
            'start_date' => $start,
            'end_date' => $end,
            'total' => $response->getResult()->count(),
            'first' => $response->getResult()->first(),
            'last' => $response->getResult()->last(),
        ];

        // download
        $pdf = PDF::loadView('exports.invoice-pdf', [
            'data' => $data,
            'billing' => $this->billing($data['last']->totalizer_1 - $data['first']->totalizer_1),
            'tax' => Tax::first(),
            'price' => config('app.main_price')
        ])->setPaper('A4', 'potrait');

        $fileName = $token . '.pdf';
        return $pdf->download($fileName);

        // preview
        // return view('exports.invoice-pdf', [
        //     'data' => $data,
        //     'billing' => $this->billing($data['last']->totalizer_1 - $data['first']->totalizer_1),
        //     'tax' => Tax::first(),
        //     'price' => config('app.main_price')
        // ]);
    }

    public function billing($total)
    {
        $shippingCost = 0;
        if ($total >= 0 && $total <= 50) {
            $shippingCost = config('app.flat_price');
        }
        // > 50: calculate based on a rate of 8.000 per unit
        else {
            $additionalUnits = $total - 50;
            $shippingCost = config('app.flat_price') + ($additionalUnits * config('app.main_price'));
        }


        return \intval($shippingCost);
    }

    public function filterQuery($id, $start, $end)
    {
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

        return $results;
    }
}
