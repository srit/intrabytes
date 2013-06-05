<?php
/**
 * @created 08.03.13 - 09:43
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Autoloader;
use Fuel\Core\Config;
use Fuel\Core\Finder;
use Fuel\Core\Fuel;

class Module extends \Fuel\Core\Module
{

    protected static $_init_modules = null;

    protected static $_module_path = '';

    protected static $_extended_graph = array();

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
                $paths = \Config::get('module_paths', array());

                if (!empty($paths)) {
                    foreach ($paths as $modpath) {
                        if (is_dir($path = $modpath . strtolower($module) . DS)) {
                            break;
                        }
                    }
                }

            }
            if (!is_dir($path)) {
                throw new \Exception(__('exception.srit.module.load.path.not_exists', array('path' => $path)));
            }
            \Finder::instance()->add_path($path, 1);
            $autoloader = \Finder::instance()->locate('', $path . '/autoloader.php');
            $base = \Finder::instance()->locate('', $path . '/base.php');
            if($autoloader == true) {
                \Fuel::load($autoloader);
            }
            if($base == true) {
                \Fuel::load($base);
            }
            return true;
        }
        return $parent_load;
    }

    public static function load_active_modules($force = true) {
        $paths = \Config::get('module_paths', array());
        static::$_module_path = $paths[0];
        static::init_modules($force);
    }

    public static function init_modules($force = true)
    {
        if ($force == true && static::$_init_modules === null) {
            self::register_modules();

            $active_modules = \Model_Module::find_active();

            if (!empty($active_modules)) {

                $extended_autloader = array();

                foreach ($active_modules as $module) {
                    $module_name = $module->get_name();
                    /**
                     * active module as always load
                     */
                    \Module::load($module_name);

                    /**
                     * @note config from database
                     */
                    $module_config = $module->get_config();
                    if (isset($module_config['extend'])
                        && !empty($module_config['extend'])
                        && is_array($module_config['extend'])
                    ) {

                        /**
                         * extending core classes
                         */
                        foreach ($module_config['extend'] as $clss => $file) {
                            $abs_file_path = static::$_module_path . $file;
                            list($namespace, $classes) = \File::get_namespace_classes_extends_from_file($abs_file_path);

                            if (empty($classes)) {
                                throw new \Exception(__('exception.srit.srit.init_modules.no_classes_defined', array('file' => $file)));
                            }

                            if (!isset(static::$_extended_graph[$clss])) {
                                static::$_extended_graph[$clss] = array();
                            }

                            foreach ($classes as $class => $extends) {
                                if(substr($extends, 0, 1) == '\\') {
                                    $extends = substr($extends, 1);
                                }

                                $class_with_namespace = $namespace . '\\' . $class;
                                $extends_with_namespace = $namespace . '\\' . $extends;

                                if(empty(static::$_extended_graph[$clss])) {
                                    $parent_extends = $clss;
                                } else {
                                    $cnt_class_graph = count(static::$_extended_graph[$clss]);
                                    $parent_extends = static::$_extended_graph[$clss][$cnt_class_graph - 1]['class'];
                                }

                                static::$_extended_graph[$clss][] = array(
                                    'class' => $class_with_namespace,
                                    'extends' => $extends_with_namespace
                                );

                                $class_dir_path = TMPPATH . 'classes' . DS;
                                $extend_class_file_name = str_replace('\\', '_', strtolower($extends_with_namespace)) . '.php';
                                $extend_class_file_path = $class_dir_path . $extend_class_file_name;

                                if (!file_exists($extend_class_file_path)) {

                                    if (!is_dir($class_dir_path)) {
                                        mkdir($class_dir_path, 0700);
                                    }

                                    $date_time = date('d.m.Y H:i');
                                    $class_content = <<<PHP
<?php
/**
 * @created {$date_time}
 * @author stefanriedel
 */

namespace {$namespace};

class {$extends} extends \\{$parent_extends} {

}

PHP;

                                    \File::create($class_dir_path, $extend_class_file_name, $class_content);


                                }

                                $extended_autloader[$extends_with_namespace] = $extend_class_file_path;
                                $extended_autloader[$class_with_namespace] = $abs_file_path;
                            }
                        }
                    }
                }

                if(!empty($extended_autloader)) {
                    Autoloader::add_classes($extended_autloader);
                }

                //var_dump(Autoloader::get_classes());

                // Load in the routes
                \Config::load('routes', true, true);
                \Router::add(\Config::get('routes'));
            }
        }
    }

    /**
     * @param $module
     * @throws Exception
     */
    public static function register_modules()
    {
        $paths = \Config::get('module_paths', array());
        if (!empty($paths)) {
            static::$_module_path = $paths[0];
            $module_finder = \Finder::forge(static::$_module_path);
            try {
                $dir_iterator = new \DirectoryIterator(static::$_module_path);
                foreach ($dir_iterator as $dir) {
                    if ($dir->isDir() && $dir->isDot() == false) {
                        if ($module_file = $module_finder->locate($dir, 'module')) {
                            require_once $module_file;
                            if (!isset($module['name'])) {
                                $module['name'] = (string)$dir;
                            }

                            if (($module_object = \Model_Module::find_by_name($module['name'])) == false) {
                                $module_object = \Model_Module::forge();
                                $module_object_properties = \Model_Module::properties();
                                $module_object_data = $module;
                                if (isset($module_object_data['title']) && is_array($module_object_data['title'])) {
                                    list($lang, $value, $module_object_properties, $module_object_data) = self::_declare_translated($module_object_data, $module_object_properties, 'title');
                                    unset($module_object_data['title']);
                                }
                                if (isset($module_object_data['description']) && is_array($module_object_data['description'])) {
                                    list($lang, $value, $module_object_properties, $module_object_data) = self::_declare_translated($module_object_data, $module_object_properties, 'description');
                                    unset($module_object_data['description']);
                                }

                                if($module_classes_path = static::$_module_path . $dir . '/classes'
                                    AND is_dir($module_classes_path)
                                    AND !$module_finder->locate($dir, 'autoloader')
                                    AND $module_classes_files = globr('*.php', 0, $module_classes_path, 10)) {


                                    $date_time = date('d.m.Y H:i');
                                    $namespace = ucfirst($dir);
                                    $files_to_autoloader = var_export(\File::find_classes_for_autoloader($module_classes_files), true);
                                    $content_autoloader = <<<PHP
<?php
/**
 * @created {$date_time}
 * @author stefanriedel
 */

Autoloader::add_core_namespace('{$namespace}');
Autoloader::add_classes({$files_to_autoloader});


PHP;

                                    \File::create(static::$_module_path . $dir, 'autoloader.php', $content_autoloader);
                                };

                                $max_sort = \Model_Module::max('sort');

                                $module_object_data['path'] = (string)$dir;
                                $module_object_data['active'] = 1;
                                $module_object_data['config'] = $module;
                                $module_object_data['sort'] = (int)$max_sort + 1;
                                $module_object->set($module_object_data);
                                $module_object->save();
                            }
                        }
                    }
                }
            } catch (\UnexpectedValueException $e) {
                throw new \Exception(__('exception.srit.srit.init_modules.path_not_exists', array('message' => $e->getMessage())));
            } catch (\RuntimeException $e) {
                throw new \Exception(__('exception.srit.srit.init_modules.runtime_error', array('message' => $e->getMessage())));
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