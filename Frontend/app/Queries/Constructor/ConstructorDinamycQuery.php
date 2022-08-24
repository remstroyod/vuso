<?php

namespace Frontend\Queries\Constructor;

use Illuminate\Database\Eloquent\Builder;

class ConstructorDinamycQuery extends Builder
{


    /**
     * @param string $status
     */
    public function whereShortcode($page, $shortcode): static
    {

        if( request()->routeIs('b2b.product.index') )
        {
            $this->where('product_id', $page->id);
        }else{
            $this->where('page_id', $page->id);
        }

        return $this->where('shortcode', $shortcode);

    }

}
