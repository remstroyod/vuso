<?php

namespace Frontend\Queries\Catalog;

use Backend\Enums\CatalogEnum;
use Frontend\Models\Catalog\Contragents;
use Illuminate\Database\Eloquent\Builder;

class CategoryQuery extends Builder
{

    /**
     * @param $id
     * @return $this
     */
    public function whereAttach($contragent = []): CategoryQuery
    {

        if( !$contragent )
            $contragent = (new Contragents())->whereDefault()->where('is_attach', 1)->first();

        if( $contragent )
            $this->whereDefault()->where('category_type_id', $contragent->id);

        return $this;
    }

    public function whereAttachB2B($contragent = []): CategoryQuery
    {

        if( !$contragent )
            $contragent = (new Contragents())->whereDefault()->where('is_attach', 1)->first();

        if( $contragent )
            $this->whereB2B()->where('category_type_id', $contragent->id);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereDefault(): CategoryQuery
    {

        $this->where('type', CatalogEnum::default);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereB2B(): CategoryQuery
    {

        $this->where('type', CatalogEnum::b2b);

        return $this;
    }

}
