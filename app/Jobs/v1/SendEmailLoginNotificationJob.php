<?php

namespace App\Jobs\v1;

use App\Mail\v1\SendVerificationCodeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendEmailLoginNotificationJob implements ShouldQueue
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
        $email = new SendVerificationCodeMail($this->data);
        Mail::to($this->data['email'])->send($email);
    }

    public function failed(Throwable $exception)
    {
        $title = 'Login with Email Job';
        $message = '*WARNING !!! FAILED JOBS APPS*

' . $title . ' : *' . $this->data['user']['email'] . '*.

*' . config('app.name') . '*';

        if (app()->isProduction()) {
            SendWhatsappFailedJobsNotificationJob::dispatch($message);
        }
    }
}
