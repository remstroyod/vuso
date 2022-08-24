<?php
namespace Frontend\Http\Controllers;

use Frontend\Models\Contacts\Countries;
use Frontend\Models\Contacts\Offices;
use Frontend\Models\Pages;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('contacts');

        return view('pages.contacts.index', [
            'page'      => $model,
            'countries' => Countries::all(),
            'offices'   => Offices::all(),
            'blocks'    => $model->blocks->where('model', 'page'),
            'faqs'      => $model->faqs,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pages $pages, Countries $countries)
    {

        $model = $pages->findOrFail('contacts');

        return view('pages.contacts.index', [
            'page'      => $model,
            'countries' => Countries::all(),
            'offices'   => $countries->offices,
            'blocks'    => $model->blocks,
        ]);

    }

}
