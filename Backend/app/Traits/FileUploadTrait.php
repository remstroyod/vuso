<?php
namespace Backend\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait FileUploadTrait
{

    /**
     * @param null $item
     * @param $dir
     * @param array $size
     * @return mixed|string|null
     */
    public function fileUpload($item = null, $dir = 'files', $filename = false)
    {

        $name = $item->input_file;

        if ($name && request()->remove) :
            $this->remove($item);
            $name = null;
        endif;

        $source = request()->file('input_file');

        if ($source) :

            if ($item->input_file) :
                $this->remove($item);
                $name = null;
            endif;

            $src = $source->store('files/' . $dir, 'public');
            $name = basename($src);

        endif;

        if( $filename ) {
            return (object) [
                'name' => $name,
                'filename' => $source->getClientOriginalName()
            ];
        }else{
            return $name;
        }

    }


    /**
     * @param $item
     */
    public function fileRemove($item, $dir = 'files')
    {

        $file = $item->file;

        if ($file) :

            Storage::disk('public')->delete('files/' . $dir . '/' . $file);

        endif;

    }

}
