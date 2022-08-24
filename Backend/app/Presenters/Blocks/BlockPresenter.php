<?php

namespace Backend\Presenters\Blocks;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use McCool\LaravelAutoPresenter\BasePresenter;

class BlockPresenter extends BasePresenter
{

    public function __construct()
    {


    }

    /**
     * @return string
     */
    public function getTemplateName(): string
    {

        $component = isset($this->block) ? $this->block->component : $this->component ;

        $file = File::get(base_path() . '/../Frontend/resources/views/components/' . $component . '.blade.php');

        if( $file )
        {
            $title = Str::between($file, '{{--Component:', ':Component--}}');
        }else{
            $title = __( 'Компонент не найден' );
        }


        return $title;

    }

}
