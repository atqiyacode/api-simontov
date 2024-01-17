<?php

namespace App\Services\Flowrate;

use LaravelEasyRepository\BaseService;

interface FlowrateService extends BaseService
{

    public function getAll();
    public function getPaginate();
    public function findById($id);
    public function restore($id);
    public function forceDelete($id);
    public function destroyMultiple($ids);
    public function restoreMultiple($ids);
    public function forceDeleteMultiple($ids);
    public function getDataRange($locationId, $start, $end);
    public function getDataRangePaginate($locationId, $start, $end);

    public function export($format);
    public function exportFilterDate($format);
}
