<?php

namespace Backend\Modules\EDocuments\Http\Controllers;

use Backend\Modules\EDocuments\Enums\EDocumentsPlaceholdersEnum;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

class EDocumentsDocsPreviewController extends Controller
{

    /**
     * @var
     */
    protected $placeholders;

    public function __construct()
    {
        /**
         * is Access
         */
        $this->middleware('permission:modules_edocuments_documents_access');

        /**
         * is Temp Folder
         */
        $this->checkFolderTemp();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EDocumentsDocs $document)
    {

        if( $request->extension === 'docx' ) {

            return $this->previewDOCX($document);

        }elseif ( $request->extension === 'pdf' ) {

            return $this->previewPDF($document);

        }else {

            return redirect()->route('edocuments.edit', ['document' => $document])->withErrors(__( 'Расширение не зарегистрировано.' ));
        }

    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    private function previewDOCX($document)
    {

        $dir = 'files/modules/edocuments/docx/';

        if( empty($document->file) || ! Storage::disk('public')->exists($dir . $document->file) ) {
            return back()->withErrors(__( 'Файл не найден.' ));
        };

        try {

            /**
             * Folders
             */
            $file = Storage::disk('public')->path($dir) . $document->file;
            $temp_file = storage_path('app/temp/' . $document->filename);

            /**
             * Change Placeholders in docx Document
             */
            $templateProcessor = new TemplateProcessor($file);
            $templateProcessor->setValues($this->placeholders);
            $templateProcessor->saveAs($temp_file);

            /**
             * return
             */
            return response()->download($temp_file)->deleteFileAfterSend(true);

        } catch (\Throwable $e) {

            return back()->withErrors($e->getMessage());

        }

    }

    /**
     * @param $document
     * @return mixed
     */
    private function previewPDF($document)
    {

        $template = $document->template;

        if( empty($template) ) return;

        try {

            $generate = Str::replace($this->placeholdersKeysArray(), $this->placeholdersValueArray(), $template);

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($generate);
            return $pdf->stream();

        } catch (\Throwable $e) {

            return back()->withErrors($e->getMessage());

        }

    }

    /**
     * @return array
     */
    public function placeholdersValueArray(): array
    {

        $arr_values = array_values($this->placeholders);

        return $arr_values;

    }

    /**
     * @return int[]|string[]
     */
    public function placeholdersKeysArray(): array
    {

        $arr_keys = array_keys($this->placeholders);

        foreach ( $arr_keys as $key => $value ) {
            $arr_keys[$key] = '${' . $value . '}';
        }

        return $arr_keys;

    }

    /**
     * @return void
     */
    public function checkFolderTemp()
    {

        $path = storage_path('app/temp');

        if(!File::exists($path))
        {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

    }

}
