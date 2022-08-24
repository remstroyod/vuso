<?php
namespace Frontend\Shortcodes;

use Frontend\Models\Articles\Articles;
use Frontend\Models\Constructor\ConstructorShortcode;
use Frontend\Models\Constructor\ConstructorDinamic;
use Frontend\Models\Reviews;

class ConstructorDinamycShortcode
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

        /**
         * One Record
         */
        $record = [];

        /**
         * is Records General
         */
        $general = false;

        /**
         * Get Shortcode Table
         */
        $code = ConstructorShortcode::whereShortcode($name)->first();

        /**
         * Dinamyc Items
         */
        $items = ConstructorDinamic::whereShortcode($viewData['page'], $name)->get();

        /**
         * Reviews Items
         */
        if( $name === 'reviews' )
        {

            if( !$items->count() )
            {
                $limit = $code->limit ? $code->limit : 999;
                $items = Reviews::take($limit)->get();
                $general = true;
            }

        }

        /**
         * Offer Product Item
         */
        if( $name === 'offerproduct' )
        {

            if( $items->count() )
            {
                $items = $items->first();
            }

        }

        /**
         * Sales Items
         */
        if( $name === 'sales' )
        {

            if( !$items->count() )
            {
                $limit = $code->limit ? $code->limit : 3;
                $items = Articles::lastSales($limit)->get();
                $general = true;
            }

        }

        /**
         * Sales Last One Item
         */
        if( $name === 'faqsale' )
        {

            $record = Articles::lastSales(1)->first();

        }

        /**
         * Video
         */
        if( $name === 'video' )
        {

            if( $items->count() )
            {
                $items = $items->first();
            }

        }

        /**
         * Compare
         */
        if( $name === 'compare' )
        {

            if( $items->count() )
            {
                $items = $items->first();
            }

        }

        return view('constructor.dinamyc.' . $name, [
            'page' => $viewData['page'],
            'items' => $items,
            'shortcode' => $code,
            'general' => $general,
            'record' => $record,
        ]);

    }

}
