<?php

namespace App\Jobs\v1;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FirebaseNotificationjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $userFirebaseToken = UserFirebaseToken::where('user_id', $this->id)->get()->pluck('device_token');

        foreach ($userFirebaseToken as $key => $device_token) {
            if ($device_token) {
                try {
                    return Larafirebase::withTitle('Percobaan Login')
                        ->withBody("apakah ini anda?")
                        ->withPriority('normal')
                        ->withAdditionalData([
                            'data' => "apakah ini anda?"
                        ])
                        ->sendNotification($device_token);
                } catch (\Exception $e) {
                    report($e);
                    return response()->json(trans('alert.failed'), 400);
                }
            }
        }
    }
}
