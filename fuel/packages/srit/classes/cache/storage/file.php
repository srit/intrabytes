<?php
/**
 * @created 21.04.13 - 08:29
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\File;

class Cache_Storage_File extends \Fuel\Core\Cache_Storage_File
{
    public function delete_all($section)
    {

        $path = rtrim(static::$path, '\\/') . DS;
        $section = static::identifier_to_path($section);

        $files = \File::read_dir($path . $section, -1, array('\.cache$' => 'file'));

        return $this->_delete_all_files($files, $path.$section);
    }

    protected function _delete_all_files(array $files, $path) {
        $path = rtrim($path, '\\/') . DS;
        foreach($files as $dir => $file) {
            if(is_dir($path . $dir)) {
                $this->_delete_all_files($file, $path . $dir);
                rmdir($path.$dir);
            } else {
                File::delete($path.$file);
            }
        }
        return true;
    }

}