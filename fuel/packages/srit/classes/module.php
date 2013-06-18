<?php
/**
 * @created 12.06.13 - 09:50
 * @author stefanriedel
 */

namespace Srit;

use Srit\Autoloader;

class Module extends \Fuel\Core\Module
{

    protected static $_instances = array();

    protected static $_module_paths = array();

    protected static $_module_search_path = null;

    protected static $_module_finder = null;

    protected static $_active_modules = null;

    protected static $_extended_graph = array();

    protected static $_initialized = false;

    protected $_module_name = null;

    /**
     * @param $path
     */
    protected static function _load_module_file($file, $path)
    {
        $file_found = \Finder::instance()->locate('', $path . '/' . $file);
        if ($file_found == true) {
            \Fuel::load($file_found);
        }
    }

    /**
     * @param null $module_name
     */
    public function set_module_name($module_name)
    {
        $this->_module_name = $module_name;
        return $this;
    }

    /**
     * @return string
     */
    protected static function _get_graph_identifier()
    {
        $class_graph_cache_identifier = \Cache::build_cache_identifier_from_array(array(get_called_class(), __METHOD__), '.', false);
        $class_graph_cache_identifier .= \Cache::build_cache_identifier_from_array(array('class_graph'));
        return $class_graph_cache_identifier;
    }

    /**
     * @return null
     */
    public function get_module_name()
    {
        return $this->_module_name;
    }

    public static function is_active($module) {
        return \Model_Module::is_active($module);
    }

    public static function load($module, $path = null)
    {
        if(empty($module)) {
            return;
        }
        if(is_array($module)) {
            foreach($module as $mod) {
                static::load($mod, $path);
            }
        }

        if (static::$_active_modules == null) {
            static::init_modules();
        }

        if (static::$_active_modules->count() == 0 || !static::is_active($module)) {
            throw new \Exception(__('exception.srit.load.module_not_activated', array('module' => $module)));
        }

        $parent_load = parent::load($module, $path);
        if (!empty($module) && $parent_load == true) {
            static::_init_autoloader($module);

            if ($path === null) {
                $conf_module_paths = \Config::get('module_paths', array());
                if (!empty($conf_module_paths)) {
                    $path = $conf_module_paths[0] . $module;
                }
            }

            \Finder::instance()->add_path($path);
            static::_load_module_file('autoloader.php', $path);
            static::_load_module_file('base.php', $path);
            static::_load_module_file('bootstrap.php', $path);

        }
        return $parent_load;
    }

    public static function init_modules($force = false)
    {
        if ($force == true || static::$_initialized == false) {
            if (\Fuel::$profiling)
            {
                \Profiler::mark(__METHOD__.' Start');
            }
            $conf_module_paths = \Config::get('module_paths', array());
            static::$_module_search_path = $conf_module_paths[0];
            static::$_module_finder = \Finder::forge(static::$_module_search_path);
            static::register_modules();
            static::load_activated_modules();
            static::_fuel();
            static::$_initialized = true;
            if (\Fuel::$profiling)
            {
                \Profiler::mark(__METHOD__.' Start');
            }
        }
    }

    protected static function _fuel()
    {
        \Config::load('routes', true, true, true);
        \Router::add(\Config::get('routes'));
    }


    public static function load_activated_modules()
    {
        static::$_active_modules = \Model_Module::find_active();

        if (static::$_active_modules->count() > 0) {
            $class_graph_cache_identifier = self::_get_graph_identifier();

            try {
                static::$_extended_graph = \Cache::get($class_graph_cache_identifier);
            } catch (\CacheNotFoundException $e) {
                foreach (static::$_active_modules as $module) {
                    \Logger::forge()->addInfo('Iterate in Module', array($module->get_name()));
                    $module_config = $module->get_config();
                    if (isset($module_config['extend'])) {
                        static::extending_classes($module_config['extend']);
                    }
                }
                \Cache::set($class_graph_cache_identifier, static::$_extended_graph);
            }

            if (!empty(static::$_extended_graph)) {
                foreach (static::$_extended_graph as $clss) {
                    foreach ($clss as $extended) {
                        if (isset($extended['autoloader'])) {
                            Autoloader::add_classes($extended['autoloader']);
                        }
                    }
                }
            }


            foreach (static::$_active_modules as $module) {
                static::load((string)$module);
            }

        }
    }

    public static function extending_classes(array $extends)
    {
        foreach ($extends as $clss => $path) {
            static::extending_class($clss, $path);
        }
    }

