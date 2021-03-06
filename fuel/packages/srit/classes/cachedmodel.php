<?php
/**
 * @created 22.05.13 - 13:48
 * @author stefanriedel
 */

namespace Srit;

class CachedModel extends \Model
{

    public static function max($key = null)
    {
        return static::_cached('max', array($key));
    }

    public static function min($key = null)
    {
        return static::_cached('min', array($key));
    }

    public static function count(array $options = array())
    {
        return static::_cached('count', array($options));

    }

    public static function find($id = null, array $options = array())
    {
        return static::_cached('find', array($id, $options));

        /**$identifier = static::build_cache_identifier_from_array(array(get_called_class(), __FUNCTION__), '.', false);
        $identifier .= static::build_cache_identifier_from_array(array($id, $options));

        try {
        $data = Cache::get($identifier);
        } catch (CacheNotFoundException $e) {
        $data = parent::find($id, $options);
        if (Config::get('caching') == true) {
        Cache::set($identifier, $data);
        }
        }
        return $data;**/
        //Logger::forge('model')->debug('Find Function Args MODEL:', array($id, $options));

    }

    protected static function _cached($function, array $args)
    {
        $identifier = \Cache::build_cache_identifier_from_array(array(get_called_class(), $function), '.', false);
        $identifier .= \Cache::build_cache_identifier_from_array($args);

        try {
            $data = \Cache::get($identifier);
        } catch (\CacheNotFoundException $e) {
            $data = forward_static_call_array(array(get_parent_class(), $function), $args);


            //parent::find($id, $options);
            if (\Config::get('caching') == true) {
                \Cache::set($identifier, $data);
            }
        }

        return $data;

    }

    protected function _rm_cache($function, $args)
    {
        try {
            $return = call_user_func_array(array(get_parent_class(), $function), $args);
            $identifier = \Cache::build_cache_identifier_from_array(array(get_called_class()), '.');
            \Cache::delete_all($identifier);
        } catch (\Exception $e) {
            throw new \Exception(__('exception.srit.model.' . $function, array('message' => $e->getMessage())));
        }

        return $return;
    }

    public function delete($cascade = null, $use_transaction = false)
    {
        /**try {
        $return = parent::delete($cascade, $use_transaction);
        $identifier = static::build_cache_identifier_from_array(array(get_called_class()), '.');
        Cache::delete_all($identifier);
        } catch (\Fuel\Core\Exception $e) {
        throw new Exception(__('exception.srit.model.delete'));
        }

        return $return; */

        return $this->_rm_cache('delete', array($cascade, $use_transaction));
    }

    public function save($cascade = null, $use_transaction = false)
    {
        /**try {
        $return = parent::save($cascade, $use_transaction);
        $identifier = static::build_cache_identifier_from_array(array(get_called_class()), '.');
        Cache::delete_all($identifier);
        } catch (\Fuel\Core\Exception $e) {
        throw new Exception(__('exception.srit.model.save'));
        }

        return $return; **/
        return $this->_rm_cache('save', array($cascade, $use_transaction));
    }

}