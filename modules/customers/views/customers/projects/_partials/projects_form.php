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
    <div class="span3">
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('name', xss_clean($project->name), null, array(), array(), array('tabindex' => 1)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('url', xss_clean($project->url), null, array(), array(), array('tabindex' => 2)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_select('redmine_id', $redmines, xss_clean($project->redmine_id)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('redmine_project_label', xss_clean($project->redmine_project_label), null, array(), array(), array('tabindex' => 3)) ?>
            </div>
        </div>
    </div>
    <div class="span11">
        <?php echo twitter_submit_group() ?>
    </div>
</form>