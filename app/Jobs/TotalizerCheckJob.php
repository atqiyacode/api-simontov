<?php

namespace App\Jobs;

use App\Models\Flowrate;
use App\Models\LocationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TotalizerCheckJob implements ShouldQueue
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
        $lastFlowrate = Flowrate::where('location_id', $this->data['location_id'])->orderBy('mag_date', 'desc')->first();
        $timeDifference = $lastFlowrate->mag_date->diffInHours(now());
        $params = [
            'location_id' => $this->data['location_id'],
            'alert_notification_type_id' => 2
        ];
        if ($timeDifference >= 12 && $this->data['totalizer_1'] === $lastFlowrate->totalizer_1) {
            $query = LocationNotification::updateOrCreate($params, $params);
            $query->message = 'The totalizer value does not change within 12 hours';
            $query->update();
        }
    }
}
