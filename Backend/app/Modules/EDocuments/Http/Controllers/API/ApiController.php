<?php

namespace Backend\Modules\EDocuments\Http\Controllers\API;

use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsDestroyRequest;
use Backend\Modules\EDocuments\Http\Resources\EDocumentsDocsSystemResourse;
use Backend\Modules\EDocuments\Http\Resources\EDocumentsResourse;
use Backend\Modules\EDocuments\Http\Resources\EDocumentsSystemResourse;
use Backend\Modules\EDocuments\Models\EDocuments;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum;
use Backend\Traits\IsActiveTrait;
use HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller
{

    use IsActiveTrait;

    /**
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request)
    {

        $documents = EdocumentUser::paginate(10);

        if (is_null($documents))
            return response([
                'message' => 'Data not found',
                'status' => false,
            ], Response::HTTP_CREATED);

        return EDocumentsResourse::collection($documents);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $edocuments = new EDocuments();
            $edocuments->fill($request->validated())->save();

            return EDocumentsResourse::collection($edocuments);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $edocuments = EdocumentUser::findOrfail($id)->get();

        return EDocumentsResourse::collection($edocuments);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function user($id)
    {

        $edocuments = EdocumentUser::where('user_id', $id)->paginate(10);

        return EDocumentsResourse::collection($edocuments);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {


        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $dogovor_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $dogovor_id)
    {

        $document = EdocumentUser::where('dogovor_id', $dogovor_id);

        if( $document->get()->isEmpty() )
        {
            return response()->json([
                'status' => false,
                'message' => __( 'Документ не найден' )
            ], 422);
        }

        if( $document->delete() )
        {
            return response()->json([
                'status' => true,
                'message' => __( 'Документ удален' )
            ], 200);
        }

    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function system_documents(Request $request)
    {

        $documents = Edocuments::paginate(10);

        if (is_null($documents))
            return response([
                'message' => 'Data not found',
                'status' => false,
            ], Response::HTTP_CREATED);

        return EDocumentsSystemResourse::collection($documents);

    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function system_templates(Request $request)
    {

        $documents = EDocumentsDocs::paginate(10);

        if (is_null($documents))
            return response([
                'message' => 'Data not found',
                'status' => false,
            ], Response::HTTP_CREATED);

        return EDocumentsDocsSystemResourse::collection($documents);

    }

    /**
     * @param EdocumentUser $document
     * @return \Illuminate\Http\JsonResponse
     */
    public function isPaymentDocument(EdocumentUser $document)
    {

        if( $document->payment_status == PayHubPaymentStatusEnum::paid )
        {
            return response()->json([
                'status' => true,
                'message' => __( 'Оплачен' ),
                'data' => new EDocumentsResourse($document)
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => __( 'Не оплачен' ),
            'data' => new EDocumentsResourse($document)
        ], 422);

    }

}
