<?php
/**
 * @created 27.02.13 - 08:41
 * @author stefanriedel
 */

echo $theme->view('core/settings/locales/_partials/filter_form', array('crud_objects' => $crud_objects), false);

?>

<div class="row-fluid">
    <div class="span2">
        <div class="control-group">
            <?php echo html_anchor(core_settings_locales_add_route(), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
        </div>
    </div>
    <?php if (!empty($crud_objects['srit:locale']['data'])): ?>
        <div class="span10">
            <?php echo $pagination['srit:locale']->render(); ?>
        </div>
    <?php endif; ?>
</div>
<div class="row-fluid">
    <div class="span12">
        <?php if (!empty($crud_objects['srit:locale']['data'])): ?>
            <form method="post" accept-charset="utf-8" action="<?php echo core_settings_locales_deletes_route() ?>" id="chcked_actions">
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th width="5%"><?php echo html_checkbox('chckall', 1) ?></th>
                    <th><?php echo order_anchor('key', __(extend_locale('key.label')), 'srit:locale') ?></th>
                    <th><?php echo order_anchor('group', __(extend_locale('group.label')), 'srit:locale') ?></th>
                    <th><?php echo order_anchor('value', __(extend_locale('value.label')), 'srit:locale') ?></th>
                    <th><?php echo __(extend_locale('actions.label')) ?></th>
                </tr>
                <?php foreach ($crud_objects['srit:locale']['data'] as $locale): ?>
                    <tr>
                        <td width="5%"><?php echo html_checkbox('checked[]', $locale->id) ?></td>
                        <td><?php echo xss_clean($locale->key) ?></td>
                        <td><?php echo xss_clean($locale->group) ?></td>
                        <td><?php echo $locale->cutted_value() ?></td>
                        <td>
                            <?php echo twitter_button_group(array(
                                array('attr' => array(), 'value' => html_anchor(core_settings_locales_edit_route($locale->id), __(extend_locale('actions.edit.label')))),
                                array('attr' => array(), 'value' => html_anchor(core_settings_locales_delete_route($locale->id), __(extend_locale('actions.delete.label')))),
                            ), extend_locale('actions.label'), array()); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><?php echo twitter_html_submit_button('deletes', 'deletes', extend_locale('deletes.button.label'), array(), array('class' => 'btn-danger')) ?></td>
                </tr>
            </table>
            </form>
            <?php echo $pagination['srit:locale']->render(); ?>
        <?php endif; ?>
    </div>
</div>