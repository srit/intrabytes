<?php
/**
 * @created 27.02.13 - 20:03
 * @author stefanriedel
 */

echo $theme->view('core/settings/locales/_partials/locales_form', array('locale' => $crud_objects['srit:locale']['data'], 'language_id' => $language_id));