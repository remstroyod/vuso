<?php

namespace Backend\Services;

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
    public function make($menu = null)
    {

        if( !$menu ) return;

        $menu = $this->config['list'][$menu];

        if( !$menu ) return;

        $this->isTemplate();

        return view($this->config['template'], ['items' => $menu]);

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
