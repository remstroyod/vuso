<?php

namespace Backend\Http\Controllers\About;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\About\StoreAboutHistoryHandler;
use Backend\Http\Requests\About\HistoryRequest;
use Backend\Models\About\History;
use Backend\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('about');

        return view('pages.about.history.index', [
            'model' => $model,
            'items' => History::paginate()
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

        return view('pages.about.history.form', [
            'model' => $model,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoryRequest $request, StoreAboutHistoryHandler $handler, History $history)
    {

        if ($history = $handler->process($request)) :

            return redirect()->route('about.history.edit', $history)->with('message', __( 'Сохранено' ));

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

        return view('pages.about.history.form', [
            'model' => $model,
            'item' => History::find($request->history)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {

        if ($history->delete()) :
            return redirect()->route('about.history.index');
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
    public function update(HistoryRequest $request, StoreAboutHistoryHandler $handler, History $history)
    {

        if ($history = $handler->process($request, $history)) :

            return redirect()->route('about.history.edit', $history)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
