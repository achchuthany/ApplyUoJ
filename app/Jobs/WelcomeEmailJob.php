<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $ref_no,$name,$email,$programme,$academic_year,$faculty,$account_number,$amount,$close_date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ref_no,$name,$email,$programme,$academic_year,$faculty,$account_number,$amount,$close_date)
    {
        $this->ref_no = $ref_no;
        $this->name = $name;
        $this->email = $email;
        $this->programme = $programme;
        $this->academic_year = $academic_year;
        $this->faculty = $faculty;
        $this->account_number = $account_number;
        $this->amount = $amount;
        $this->close_date = $close_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailMessage = new WelcomeEmail($this->ref_no,$this->name,$this->programme,$this->academic_year,$this->faculty,$this->account_number,$this->amount,$this->close_date);
        Mail::to($this->email)->send($emailMessage);
    }
}
