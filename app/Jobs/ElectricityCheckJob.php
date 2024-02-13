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
        if (!$this->data['pln_stat']) {
            // Check if the count of existing records with the specified params is less than 5
            LocationNotification::insert([
                'location_id' => $this->data['location_id'],
                'alert_notification_type_id' => 5,
                'message' => 'Electricity uses UPS',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if (LocationNotification::where($params)->count() > 5) {
                // Keep only the latest 5 records and delete the others
                $latestIds = LocationNotification::where($params)
                    ->latest('created_at')
                    ->take(5)
                    ->pluck('id');

                LocationNotification::where($params)
                    ->whereNotIn('id', $latestIds)
                    ->delete();
            }
        }
    }
}
