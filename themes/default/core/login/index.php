<?php
/**
 * @created 28.09.12 - 12:05
 * @author stefanriedel
 */
?>
<form action="<?php echo \Uri::create('/users/login') ?>" method="post" accept-charset="utf-8" id="login"
      class="form-horizontal">

    <?php echo security_field(); ?>
    <?php echo twitter_html_input_text_wo_label('username', xss_clean($username), extend_locale('username.label'), array(), array('class' => 'span4')) ?>
    <?php echo twitter_html_input_password_wo_label('password', '', extend_locale('password.label'), array(), array('class' => 'span4')) ?>
    <?php echo twitter_html_submit_button('submit', 'submit', extend_locale('login.button.label'), array(), array('class' => 'btn-info btn-block')) ?>

</form>
<?php echo html_anchor(forget_password_route(), extend_locale('forgetpassword.label')) ?>
