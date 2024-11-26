<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $programme,$name,$ref_no,$academic_year,$faculty,$account_number,$amount,$close_date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ref_no,$name,$programme,$academic_year,$faculty,$account_number,$amount,$close_date)
    {
        $this->programme = $programme;
        $this->name = $name;
        $this->ref_no = $ref_no;
        $this->academic_year = $academic_year;
        $this->faculty = $faculty;
        $this->account_number = $account_number;
        $this->amount = $amount;
        $this->close_date = $close_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('['.$this->ref_no.'] Online Enrolment - University of Jaffna')
                ->markdown('mail.welcome_email')
                ->with([
                    'programme' => $this->programme,
                    'name'=>$this->name,
                    'academic_year'=>$this->academic_year,
                    'faculty'=>$this->faculty,
                    'account_number'=>$this->account_number,
                    'amount'=>$this->amount,
                    'close_date'=>$this->close_date,
                ]);
    }
}
