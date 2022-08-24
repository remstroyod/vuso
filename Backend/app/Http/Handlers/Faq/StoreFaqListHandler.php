<?php

namespace Backend\Http\Handlers\Faq;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Faq\FaqRequest;
use Backend\Models\Faq\Faq;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreFaqListHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param ArticlesRequest $request
     * @param Articles|null $articles
     * @return Articles|null
     */
    public function process(FaqRequest $request, Faq $faq = null): ?Faq
    {

        try {

            if (!$faq) :
                $faq = new Faq();
                $response = Gate::inspect('create', Faq::class);
            else:
                $response = Gate::inspect('update', Faq::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $faq->fill($request->all());

            $faq->save($request->all());

            return $faq;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
