<?php

namespace Backend\Modules\PayHub\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Backend\Modules\PayHub\Models\BaseModels\Status;
use Backend\Modules\PayHub\Models\AcquiringResponse;

use Egorovwebservices\Payhub\Payhub;
use Egorovwebservices\Payhub\Models\Response;
use Egorovwebservices\Payhub\Enums\StatusEnum;

class CompleteNewResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private bool $need = true;
    private int $iteration = 0;
    private int $max_iterations = 30;

    private int $iteration_interval = 5;

    /* @var AcquiringResponse $Response */
    private Response $Response;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Response $Response)
    {
        $this->Response = $Response;
    }

    private function needIteration(): bool
    {
        return $this->iteration++ < $this->max_iterations
            && $this->need;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->attempts() > $this->max_iterations) {
            $this->Response->phErr(__LINE__, __FILE__, 'Response not completed');
            $this->delete();
        }

        $response = (new Payhub())->statePayment($this->Response->{$this->Response->getHashColumn()});
        $this->Response->phDbg(__LINE__, __FILE__, $response);

        if(empty($response)) $pay_status = StatusEnum::STATUS_WAIT;
        else $pay_status = $response->getFromData('status', StatusEnum::STATUS_WAIT);

        if($pay_status === StatusEnum::STATUS_WAIT) $this->release(Carbon::now()->addSeconds(5));

        $status = (new Status())->unserialize(json_encode($response->getData()));

        $stop = false;
        if($this->Response->getReceipt()) {
            $stop = $status->getStatus() === StatusEnum::STATUS_SUCCESS;
            if(! $stop) $stop = $status->getStatus() === StatusEnum::STATUS_CANCELED;
            if(! $stop) $stop = $status->getStatus() === StatusEnum::STATUS_ERROR;
        } else $this->release(Carbon::now()->addSeconds(5));

        if(! $stop) $this->release(Carbon::now()->addSeconds(5));
    }
}
