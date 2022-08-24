<?php

namespace Backend\Http\Controllers;

use Gabievi\Promocodes\Facades\Promocodes;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
}
