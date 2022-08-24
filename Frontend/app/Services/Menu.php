<?php

namespace Frontend\Services;

use Backend\Enums\MenuEnum;
use Illuminate\Support\Facades\Config;

class Menu
{

    protected $config;

    public function __construct()
    {
        $this->config = Config::get('menu');
    }

    /**
     * @param $menu
     * @return array|mixed|void
     */
    public function make($id = null)
    {

        if( !$id ) return;

        $this->isTemplate();

        $menu = cache()->remember('menu-'.$id, 2 * 24 * 60 * 60, function() use ($id){
            return \Frontend\Models\Menu\Menu::where('id', $id)->first();
        });

        if( $menu )
        {
            return view($this->config['template'])->with('menu', $menu);
        }

    }

    /**
     * @return void
     */
    private function isTemplate()
    {

        if (!\View::exists($this->config['template']))
        {
            exit();
        }

    }

}
