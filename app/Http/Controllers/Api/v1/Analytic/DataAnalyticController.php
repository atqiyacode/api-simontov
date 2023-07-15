<?php

namespace App\Http\Controllers\Api\v1\Analytic;

use App\Http\Controllers\Controller;
use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class DataAnalyticController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        $data = [
            'userCount' => User::active()->count(),
        ];

        return $this->respondWithSuccess($data);
    }
}
