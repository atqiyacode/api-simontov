<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardChart\CreateDashboardChartRequest;
use App\Http\Requests\DashboardChart\UpdateDashboardChartRequest;
use App\Http\Resources\DashboardChart\DashboardChartResource;
use App\Models\DashboardChart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;

class DashboardChartController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection 
    {
        $dashboardCharts = DashboardChart::useFilters()->dynamicPaginate();

        return DashboardChartResource::collection($dashboardCharts);
    }

    public function store(CreateDashboardChartRequest $request): JsonResponse
    {
        $dashboardChart = DashboardChart::create($request->validated());

        return $this->responseCreated('DashboardChart created successfully', new DashboardChartResource($dashboardChart));
    }

    public function show(DashboardChart $dashboardChart): JsonResponse
    {
        return $this->responseSuccess(null, new DashboardChartResource($dashboardChart));
    }

    public function update(UpdateDashboardChartRequest $request, DashboardChart $dashboardChart): JsonResponse
    {
        $dashboardChart->update($request->validated());

        return $this->responseSuccess('DashboardChart updated Successfully', new DashboardChartResource($dashboardChart));
    }

    public function destroy(DashboardChart $dashboardChart): JsonResponse
    {
        $dashboardChart->delete();

        return $this->responseDeleted();
    }

}
