<?php
/**
 * @created 21.05.13 - 09:15
 * @author stefanriedel
 */

namespace Srit;

class Cache_Storage_Memcached extends \Fuel\Core\Cache_Storage_Memcached {

    /**
     *
     * with prefixes ;-)
     *
     * @param $section
     * @return bool|void
     */
    public function delete_all($section)
    {
        // determine the section index name
        $section = $this->config['cache_id'] . (empty($section) ? '' : '.' . $section);

        // get the directory index
        $index = $this->memcached->get($this->config['cache_id'] . '__DIR__');

        $dirs = array();

        if (is_array($index)) {
            // limit the delete if we have a valid section
            if (!empty($section)) {
                if (in_array($section, $index)) {
                    $dirs[] = $section;
                } else {
                    foreach ($index as $identifier) {
                        if (preg_match('/^' . $section . '/', $identifier)) {
                            $dirs[] = $identifier;
                        }
                    }
                }
            } else {
                $dirs = $index;
            }

            // loop through the indexes, delete all stored keys, then delete the indexes
            foreach ($dirs as $dir) {
                $list = $this->memcached->get($dir);
                foreach ($list as $item) {
                    $this->memcached->delete($item[0]);
                }
                $this->memcached->delete($dir);
            }

            // update the directory index
            $index = array_diff($index, $dirs);
            $this->memcached->set($this->config['cache_id'] . '__DIR__', $index);
        }
    }
}