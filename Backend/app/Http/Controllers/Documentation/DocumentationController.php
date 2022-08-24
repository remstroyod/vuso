<?php

namespace Backend\Http\Controllers\Documentation;

use Backend\Http\Controllers\Controller;
use Illuminate\View\View;

class DocumentationController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:documentation_access');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {

        return view('pages.documentation.index');

    }

}
