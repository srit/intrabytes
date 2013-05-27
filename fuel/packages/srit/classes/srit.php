<?php
/**
 * @created 26.05.13 - 21:46
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Config;
use Fuel\Core\Finder;
use Fuel\Core\Router;

class Srit
{

    protected static $_init_modules = null;

    public static function init()
    {
        static::init_modules();
    }

    public static function init_modules($force = true)
    {
        if ($force == true && static::$_init_modules === null) {
            self::_register_modules();
            $active_modules = Model_Module::find_active(1);
            if(!empty($active_modules)) {
                foreach($active_modules as $module) {
                    Module::load($module->get_path());
                }
                // Load in the routes
                Config::load('routes', true, true);
                Router::add(Config::get('routes'));
            }
        }
    }

    /**
     * @param $module
     * @throws Exception
     */
    protected static function _register_modules()
    {
        $paths = Config::get('module_paths', array());
        if (!empty($paths)) {
            $path = $paths[0];
            $module_finder = Finder::forge($path);
            try {
                $dir_iterator = new \DirectoryIterator($path);
                foreach ($dir_iterator as $dir) {
                    if ($dir->isDir() && $dir->isDot() == false) {
                        if ($module_file = $module_finder->locate($dir, 'module')) {
                            require_once $module_file;
                            if (!isset($module['name'])) {
                                throw new Exception(__('exception.srit.srit.init_modules.module_name_not_defined', array('module_dir' => $dir)));
                            }
                            if (($module_object = Model_Module::find_by_name($module['name'])) == false) {
                                $module_object = Model_Module::forge();
                                $module_object_properties = Model_Module::properties();
                                $module_object_data = $module;
                                if (isset($module_object_data['title']) && is_array($module_object_data['title'])) {
                                    list($lang, $value, $module_object_properties, $module_object_data) = self::_declare_translated($module_object_data, $module_object_properties, 'title');
                                    unset($module_object_data['title']);
                                }
                                if (isset($module_object_data['description']) && is_array($module_object_data['description'])) {
                                    list($lang, $value, $module_object_properties, $module_object_data) = self::_declare_translated($module_object_data, $module_object_properties, 'description');
                                    unset($module_object_data['description']);
                                }
                                $module_object_data['path'] = $dir;
                                $module_object_data['active'] = 0;
                                $module_object_data['config'] = $module;
                                $module_object->set($module_object_data);
                                $module_object->save();
                            }
                        }
                    }
                }
            } catch (\UnexpectedValueException $e) {
                throw new Exception(__('exception.srit.srit.init_modules.path_not_exists', array('message' => $e->getMessage())));
            } catch (\RuntimeException $e) {
                throw new Exception(__('exception.srit.srit.init_modules.runtime_error', array('message' => $e->getMessage())));
            }
        }
    }

    /**
     * @param $module_object_data
     * @param $module_object_properties
     * @return array
     */
    private static function _declare_translated($module_object_data, $module_object_properties, $property)
    {
        foreach ($module_object_data[$property] as $lang => $value) {
            if (isset($module_object_properties[$property . '_' . $lang])) {
                $module_object_data[$property . '_' . $lang] = $value;
            }
        }
        return array($lang, $value, $module_object_properties, $module_object_data);
    }

}