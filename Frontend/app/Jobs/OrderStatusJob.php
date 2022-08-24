<?php

namespace Frontend\Jobs;

use Backend\Models\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Integrations\Payhub;
use Frontend\Events\OrderStatusChanged;
use Carbon\Carbon;

use Egorovwebservices\Payhub\Enums\StatusEnum;
use Egorovwebservices\Payhub\Traits\Log as PayHubLog;

class OrderStatusJob implements ShouldQueue
{
    use PayHubLog;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public EdocumentUser $contract;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EdocumentUser $contract)
    {
        $this->contract = $contract;
    }

    protected function getPayHubLoggingSystem(): string
    {
        return '';
        return $this->contract->getPaymentData()->getPaySystemKey();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $status_message = 'error';

            $response = $this->contract->getPayHubService()->statePayment($this->contract->getTransactionHash());
            $this->phDbg(__LINE__, __FILE__, ['contract_id' => $this->contract->id, 'response' => $response]);

            info($this->contract->id);
            info(json_encode($response));

            if ($this->attempts() > config('constants.job.allowable_attempt', 24)) {
                $status_message = 'Payment is error';
                OrderStatusChanged::dispatch($this->contract, $status_message);

                $this->delete();
            }

            if(empty($response)) $pay_status = StatusEnum::STATUS_WAIT;
            else $pay_status = $response->getFromData('status', StatusEnum::STATUS_WAIT);

            if($pay_status === StatusEnum::STATUS_WAIT) {
                info('STATUS_WAIT');

                $this->phDbg(__LINE__, __FILE__, ['contract_id' => $this->contract->id, 'response' => $response, 'status' => 'wait']);
                $this->release(Carbon::now()->addSeconds(5));
            }

            if($pay_status === StatusEnum::STATUS_CANCELED) {
                info('STATUS_CANCELED');
                $status_message = 'Payment is canceled';
            }

            if($pay_status === StatusEnum::STATUS_SUCCESS) {
                info('STATUS_SUCCESS');
                $status_message = 'Payment is success';
            }

            if($pay_status === StatusEnum::STATUS_ERROR) {
                info('STATUS_ERROR');
                $status_message = 'Payment is error';
            }

            OrderStatusChanged::dispatch($this->contract, $status_message);
        } catch (\Throwable $exception) {
            $this->phExc($exception, __LINE__, __FILE__);
        }
    }
}
