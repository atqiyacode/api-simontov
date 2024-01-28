<?php

namespace App\Jobs;

use App\Models\LocationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ElectricityCheckJob implements ShouldQueue
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
        $params = [
            'location_id' => $this->data['location_id'],
            'alert_notification_type_id' => 5
        ];
        if ($this->data['panel_stat'] && !$this->data['pln_stat']) {
            $query = LocationNotification::updateOrCreate($params, $params);
            $query->message = 'Electricity uses UPS';
            $query->update();
        } else {
            LocationNotification::where($params)->delete();
        }
    }
}
