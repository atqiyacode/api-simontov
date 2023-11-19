<?php

namespace App\Http\Resources\Flowrate;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FlowrateMqttResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'flowrate' => $this->flowrate,
            'unit_flowrate' => $this->unit_flowrate,
            'totalizer_1' => $this->totalizer_1,
            'totalizer_2' => $this->totalizer_2,
            'totalizer_3' => $this->totalizer_3,
            'unit_totalizer' => $this->unit_totalizer,
            'analog_1' => $this->analog_1,
            'pressure' => $this->pressure,
            'status_battery' => $this->status_battery,
            'alarm' => $this->alarm,
            'bin_alarm' => $this->bin_alarm,
            'file_name' => $this->file_name,
            'ph' => $this->ph,
            'cod' => $this->cod,
            'cond' => $this->cond,
            'level' => $this->level,
            'do' => $this->do,

            'do_alarm_hi' => (bool)$this->do_alarm_hi,
            'do_alarm_lo' => (bool)$this->do_alarm_lo,
            'pres_alarm_hi' => (bool)$this->pres_alarm_hi,
            'pres_alarm_lo' => (bool)$this->pres_alarm_lo,
            'ph_alarm_hi' => (bool)$this->ph_alarm_hi,
            'ph_alarm_lo' => (bool)$this->ph_alarm_lo,

            'fm_status' => $this->fm_status,
            'fm_err_code' => $this->fm_err_code,

            'pln_stat' => (bool)$this->pln_stat,
            'panel_stat' => (bool)$this->panel_stat,
            'location_id' => $this->location_id,
            'mag_date' => Carbon::parse($this->mag_date)->format('m/d/Y, g:i:s A'),
        ];
    }
}
