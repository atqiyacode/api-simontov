<?php

namespace App\Http\Resources\v1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlowrateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'mag_date' => Carbon::parse($this->mag_date)->isoFormat('LLL'),
            'mag_date_time' => $this->mag_date_time,
            'flowrate' => $this->flowrate . ' m3/h',
            'unit_flowrate' => $this->unit_flowrate,
            'totalizer_1' => $this->totalizer_1 . ' m3',
            'totalizer_2' => $this->totalizer_2 . ' m3',
            'totalizer_3' => $this->totalizer_3 . ' m3',
            'unittotalizer' => $this->unittotalizer,
            'analog_1' => $this->analog_1,
            'analog_2' => $this->analog_2,
            'status_battery' => $this->status_battery,
            'alarm' => $this->alarm,
            'bin_alarm' => $this->bin_alarm,
            'file_name' => $this->file_name,
        ];
    }
}
