<?php

namespace Frontend\Queries\Constructor;

use Illuminate\Database\Eloquent\Builder;

class ConstructorShortcodeQuery extends Builder
{


    /**
     * @param string $status
     */
    public function whereShortcode($shortcode): static
    {

        $this->where('shortcode', $shortcode);

        return $this;

    }

}
