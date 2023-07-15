<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MobileVersion\StoreMobileVersionRequest;
use App\Http\Requests\v1\MobileVersion\UpdateMobileVersionRequest;
use App\Http\Resources\v1\MobileVersionResource;
use App\Models\v1\MobileVersion;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;

class MobileVersionController extends Controller
{
    use ApiResponseHelpers;

    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/ibr-app-file');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = MobileVersion::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = MobileVersionResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMobileVersionRequest $request)
    {
        $file = $request->file('file');
        $fileName = 'indo-bharat-rayon-' . $request->code . '-' . $request->name . '.' . $file->getClientOriginalExtension();
        $data = DB::transaction(function () use ($request, $fileName, $file) {
            $this->getAppUrl($file, $fileName, null);
            $request->merge([
                'mobile_build_type_id' => $request->build,
                'mobile_device_type_id' => $request->device,
                'mobile_status_id' => $request->status,
                'app_file' => $fileName,
            ]);
            $query = MobileVersion::create($request->all());
            return new MobileVersionResource($query);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MobileVersion $mobileVersion)
    {
        return $this->respondWithSuccess([
            'data' => new MobileVersionResource($mobileVersion)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMobileVersionRequest $request, MobileVersion $mobileVersion)
    {
        $request->merge([
            'mobile_build_type_id' => $request->build,
            'mobile_device_type_id' => $request->device,
            'mobile_status_id' => $request->status,
        ]);
        $mobileVersion->slug = null;
        $mobileVersion->update($request->all());
        $data = new MobileVersionResource($mobileVersion);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MobileVersion $mobileVersion)
    {
        $check = MobileVersion::where('mobile_device_type_id', $mobileVersion->mobile_device_type_id)->count();
        if ($check > 1) {
            $mobileVersion->delete();
            return $this->respondWithSuccess([
                'message' => trans('alert.success-delete'),
            ]);
        }
        return $this->respondError(trans('alert.failed'));
    }

    public function restore($id)
    {
        MobileVersion::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        $query = MobileVersion::onlyTrashed()->whereId($id)->firstOrFail();
        $this->deleteApp($query->app_file);
        $query->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }

    public function getAppUrl($file, $fileName, $old)
    {
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path, 0775, true, true);
        }

        $file->move($this->path, $fileName);

        $this->deleteApp($old);

        return request()->getSchemeAndHttpHost() . '/storage/ibr-app-file/' . $fileName;
    }

    public function deleteApp($old)
    {
        $old_file = str_replace(request()->getSchemeAndHttpHost() . '/storage/ibr-app-file', '', $old);
        if (File::exists($this->path . '/' . $old_file)) {
            File::delete($this->path . '/' . $old_file);
        }
    }
}
