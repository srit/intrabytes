<?php
/**
 * @created 05.02.13 - 13:02
 * @author stefanriedel
 */
?>
<div class="span10">
    <form method="post" accept-charset="utf-8">
        <?php echo security_field(); ?>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('company_name', xss_clean($customer->company_name)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('firstname', xss_clean($customer->firstname), null, array(), array(), array('class' => 'span2')) ?>
                <?php echo twitter_html_input_text_wo_label('lastname', xss_clean($customer->lastname), null, array(), array('class' => 'span2')) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('email', xss_clean($customer->email)) ?>
            </div>
        </div>
        <?php echo twitter_submit_group() ?>
    </form>
</div>