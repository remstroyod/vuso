<?php

namespace Frontend\Http\Controllers;

use Frontend\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{

    /**
     * @return void
     */
    public function index(Request $request)
    {

        app()->setLocale($request->{'locale'});
        session()->put('locale', $request->{'locale'});
        return redirect()->back();

    }

}
