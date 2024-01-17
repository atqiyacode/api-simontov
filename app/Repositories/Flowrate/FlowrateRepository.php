<?php

namespace App\Repositories\Flowrate;

use LaravelEasyRepository\Repository;

interface FlowrateRepository extends Repository
{

    public function getAll();
    public function getPaginate();
    public function findById($id);
    public function restore($id);
    public function forceDelete($id);
    public function destroyMultiple($ids);
    public function restoreMultiple($ids);
    public function forceDeleteMultiple($ids);
    public function findByLocation($locationId, $start, $end);
    public function findByLocationPaginate($locationId, $start, $end);

    public function export($format);
    public function exportFilterDate($format);
}
