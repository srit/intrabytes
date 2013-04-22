<?php
/**
 * @created 21.04.13 - 08:29
 * @author stefanriedel
 */

namespace Srit;

class Cache_Storage_File extends \Fuel\Core\Cache_Storage_File
{
    public function delete_all($section)
    {
        $path = rtrim(static::$path, '\\/') . DS;
        $section = static::identifier_to_path($section);

        $files = \File::read_dir($path . $section, -1, array('\.cache$' => 'file'));

        $delete = function ($path, $files) use (&$delete, &$section) {
            $path = rtrim($path, '\\/') . DS;

            foreach ($files as $dir => $file) {
                if (is_numeric($dir)) {
                    if (!$result = \File::delete($path . $file)) {
                        return $result;
                    }
                } else {
                    if (!$result = ($delete($path . $dir, $file) and is_dir($path . $dir) and rmdir($path . $dir))) {
                        return $result;
                    }
                }
            }

            $section !== '' and rmdir($path);

            return true;
        };

        return $delete($path . $section, $files);
    }
}