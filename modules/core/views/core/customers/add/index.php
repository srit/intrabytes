<?php
/**
 * @created 05.02.13 - 13:01
 * @author stefanriedel
 */
echo $theme->view($theme->get_templates_path_prefix() . 'customers/_partials/customer_form', array('salutations' => $salutations, 'countries' => $countries, 'crud_objects' => $crud_objects));
