<?php
/**
 * @created 19.03.13 - 21:22
 * @author stefanriedel
 */

return array(
    'top_right' => array(
        'settings' => array(
            'links' => array(
                'redmines_list' => array(
                    'acl' => 'Redmines\\List.index',
                    'module' => 'redmines',
                    'controller_name' => 'list',
                    'action' => 'index',
                    'links' => array(
                        'redmines_add' => array(
                            'acl' => 'Redmines\\Add.index',
                            'module' => 'redmines',
                            'controller_name' => 'add',
                            'action' => 'index',
                            'show' => false
                        ),
                        'redmines_edit' => array(
                            'acl' => 'Redmines\\Edit.index',
                            'module' => 'redmines',
                            'controller_name' => 'edit',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            )
                        ),
                        'redmines_delete' => array(
                            'acl' => 'Redmines\\Delete.index',
                            'module' => 'redmines',
                            'controller_name' => 'delete',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            )
                        ),
                        'redmines_show' => array(
                            'acl' => 'Redmines\\Show.index',
                            'module' => 'redmines',
                            'controller_name' => 'show',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            )
                        )
                    )
                )
            )
        )
    )
);