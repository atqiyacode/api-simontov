<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Client\ClientCompanyInformationResource;
use App\Http\Resources\v1\Client\ClientHomeMenuResource;
use App\Http\Resources\v1\Client\ClientHomeSliderResource;
use App\Http\Resources\v1\Client\ClientLoginHistoryResource;
use App\Http\Resources\v1\MobileStatusResource;
use App\Models\v1\CompanyInformation;
use App\Models\v1\HomeSlider;
use App\Models\v1\LogUserActivity;
use App\Models\v1\MobileAppMenu;
use App\Models\v1\MobileStatus;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientMobileController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function mobileStatus()
    {
        $query = Cache::remember('mobileStatus', config('app.cache_time'), function () {
            return MobileStatus::all();
        });
        $data = MobileStatusResource::collection($query);
        return $this->respondWithSuccess($data);
    }

    public function mobileAppMenu()
    {
        $query = Cache::remember('mobileAppMenu', config('app.cache_time'), function () {
            return MobileAppMenu::whereHas('status', function ($query) {
                return $query->active()->orderBy('name', 'ASC');
            })
                ->get();
        });
        $data = ClientHomeMenuResource::collection($query);
        return $this->respondWithSuccess($data);
    }

    public function homeSlider()
    {
        $query = Cache::remember('homeSlider', config('app.cache_time'), function () {
            return HomeSlider::isActive()->orderBy('updated_at', 'DESC')->get();
        });
        $data = ClientHomeSliderResource::collection($query);
        return $this->respondWithSuccess($data);
    }

    public function companyInformation()
    {
        $query = Cache::remember('companyInformation', config('app.cache_time'), function () {
            return CompanyInformation::isActive()->orderBy('updated_at', 'DESC')->get();
        });
        $data = ClientCompanyInformationResource::collection($query);
        return $this->respondWithSuccess($data);
    }

    public function loginHistory()
    {
        $query = LogUserActivity::currentUser()
            ->where('log_type', 'login')
            ->orderBy('id', 'DESC')
            ->paginate();
        $data = ClientLoginHistoryResource::collection($query);
        return $data;
    }
}
