<?php
/**
 * @created 08.02.13 - 12:50
 * @author stefanriedel
 */
echo $theme->view($theme->get_templates_path_prefix() . '/customers/_partials/customer_form', array('salutations' => $salutations, 'countries' => $countries, 'customer' => $customer));