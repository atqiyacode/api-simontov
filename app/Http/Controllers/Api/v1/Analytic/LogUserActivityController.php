<?php

namespace App\Http\Controllers\Api\v1\Analytic;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\LogUserActivityResource;
use App\Models\v1\LogUserActivity;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LogUserActivityController extends Controller
{
    use ApiResponseHelpers;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = LogUserActivity::with('user')->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('log_type', 'LIKE', "%{$keyword}%")
                ->orWhere('table_name', 'LIKE', "%{$keyword}%")
                ->orWhere('log_date', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = LogUserActivityResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $this->validate($request, [
            'table'  => 'nullable|string',
            'id'     => 'nullable|numeric',
            'log_id' => 'nullable|numeric'
        ]);

        $table = request('table');
        $id = request('id');
        $logId = request('log_id');

        $currentData = $table != null ? DB::table($table)->find($id) : false;

        if ($currentData) {
            $editHistory =
                LogUserActivity::orderBy('log_date', 'desc')
                ->whereNotIn('id', [$logId])
                ->where(['table_name' => $table, 'log_type' => 'edit'])
                ->get();
            return ['edit_history' => LogUserActivityResource::collection($editHistory)];
        }
        return [];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogUserActivity $logUserActivity)
    {
        $logUserActivity->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }
}
