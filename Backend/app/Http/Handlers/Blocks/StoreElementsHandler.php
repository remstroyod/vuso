<?php

namespace Backend\Http\Handlers\Blocks;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Blocks\BlocksRequest;
use Backend\Http\Requests\Blocks\ElementsRequest;
use Backend\Models\Blocks\Block;
use Backend\Models\Blocks\BlockElement;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreElementsHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param BlocksRequest $request
     * @param Block|null $block
     * @return Block|null
     */
    public function process(ElementsRequest $request, Pages $page, Block $block, BlockElement $element = null): ?BlockElement
    {

        try {

            if (!$element) :
                $element = new BlockElement();
                $response = Gate::inspect('create', Block::class);
            else:
                $response = Gate::inspect('update', Block::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $request->merge(['block_id' => $block->id]);

            $element->fill($request->all());

            $element->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') || $request->hasFile('icon') )
            {

                if ($request->hasFile('image'))
                {
                    $element->update(['image' => $this->imageUpload($element, 'blocks/elements')]);
                }

                if ($request->hasFile('icon'))
                {
                    $element->update(['icon' => $this->imageUpload($element, 'blocks/elements', 'icon')]);
                }

            }

            /**
             * Remove Image
             */
            if ($request->input('flush_image') || $request->input('flush_icon'))
            {

                if( $request->input('flush_image') )
                {
                    $this->imageRemove($element, 'blocks/elements');
                    $block->update(['image' => null]);
                }

                if( $request->input('flush_icon') )
                {
                    $this->imageRemove($element, 'blocks/elements', 'icon');
                    $block->update(['icon' => null]);
                }

            }

            return $element;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
