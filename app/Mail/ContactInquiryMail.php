<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $filePath;
    public $fileName;

    /**
     * Create a new message instance.
     *
     * @param array $inquiry
     * @param string|null $filePath
     * @param string|null $fileName
     */
    public function __construct(array $inquiry, ?string $filePath = null, ?string $fileName = null)
    {
        $this->inquiry = $inquiry;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject('New Service Inquiry: ' . $this->inquiry['service'] . ' - ' . $this->inquiry['name'])
                     ->replyTo($this->inquiry['email'], $this->inquiry['name'])
                     ->view('emails.contact')
                     ->with(['inquiry' => $this->inquiry]);

        if ($this->filePath && file_exists($this->filePath)) {
            $mail->attach($this->filePath, [
                'as' => $this->fileName ?: basename($this->filePath),
            ]);
        }

        return $mail;
    }
}

