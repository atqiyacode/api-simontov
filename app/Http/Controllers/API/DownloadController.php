<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RangeCost\RangeCostResource;
use App\Models\RangeCost;
use App\Models\RangeType;
use App\Services\Flowrate\FlowrateService;
use Carbon\Carbon;
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
        $response = $this->flowrateService->getDataRange($id, $start, $end);

        $data = [
            'title' => Carbon::parse($start)->isoFormat('LL') . ' - ' . Carbon::parse($end)->isoFormat('LL'),
            'start_date' => $start,
            'end_date' => $end,
            'result' => $response->getResult(),
            'total' => $response->getResult()->count(),
        ];

        return $response;
        return $this->billing($data['total']);



        $pdf = PDF::loadView('exports.invoice-pdf', [
            'data' => $data
        ])->setPaper('A4', 'potrait');

        $fileName = $token . '.pdf';
        // $fileName = Str::upper(Str::slug($payroll->employee->code . ' ' . $payroll->employee->full_name . ' ' . $payroll->month->name)) . '.pdf';

        return view('exports.invoice-pdf', [
            'data' => $data,
            'result' => $data['result'],
        ]);
        return $pdf->download($fileName);
    }

    public function billing($total)
    {
        $maxLimit = RangeType::orderBy('upper_limit', 'desc')->first();
        if ($total >= $maxLimit->upper_limit) {
            $type = $maxLimit;
        } else {
            $type = RangeType::where('upper_limit', '>', $total)
                ->where('lower_limit', '<', $total)
                ->orderBy('upper_limit', 'desc')
                ->firstOrFail();
        }

        $data = RangeCost::with(['rangeType'])->where('range_type_id', $type->id)->first();

        return response()->json(
            [
                'data' => new RangeCostResource($data),
                'total' => floatval($data->value) * $total,
                'price' => $data->value
            ]
        );
    }
}
