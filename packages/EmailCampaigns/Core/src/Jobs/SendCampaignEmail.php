<?php

namespace EmailCampaigns\Core\Jobs;

use EmailCampaigns\Core\Mail\CampaignMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendCampaignEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaignId;
    protected $customerId;
    protected $email;
    protected $subject;
    protected $body;

    /**
     * Create a new job instance.
     */
    public function __construct($campaignId, $customerId, $email, $subject, $body)
    {
        $this->campaignId = $campaignId;
        $this->customerId = $customerId;
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            // Send the email
            Mail::to($this->email)->send(new CampaignMail($this->subject, $this->body));
        } catch (\Exception $e) {
            // Log failure to Laravel log
            Log::error('Failed to send campaign email', [
                'campaign_id'   => $this->campaignId,
                'customer_id'   => $this->customerId,
                'email'         => $this->email,
                'error_message' => $e->getMessage(),
            ]);
        }
    }
}
