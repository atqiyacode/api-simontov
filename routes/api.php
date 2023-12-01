<?php

use App\Http\Controllers\API\DashboardChartController;
use App\Http\Controllers\API\FailedJobController;
use App\Http\Controllers\API\FlowrateController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\RangeCostController;
use App\Http\Controllers\API\RangeTypeController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\StatusAlarmController;
use App\Http\Controllers\API\TaxController;
use App\Http\Controllers\API\TopicController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserLogActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    /*===========================
    =           roles           =
    =============================*/

    Route::apiResource('/roles', RoleController::class)->parameters([
        'roles' => 'id'
    ]);

    Route::group([
        'prefix' => 'roles',
    ], function () {
        Route::post('{id}/restore', [RoleController::class, 'restore']);
        Route::delete('{id}/force-delete', [RoleController::class, 'forceDelete']);
        Route::post('destroy-multiple', [RoleController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [RoleController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [RoleController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [RoleController::class, 'exportCsv']);
        Route::get('export/pdf', [RoleController::class, 'exportPdf']);
        Route::get('export/excel', [RoleController::class, 'exportExcel']);
    });
    /*=====  End of roles   ======*/

    /*===========================
    =           permissions           =
    =============================*/

    Route::apiResource('/permissions', PermissionController::class)->parameters([
        'permissions' => 'id'
    ]);

    Route::group([
        'prefix' => 'permissions',
    ], function () {
        Route::post('{id}/restore', [PermissionController::class, 'restore']);
        Route::delete('{id}/force-delete', [PermissionController::class, 'forceDelete']);
        Route::post('destroy-multiple', [PermissionController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [PermissionController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [PermissionController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [PermissionController::class, 'exportCsv']);
        Route::get('export/pdf', [PermissionController::class, 'exportPdf']);
        Route::get('export/excel', [PermissionController::class, 'exportExcel']);
    });
    /*=====  End of permissions   ======*/

    /*===========================
    =           users           =
    =============================*/

    Route::apiResource('/users', UserController::class)->parameters([
        'users' => 'id'
    ]);

    Route::group([
        'prefix' => 'users',
    ], function () {
        Route::post('{id}/restore', [UserController::class, 'restore']);
        Route::delete('{id}/force-delete', [UserController::class, 'forceDelete']);
        Route::post('destroy-multiple', [UserController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [UserController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [UserController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [UserController::class, 'exportCsv']);
        Route::get('export/pdf', [UserController::class, 'exportPdf']);
        Route::get('export/excel', [UserController::class, 'exportExcel']);
    });

    /*=====  End of users   ======*/

    /*===========================
    =           locations           =
    =============================*/

    Route::apiResource('/locations', LocationController::class)->parameters([
        'locations' => 'id'
    ]);

    Route::group([
        'prefix' => 'locations',
    ], function () {
        Route::post('{id}/restore', [LocationController::class, 'restore']);
        Route::delete('{id}/force-delete', [LocationController::class, 'forceDelete']);
        Route::post('destroy-multiple', [LocationController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [LocationController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [LocationController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [LocationController::class, 'exportCsv']);
        Route::get('export/pdf', [LocationController::class, 'exportPdf']);
        Route::get('export/excel', [LocationController::class, 'exportExcel']);

        Route::get('myLocations', [LocationController::class, 'myLocations']);
    });
    /*=====  End of locations   ======*/

    /*===========================
    =           statusAlarms           =
    =============================*/

    Route::apiResource('/statusAlarms', StatusAlarmController::class)->parameters([
        'statusAlarms' => 'id'
    ]);

    Route::group([
        'prefix' => 'statusAlarms',
    ], function () {
        Route::post('{id}/restore', [StatusAlarmController::class, 'restore']);
        Route::delete('{id}/force-delete', [StatusAlarmController::class, 'forceDelete']);
        Route::post('destroy-multiple', [StatusAlarmController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [StatusAlarmController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [StatusAlarmController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [StatusAlarmController::class, 'exportCsv']);
        Route::get('export/pdf', [StatusAlarmController::class, 'exportPdf']);
        Route::get('export/excel', [StatusAlarmController::class, 'exportExcel']);
    });
    /*=====  End of statusAlarms   ======*/

    /*===========================
    =           taxes           =
    =============================*/

    Route::apiResource('/taxes', TaxController::class)->parameters([
        'taxes' => 'id'
    ]);

    Route::group([
        'prefix' => 'taxes',
    ], function () {
        Route::post('{id}/restore', [TaxController::class, 'restore']);
        Route::delete('{id}/force-delete', [TaxController::class, 'forceDelete']);
        Route::post('destroy-multiple', [TaxController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [TaxController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [TaxController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [TaxController::class, 'exportCsv']);
        Route::get('export/pdf', [TaxController::class, 'exportPdf']);
        Route::get('export/excel', [TaxController::class, 'exportExcel']);
    });
    /*=====  End of taxes   ======*/

    /*===========================
    =           rangeTypes           =
    =============================*/

    Route::apiResource('/rangeTypes', RangeTypeController::class)->parameters([
        'rangeTypes' => 'id'
    ]);

    Route::group([
        'prefix' => 'rangeTypes',
    ], function () {
        Route::post('{id}/restore', [RangeTypeController::class, 'restore']);
        Route::delete('{id}/force-delete', [RangeTypeController::class, 'forceDelete']);
        Route::post('destroy-multiple', [RangeTypeController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [RangeTypeController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [RangeTypeController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [RangeTypeController::class, 'exportCsv']);
        Route::get('export/pdf', [RangeTypeController::class, 'exportPdf']);
        Route::get('export/excel', [RangeTypeController::class, 'exportExcel']);
    });
    /*=====  End of rangeTypes   ======*/

    /*===========================
    =           rangeCosts           =
    =============================*/

    Route::apiResource('/rangeCosts', RangeCostController::class)->parameters([
        'rangeCosts' => 'id'
    ]);

    Route::group([
        'prefix' => 'rangeCosts',
    ], function () {
        Route::post('{id}/restore', [RangeCostController::class, 'restore']);
        Route::delete('{id}/force-delete', [RangeCostController::class, 'forceDelete']);
        Route::post('destroy-multiple', [RangeCostController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [RangeCostController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [RangeCostController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [RangeCostController::class, 'exportCsv']);
        Route::get('export/pdf', [RangeCostController::class, 'exportPdf']);
        Route::get('export/excel', [RangeCostController::class, 'exportExcel']);
    });
    /*=====  End of rangeCosts   ======*/

    /*===========================
    =           flowrates           =
    =============================*/

    Route::apiResource('/flowrates', FlowrateController::class)->parameters([
        'flowrates' => 'id'
    ]);

    Route::group([
        'prefix' => 'flowrates',
    ], function () {
        Route::post('{id}/restore', [FlowrateController::class, 'restore']);
        Route::delete('{id}/force-delete', [FlowrateController::class, 'forceDelete']);
        Route::post('destroy-multiple', [FlowrateController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [FlowrateController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [FlowrateController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [FlowrateController::class, 'exportCsv']);
        Route::get('export/pdf', [FlowrateController::class, 'exportPdf']);
        Route::get('export/excel', [FlowrateController::class, 'exportExcel']);
        Route::get('{id}/range', [FlowrateController::class, 'range']);
        Route::get('{id}/billing', [FlowrateController::class, 'billing']);
    });
    /*=====  End of flowrates   ======*/

    /*===========================
    =           failedJobs           =
    =============================*/

    Route::apiResource('/failedJobs', FailedJobController::class)->parameters([
        'failedJobs' => 'id'
    ]);

    /*=====  End of failedJobs   ======*/

    /*===========================
    =           userLogActivities           =
    =============================*/

    Route::apiResource('/userLogActivities', UserLogActivityController::class)->parameters([
        'userLogActivities' => 'id'
    ]);

    /*=====  End of userLogActivities   ======*/

    /*===========================
    =           dashboardCharts           =
    =============================*/

    Route::apiResource('/dashboardCharts', DashboardChartController::class)->parameters([
        'dashboardCharts' => 'id'
    ]);
    Route::group([
        'prefix' => 'dashboardCharts',
    ], function () {
        Route::post('{id}/restore', [DashboardChartController::class, 'restore']);
        Route::delete('{id}/force-delete', [DashboardChartController::class, 'forceDelete']);
        Route::post('destroy-multiple', [DashboardChartController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [DashboardChartController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [DashboardChartController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [DashboardChartController::class, 'exportCsv']);
        Route::get('export/pdf', [DashboardChartController::class, 'exportPdf']);
        Route::get('export/excel', [DashboardChartController::class, 'exportExcel']);
    });

    /*=====  End of dashboardCharts   ======*/

    /*===========================
    =           topics           =
    =============================*/

    Route::apiResource('/topics', TopicController::class)->parameters([
        'topics' => 'id'
    ]);
    Route::group([
        'prefix' => 'topics',
    ], function () {
        Route::post('{id}/restore', [TopicController::class, 'restore']);
        Route::delete('{id}/force-delete', [TopicController::class, 'forceDelete']);
        Route::post('destroy-multiple', [TopicController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [TopicController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [TopicController::class, 'forceDeleteMultiple']);
        Route::get('export/csv', [TopicController::class, 'exportCsv']);
        Route::get('export/pdf', [TopicController::class, 'exportPdf']);
        Route::get('export/excel', [TopicController::class, 'exportExcel']);
    });

    /*=====  End of topics   ======*/
});
