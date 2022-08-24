<?php

namespace Backend\Http\Controllers\Tags;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Tags\TagHandler;
use Backend\Http\Requests\Tags\TagsRequest;
use Backend\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:tags_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tag $tags)
    {

        return view('tag.index', [
            'items' => $tags->paginate(10),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tag $tag)
    {

        return view('tag.form', [
            'model' => $tag,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsRequest $request, TagHandler $handler, Tag $tag)
    {

        if ($tag = $handler->process($request)) :

            return redirect()->route('tag.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {

        return view('tag.form', [
            'model' => $tag,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagsRequest $request, TagHandler $handler, Tag $tag)
    {

        if ($tag = $handler->process($request, $tag)) :

            return redirect()->route('tag.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {

        if ($tag->delete()) :

            return redirect()->route('tag.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

}
