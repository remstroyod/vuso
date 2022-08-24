<?php

namespace Backend\Http\Handlers\Sales;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Sales\SalesListRequest;
use Backend\Models\Sales\Sales;
use Backend\Traits\FileUploadTrait;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreSalesListHandler extends BaseHandler
{

    use FileUploadTrait, ImageUploadTrait;

    /**
     * @param SalesListRequest $request
     * @param Sales|null $sales
     * @return Sales|null
     */
    public function process(SalesListRequest $request, Sales $sales = null): ?Sales
    {

        try {

            if (!$sales) :
                $sales = new Sales();
                $response = Gate::inspect('create', Sales::class);
            else:
                $response = Gate::inspect('update', Sales::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $sales->fill($request->all());

            $sales->save($request->all());

            /**
             * Upload File
             */
            if( $request->hasFile('input_file') )
                $sales->update(['file' => $this->fileUpload($sales, 'sales')]);

            /**
             * Remove File
             */
            if ($request->input('flush_file')) :

                $this->fileRemove($sales, 'sales');
                $sales->update(['file' => null]);

            endif;

            /**
             * Upload Image
             */
            if( $request->hasFile('image') ) :
                $sales->update(['image' => $this->imageUpload($sales, 'sales')]);
            endif;

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($sales, 'sales');
                $sales->update(['image' => null]);

            endif;

            return $sales;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
