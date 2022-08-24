<?php

namespace Backend\Http\Handlers\Constructor;

use Backend\Http\Handlers\BaseHandler;
use Backend\Enums\PagesTypeEnum;
use Backend\Http\Requests\PagesRequest;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Str;

class StoreConstructorHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param PagesRequest $request
     * @param Pages|null $pages
     * @return Pages|null
     */
    public function process(PagesRequest $request, Pages $pages = null): ?Pages
    {

        try {

            if ( ! $pages ) $pages = new Pages();

            $request->merge([
                'type' => PagesTypeEnum::constructor,
                'page' => (!empty($request->page)) ? Str::snake($request->page, '-') : Str::slug($request->name)
            ]);

            $pages->fill($request->all());

            $pages->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') )
                $pages->update(['image' => $this->imageUpload($pages, 'home')]);

            /**
             * Upload Poster Video
             */
            if( $request->hasFile('video_poster') )
                $pages->update(['video_poster' => $this->imageUpload($pages, 'home', 'video_poster')]);

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($pages, 'home');
                $pages->update(['image' => null]);

            endif;

            /**
             * Remove Poster Video
             */
            if ($request->input('flush_poster')) :

                $this->imageRemove($pages, 'home', 'video_poster');
                $pages->update(['video_poster' => null]);

            endif;

            return $pages;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
