<?php

namespace Frontend\Http\Controllers\Cart;

use Frontend\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {

            $user = $request->user();

            if( $request->has('item') )
            {

                \Cart::session($user->id)->remove($request->item);

                if( \Cart::session($user->id)->isEmpty() )
                {
                    \Cart::session($user->id)->clearCartConditions(); // Clear all promocodes
                }
                return redirect()->back()->with('message', __( 'Продукт успешно удален' ));

            }else{
                return redirect()->back()->withErrors('message', __( 'Не передан ID продукта' ));

            }

        } catch (\Throwable $e) {

            return redirect()->back()->withErrors('message', $e->getMessage());

        }


    }

}
