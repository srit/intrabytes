<?php
/**
 * @created 27.02.13 - 08:41
 * @author stefanriedel
 */
?>

<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(\Uri::create('/core/settings/locales/add/:language_id', array('language_id' => $language_id)), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($crud_objects['srit:locale']['data'])): ?>
    <table class="table table-striped table-condensed">
        <tr>
            <th><?php echo __(extend_locale('key.label')) ?></th>
            <th><?php echo __(extend_locale('group.label')) ?></th>
            <th><?php echo __(extend_locale('value.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>

        <?php foreach ($crud_objects['srit:locale']['data'] as $locale): ?>
        <tr>
            <td><?php echo xss_clean($locale->key) ?></td>
            <td><?php echo xss_clean($locale->group) ?></td>
            <td><?php echo xss_clean($locale->value) ?></td>
            <td>
                <?php echo twitter_button_group(array(
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/core/settings/locales/edit/:language_id/:id', array('language_id' => $language_id, 'id' => $locale->id)), __(extend_locale('actions.edit.label')))),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/core/settings/locales/delete/:language_id/:id', array('language_id' => $language_id, 'id' => $locale->id)), __(extend_locale('actions.delete.label')))),
            ), extend_locale('actions.label'), array()); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $pagination['srit:locale']->render(); ?>
    <?php endif; ?>
</div>
