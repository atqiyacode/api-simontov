<?php

namespace App\Http\Resources\Flowrate;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FlowrateExportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'location_id' => $this->location_id,
            'flowrate' => $this->flowrate,
            'mag_date' => dateTimeFormat($this->mag_date),
            'flowrate' => $this->flowrate . ' m3/h',
            'totalizer_1' => $this->totalizer_1 . ' m3',
            'totalizer_2' => $this->totalizer_2 . ' m3',
            'totalizer_3' => $this->totalizer_3 . ' m3',
            'analog_1' => $this->analog_1,
            'pressure' => $this->pressure,
            'status_battery' => $this->status_battery,
            'alarm' => $this->alarm,
            'bin_alarm' => (string) $this->bin_alarm,
            'file_name' => $this->file_name,
            'ph' => $this->ph,
            'cod' => $this->cod,
            'cond' => $this->cond,
            'level' => $this->level,
        ];
    }
}
