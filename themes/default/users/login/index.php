<?php
/**
 * @created 28.09.12 - 12:05
 * @author stefanriedel
 */
?>
<form action="<?php echo \Uri::create('/users/login') ?>" method="post" accept-charset="utf-8" id="login"
      class="form-horizontal">
    <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>
    <?php echo \Form::input(
    'username',
    '',
    array('class' => 'span4', 'placeholder' => __('Nutzername/E-Mail'))
) ?>
    <?php echo \Form::password(
    'password',
    '',
    array('class' => 'span4', 'placeholder' => __('Passwort'))
) ?>
    <?php echo \Form::button('submit', __('Login'), array('class' => 'btn btn-info btn-block', 'value' => 'submit')) ?>
</form>
<?php echo \Html::anchor(\Uri::create('/users/password/forget'), __('Passwort vergessen')) ?>
