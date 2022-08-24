<?php
namespace Backend\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageUploadTrait
{

    /**
     * @param null $item
     * @param $dir
     * @param array $size
     * @return mixed|string|null
     */
    public function imageUpload($item = null, $dir = 'images', $field = 'image')
    {

        $name = $item->{$field};

        if ($name && request()->remove) :
            $this->remove($item);
            $name = null;
        endif;

        $source = request()->file($field);

        if ($source) :

            $src = $source->store('images/' . $dir, 'public');
            $name = basename($src);

        endif;

        return $name;
    }

    /**
     * @param $src
     * @param $dst
     * @param $width
     * @param $height
     */
    private function resize($src, $dst, $width, $height)
    {

        $path = Storage::disk('public')->path($src);

        $image = Image::make($path)
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee')
            ->encode(pathinfo($path, PATHINFO_EXTENSION), 100);

        Storage::disk('public')->put($dst, $image);

        $image->destroy();

    }

    /**
     * @param $item
     */
    public function imageRemove($item, $dir = 'images', $field = 'image')
    {

        $image = $item->{$field};

        if ($image) :

            Storage::disk('public')->delete('images/' . $dir . '/' . $image);

        endif;

    }

}
