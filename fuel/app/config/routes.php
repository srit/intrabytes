<?php
return array(
	'_root_'  => 'dashboard/board',  // The default route
	'_404_'   => 'core/404',    // The main 404 route
    '_500_'   => 'core/500',    // The main 500 route
    '(:any)/edit/(:id)' => '$1/edit/index/$2',
    '(:any)/delete/(:id)' => '$1/delete/index/$2',
    '(:any)/show/(:id)' => '$1/show/index/$2'
);