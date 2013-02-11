<?php
/**
 * @created 05.02.13 - 13:01
 * @author stefanriedel
 */
echo $theme->view('customers/_partials/customer_form', array('customer' => $customer, 'salutations' => $salutations, 'countries' => $countries, 'city_text' => $city_text, 'postalcode_text' => $postalcode_text, 'country_id' => $country_id));
