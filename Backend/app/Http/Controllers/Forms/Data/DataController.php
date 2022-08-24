<?php

namespace Backend\Http\Controllers\Forms\Data;

use Backend\Enums\FormsEnum;
use Backend\Http\Controllers\Controller;
use Backend\Models\Forms\FormsData;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:formsdata_access');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request, FormsData $formsData)
    {

        $type = FormsEnum::$name;

        return view('forms.data.index', [
            'items' => $formsData->search($request->all())->paginate(),
            'type' => $type,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FormsData $formsdata)
    {
        return view('forms.data.show', [
            'model' => $formsdata
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormsData $formsdata)
    {

        if ($formsdata->delete()) :

            return redirect()->route('forms.data.index');

        endif;

        return back()->withErrors([
            __('Не удалось удалить запись')
        ]);

    }

}
