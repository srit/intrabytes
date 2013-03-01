<?php
/**
 * @created 12.02.13 - 10:48
 * @author stefanriedel
 */

$user_public_key = $crud_objects['user_public_key']['data'];

?>
<form method="post" accept-charset="utf-8">

    <?php echo security_field(); ?>
    <?php echo html_legend(); ?>

    <div class="span6">
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
    </div>
    <div class="span5">
        <p>If you want to change your email or password please remember to do these three things.</p>
        <ul>
            <li>The first thing you should do is this</li>
            <li>The second thing is probably this</li>
            <li>There isn't actually a third thing</li>
        </ul>
    </div>

</form>

<!--
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
 -->
