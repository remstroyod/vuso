<?php

namespace Backend\Modules\EDocuments\Http\Controllers\API;

use Backend\Models\Catalog\Product;
use Backend\Modules\EDocuments\Enums\EDocumentsDocsExtensionEnum;
use Backend\Modules\EDocuments\Enums\EDocumentsPlaceholdersEnum;
use Backend\Modules\EDocuments\Enums\EDocumentsSourceEnum;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Backend\Modules\EDocuments\Models\EDocuments;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Traits\IsActiveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;
use Backend\DTO\InsuranceObjectDynamicForm;


class DocumentController extends Controller
{

    use IsActiveTrait;

    protected $placeholders;

    public function __construct()
    {

        /**
         * Get Systems Placeholders
         */
        $systems_placeholders = EDocumentsPlaceholdersEnum::labels();

        /**
         * Get Table Placeholders
         */
        $this->placeholders =
            EDocumentsPlaceholders::pluck('render', 'slug')
                ->collect()
                ->merge($systems_placeholders)
                ->toArray();

    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Product $product)
    {
        /**
         * if has Endpoint
         */
        if( ! $request->has('endpoint') || empty($request->input('endpoint')) )
        {
            return response()->json([
                'message' => __( 'Не указан Endpoint' ),
                'status' => false,
            ], 422);
        };

        /**
         * Get Document by Endpoint
         */
        $document_type = EDocuments::where('endpoint', $request->input('endpoint'))->first();

        if( ! $document_type )
        {
            return response()->json([
                'message' => __( 'В системе не обнаружен такой Endpoint' ),
                'status' => false,
            ], 422);
        };

        /**
         *
         */
        $document = $product->document($document_type->id)->first();

        if( ! $document )
        {
            return response()->json([
                'message' => __( 'Не привязан документ к продукту.' ),
                'status' => false,
            ], 422);
        }

        switch ($document->extension)
        {
            case EDocumentsDocsExtensionEnum::pdf:

                $file = $this->generatePDF($document, $request->all());
                break;

            case EDocumentsDocsExtensionEnum::doc:

                $file = $this->generateDOCX($document, $request->all());
                break;

        }

        $store_file = false;

        if( $file )
        {

            try{

                $folder = $document_type->folder;
                $filename = basename($file);
                $store_file = Storage::disk('google')->put($folder . '/' . $filename, file_get_contents($file));

            }catch(\Exception $e){

                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

        }

        if( $store_file )
        {

            try{

                $metadata = Storage::disk('google')->getMetadata($folder . '/' . $filename);
                if( $metadata )
                {

                    $basename = Str::afterLast($metadata['path'], '/');
                    if( $document->extension == EDocumentsDocsExtensionEnum::doc ) {
                        $url = 'https://docs.google.com/document/d/' . $basename . '/edit';
                    }elseif ( $document->extension == EDocumentsDocsExtensionEnum::pdf ) {
                        $url = 'https://drive.google.com/file/d/' . $basename . '/view';
                    }

//                    if( $request->has('regenerate') && $request->input('regenerate') === true )
//                    {
//
//                        $userDocument = EdocumentUser::where('dogovor_id', $request->input('policy_no'))->update([
//                            'folder' => $folder,
//                            'path' => $metadata['path'],
//                            'mimetype' => $metadata['mimetype'],
//                            'filename' => $filename,
//                            'url' => $url,
//                            'extension' => $document->extension,
//                        ]);
//
//                    }else{


                    $checkContract = EdocumentUser::where('dogovor_id', $request->input('policy_no'))->first();

                    $userDocument = EdocumentUser::create([
                        'documents_id' => $document->documents_id,
                        'dogovor_id' => $request->input('policy_no'),
                        'user_id' => ($checkContract) ? $checkContract->user_id : '',
                        'product_id' => $product->id,
                        'storage' => 'google',
                        'folder' => $folder,
                        'path' => $metadata['path'],
                        'mimetype' => $metadata['mimetype'],
                        'filename' => $filename,
                        'url' => $url,
                        'extension' => $document->extension,
                        'source' => EDocumentsSourceEnum::api,
                        'data' => $request->toArray(),
                        'is_pp' => ($checkContract) ? 1 : 0,
                    ]);

                    //}


                    return response()->json([
                        'message' => settings('site_url') . '/document/get/' . $userDocument->id . '?file=' . $userDocument->filename,
                        'status' => true,
                        'document' => $userDocument->id,
                    ], 200);

                }else{

                    return response()->json([
                        'message' => __( 'Не удалось получить данные файла' ),
                        'status' => false,
                    ], 422);

                }

            }catch(\Exception $e){

                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => false,
                ], 422);
            }

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * @param $document
     * @param $placeholders
     * @return \Illuminate\Http\JsonResponse|string
     */
    private function generatePDF($document, $placeholders)
    {

        $this->modification_placeholders($placeholders);

        $template = $document->template;

        if( empty($template) )
        {
            return response()->json([
                'status' => false,
                'message' => __( 'Не найден Template' ),
            ], 200);
        }

        try {

            $generate = Str::replace($this->placeholdersKeysArray($placeholders), $this->placeholdersValueArray($placeholders), $template);

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($generate);

            $file_name = $this->generateFileName();
            Storage::put('public/temp/' . $file_name . '.pdf', $pdf->output());

            return $file = Storage::disk('public')->path('temp/') . $file_name . '.pdf';


        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 200);

        }

    }

