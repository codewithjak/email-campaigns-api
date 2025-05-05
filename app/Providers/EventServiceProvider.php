<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // You can add other event listeners here
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Log when a job is processed
        Event::listen(JobProcessed::class, function (JobProcessed $event) {
            Log::info('Job processed', [
                'job' => get_class($event->job),
                'data' => $event->job->payload(),
            ]);
        });

        // Log when a job fails
        Event::listen(JobFailed::class, function (JobFailed $event) {
            Log::error('Job failed', [
                'job' => get_class($event->job),
                'exception' => $event->exception->getMessage(),
            ]);
        });
    }
}
