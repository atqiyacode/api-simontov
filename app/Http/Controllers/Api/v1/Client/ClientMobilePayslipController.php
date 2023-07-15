<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Client\ClientDetailPayrollResource;
use App\Http\Resources\v1\Client\ClientPayrollResource;
use App\Models\v1\Overtime;
use App\Models\v1\Payroll;
use App\Models\v1\ShiftExc;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use PDF;

class ClientMobilePayslipController extends Controller
{
    use ApiResponseHelpers;

    public function index(Request $request)
    {
        $keyword = $request->search;
        $query = Payroll::currentUser()
            ->when($request->has('search'), function ($q) use ($keyword) {
                $q->wherehas('month', function ($query) use ($keyword) {
                    $query->where('company', 'LIKE', "%{$keyword}%")
                        ->orWhere('name', 'LIKE', "%{$keyword}%");
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate();
        $data = ClientPayrollResource::collection($query);
        return $data;
    }

    public function show($id)
    {
        $data = Cache::remember('payslips-detail-' . $id . '-' . auth()->user()->id, config('app.cache_time'), function () use ($id) {
            $query = Payroll::withCount([
                'earn', 'deduction', 'overtime', 'shiftExc', 'employee'
            ])
                ->currentUser()
                ->where('id', $id)
                ->firstOrFail();
            return new ClientDetailPayrollResource($query);
        });
        return $data;
    }

    public function download($id)
    {
        $payroll = Payroll::with(['month', 'employee', 'earn', 'deduction', 'overtime', 'shiftExc'])
            ->currentUser()
            ->withCount(['earn', 'deduction', 'overtime', 'shiftExc'])
            ->findOrFail($id);

        $overtimeTypes = Cache::remember('client-overtime-types', config('app.cache_time'), function () {
            return Overtime::all();
        });

        $shiftExcTypes = Cache::remember('client-shift-exc-types', config('app.cache_time'), function () {
            return ShiftExc::all();
        });

        $token = Str::uuid();

        $pdf = PDF::loadView('exports.payroll-pdf', compact(['payroll', 'token', 'overtimeTypes', 'shiftExcTypes']))->setPaper('A4', 'landscape');

        $fileName = Str::upper(Str::slug($payroll->employee->code . ' ' . $payroll->employee->full_name . ' ' . $payroll->month->name)) . '.pdf';

        return $pdf->download($fileName);
    }
}
