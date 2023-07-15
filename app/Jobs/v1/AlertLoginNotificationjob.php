<?php

namespace App\Jobs\v1;

use App\Models\v1\PersonalNotificationUser;
use App\Models\v1\UserFirebaseToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kutia\Larafirebase\Facades\Larafirebase;
use Browser;
use Carbon\Carbon;

class AlertLoginNotificationjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id, $data, $code;

    /**
     * Create a new job instance.
     */
    public function __construct($id, $data, $code)
    {
        $this->id = $id;
        $this->data = $data;
        $this->code = $code;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $userFirebaseToken = UserFirebaseToken::where('user_id', $this->id)->get()->pluck('device_token');
        $device = Browser::parse($this->data);
        $title = trans('alert.attempt_login_via', ['platform' => $device->deviceFamily() . ' - ' . $device->deviceModel()]);
        $message = Carbon::now()->isoFormat('LLLL') . ' - ' . trans('alert.your_otp_code', ['code' => $this->code]);
        // push to message
        PersonalNotificationUser::create([
            'label' => $title,
            'message' => $message,
            'user_id' => $this->id,
            'data' => json_encode([
                'device' => $device,
                'title' => $title,
                'message' => $message,
            ])
        ]);
        foreach ($userFirebaseToken as $key => $device_token) {
            if ($device_token) {
                try {
                    // push fcm notification
                    return Larafirebase::withTitle($title)
                        ->withBody($message)
                        ->withPriority('normal')
                        ->withAdditionalData([
                            'code' => $this->code
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
