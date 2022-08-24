<?php

namespace Backend\Modules\PayHub\Http\Controllers;

use Backend\Http\Controllers\Controller;
use Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum;
use Backend\Modules\PayHub\Http\Handlers\StorePayHubSystemsHandler;
use Backend\Modules\PayHub\Http\Requests\PayHubSystemsRequest;
use Backend\Modules\PayHub\Models\PayHubLog;
use Backend\Modules\PayHub\Models\PayHubSystem;
use Illuminate\Http\Request;

class PayHubSystemsController extends Controller
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
    public function index(Request $request, PayHubSystem $system)
    {

        return view('PayHub::systems.index', [
            'items' => $system->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PayHubSystem $system)
    {

        return view('PayHub::systems.form', [
            'model' => $system,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PayHubSystem $system)
    {

        return view('PayHub::systems.form', [
            'model' => $system,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PayHubSystemsRequest $request, StorePayHubSystemsHandler $handler, PayHubSystem $system)
    {

        if ($system = $handler->process($request, $system)) :

            return redirect()->route('payhub.systems.edit', $system)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayHubSystemsRequest $request, StorePayHubSystemsHandler $handler, PayHubSystem $system)
    {

        if ($system = $handler->process($request)) :

            return redirect()->route('payhub.systems.edit', $system)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayHubSystem $system)
    {

        if ($system->delete()) :
            return redirect()->route('payhub.systems.index');
        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

}
