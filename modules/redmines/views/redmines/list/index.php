<?php
/**
 * @created 24.02.13 - 21:19
 * @author stefanriedel
 */
?>
<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(\Uri::create('/redmines/add'), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($crud_objects['redmine']['data'])): ?>

    <table class="table table-striped table-condensed">
        <tr>
            <th><?php echo __(extend_locale('name.label')) ?></th>
            <th><?php echo __(extend_locale('url.label')) ?></th>
            <th><?php echo __(extend_locale('api_key.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>

        <?php foreach ($crud_objects['redmine']['data'] as $redmine): ?>
        <tr>
            <td><?php echo xss_clean($redmine->name) ?></td>
            <td><?php echo xss_clean($redmine->url) ?></td>
            <td><?php echo xss_clean($redmine->api_key) ?></td>
            <td>
                <?php echo twitter_button_group(array(
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/redmines/show/:id', array('id' => $redmine->id)), __(extend_locale('actions.show.label')))),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/redmines/edit/:id', array('id' => $redmine->id)), __(extend_locale('actions.edit.label')))),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/redmines/delete/:id', array('id' => $redmine->id)), __(extend_locale('actions.delete.label')))),
            ), extend_locale('actions.label'), array()); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php else: ?>
    <?php echo error_text(__(extend_locale('nodata'))) ?>
    <?php endif; ?>
</div>