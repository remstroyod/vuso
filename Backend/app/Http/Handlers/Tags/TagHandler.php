<?php

namespace Backend\Http\Handlers\Tags;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Tags\TagsRequest;
use Backend\Models\Tag;
use Illuminate\Support\Facades\Gate;

class TagHandler extends BaseHandler
{

    /**
     * @param TagsRequest $request
     * @param Tag|null $articles
     * @return Tag|null
     */
    public function process(TagsRequest $request, Tag $tag = null): ?Tag
    {

        try {

            if (!$tag) :
                $tag = new Tag();
                $response = Gate::inspect('create', Tag::class);
            else:
                $response = Gate::inspect('update', Tag::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $tag->fill($request->all());
            $tag->save($request->all());

            return $tag;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
