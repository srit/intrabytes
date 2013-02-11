<?php
return array(
	'_root_'  => 'dashboard/board',  // The default route
	'_404_'   => 'core/404',    // The main 404 route
    '_500_'   => 'core/500',    // The main 500 route
    '(:any)' => '$1',
    '(:any)/rest/(:any)' => '$1/rest/$2',
    '(:any)/(:any)/:id' => '$1/$2/index/$3',
);