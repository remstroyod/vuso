<?php

namespace Backend\Http\Handlers\Constructor;

use Backend\Enums\ConstructorDinamycEnum;
use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Constructor\ConstructorDinamycRequest;
use Backend\Models\Constructor\ConstructorDinamic;
use Backend\Traits\ImageUploadTrait;

class StoreConstructorDinamycHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param ConstructorDinamycRequest $request
     * @param ConstructorDinamic|null $dinamic
     * @return ConstructorDinamic|null
     */
    public function process(ConstructorDinamycRequest $request, ConstructorDinamic $item = null): ?ConstructorDinamic
    {

        try {

            if (!$item) $item = new ConstructorDinamic();

            $shortcode = $request->shortcode;
            $request->merge([
                'shortcode' => $shortcode,
                'type' => ConstructorDinamycEnum::$ids[$shortcode],
                'page_id' => $request->pages->id,
            ]);

            /**
             * is B2B Page
             */
            if( $request->has('product') )
            {
                $request->merge([
                    'product_id' => $request->product->id,
                ]);
            }

            $item->fill($request->all());

            $item->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') ) :
                $item->update(['image' => $this->imageUpload($item, 'constructor/dinamyc')]);
            endif;

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($item, 'constructor/dinamyc');
                $item->update(['image' => null]);

            endif;

            return $item;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
