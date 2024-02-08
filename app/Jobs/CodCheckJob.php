<?php

namespace App\Jobs;

use App\Models\LocationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CodCheckJob implements ShouldQueue
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
            'alert_notification_type_id' => 3
        ];
        if (!empty($this->data['cod']) && $this->data['cod'] != 'N/A' && $this->data['cod'] > 90) {
            LocationNotification::updateOrCreate($params, ['message' => 'COD value over 90 mg/l']);
        } else {
            LocationNotification::where($params)->delete();
        }
    }
}
