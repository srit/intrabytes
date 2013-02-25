<?php
/**
 * @created 24.02.13 - 13:29
 * @author stefanriedel
 */
$redmine = $crud_objects['redmine']['data'];
?>

<form method="post" accept-charset="utf-8" id="customer">
    <div class="span12">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
    </div>

    <div class="span3">
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('redmine[name]', xss_clean($redmine->name)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('redmine[url]', xss_clean($redmine->url)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('redmine[api_key]', xss_clean($redmine->api_key)) ?>
            </div>
        </div>
    </div>
    <div class="span10">
        <?php echo twitter_submit_group() ?>
    </div>
</form>

