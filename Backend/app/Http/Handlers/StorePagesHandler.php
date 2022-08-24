<?php

namespace Backend\Http\Handlers;

use Backend\Http\Requests\PagesRequest;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class StorePagesHandler extends BaseHandler
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
            if (!$pages) :
                $pages = new Pages();
                $response = Gate::inspect('create', $pages);
            else:
                $response = Gate::inspect('update', $pages);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            /**
             * if Update or Store
             */
            if ($request->page) :

                $model = $pages->findOrFail($request->page);

            else:

                if ($request->pages) :

                    $model = $pages->findOrFail($request->pages->page);

                else:
                    $model = $pages;
                    $request->merge([
                        'page' => Str::slug($request->name)
                    ]);
                endif;
            endif;

            $model->fill($request->all());

            $model->save($request->all());

            $this->template($model, $request->input('content'));

            /**
             * Upload Image
             */
            if ($request->hasFile('image'))
            {
                $model->update(['image' => $this->imageUpload($pages, 'pages')]);
            }

            /**
             * Upload Poster Video
             */
            if ($request->hasFile('video_poster'))
            {
                $model->update(['video_poster' => $this->imageUpload($pages, 'pages', 'video_poster')]);
            }

            /**
             * Remove Image
             */
            if ($request->input('flush_image'))
            {
                $this->imageRemove($model, 'pages');
                $model->update(['image' => null]);
            }

            /**
             * Remove Poster Video
             */
            if ($request->input('flush_poster'))
            {
                $this->imageRemove($model, 'pages', 'video_poster');
                $model->update(['video_poster' => null]);
            }

            return $model;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }
    }

    /**
     * @param $model
     * @return void
     */
    public function template($model, $template)
    {

        try {

            $file = 'files/template/' . $model->id . '.blade.php';

            if ( $model->is_template == 1 && Str::length($template) > 10 )
            {

                Storage::disk('public')->put($file, $template);

            }elseif ( $model->is_template == 0 ) {

                Storage::disk('public')->delete($file);

            }

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
