<?php

namespace Backend\Http\Controllers\Users\Orders;

use Backend\Events\NewUserRegistered;
use Backend\Services\User\UserService as UserService;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Profile\StoreProfileHandler;
use Backend\Http\Requests\Profile\ProfileRequest;
use Backend\Http\Requests\Profile\RegistrationRequest;
use Backend\Models\Catalog\Product;
use Backend\Http\Requests\User\PhoneRequest;
use Backend\Http\Controllers\Api\v1\User as ApiUser;
use Backend\Models\Profile\User;
use Backend\Models\Role;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:users_access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(PhoneRequest $request, Product $products, UserService $userService)
    {

        $products = $products->whereDefault()->get(['id', 'name']);

        $request->merge(['field' => 'phone', 'value' => $request->phone]);

        $user = null;

        if($request->phone){

            try{

                $user = $userService->findUser($request);
            
            } catch(\Exception $e){

                return back()->withErrors($e->getMessage());
            
            }
        
        }

        //$user = (new ApiUser\UserController())->findUser($request);

        return view('pages.orders.index', [
            'items' => $products,
            'user' => $user
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(/** TO DO */);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {


        return $request->all();
        // $user->fill($request->input());

        // if ($user->save()) {

        //     $user->setRolesDefault();

        //     event(new NewUserRegistered($user));
        //     return redirect()->route('users.list.edit', $user)->with('message', __( 'Сохранено' ));

        // }

        // return back()->withErrors(['Не удалось сохранить запись']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {

        return view('users.form', [
            'user' => $user,
            'roles' => Role::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, StoreProfileHandler $handler, User $user)
    {

        if ($user = $handler->process($request, $user)) :

            $route = $request->routeIs('users.list.update') ? 'users.list.edit' : 'users.profile.edit';

            return redirect()->route($route, $user)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {

        if ($user->delete()) :

            return redirect()->route('users.list.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * Adding a template to card.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProductTemplate(Product $product)
    {

        $productCard = view('template-parts.product-card', compact('product'))->render();

        return response()->json([
            'product' => $productCard
        ]);
    }
}
