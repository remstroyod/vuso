<?php

namespace Backend\Http\Controllers;

use ArtemSchander\L5Modular\Facades\L5Modular;
use Backend\Http\Resources\MenuPrimaryResource;
use Backend\Policies\MenuPolicy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Menu;

class MenusController extends Controller
{

    /**
     * Menu Constructor
     */
    public function menuPrimary()
    {
//        $filesystem = new Filesystem();
//
//        $directories = new Collection($filesystem->directories(app_path('Modules')));
//
//        dd($directories);

        if( !auth()->check() ) return;

        $collect = Config::get('menu.list.primary');

        $data = new Collection($collect);

        Menu::make('Primary', function ($menu) use ($data)
        {

            $data->each(function ($item, $key) use ($menu)
            {

                $active_class = '';
                $prepend = '';
                $append = '';
                $attr_link = [];

                $menu->raw(
                    __($item['title']),
                    [
                        'class' => 'nav-item nav-category'
                    ],
                );

                if( $item['child'] )
                {

                    foreach ( $item['child'] as $key => $child )
                    {

                        /**
                         * Permission
                         */
                        if( array_key_exists( 'permission', $child ) )
                        {
                            if ($child['permission'] && ! auth()->user()->hasRole('admin')) :
                                if (!auth()->user()->can($child['permission'])) {
                                    return;
                                }
                            endif;
                        }


                        if (array_key_exists( 'child', $child ))
                        {

                            $attr_link = [
                                'class' => 'nav-link',
                                'data-toggle' => 'collapse',
                                'role' => 'button',
                                'aria-expanded' => 'false',
                                'aria-controls' => 'uiComponents-' . $key,
                                'href' => '#uiComponents-' . $key,
                            ];

                            if( array_key_exists('icon', $child) )
                            {
                                $prepend = '<i class="link-icon" data-feather="' . $child['icon'] . '"></i><span class="link-title">';
                            }

                            $append = '</span><i class="link-arrow" data-feather="chevron-down"></i>';

                        }

                        if (!empty($child['route']))
                        {
                            $attr['route'] = $child['route'];
                        }

                        if( array_key_exists( 'routeIs', $child ) )
                        {
                            $active_class = (request()->routeIs($child['routeIs'])) ? 'active' : '';
                        }

                        $attr = [
                            'class' => 'nav-item ' . $active_class,
                        ];

                        $menu->add(
                            __($child['title']),
                            $attr
                        )
                            ->attr([])
                            ->prepend($prepend)
                            ->append($append)
                            ->after(
                                view(
                                    'template-parts.nav-sidebar.collapse',
                                    [
                                        'id' => $key,
                                        'items' => array_key_exists( 'child', $child ) ? $child['child'] : [],
                                        'routeIs' => array_key_exists( 'routeIs', $child ) ? $child['routeIs'] : '',
                                        'permission' => array_key_exists('permission', $child) ? $child['permission'] : ''
                                    ]
                                )
                            )
                            ->link->attr($attr_link);



                    }

                }



//                if ($item['category']) :
//
//
//
//                else:
//
//                    $done = true;
//
//                    if ($item['module']) {
//                        if (!L5Modular::enabled('EDocuments')) {
//                            $done = false;
//                        }
//                    }
//
//
//
//                endif;
            });
        });
    }

}
