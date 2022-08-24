<?php

namespace Backend\Http\Handlers\Reviews;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Articles\ArticlesRequest;
use Backend\Http\Requests\Reviews\ReviewsListRequest;
use Backend\Models\Articles\Articles;
use Backend\Models\Reviews;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreReviewsListHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param ArticlesRequest $request
     * @param Articles|null $articles
     * @return Articles|null
     */
    public function process(ReviewsListRequest $request, Reviews $reviews = null): ?Reviews
    {

        try {

            if (!$reviews) :
                $reviews = new Reviews();
                $response = Gate::inspect('create', Reviews::class);
            else:
                $response = Gate::inspect('update', Reviews::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $reviews->fill($request->all());

            $reviews->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') ) :
                $reviews->update(['image' => $this->imageUpload($reviews, 'reviews')]);
            endif;

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($reviews, 'reviews');
                $reviews->update(['image' => null]);

            endif;

            return $reviews;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
