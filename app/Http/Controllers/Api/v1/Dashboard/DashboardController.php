<?php

namespace App\Http\Controllers\Api\v1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\v1\Flowrate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function battery(Request $request)
    {
        $flowrateBattery = Flowrate::orderBy('mag_date_time', 'asc')
            ->first();

        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $flowrateBattery->getBin()
        ]);
    }
}
