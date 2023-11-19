<?php

namespace App\Jobs;

use App\Events\FlowrateEvent;
use App\Http\Resources\Flowrate\FlowrateMqttResource;
use App\Models\Flowrate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FlowrateMqttJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $query = Flowrate::create([
            'mag_date' => $this->data['mag_date'],
            'flowrate' => $this->data['flowrate'],
            'unit_flowrate' => $this->data['unit_flowrate'],
            'totalizer_1' => $this->data['totalizer_1'],
            'totalizer_2' => $this->data['totalizer_2'],
            'totalizer_3' => $this->data['totalizer_3'],
            'unit_totalizer' => $this->data['unit_totalizer'],
            'analog_1' => $this->data['analog_1'],
            'pressure' => $this->data['pressure'],
            'status_battery' => $this->data['status_battery'],
            'alarm' => $this->data['alarm'],
            'bin_alarm' => $this->data['bin_alarm'],
            'file_name' => $this->data['file_name'],
            'ph' => $this->data['ph'],
            'cod' => $this->data['cod'],
            'cond' => $this->data['cond'],
            'level' => $this->data['level'],
            'do' => $this->data['do'],

            'do_alarm_hi' => $this->data['do_alarm_hi'],
            'do_alarm_lo' => $this->data['do_alarm_lo'],
            'pres_alarm_hi' => $this->data['pres_alarm_hi'],
            'pres_alarm_lo' => $this->data['pres_alarm_lo'],
            'ph_alarm_hi' => $this->data['ph_alarm_hi'],
            'ph_alarm_lo' => $this->data['ph_alarm_lo'],

            'fm_status' => $this->data['fm_status'],
            'fm_err_code' => $this->data['fm_err_code'],

            'pln_stat' => $this->data['pln_stat'],
            'panel_stat' => $this->data['panel_stat'],

            'location_id' => $this->data['loc_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $data = new FlowrateMqttResource($query);
        FlowrateEvent::dispatch([
            "message" => 'New Data',
            "data" => $data,
        ]);
    }
}
