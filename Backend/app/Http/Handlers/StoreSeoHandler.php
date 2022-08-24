<?php

namespace Backend\Http\Handlers;

use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\Pages;
use Backend\Models\Seo;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreSeoHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param PagesRequest $request
     * @param Pages|null $pages
     * @return Pages|null
     */
    public function process(SeoRequest $request, Seo $seo = null): ?Seo
    {

        try {
            if (!$seo) :
                $seo = new Seo();
                $response = Gate::inspect('create', $seo);
            else:
                $response = Gate::inspect('update', $seo);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $seo->fill($request->input());

            if ($request->seo_id <> 0) :

                $seo = $seo->findOrFail($request->seo_id);
                $seo->update($request->all());

            else:

                if ($seo->save()) :

                    if( $request->model ) :
                        $model = app('Backend\\Models\\' . $request->model);
                        $model->where('id', $request->id)->update(['seo_id' => $seo->id]);
                    else:
                        Pages::where('id', $request->id)->update(['seo_id' => $seo->id]);
                    endif;

                endif;

            endif;

            /**
             * Upload Image
             */
            if ($request->hasFile('image')) {
                $seo->update(['image' => $this->imageUpload($seo, 'seo')]);
            }

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($seo, 'seo');
                $seo->update(['image' => null]);

            endif;

            return $seo;
        } catch (\Throwable $e) {
            $this->setErrors(__('Не удалось сохранить запись'));
            return null;
        }
    }

}
