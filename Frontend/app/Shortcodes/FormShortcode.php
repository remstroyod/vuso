<?php
namespace Frontend\Shortcodes;

class FormShortcode
{

    /**
     * @param $shortcode
     * @param $content
     * @param $compiler
     * @param $name
     * @param $viewData
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {

        return view('forms.' . $shortcode->template, [ 'page' => $viewData['page'] ]);

    }


}
