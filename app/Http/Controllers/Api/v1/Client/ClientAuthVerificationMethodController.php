<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Client\ClientAuthVerificationMethodResource;
use App\Models\v1\AuthVerificationMethod;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientAuthVerificationMethodController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        $query = AuthVerificationMethod::where('status', 1)
            ->orderBy('id', 'DESC')->get();

        $data = ClientAuthVerificationMethodResource::collection($query);
        return $data;
    }
}
