<?php

namespace Backend\Http\Handlers\Menu;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Menu\MenuElementsRequest;
use Backend\Http\Requests\Menu\MenuRequest;
use Backend\Models\Menu\Menu;
use Backend\Models\Menu\MenuItem;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreMenuElementsHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param MenuRequest $request
     * @param Menu|null $menu
     * @return Menu|null
     */
    public function process(MenuElementsRequest $request, Menu $menu, MenuItem $element = null): ?MenuItem
    {

        try {

            if (!$element) :
                $element = new MenuItem();
                $response = Gate::inspect('create', MenuItem::class);
            else:
                $response = Gate::inspect('update', MenuItem::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $request->merge(['menu_id' => $menu->id]);

            $element->fill($request->all());

            $element->save($request->all());

            /**
             * Upload Icon
             */
            if( $request->hasFile('icon') )
            {

                $element->update(['icon' => $this->imageUpload($element, 'menu', 'icon')]);

            }

            /**
             * Remove Icon
             */
            if ($request->input('flush_icon'))
            {

                $this->imageRemove($element, 'menu', 'icon');
                $element->update(['icon' => null]);

            }

            return $element;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
