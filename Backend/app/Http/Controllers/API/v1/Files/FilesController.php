<?php
namespace Backend\Http\Controllers\API\v1\Files;

use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesController extends Controller
{

    /**
     * @return void
     */
    public function index(Request $request)
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        if($request->filled('file'))
        {

            return response()->json([
                'data' => [],
                'message' => 'File not attached'
            ], 403);
        }

        $path = $request->file('file')->store('public/images/upload');

        if( $path )
        {

            return response()->json([
                'data' => [
                    'file' => settings('site_url') . '/' . Str::replace('public', 'storage', $path),
                ],
                'message' => 'File uploaded successfully'
            ], 200);

        }else{

            return response()->json([
                'data' => [],
                'message' => 'File upload error'
            ], 403);

        }

    }

}
