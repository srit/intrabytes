<?php
/**
 * @created 13.02.2013
 * @author stefanriedel
 */

$project = $crud_objects['customer_project']['data'];

?>
<form method="post" accept-charset="utf-8" id="customer">
    <div class="span11">
        <?php echo html_hidden('customer_id', xss_clean($project->customer_id)) ?>
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
    </div>
    <div class="span7">
        <div class="control-group">
            <?php echo twitter_html_input_text('name', xss_clean($project->name), null, array(), array(), array('tabindex' => 1)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_textarea('description', xss_clean($project->description), null, array(), array(), array('style' => 'width: 550px; height: 200px;')) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('url', xss_clean($project->url), null, array(), array(), array('tabindex' => 2)) ?>
        </div>
        <?php echo twitter_submit_group() ?>
    </div>
    <div class="span4">
        <?php echo form_help_text('projects') ?>
    </div>
</form>