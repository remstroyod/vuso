<?php

namespace Backend\Http\Handlers\Articles;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Articles\ArticlesRequest;
use Backend\Http\Requests\Articles\ListRequest;
use Backend\Models\Articles\Articles;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreArticlesListHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param ArticlesRequest $request
     * @param Articles|null $articles
     * @return Articles|null
     */
    public function process(ListRequest $request, Articles $articles = null): ?Articles
    {

        try {

            if (!$articles) :
                $articles = new Articles();
                $response = Gate::inspect('create', Articles::class);
            else:
                $response = Gate::inspect('update', Articles::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $articles->fill($request->all());

            $articles->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') ) :
                $articles->update(['image' => $this->imageUpload($articles, 'articles')]);
            endif;

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($articles, 'articles');
                $articles->update(['image' => null]);

            endif;

            return $articles;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
