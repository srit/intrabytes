<?php
/**
 * @created 12.02.13 - 10:48
 * @author stefanriedel
 */

$user_public_key = $crud_objects['user_public_key']['data'];

?>
<form method="post" accept-charset="utf-8">
    <?php echo security_field(); ?>

    <div class="control-group">
        <div class="controls">
            <?php echo twitter_html_input_text('name', xss_clean($user_public_key->name)) ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo twitter_html_input_textarea('value', xss_clean($user_public_key->value)) ?>
        </div>
    </div>
    <?php echo twitter_submit_group() ?>
</form>
