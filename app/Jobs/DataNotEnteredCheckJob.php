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

class DataNotEnteredCheckJob implements ShouldQueue
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
            'alert_notification_type_id' => 1
        ];

        // Logic to send notification if no data is entered in the last 3 minutes
        $threeMinutesAgo = now()->subMinutes(3);

        $dataEntries = Flowrate::where('location_id', $this->data['location_id'])->where('mag_date', '>=', $threeMinutesAgo)->count();

        if ($dataEntries === 0) {
            $query = LocationNotification::updateOrCreate($params, $params);
            $query->message = 'Data Not in 3 minutes';
            $query->update();
        }
    }
}
