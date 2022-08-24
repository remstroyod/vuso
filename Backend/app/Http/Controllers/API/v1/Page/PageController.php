<?php

namespace Backend\Http\Controllers\API\v1\Page;

use Backend\Http\Handlers\API\v1\Page\StorePageHandler;
use Backend\Http\Resources\API\v1\Page\PageResource;
use Backend\Models\Pages;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
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
    public function show(Request $request, Pages $page)
    {

        if(!$page) {

            return response()->json([
                'data' => [],
                'message' => 'Page Not Found'
            ], 403);
        }

        return new PageResource($page);

    }

    /**
     * @param Request $request
     * @param StorePageHandler $handler
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, StorePageHandler $handler, Pages $page)
    {

        if ($page = $handler->process($request, $page))
        {

            return response()->json([
                'data' => $page,
                'status' => 'success',
                'message' => 'Page Save Success'
            ], 200);

        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => $handler->getErrors()
        ], 403);

    }

}
