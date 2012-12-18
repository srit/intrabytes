<?php
/**
 * @created 12.10.12 - 11:41
 * @author stefanriedel
 */
?>
<?php if (true == $hash_true && false == $password_changed) { ?>
<form action="<?php echo \Uri::create('/users/password/confirmed_email/' . $hash) ?>" method="post"
      accept-charset="utf-8" id="password_forget">
    <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>
    <?php echo \Form::password('password', '', array('class' => 'span4', 'placeholder' => __('Passwort'))) ?>
    <?php echo \Form::password('repeat_password', '', array('class' => 'span4', 'placeholder' => __('Password wiederholen'))) ?>
    <?php echo \Form::button('submit', __('Passwort ändern'), array('class' => 'btn btn-info', 'value' => 'submit')) ?>
    <?php echo \Html::anchor(\Uri::create('/users/login'), __('Abbruch'), array('class' => 'btn btn-warning')) ?>
</form>
<?php } else { ?>
<?php echo \Html::anchor(\Uri::create('/users/login'), __('Zurück zum Login')) ?>
<?php } ?>
