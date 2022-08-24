<?php
namespace Backend\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait BlocksTrait
{

    /**
     * @param null $item
     * @param $dir
     * @param array $size
     * @return mixed|string|null
     */
    public function blocksTemplates()
    {

        $out = [];
        $files = File::allFiles(base_path() . '/../Frontend/resources/views/components');

        if( $files )
        {
            foreach ( $files as $file )
            {

                $content = File::get($file);
                $title = Str::between($content, '{{--Component:', ':Component--}}');

                /**
                 * Fields
                 */
                $contains_fields = Str::contains($content, '{{--Fields:');
                if( $contains_fields )
                {
                    $fields = trim(Str::between($content, '{{--Fields:', ':Fields--}}'));

                    if( !empty($fields) )
                    {
                        $fields = Str::of($fields)->ltrim()->rtrim()->split('/[\s,]+/')->toJson();
                    }
                }

                /**
                 * Get File
                 */
                $name = Str::remove('.blade.php', $file->getFilename());

                $out['list'][$name] = $title;
                $out['fields'][$name]['fields'] = $fields;

                $fields = [];
            }

        }

        return $out;

    }

    /**
     * @param $data
     * @param $component
     * @return void
     */
    public function blocksFieldsArray($data, $component)
    {

        if( array_key_exists($component, $data['fields']) )
        {
            if( array_key_exists('fields', $data['fields'][$component]) )
            {
                if( $data['fields'][$component]['fields'] )
                {
                    $arr = json_decode($data['fields'][$component]['fields']);
                    return array_flip($arr);
                }
            }
        }

    }

}
