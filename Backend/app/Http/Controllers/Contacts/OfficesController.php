<?php

namespace Backend\Http\Controllers\Contacts;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Contacts\StoreContactsOfficesHandler;
use Backend\Http\Requests\Contacts\CountriesRequest;
use Backend\Http\Requests\Contacts\OfficesRequest;
use Backend\Models\Contacts\Countries;
use Backend\Models\Contacts\Offices;
use Backend\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class OfficesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('contacts');

        return view('pages.contacts.offices.index', [
            'model' => $model,
            'items' => Offices::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pages $pages)
    {

        $model = $pages->findOrFail('contacts');

        return view('pages.contacts.offices.form', [
            'model' => $model,
            'countries' => Countries::all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficesRequest $request, StoreContactsOfficesHandler $handler, Offices $offices)
    {

        if ($offices = $handler->process($request)) :

            return redirect()->route('contacts.offices.edit', $offices)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pages $pages)
    {

        $model = $pages->findOrFail('contacts');

        return view('pages.contacts.offices.form', [
            'model' => $model,
            'item' => Offices::find($request->offices),
            'countries' => Countries::all(),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offices $offices)
    {

        if ($offices->delete()) :
            return redirect()->route('contacts.countries.index');
        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficesRequest $request, StoreContactsOfficesHandler $handler, Offices $offices)
    {

        if ($offices = $handler->process($request, $offices)) :

            return redirect()->route('contacts.offices.edit', $offices)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
