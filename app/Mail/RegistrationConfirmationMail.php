<?php

namespace App\Mail;

use App\Models\Enroll;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $programme,$name,$ref_no;

    /**
     * Create a new message instance.
     * @param $programme
     * @param $name
     * @param $ref_no
     */
    public function __construct($programme,$name,$ref_no)
    {
        $this->programme = $programme;
        $this->name = $name;
        $this->ref_no = $ref_no;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[#'.$this->ref_no.'] Notification of Online Registration ')
            ->markdown('mail.registration_confirmation')
            ->with([
                'programme' => $this->programme,
                'name'=>$this->name,
                'ref_no'=>$this->ref_no
            ]);
    }
}
