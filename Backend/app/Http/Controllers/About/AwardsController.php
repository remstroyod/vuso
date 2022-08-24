<?php

namespace Backend\Http\Controllers\About;

use Backend\Http\Controllers\API\v1\User\UserController;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\About\StoreAboutAwardsHandler;
use Backend\Http\Requests\About\AwardsRequest;
use Backend\Models\About\Awards;
use Backend\Models\Pages;
use Backend\Traits\FileUploadTrait;
use Exception;
use Illuminate\Http\Request;

class AwardsController extends Controller
{

    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('about');

        return view('pages.about.awards.index', [
            'model' => $model,
            'items' => Awards::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pages $pages)
    {

        $model = $pages->findOrFail('about');

        return view('pages.about.awards.form', [
            'model' => $model,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AwardsRequest $request, StoreAboutAwardsHandler $handler, Awards $awards)
    {

        if ($awards = $handler->process($request)) :

            return redirect()->route('about.awards.edit', $awards)->with('message', __( 'Сохранено' ));

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

        $model = $pages->findOrFail('about');

        return view('pages.about.awards.form', [
            'model' => $model,
            'item' => Awards::find($request->awards)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Awards $awards)
    {

        if ($awards->delete()) :

            $this->fileRemove($awards, 'about/awards');

            return redirect()->route('about.awards.index');
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
    public function update(AwardsRequest $request, StoreAboutAwardsHandler $handler, Awards $awards)
    {

        if ($awards = $handler->process($request, $awards)) :

            return redirect()->route('about.awards.edit', $awards)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }


}
