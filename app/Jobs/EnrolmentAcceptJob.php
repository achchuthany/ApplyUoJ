<?php

namespace App\Jobs;

use App\Mail\EnrolmentAcceptMail;
use App\Models\Enroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnrolmentAcceptJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $enroll_id,$email_message;
    /**
     * Create a new job instance.
     *
     * @param $enroll_id
     * @param $email_message
     */
    public function __construct($enroll_id,$email_message)
    {
        $this->email_message = $email_message;
        $this->enroll_id = $enroll_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $enroll = Enroll::whereId($this->enroll_id)->first();
        $email = new EnrolmentAcceptMail($enroll,$this->email_message);
        Mail::to($enroll->student->email)->send($email);
    }
}
