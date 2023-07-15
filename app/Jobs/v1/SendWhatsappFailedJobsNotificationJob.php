<?php

namespace App\Jobs\v1;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsappFailedJobsNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message;

    /**
     * Create a new job instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $privateAccess = User::role(['privateAccess'])->whereNotNull('phone')->pluck('phone')->toArray();

        foreach ($privateAccess as $key => $value) {
            $url = config('app.whatsapp_server_main') . '/messages/send';
            $body = [
                'jid' => $value,
                'message' => [
                    'text' => $this->message,
                ]
            ];
            if (app()->isProduction()) {
                Http::post($url, $body);
            }
        }
    }
}
