<?php

namespace App\Exports;

use App\Http\Resources\Flowrate\FlowrateExportResource;
use App\Models\Flowrate;
use Maatwebsite\Excel\Concerns\FromCollection;

class FlowrateExport implements FromCollection
{
    protected $locationId;

    public function __construct($locationId)
    {
        $this->locationId = $locationId;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query =  Flowrate::with(['location'])
            ->when($this->locationId, function ($query) {
                $query->where('location_id', $this->locationId);
            })
            ->useFilters()
            ->get();

        return FlowrateExportResource::collection($query);
    }
}