    /**
     * @param $document
     * @param $placeholders
     * @return \Illuminate\Http\JsonResponse|string
     */
    private function generateDOCX($document, $placeholders)
    {

        $dir = 'files/modules/edocuments/docx/';

        if( empty($document->file) || ! Storage::disk('public')->exists($dir . $document->file) )
        {

            return response()->json([
                'status' => false,
                'message' => __( 'Файл не найден' ),
            ], 200);

        };

        try {

            /**
             * Folders
             */
            $file = Storage::disk('public')->path($dir) . $document->file;
            $temp_file = storage_path('app/public/temp/' . $this->generateFileName());

            /**
             * Change Placeholders in docx Document
             */
            $templateProcessor = new TemplateProcessor($file);
            $templateProcessor->setValues($placeholders);
            $templateProcessor->saveAs($temp_file);

            /**
             * return
             */
            return $temp_file;


        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 200);

        }

    }

    /**
     * @param $placeholders
     * @return array
     */
    public function placeholdersValueArray($placeholders): array
    {

        $placeholders = array_merge($placeholders, $this->placeholders);

        $arr_values = array_values($placeholders);

        return $arr_values;

    }

    /**
     * @param $placeholders
     * @return array
     */
    public function placeholdersKeysArray($placeholders): array
    {

        $placeholders = array_merge($placeholders, $this->placeholders);
        $arr_keys = array_keys($placeholders);

        foreach ( $arr_keys as $key => $value ) {
            $arr_keys[$key] = '${' . $value . '}';
        }

        return $arr_keys;

    }

    /**
     * @return string
     */
    protected function generateFileName(): string
    {
        return Str::random(40);
    }

    /**
     * @param $request_placeholders
     * @return void
     */
    protected function modification_placeholders($request_placeholders)
    {
        $system_placeholders = EDocumentsPlaceholdersEnum::labels();
        $items = $this->placeholders;
        foreach ( $items as $key=> $item )
        {

            if( !array_key_exists($key, $system_placeholders) )
            {

                if( array_key_exists( $key, $request_placeholders ) )
                {
                    $this->placeholders[$key] = $request_placeholders[$key];
                }else{
                    $this->placeholders[$key] = null;
                }

            }

        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function storeDogovorInformation($request, $array)
    {

        $document = EdocumentUser::findOrFail(Arr::get($array, 'data.response.contract.document_id'));
        
        /**
         * Save Data
         */
        if( $document )
        {
            
            $data = Arr::get($array, 'data.request');
            $dogovorNumber = Arr::get($array, 'data.response.contract.policy_no');
            $insuranceObjectTableName = $request->obj_type;
            
            $document->update([
                'user_id' => $request->user,
                'dogovor_id' => $dogovorNumber,
                'total' => $request->total,
                'subtotal' => $request->total,
                'data' => $data,
                'source' => EDocumentsSourceEnum::site,
            ]);

            $InsuranceObjectDynamicForm = new InsuranceObjectDynamicForm();
                
            if(method_exists($InsuranceObjectDynamicForm, $insuranceObjectTableName)){
                    
                $InsuranceObjectDynamicForm->$insuranceObjectTableName($request);
                
                $getDynamicData = $InsuranceObjectDynamicForm->jsonSerialize();
                
                $document->$insuranceObjectTableName()->delete();
                
                $document->$insuranceObjectTableName()->createMany($getDynamicData);
                
                $getObjIds = $document->$insuranceObjectTableName()->pluck('obj_id');
                
                $document->$insuranceObjectTableName()->sync($getObjIds);
            }

            return response()->json([
                'message' => __( 'Данные успешно обновлены' ),
                'status' => true,
            ], 200);

        }else{

            return response()->json([
                'message' => __( 'Не переданые данные для записи' ),
                'status' => false,
            ], 422);

        }

    }

}
