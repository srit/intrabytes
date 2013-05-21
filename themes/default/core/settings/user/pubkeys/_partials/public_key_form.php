<?php
/**
 * @created 12.02.13 - 10:48
 * @author stefanriedel
 */

$user_public_key = $crud_objects['srit:user_public_key']['data'];

?>
<form method="post" accept-charset="utf-8">

    <?php echo security_field(); ?>
    <?php echo html_legend(); ?>

    <div class="span6">
        <div class="control-group">
            <?php echo twitter_html_input_text('name', xss_clean($user_public_key->name)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_textarea('value', xss_clean($user_public_key->value)) ?>
        </div>
        <?php echo twitter_submit_group() ?>
    </div>
    <div class="span5">
        <?php echo form_help_text('pubkeys') ?>
    </div>
</form>
