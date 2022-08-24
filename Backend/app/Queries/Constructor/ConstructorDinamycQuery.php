<?php

namespace Backend\Queries\Constructor;

use Illuminate\Database\Eloquent\Builder;

class ConstructorDinamycQuery extends Builder
{


    /**
     * @param string $status
     */
    public function whereShortcode($page, $shortcode): static
    {

        $this
            ->where('page_id', $page->id)
            ->where('shortcode', $shortcode);

        return $this;

    }

}
