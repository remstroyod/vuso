<?php

namespace Frontend\Http\Controllers\EDocuments;

use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Traits\GoogleDrive;
use Frontend\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class EDocumentsController extends Controller
{

    use GoogleDrive;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //

    }

    /**
     * @param EDocuments $documents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EdocumentUser $document)
    {

        if( $request->missing('file') )
        {
            abort(404);
        }

        $filename = EdocumentUser::where('filename', $request->input('file'))->first();

        if( !$filename )
        {
            abort(404);
        }

        if( $document )
        {

            $file = Storage::disk('google')->get($document->path);

            if( $file )
            {
                return (new Response($file, 200))->header('Content-Type', $document->mimetype);
            }else{
                abort(404);
            }

        }else{

            abort(404);

        }

    }

}
