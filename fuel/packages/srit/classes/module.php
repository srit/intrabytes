<?php
/**
 * @created 08.03.13 - 09:43
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Config;
use Fuel\Core\Finder;
use Fuel\Core\Fuel;

class Module extends \Fuel\Core\Module
{
    /**
     * @param $module
     * @param null $path
     * @return bool
     * @throws \Fuel\Core\FuelException
     */
    public static function load($module, $path = null)
    {
        $parent_load = parent::load($module, $path);
        if ($parent_load == true) {
            if ($path === null) {
                $paths = Config::get('module_paths', array());

                if (!empty($paths)) {
                    foreach ($paths as $modpath) {
                        if (is_dir($path = $modpath . strtolower($module) . DS)) {
                            break;
                        }
                    }
                }

            }
            if (!is_dir($path)) {
                throw new Exception(__('exception.srit.module.load.path.not_exists', array('path' => $path)));
            }
            Finder::instance()->add_path($path, 1);
            $base =Finder::instance()->locate('', $path . '/base.php');
            if($base == true) {
                Fuel::load($base);
            }
            return true;
        }
        return $parent_load;
    }
}