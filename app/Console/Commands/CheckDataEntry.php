<?php

namespace App\Console\Commands;

use App\Events\LocationNotificationEvent;
use App\Http\Resources\LocationNotification\LocationNotificationResource;
use App\Models\Flowrate;
use App\Models\Location;
use App\Models\LocationNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckDataEntry extends Command
{
    protected $signature = 'check:flowrate';

    protected $description = 'Check Totalizer if data not inserted on 3 minutes';

    public function handle()
    {
        $locations = Location::all();

        foreach ($locations as $location) {
            $params = [
                'location_id' => $location->id,
                'alert_notification_type_id' => 1
            ];

            $threeMinutesAgo = Carbon::now()->subMinutes(3);

            $dataEntries = Flowrate::where('location_id', $location->id)->where('mag_date', '>=', $threeMinutesAgo)->count();

            if ($dataEntries > 0) {
                LocationNotification::updateOrCreate($params, ['message' => 'no data entered in the last 3 minutes']);
            } else {
                try {
                    $data = LocationNotification::where($params)->firstOrFail();
                    LocationNotificationEvent::dispatch(new LocationNotificationResource($data));
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                    // Handle the case when no record is found
                }

                LocationNotification::where($params)->delete();
            }
        }
    }
}
