<?php

namespace App\Http\Controllers\Api\v1\Config;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\FailedJobResource;
use App\Http\Resources\v1\JobQueueResource;
use App\Models\v1\FailedJob;
use App\Models\v1\JobQueue;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Artisan;

class JobQueueController extends Controller
{
    use ApiResponseHelpers;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = JobQueue::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('payload', 'LIKE', "%{$keyword}%")
                ->orWhere('queue', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = JobQueueResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    public function failedJob(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = FailedJob::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('uuid', 'LIKE', "%{$keyword}%")
                ->orWhere('queue', 'LIKE', "%{$keyword}%")
                ->orWhere('payload', 'LIKE', "%{$keyword}%")
                ->orWhere('connection', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = FailedJobResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobQueue $queue)
    {
        $queue->delete();
        return $this->respondOk('Data deleted successfully');
    }

    public function deleteFailedJob($id)
    {
        $failed = FailedJob::findOrFail($id);
        $failed->delete();
        return $this->respondOk('Data deleted successfully');
    }

    public function killJob()
    {
        Artisan::call('queue:clear');
    }

    public function flushJob()
    {
        Artisan::call('queue:flush');
    }

    public function retryJob()
    {
        Artisan::call('queue:retry all');
    }
}
