<?php

namespace Backend\Modules\PayHub\Http\Controllers;

use Backend\Http\Controllers\Controller;
use Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum;
use Backend\Modules\PayHub\Models\PayHubLog;
use Illuminate\Http\Request;

class PayHubLogsController extends Controller
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

        $logs = $log->orderBy('id', 'desc')->paginate(20);

        return view('PayHub::logs.index', [
            'logs' => $logs,
        ]);
    }
}
