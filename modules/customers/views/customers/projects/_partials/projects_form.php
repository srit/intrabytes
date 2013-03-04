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
    <div class="span6">
        <div class="control-group">
            <?php echo twitter_html_input_text('name', xss_clean($project->name), null, array(), array(), array('tabindex' => 1)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('url', xss_clean($project->url), null, array(), array(), array('tabindex' => 2)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_select('redmine_id', $redmines, xss_clean($project->redmine_id)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('redmine_project_label', xss_clean($project->redmine_project_label), null, array(), array(), array('autocomplete' => 'off', 'data-provide' => 'typeahead', 'data-link' => \Uri::create('/redmines/rest/projects/get'))) ?>
        </div>
        <?php echo twitter_submit_group() ?>
    </div>
    <div class="span5">
        <?php echo form_help_text('pubkeys') ?>
    </div>
</form>