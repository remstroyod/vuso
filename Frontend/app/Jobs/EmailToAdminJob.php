<?php

namespace Frontend\Jobs;

use Frontend\Notifications\FormsAdminNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class EmailToAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->model = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Notification::route('mail', 'remstroyod@gmail.com')
            ->notify(new FormsAdminNotification($this->model));

    }
}
