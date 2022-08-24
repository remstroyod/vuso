<?php

namespace Backend\Http\Handlers\Partners;

use Backend\Enums\TagsEnum;
use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Partners\PartnersListRequest;
use Backend\Models\Pages;
use Backend\Models\Partners\Partners;
use Backend\Models\Tag;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StorePartnersListHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param AwardsRequest $request
     * @param Awards|null $awards
     * @return Awards|null
     */
    public function process(PartnersListRequest $request, Partners $partners = null): ?Partners
    {

        try {

            if (!$partners) :
                $partners = new Partners();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('partners'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $partners->fill($request->all());

            $partners->save($request->all());

            /**
             * Tags
             */
            $tags = $this->tags($partners, $request->tag);
            $partners->tags()->sync($tags);

            /**
             * Upload Image
             */
            if( $request->hasFile('image') ) :
                $partners->update(['image' => $this->imageUpload($partners, 'partners')]);
            endif;

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($partners, 'partners');
                $partners->update(['image' => null]);

            endif;

            return $partners;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

    /**
     * @param array $tags
     * @return array
     */
    public function tags($model, array $tags)
    {

        $arr = [];

        if( $tags )
        {

            foreach ( $tags as $tag )
            {
                $tg = Tag::where('name', $tag)->orWhere('id', $tag)->first();

                if( !$tg )
                {

                    $tg = Tag::create([
                       'name' => $tag,
                        'type' => TagsEnum::page,
                   ]);

                }

                $arr[$tg->id] = [
                    'pages_id' => $model->id,
                ];

            }

        }

        return $arr;

    }

}
