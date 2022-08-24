<?php

namespace Backend\Http\Controllers\Contacts;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Contacts\StoreContactsCountriesHandler;
use Backend\Http\Requests\Contacts\CountriesRequest;
use Backend\Models\Contacts\Countries;
use Backend\Models\Pages;
use Illuminate\Http\Request;

class CountriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('contacts');

        return view('pages.contacts.countries.index', [
            'model' => $model,
            'items' => Countries::paginate()
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

        return view('pages.contacts.countries.form', [
            'model' => $model,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountriesRequest $request, StoreContactsCountriesHandler $handler, Countries $countries)
    {

        if ($countries = $handler->process($request)) :

            return redirect()->route('contacts.countries.edit', $countries)->with('message', __( 'Сохранено' ));

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

        return view('pages.contacts.countries.form', [
            'model' => $model,
            'item' => Countries::find($request->countries)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countries $countries)
    {

        if ($countries->delete()) :
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
    public function update(CountriesRequest $request, StoreContactsCountriesHandler $handler, Countries $countries)
    {

        if ($countries = $handler->process($request, $countries)) :

            return redirect()->route('contacts.countries.edit', $countries)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
