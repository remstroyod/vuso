<?php
namespace Backend\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

trait GoogleDrive
{

    protected $folder;

    /**
     *
     */
    public function __construct()
    {

        $this->folder = env('GOOGLE_DRIVE_ROOT_FOLDER_ID');

    }

    /**
     * @param $recursive
     * @return array
     */
    public function listFolders($recursive = false)
    {

        $folders = Storage::disk('google')->listContents($this->folder, $recursive);
        $arr = Arr::where($folders, function ($value, $key)
        {
            return $value['type'] == 'dir';
        });

        return new Collection($arr);

    }

}
