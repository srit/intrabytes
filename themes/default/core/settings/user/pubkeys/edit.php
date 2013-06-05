<?php
/**
 * @created 12.02.13 - 10:47
 * @author stefanriedel
 */

/**
 * @todo controller_template_path
 */
echo $theme->view('core/settings/user/pubkeys/_partials/public_key_form', array('user_public_key' => $user_public_key));