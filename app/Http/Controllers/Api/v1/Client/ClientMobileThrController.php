<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Client\ClientDetailThrResource;
use App\Http\Resources\v1\Client\ClientThrResource;
use App\Http\Resources\v1\THREmployeeResource;
use App\Models\v1\THREmployee;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use PDF;

class ClientMobileThrController extends Controller
{
    use ApiResponseHelpers;

    public function index(Request $request)
    {
        $keyword = $request->search;
        $query = THREmployee::withCount([
            'employee', 'thr'
        ])
            ->when($request->has('search'), function ($q) use ($keyword) {
                $q->wherehas('thr', function ($query) use ($keyword) {
                    $query->where('company', 'LIKE', "%{$keyword}%")
                        ->orWhere('name', 'LIKE', "%{$keyword}%");
                });
            })
            ->currentUser()
            ->orderBy('id', 'DESC')
            ->paginate();
        $data = ClientThrResource::collection($query);
        return $data;
    }

    public function show($id)
    {
        $query = THREmployee::withCount([
            'employee', 'thr'
        ])
            ->currentUser()
            ->where('id', $id)
            ->first();
        $data = new ClientDetailThrResource($query);
        return $data;
    }

    public function download($id)
    {
        $query = THREmployee::with(['employee', 'thr'])->where([
            'id' => $id,
        ])
            ->currentUser()
            ->firstOrFail();

        $slip = new THREmployeeResource($query);

        $data = json_decode($query->data);

        $token = Str::uuid();

        $pdf = PDF::loadView('exports.thr-slip-pdf', compact(['slip', 'data', 'token',]))->setPaper('A4', 'landscape');

        $fileName = Str::upper(Str::slug($slip->employee->code . ' ' . $slip->employee->full_name . ' ' . $slip->thr->name)) . '.pdf';

        return $pdf->download($fileName);
    }
}
