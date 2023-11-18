<?php

namespace App\Http\Resources\Flowrate;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FlowrateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'location_id' => $this->location_id,
            'location' => $this->location,
            'flowrate' => floatval($this->flowrate),
            'mag_date' => Carbon::parse($this->mag_date)->format('m/d/Y, g:i:s A'),
            'unit_flowrate' => $this->unit_flowrate,
            'totalizer_1' => floatval($this->totalizer_1),
            'totalizer_2' => floatval($this->totalizer_2),
            'totalizer_3' => floatval($this->totalizer_3),
            'unit_totalizer' => $this->unit_totalizer,
            'analog_1' => floatval($this->analog_1),
            'pressure' => floatval($this->pressure),
            'status_battery' => floatval($this->status_battery),
            'alarm' => $this->alarm,
            'bin_alarm' => $this->bin_alarm,
            'file_name' => $this->file_name,
            'ph' => floatval($this->ph),
            'cod' => floatval($this->cod),
            'cond' => floatval($this->cond),
            'level' => floatval($this->level),

            'created_at' => Carbon::parse($this->created_at)->format('m/d/Y, g:i:s A'),
            'updated_at' => dateTimeFormat($this->updated_at),
            'trashed' => $this->when(auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
