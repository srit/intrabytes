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
        <?php echo security_field(); ?>
        <?php echo twitter_html_input_password_wo_label('user[password]', '', __ext('password.label'), array(), array('class' => 'span4')) ?>
        <?php echo twitter_html_input_password_wo_label('user[password_repeat]', '', __ext('password_repeat.label'), array(), array('class' => 'span4')) ?>
        <?php echo twitter_html_submit_button('submit', 'submit', __ext('login.button.label'), array(), array('class' => 'btn btn-info')) ?>
        <?php echo html_anchor(named_route('login'), __ext('forgetpassword.cancel_button.label'), array('class' => 'btn btn-warning')) ?>
    </form>
<?php } else { ?>
    <?php echo html_anchor(login_route(), __ext('back_to_login.label')) ?>
<?php } ?>
