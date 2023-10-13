<?php

namespace App\Jobs\v1;

use App\Events\v1\FlowrateEvent;
use App\Http\Resources\v1\FlowrateResource;
use App\Models\v1\Flowrate;
use Carbon\Carbon;
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
            'mag_date_time' => Carbon::parse($this->data['mag_date'])->timestamp,
            'flowrate' => $this->data['flowrate'],
            'unit_flowrate' => $this->data['unit_flowrate'],
            'totalizer_1' => $this->data['totalizer_1'],
            'totalizer_2' => $this->data['totalizer_2'],
            'totalizer_3' => $this->data['totalizer_3'],
            'unit_totalizer' => $this->data['unit_totalizer'],
            'analog_1' => $this->data['analog_1'],
            'analog_2' => $this->data['analog_2'],
            'status_battery' => $this->data['status_battery'],
            'alarm' => $this->data['alarm'],
            'bin_alarm' => $this->data['bin_alarm'],
            'file_name' => $this->data['file_name'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $data = new FlowrateResource($query);
        FlowrateEvent::dispatch([
            "message" => 'New Data',
            "data" => $data
        ]);
    }
}
