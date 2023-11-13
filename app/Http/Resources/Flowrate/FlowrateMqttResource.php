<?php

namespace App\Http\Resources\Flowrate;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FlowrateMqttResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'mag_date' => Carbon::parse($this->mag_date)->isoFormat('LLL'),
            'flowrate' => $this->flowrate,
            'unit_flowrate' => $this->unit_flowrate,
            'totalizer_1' => $this->totalizer_1,
            'totalizer_2' => $this->totalizer_2,
            'totalizer_3' => $this->totalizer_3,
            'unit_totalizer' => $this->unit_totalizer,
            'analog_1' => $this->analog_1,
            'analog_2' => $this->analog_2,
            'status_battery' => $this->status_battery,
            'alarm' => $this->alarm,
            'bin_alarm' => $this->bin_alarm,
            'file_name' => $this->file_name,
            'ph' => $this->ph,
            'cod' => $this->cod,
            'cond' => $this->cond,
            'level' => $this->level,
            'location_id' => $this->location_id,
        ];
    }
}
