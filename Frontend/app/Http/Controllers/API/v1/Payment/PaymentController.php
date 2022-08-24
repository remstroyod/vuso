<?php
namespace Frontend\Http\Controllers\API\v1\Payment;

use Frontend\Http\Controllers\Controller;
use Frontend\Http\Requests\Payment\PaymentCheckContractRequest;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function payment(PaymentCheckContractRequest $request): JsonResponse
    {
        return (new \Frontend\Http\Controllers\PaymentController())->checkContract($request);
    }

    public function orderStatus(EdocumentUser $contract)
    {

        return (new \Frontend\Http\Controllers\PaymentController())->orderStatus($contract);
    }

    public function getReceipt(EdocumentUser $contract)
    {
        return (new \Frontend\Http\Controllers\PaymentController())->getReceipt($contract);
    }

    public function orderContractShare(EdocumentUser $contract)
    {
        return (new \Frontend\Http\Controllers\PaymentController())->orderContractShare($contract);
    }

}
