<?php
/**
 * @created 19.03.13 - 21:22
 * @author stefanriedel
 */

return array(
    'top_right' => array(
        'settings' => array(
            'links' => array(
                'redmines' => array(
                    'route' => redmines_list_route(),
                    'acl' => 'Redmines\\List.index',
                    'module' => 'redmines',
                    'controller_name' => 'list',
                    'action' => 'index'
                )
            )
        )
    )
);