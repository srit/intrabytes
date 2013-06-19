<?php
/**
 * @created 02.05.13 - 11:06
 * @author stefanriedel
 */

echo $theme->view('templates/_partials/email_head'); ?>


Hallo <?php echo $user ?>,

für deinen Account wurde ein neues Passwort angefordert.

Bitte folge dem Link <?php echo html_anchor($link, __ext('confirm_link.label')) ?>, um diese Aktion zu bestätigen. Danach kannst du ganz bequem dein neues Passwort wie gewohnt vergeben.

Beste Grüße

<?php echo $theme->view('templates/_partials/email_footer'); ?>