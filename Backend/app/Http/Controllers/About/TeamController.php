<?php

namespace Backend\Http\Controllers\About;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\About\StoreAboutTeamHandler;
use Backend\Http\Requests\About\TeamRequest;
use Backend\Models\About\Team;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('about');

        return view('pages.about.team.index', [
            'model' => $model,
            'items' => Team::paginate()
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

        return view('pages.about.team.form', [
            'model' => $model,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request, StoreAboutTeamHandler $handler, Team $team)
    {

        if ($team = $handler->process($request)) :

            return redirect()->route('about.team.edit', $team)->with('message', __( 'Сохранено' ));

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

        return view('pages.about.team.form', [
            'model' => $model,
            'item' => Team::find($request->team)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {

        if ($team->delete()) :

            $this->imageRemove($team, 'about/team');

            return redirect()->route('about.team.index');
        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param TeamRequest $request
     * @param StoreAboutTeamHandler $handler
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TeamRequest $request, StoreAboutTeamHandler $handler, Team $team)
    {

        if ($team = $handler->process($request, $team)) :

            return redirect()->route('about.team.edit', $team)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }


}
