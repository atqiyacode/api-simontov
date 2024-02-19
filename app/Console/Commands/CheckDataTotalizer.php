<?php

namespace App\Console\Commands;

use App\Models\Flowrate;
use App\Models\Location;
use App\Models\LocationNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckDataTotalizer extends Command
{
    protected $signature = 'check:totalizer';

    protected $description = 'Check Totalizer if data not change on 12 hours';

    public function handle()
    {
        $locations = Location::all();

        foreach ($locations as $key) {
            $beforeLastFlowrate = Flowrate::where('location_id', $key->id)->orderBy('mag_date', 'desc')->first();

            if (!$beforeLastFlowrate) {
                continue; // or handle the situation appropriately
            }

            $lastFlowrate = Flowrate::where([
                'location_id' => $key->id,
            ])
                ->where('mag_date', '<', Carbon::parse($beforeLastFlowrate->mag_date)->subHours(12)->toDateTimeString())
                ->orderBy('id', 'desc')
                ->first();

            // rest of your code...
            // dd(Carbon::parse($beforeLastFlowrate->mag_date)->subHours(12)->toDateTimeString());
            // dd($beforeLastFlowrate->id);
            // dd($lastFlowrate->id);


            $params = [
                'location_id' => $key->id,
                'alert_notification_type_id' => 2
            ];

            if ($beforeLastFlowrate->totalizer_1 === $lastFlowrate->totalizer_1) {
                LocationNotification::updateOrCreate($params, ['message' => 'The totalizer value does not change within 12 hours']);
            } else {
                LocationNotification::where($params)->forceDelete();
            }
        }
    }
}
