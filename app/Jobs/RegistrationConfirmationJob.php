<?php

namespace App\Jobs;

use App\Mail\RegistrationConfirmationMail;
use App\Models\Enroll;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RegistrationConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $eid,$sid;
    /**
     * Create a new job instance.
     *
     * @param $eid
     * @param $sid
     */
    public function __construct($eid,$sid)
    {
       $this->eid = $eid;
       $this->sid = $sid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $enroll= Enroll::whereId($this->eid)->first();
        $student = Student::whereId($this->sid)->first();
        $email_id = $student->users()->latest()->first()->email;
        $email = new RegistrationConfirmationMail($enroll->programme->name,$student->full_name,$enroll->getRefNo());
        Mail::to($email_id)->send($email);
    }
}
