<?php
/**
 * @created 08.02.13 - 12:50
 * @author stefanriedel
 */
echo $theme->view('core/customers/_partials/customer_form', array('salutations' => $salutations, 'countries' => $countries, 'crud_objects' => $crud_objects));