    public static function extending_class($clss, $path)
    {
        $abs_path = static::$_module_search_path . $path;
        list($namespace, $classes) = \File::get_namespace_classes_extends_from_file($abs_path);
        if (empty($classes)) {
            throw new \Exception(__('exception.srit.srit.init_modules.no_classes_defined'));
        }

        if (!isset(static::$_extended_graph[$clss])) {
            static::$_extended_graph[$clss] = array();
        }

        foreach ($classes as $class => $extends) {
            if (substr($extends, 0, 1) == '\\') {
                $extends = substr($extends, 1);
            }

            $class_with_namespace = $namespace . '\\' . $class;
            $extends_with_namespace = $namespace . '\\' . $extends;

            if (empty(static::$_extended_graph[$clss])) {
                $parent_extends = $clss;
            } else {
                $cnt_class_graph = count(static::$_extended_graph[$clss]);
                $parent_extends = static::$_extended_graph[$clss][$cnt_class_graph - 1]['class'];
            }


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

            static::$_extended_graph[$clss][] = array(
                'class' => $class_with_namespace,
                'extends' => $extends_with_namespace,
                'autoloader' => array(
                    $extends_with_namespace => $extend_class_file_path,
                    $class_with_namespace => $abs_path
                )
            );

            //static::$_extended_autoloader[$extends_with_namespace] = $extend_class_file_path;
            //static::$_extended_autoloader[$class_with_namespace] = $abs_file_path;
        }

    }

    public static function register_modules()
    {
        $modules_in_rdb = \Model_Module::find_all();
        $modules_in_dir = static::get_module_paths();
        $modules_diff = array_diff($modules_in_dir, $modules_in_rdb->get_module_names_array());

        if (!empty($modules_diff)) {
            foreach ($modules_diff as $module_name) {
                static::add_new_module($module_name);
            }
        }
    }

    public static function add_new_module($module_name)
    {
        $module_finder = static::$_module_finder;
        if (($module_file = $module_finder->locate($module_name, 'module')) == false) {
            return false;
        }
        require_once $module_file;
        $module_object = \Model_Module::forge();
        $module_object_data = $module;
        $module_object_properties = \Model_Module::properties();
        if (isset($module_object_data['title']) && is_array($module_object_data['title'])) {
            $module_object_data = self::_declare_translated($module_object_data, $module_object_properties, 'title');
            unset($module_object_data['title']);
        }

        if (isset($module_object_data['description']) && is_array($module_object_data['description'])) {
            $module_object_data = self::_declare_translated($module_object_data, $module_object_properties, 'description');
            unset($module_object_data['description']);
        }

        $max_sort = \Model_Module::max('sort');
        $module_object_data['name'] = $module_name;
        $module_object_data['path'] = $module_name;
        $module_object_data['active'] = 0;
        $module_object_data['config'] = $module;
        $module_object_data['sort'] = (int)$max_sort + 1;
        $module_object->set($module_object_data);
        $module_object->save();
        return $module_object;

    }

    public static function get_module_paths()
    {
        if (empty(static::$_module_paths)) {
            $dir_iterator = new \DirectoryIterator(static::$_module_search_path);
            foreach ($dir_iterator as $module_name) {
                if ($module_name->isDir() && $module_name->isDot() == false) {
                    static::$_module_paths[] = (string)$module_name;
                }
            }
        }
        return static::$_module_paths;
    }

    public static function forge($module_name)
    {
        if (!isset(static::$_instances[$module_name])) {
            static::$_instances[$module_name] = new static($module_name);
        }
        return static::$_instances[$module_name];
    }

    public function __construct($module_name)
    {
        $this->set_module_name($module_name);
    }

    private static function _declare_translated($module_object_data, $module_object_properties, $property)
    {
        foreach ($module_object_data[$property] as $lang => $value) {
            if (isset($module_object_properties[$property . '_' . $lang])) {
                $module_object_data[$property . '_' . $lang] = $value;
            }
        }
        return $module_object_data;
    }

    protected static function _init_autoloader($module, $module_finder = null)
    {
        if ($module_finder == null) {
            $module_finder = \Finder::forge(static::$_module_search_path);
        }
        if ($module_classes_path = static::$_module_search_path . $module . '/classes'
            AND is_dir($module_classes_path)
            AND !$module_finder->locate($module, 'autoloader')
            AND $module_classes_files = globr('*.php', 0, $module_classes_path, 10)
        ) {

            $date_time = date('d.m.Y H:i');
            $namespace = ucfirst($module);
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

            \File::create(static::$_module_search_path . $module, 'autoloader.php', $content_autoloader);
        };
    }

    public static function deactivate($module_name) {
        if($module_model = \Model_Module::find_by_name($module_name)) {
            $module_model->set_active(false);
            $module_model->save();
            $graph_identifier = static::_get_graph_identifier();
            \Cache::delete($graph_identifier);
            static::init_modules(true);
            return true;
        }
        throw new \Exception(__('exception.srit.activate.module_not_exists', array('module' => $module_name)));
    }

    public static function activate($module_name) {
        if($module_model = \Model_Module::find_by_name($module_name)) {
            $module_model->set_active(true);
            $module_model->save();
            $graph_identifier = static::_get_graph_identifier();
            \Cache::delete($graph_identifier);
            static::init_modules(true);
            return true;
        }
        throw new \Exception(__('exception.srit.activate.module_not_exists', array('module' => $module_name)));
    }

}