<?php

namespace Backend\Modules\PayHub\Http\Controllers;

use Backend\Http\Controllers\Controller;
use Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum;
use Backend\Modules\PayHub\Models\PayHubLog;
use Illuminate\Http\Request;

class PayHubController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:modules_payhub_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PayHubLog $log)
    {

        $logs = $log->orderBy('id', 'desc')->take(10)->get();
        $paid = $log->orderBy('id', 'desc')->where('status', PayHubPaymentStatusEnum::paid)->take(10)->get();

        return view('PayHub::index', [
            'logs' => $logs,
            'paid' => $paid,
        ]);
    }
}
