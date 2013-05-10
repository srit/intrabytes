<?php
/**
 * @created 24.02.13 - 21:19
 * @author stefanriedel
 */
?>
<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(redmines_add_route(), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($crud_objects['redmine']['data'])): ?>

    <table class="table table-striped table-condensed table-bordered">
        <tr>
            <th><?php echo __(extend_locale('name.label')) ?></th>
            <th><?php echo __(extend_locale('url.label')) ?></th>
            <th><?php echo __(extend_locale('api_key.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>

        <?php foreach ($crud_objects['redmine']['data'] as $redmine): ?>
        <tr>
            <td><?php echo xss_clean($redmine->name) ?></td>
            <td><?php echo html_anchor(xss_clean($redmine->url), xss_clean($redmine->url), array('target' => '_blank'))?></td>
            <td><?php echo xss_clean($redmine->api_key) ?></td>
            <td>
                <?php echo twitter_button_group(array(
                array('attr' => array(), 'value' => html_anchor(redmines_show_route($redmine->id), __(extend_locale('actions.show.label')))),
                array('attr' => array(), 'value' => html_anchor(redmines_edit_route($redmine->id), __(extend_locale('actions.edit.label')))),
                array('attr' => array(), 'value' => html_anchor(redmines_delete_route($redmine->id), __(extend_locale('actions.delete.label')))),
            ), extend_locale('actions.label'), array()); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php else: ?>
    <?php echo error_text(__(extend_locale('nodata'))) ?>
    <?php endif; ?>
</div>