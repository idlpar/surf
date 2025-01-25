<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOtpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $otp;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $otp)
    {
        $this->email = $email;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subject = "Your OTP Code";
        $message = "Your OTP is: {$this->otp}\nThis code will expire in 5 minutes.";

        mail(
            $this->email,
            $subject,
            $message,
            "From: TARPOR | Shop Online, Save Time <info@tarpor.com>\r\n"
        );
    }
}
