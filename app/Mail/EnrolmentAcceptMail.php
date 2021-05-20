<?php

namespace App\Mail;

use App\Models\Enroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrolmentAcceptMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $enroll;
    private $message;

    /**
     * Create a new message instance.
     *
     * @param Enroll $enroll
     * @param $message
     */
    public function __construct(Enroll $enroll,$message)
    {
        $this->enroll = $enroll;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('['.$this->enroll->getRefNo().'] Status of Online Enrolment')
            ->markdown('mail.enrollment_accept')
            ->with([
                'enroll' => $this->enroll,
                'message'=>$this->message
            ]);
    }
}
