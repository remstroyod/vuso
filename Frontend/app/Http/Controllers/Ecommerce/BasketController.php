<?php

namespace Frontend\Http\Controllers\Ecommerce;

use Backend\Http\Controllers\Controller;
use Frontend\Models\Pages;

class BasketController extends Controller
{
    public function index(Pages $pages)
    {
        $model = $pages->findOrFail('basket');

        return view('pages.basket.index', [
            'page' => $model,
            'blocks' => $model->blocks,
        ]);

    }
}
