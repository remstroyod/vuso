<?php

namespace Backend\Http\Handlers\Attachfaq;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Attachfaq\AttachFaqRequest;
use Backend\Models\Pages;
use Illuminate\Support\Facades\Gate;

class StoreAttachFaqHandler extends BaseHandler
{

    /**
     * @param AttachFaqRequest $request
     * @param Pages|null $page
     * @return Pages|null
     */
    public function process(AttachFaqRequest $request, Pages $page = null): ?Pages
    {

        try {

            if (!$page) :
                $page = new Pages();
                $response = Gate::inspect('create', $page);
            else:
                $response = Gate::inspect('update', Pages::findOrFail($page->page));
            endif;

            if (!$response->allowed())
            {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $model = $page->findOrFail($page->page);

            /**
             * Faqs List
             */
            $this->storePagesRelatedData($model, $request->input('faqs') ?? []);

            return $model;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

    /**
     * @param Pages $pages
     * @param array $tags
     * @return void
     */
    private function storePagesRelatedData(Pages $pages, array $tags)
    {

        $arr = [];
        foreach ( $tags as $tag ) :

            $arr[$tag] = [
                'pages_page' => $pages->id,
                'model' => 'page'
            ];

        endforeach;

        $pages->faqs()->sync($arr);

    }

}
