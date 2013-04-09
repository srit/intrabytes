<?php
/**
 * @created 09.04.13 - 21:35
 * @author stefanriedel
 */

$profile = $crud_objects['user_profile']['data'];

?>
<form method="post" accept-charset="utf-8" id="customer">
    <?php echo security_field(); ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="span5">
                <div class="control-group">
                    <?php echo twitter_html_input_text('firstname', xss_clean($profile->firstname)) ?>
                </div>
                <div class="control-group">
                    <?php echo twitter_html_input_text('lastname', xss_clean($profile->lastname)) ?>
                </div>
                <div class="control-group">
                    <?php echo twitter_html_input_text('birthday', xss_clean($profile->birthday)) ?>
                </div>
            </div>
            <div class="span6"><?php echo form_help_text('edit_my_profile') ?></div>
        </div>
    </div>
</form>