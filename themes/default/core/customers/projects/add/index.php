<?php
/**
 * @created 13.02.2013
 * @author stefanriedel
 */
echo $theme->view($theme->get_templates_path_prefix() . 'customers/projects/_partials/projects_form', array('customer_project' => $customer_project));