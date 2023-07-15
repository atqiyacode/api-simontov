<?php

namespace App\Jobs\v1;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsappLoginNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
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
        $url = config('app.whatsapp_server_main') . '/messages/send';
        $body = [
            'jid' => $this->data['phone'],
            'message' => [
                'text' => $this->data['msg'],
            ]
        ];
        if (app()->isProduction()) {
            Http::post($url, $body);
        }
    }
}
