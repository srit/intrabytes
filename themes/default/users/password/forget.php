<?php
/**
 * @created 01.10.12 - 13:41
 * @author stefanriedel
 */

/**
 * @todo new code style
 */

?>
<form action="<?php echo \Uri::create('/users/password/forget') ?>" method="post" accept-charset="utf-8"
      id="password_forget">

    <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>
    <?php echo \Form::input(
    'username',
    '',
    array('class' => 'span4', 'placeholder' => __(extend_locale('username.label')))
) ?>



    <?php echo \Form::button(
    'submit',
    __(extend_locale('send.label')),
    array('class' => 'btn btn-block btn-info', 'value' => 'submit')
) ?>
</form>
<?php echo \Html::anchor(\Uri::create('/users/login'), __(extend_locale('back_to_login.label'))) ?>
