<?php

use App\Http\Controllers\API\DashboardChartController;
use App\Http\Controllers\API\DownloadController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    /*===========================
    =           roles           =
    =============================*/

    Route::apiResource('/roles', RoleController::class)->parameters([
        'roles' => 'id'
    ]);

    Route::group([
        'prefix' => 'roles',
    ], function () {
        Route::get('{id}/restore', [RoleController::class, 'restore']);
        Route::delete('{id}/force-delete', [RoleController::class, 'forceDelete']);
        Route::post('destroy-multiple', [RoleController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [RoleController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [RoleController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [RoleController::class, 'export']);
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
        Route::get('{id}/restore', [PermissionController::class, 'restore']);
        Route::delete('{id}/force-delete', [PermissionController::class, 'forceDelete']);
        Route::post('destroy-multiple', [PermissionController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [PermissionController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [PermissionController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [PermissionController::class, 'export']);
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
        Route::get('{id}/restore', [UserController::class, 'restore']);
        Route::delete('{id}/force-delete', [UserController::class, 'forceDelete']);
        Route::post('destroy-multiple', [UserController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [UserController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [UserController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [UserController::class, 'export']);
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
        Route::get('{id}/restore', [LocationController::class, 'restore']);
        Route::delete('{id}/force-delete', [LocationController::class, 'forceDelete']);
        Route::post('destroy-multiple', [LocationController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [LocationController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [LocationController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [LocationController::class, 'export']);

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
        Route::get('{id}/restore', [StatusAlarmController::class, 'restore']);
        Route::delete('{id}/force-delete', [StatusAlarmController::class, 'forceDelete']);
        Route::post('destroy-multiple', [StatusAlarmController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [StatusAlarmController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [StatusAlarmController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [StatusAlarmController::class, 'export']);
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
        Route::get('{id}/restore', [TaxController::class, 'restore']);
        Route::delete('{id}/force-delete', [TaxController::class, 'forceDelete']);
        Route::post('destroy-multiple', [TaxController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [TaxController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [TaxController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [TaxController::class, 'export']);
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
        Route::get('{id}/restore', [RangeTypeController::class, 'restore']);
        Route::delete('{id}/force-delete', [RangeTypeController::class, 'forceDelete']);
        Route::post('destroy-multiple', [RangeTypeController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [RangeTypeController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [RangeTypeController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [RangeTypeController::class, 'export']);
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
        Route::get('{id}/restore', [RangeCostController::class, 'restore']);
        Route::delete('{id}/force-delete', [RangeCostController::class, 'forceDelete']);
        Route::post('destroy-multiple', [RangeCostController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [RangeCostController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [RangeCostController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [RangeCostController::class, 'export']);
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
        Route::get('{id}/restore', [FlowrateController::class, 'restore']);
        Route::delete('{id}/force-delete', [FlowrateController::class, 'forceDelete']);
        Route::post('destroy-multiple', [FlowrateController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [FlowrateController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [FlowrateController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [FlowrateController::class, 'export']);
        // others
        Route::get('{id}/range', [FlowrateController::class, 'range']);
        Route::get('{id}/billing', [FlowrateController::class, 'billing']);
        Route::get('{id}/filterDate', [FlowrateController::class, 'filterDate']);
        Route::get('{id}/filterDate/export/{format}', [FlowrateController::class, 'exportFilterDate']);
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
        Route::get('{id}/restore', [DashboardChartController::class, 'restore']);
        Route::delete('{id}/force-delete', [DashboardChartController::class, 'forceDelete']);
        Route::post('destroy-multiple', [DashboardChartController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [DashboardChartController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [DashboardChartController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [DashboardChartController::class, 'export']);
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
        Route::get('{id}/restore', [TopicController::class, 'restore']);
        Route::delete('{id}/force-delete', [TopicController::class, 'forceDelete']);
        Route::post('destroy-multiple', [TopicController::class, 'destroyMultiple']);
        Route::post('restore-multiple', [TopicController::class, 'restoreMultiple']);
        Route::post('force-delete-multiple', [TopicController::class, 'forceDeleteMultiple']);
        Route::get('export/{format}', [TopicController::class, 'export']);
    });

    /*=====  End of topics   ======*/

    Route::get('/invoice/{id}/range', [DownloadController::class, 'invoice']);
});
