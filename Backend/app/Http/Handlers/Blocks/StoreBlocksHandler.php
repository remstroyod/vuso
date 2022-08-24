<?php

namespace Backend\Http\Handlers\Blocks;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Blocks\BlocksRequest;
use Backend\Models\Blocks\Block;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreBlocksHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param BlocksRequest $request
     * @param Block|null $block
     * @return Block|null
     */
    public function process(BlocksRequest $request, Pages $page, Block $block = null): ?Block
    {

        try {

            if (!$block) :
                $block = new Block();
                $response = Gate::inspect('create', Block::class);
            else:
                $response = Gate::inspect('update', Block::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $block->fill($request->all());

            $block->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') || $request->hasFile('videoposter') )
            {

                if ($request->hasFile('image')) {
                    $block->update(['image' => $this->imageUpload($block, 'blocks')]);
                }

                if ($request->hasFile('videoposter')) {
                    $block->update(['videoposter' => $this->imageUpload($block, 'blocks', 'videoposter')]);
                }

            }

            /**
             * Remove Image
             */
            if ( $request->input('flush_image') || $request->input('flush_poster') )
            {

                if( $request->input('flush_image') )
                {
                    $this->imageRemove($block, 'blocks');
                    $block->update(['image' => null]);
                }

                if( $request->input('flush_poster') )
                {
                    $this->imageRemove($block, 'blocks', 'videoposter');
                    $block->update(['videoposter' => null]);
                }

            }

            return $block;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
