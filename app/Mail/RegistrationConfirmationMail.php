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
    protected $programme,$name;

    /**
     * Create a new message instance.
     * @param $programme
     * @param $name
     */
    public function __construct($programme,$name)
    {
        $this->programme = $programme;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('['.config('app.name').'] Notification of Online Registration ')
            ->markdown('mail.registration_confirmation')
            ->with([
                'programme' => $this->programme,
                'name'=>$this->name
            ]);
    }
}
