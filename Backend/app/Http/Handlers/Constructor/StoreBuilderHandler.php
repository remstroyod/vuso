<?php

namespace Backend\Http\Handlers\Constructor;

use Backend\Http\Handlers\BaseHandler;
use Backend\Enums\PagesTypeEnum;
use Backend\Http\Requests\PagesRequest;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Str;

class StoreBuilderHandler extends BaseHandler
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

            $pages->fill($request->all());

            $pages->save($request->all());

            return $pages;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
