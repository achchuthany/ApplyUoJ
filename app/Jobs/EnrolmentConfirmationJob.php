<?php

namespace App\Jobs;

use App\Mail\EnrolmentConfirmationMail;
use App\Mail\RegistrationConfirmationMail;
use App\Models\Enroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnrolmentConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $eid;

    /**
     * Create a new job instance.
     *
     * @param $eid
     */
    public function __construct($eid)
    {
        $this->eid = $eid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $enroll = Enroll::whereId($this->eid)->first();
        $email = new EnrolmentConfirmationMail($enroll);
        Mail::to($enroll->student->email)->send($email);
    }
}
