<?php
/**
 * @created 21.06.13 - 15:27
 * @author stefanriedel
 */

\Event::register('module_activate', function(){
     \Model_Dashboard_Item::forge(array(
         'name' => 'tasks',
         'route' => 'tasks/dashboard/list'
     ))->save();
});


\Event::register('module_deactivate', function(){
    \Model_Dashboard_Item::find_by_name('tasks')->delete();
});
