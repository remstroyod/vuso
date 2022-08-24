<?php

namespace Backend\Http\Handlers\Menu;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Menu\MenuRequest;
use Backend\Models\Menu\Menu;
use Illuminate\Support\Facades\Gate;

class StoreMenuHandler extends BaseHandler
{

    /**
     * @param MenuRequest $request
     * @param Menu|null $menu
     * @return Menu|null
     */
    public function process(MenuRequest $request, Menu $menu = null): ?Menu
    {

        try {

            if (!$menu) :
                $menu = new Menu();
                $response = Gate::inspect('create', Menu::class);
            else:
                $response = Gate::inspect('update', Menu::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $menu->fill($request->all());

            $menu->save($request->all());

            return $menu;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
