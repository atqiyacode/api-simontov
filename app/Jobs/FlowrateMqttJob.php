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
        Flowrate::create([
            'mag_date' => $this->data['mag_date'] ?? null,
            'flowrate' => $this->data['flowrate'] ?? null,
            'unit_flowrate' => $this->data['unit_flowrate'] ?? null,
            'totalizer_1' => $this->data['totalizer_1'] ?? null,
            'totalizer_2' => $this->data['totalizer_2'] ?? null,
            'totalizer_3' => $this->data['totalizer_3'] ?? null,
            'unit_totalizer' => $this->data['unit_totalizer'] ?? null,
            'analog_1' => $this->data['analog_1'] ?? null,
            'pressure' => $this->data['pressure'] ?? null,
            'status_battery' => $this->data['status_battery'] ?? null,
            'alarm' => $this->data['alarm'] ?? null,
            'bin_alarm' => $this->data['bin_alarm'] ?? null,
            'file_name' => $this->data['file_name'] ?? null,
            'ph' => $this->data['ph'] ?? null,
            'cod' => $this->data['cod'] ?? null,
            'cond' => $this->data['cond'] ?? null,
            'level' => $this->data['level'] ?? null,
            'do' => $this->data['do'] ?? null,

            'do_alarm_hi' => (bool) ($this->data['do_alarm_hi'] ?? false),
            'do_alarm_lo' => (bool) ($this->data['do_alarm_lo'] ?? false),
            'pres_alarm_hi' => (bool) ($this->data['pres_alarm_hi'] ?? false),
            'pres_alarm_lo' => (bool) ($this->data['pres_alarm_lo'] ?? false),
            'ph_alarm_hi' => (bool) ($this->data['ph_alarm_hi'] ?? false),
            'ph_alarm_lo' => (bool) ($this->data['ph_alarm_lo'] ?? false),

            'fm_status' => $this->data['fm_status'] ?? null,
            'fm_err_code' => $this->data['fm_err_code'] ?? null,

            'pln_stat' => (bool) ($this->data['pln_stat'] ?? false),
            'panel_stat' => (bool) ($this->data['panel_stat'] ?? false),

            'location_id' => $this->data['loc_id'],

            'log_data' => json_encode($this->data),

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // $data = new FlowrateMqttResource($query);
        // FlowrateEvent::dispatch([
        //     "message" => 'New Data',
        //     "data" => $data,
        // ]);
    }
}
