<?php
namespace Backend\Http\Controllers\Pages;

use Backend\Enums\PagesEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\PagesRequest;
use Backend\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:pages_access');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $type = PagesEnum::toArray();

        return view('pages.static-pages.index', [
            'items' => Pages::whereStatic()->paginate(),
            'type' => $type,
        ]);

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Pages $pages)
    {

        $type = PagesEnum::toArray();

        return view('pages.static-pages.form', [
            'model' => $pages,
            'parents' => $pages->whereStatic()->get(),
            'type' => $type,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {

        $type = PagesEnum::toArray();

        $template = '';
        $file = 'files/template/' . $pages->id . '.blade.php';
        if( Storage::disk('public')->exists($file) )
        {
            $template = Storage::disk('public')->get('files/template/' . $pages->id . '.blade.php');
        }

        return view('pages.static-pages.form', [
            'model' => $pages,
            'parents' => $pages->whereStatic()->get(),
            'type' => $type,
            'template' => $template
        ]);

    }

    /**
     * @param PagesRequest $request
     * @param StorePagesHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PagesRequest $request, StorePagesHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request)) :

            return redirect()->route('static-pages.edit', $pages)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param PagesRequest $request
     * @param StorePagesHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PagesRequest $request, StorePagesHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('static-pages.edit', $pages)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pages $pages)
    {

        if ($pages->delete()) :

            $file = 'files/template/' . $pages->id . '.blade.php';
            if( Storage::disk('public')->exists($file) )
            {
                Storage::disk('public')->delete($file);
            }

            return redirect()->route('static-pages.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Pages $pages)
    {

        return view('pages.static-pages.seo', [
            'model' => $pages,
            'static_page' => true,
        ]);

    }
}
