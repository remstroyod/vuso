<?php
namespace Frontend\Traits;

use Frontend\Scopes\IsActiveScope;

trait IsActiveTrait
{

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new IsActiveScope());
    }

}
