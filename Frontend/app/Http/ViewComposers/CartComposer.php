<?php
namespace Frontend\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartComposer
{

    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {

        $cart = Auth::check() ? \Cart::session(Auth::id())->getContent() : [];
        $total = Auth::check() ? \Cart::session(Auth::id())->getTotal() : 0;

        return $view->with([
            'cartContent' => $cart,
            'cartTotal' => $total,
        ]);

    }

}
