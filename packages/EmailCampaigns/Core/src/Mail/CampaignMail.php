<?php

namespace EmailCampaigns\Core\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $bodyContent;
    public $customerId;

    public function __construct($subjectLine, $bodyContent, $customerId = null)
    {
        $this->subjectLine = $subjectLine;
        $this->bodyContent = $bodyContent;
        $this->customerId = $customerId;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
        ->view('emailcampaigns::emails.campaign')
        ->with([
            'body' => $this->bodyContent,
            'customerId' => $this->customerId,
        ]);
    }
}
