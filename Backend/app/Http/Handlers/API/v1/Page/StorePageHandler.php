<?php
namespace Backend\Http\Handlers\API\v1\Page;

use Backend\Http\Handlers\BaseHandler;
use Backend\Models\Pages;
use Illuminate\Http\Request;

class StorePageHandler extends BaseHandler
{

    /**
     * @param Request $request
     * @param $product
     * @return mixed
     */
    public function process(Request $request, Pages $page = NULL): ?Pages
    {

        try {

            $page->fill($request->all());

            if( $request->has('lang') && $request->has('scenario') )
            {
                $page->setTranslation('scenario', $request->lang, $request->scenario);
            }

            $page->save($request->all());

            return $page;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
