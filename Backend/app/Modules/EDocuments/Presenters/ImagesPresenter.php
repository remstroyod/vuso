<?php
namespace Backend\Modules\EDocuments\Presenters;

use Illuminate\Support\Str;
use McCool\LaravelAutoPresenter\BasePresenter;
use Rolandstarke\Thumbnail\Thumbnail;

class ImagesPresenter extends BasePresenter
{

    protected $thumbnail;

    public function __construct(Thumbnail $thumbnail)
    {

        /**
         * Thumbnail
         */
        $this->thumbnail = $thumbnail;

    }

    /**
     * @param $categories
     * @return string
     */
    public function getThumbnail(): string
    {

        return Str::of($this->thumbnail->src('/images/modules/edocuments/images/' . $this->image, 'public')->smartcrop(50, 50)->url())->replace('//storage', '/storage');

    }

}
