<?php

namespace App\Mail;

use App\Models\Enroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrolmentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $enroll;
    /**
     * Create a new message instance.
     *
     * @param Enroll $enroll
     */
    public function __construct(Enroll $enroll)
    {
        $this->enroll = $enroll;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('['.$this->enroll->getRefNo().'] Confirmation of Enrolment ')
            ->markdown('mail.enrollment_confirmation')
            ->with([
                'enroll' => $this->enroll,
            ]);
    }
}
