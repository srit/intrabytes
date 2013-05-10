<?php
/**
 * @created 12.10.12 - 11:41
 * @author stefanriedel
 */

/**
 * @todo new code style!!
 */
?>
<?php if (true == $hash_true && false == $password_changed) { ?>
<form action="<?php echo confirmed_email_password_route($hash) ?>" method="post"
      accept-charset="utf-8" id="password_forget">
    <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>
    <?php echo \Form::password('password', '', array('class' => 'span4', 'placeholder' => __('forgetpassword.password.label'))) ?>
    <?php echo \Form::password('repeat_password', '', array('class' => 'span4', 'placeholder' => __('forgetpassword.password_confirm.label'))) ?>
    <?php echo \Form::button('submit', __('forgetpassword.change_password_button.label'), array('class' => 'btn btn-info', 'value' => 'submit')) ?>
    <?php echo html_anchor(login_route(), __('forgetpassword.cancel_button.label'), array('class' => 'btn btn-warning')) ?>
</form>
<?php } else { ?>
<?php echo html_anchor(login_route(), __('forgetpassword.back_to_login.label')) ?>
<?php } ?>
