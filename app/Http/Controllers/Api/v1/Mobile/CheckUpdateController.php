<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\AppMobileAppStore;
use App\Http\Resources\v1\AppMobileLatestVersionResource;
use App\Http\Resources\v1\AppMobilePlayStore;
use App\Http\Resources\v1\MaintenanceMobileResource;
use App\Http\Resources\v1\MajorUpdateMobileAppVersionResource;
use App\Http\Resources\v1\MinorUpdateMobileAppVersionResource;
use App\Http\Resources\v1\MobileAppServerStatusResource;
use App\Models\v1\MobileAppServerStatus;
use App\Models\v1\MobileVersion;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;

class CheckUpdateController extends Controller
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
    public function mobile(Request $request)
    {
        $currentBuild = $request->build;
        $currentVersion = $request->version;
        if ($request->has('type')) {
            $keyword = $request->type;
            $query = MobileVersion::whereHas('device', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('slug', 'LIKE', "%{$keyword}%");
            })
                ->whereHas('status', function ($q) {
                    $q->where('name', '!=', 'inactive');
                })
                ->orderBy('id', 'DESC')
                ->first();

            if ($query) {

                if ($query->status->name === 'maintenance') {
                    $data = new MaintenanceMobileResource($query);
                    return $this->respondWithSuccess($data);
                } else {
                    switch ($query->build->name) {
                        case 'release':
                            if ($query->code > $currentBuild) {
                                // need major update
                                $data = new MajorUpdateMobileAppVersionResource($query);
                            } elseif ($query->name != $currentVersion) {
                                // need minor update
                                $data = new MinorUpdateMobileAppVersionResource($query);
                            } else {
                                return $this->respondWithSuccess(new AppMobileLatestVersionResource($query));
                            }
                            return $this->respondWithSuccess($data);
                            break;
                        case 'debug':
                            if ($keyword === 'android') {
                                $data = new AppMobilePlayStore($query);
                            }
                            if ($keyword === 'ios') {
                                $data = new AppMobileAppStore($query);
                            }
                            return $this->respondWithSuccess($data);
                            break;

                        default:
                            return $this->respondWithSuccess(new AppMobileLatestVersionResource($query));
                            break;
                    }
                }
            }
            return $this->respondWithSuccess(new AppMobileLatestVersionResource($query));
        }
    }
    public function website(Request $request)
    {
        if ($request->has('type')) {
            $keyword = $request->type;
            $query = MobileVersion::whereHas('device', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('slug', 'LIKE', "%{$keyword}%");
            })
                ->whereHas('status', function ($q) {
                    $q->where('name', '!=', 'inactive');
                })
                ->orderBy('id', 'DESC')
                ->first();

            if ($query) {
                $data = null;
                if ($query->status->name === 'maintenance') {
                    $data = new MaintenanceMobileResource($query);
                    return $this->respondWithSuccess($data);
                } else {
                    switch ($keyword) {
                        case 'android':
                            $data = new AppMobilePlayStore($query);
                            break;
                        case 'ios':
                            $data = new AppMobileAppStore($query);
                            break;
                        default:
                            return $this->respondWithSuccess(new AppMobileLatestVersionResource($query));
                            break;
                    }
                    return $this->respondWithSuccess($data);
                }
            }
            return $this->respondWithSuccess(new AppMobileLatestVersionResource($query));
        }
    }

    public function download(Request $request)
    {
        if ($request->has('type')) {
            $keyword = $request->type;
            $query = MobileVersion::whereHas('device', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('slug', 'LIKE', "%{$keyword}%");
            })
                ->whereHas('status', function ($q) {
                    $q->where('name', '!=', 'inactive');
                })
                ->orderBy('id', 'DESC')
                ->first();

            return response()->download($this->path . '/' . $query->app_file);
        }
    }

    public function mobileAppServerStatus()
    {
        $mobileAppServerStatus = MobileAppServerStatus::firstOrFail();
        return $this->respondWithSuccess([
            'is_maintenance' => $mobileAppServerStatus->status === 'online' ? false : true,
            'msg' => $mobileAppServerStatus->status === 'online' ? 'online' : [
                'title' => trans('alert.app_maintenance'),
                'message' => trans('alert.app_maintenance_message'),
            ],
        ]);
    }
}
