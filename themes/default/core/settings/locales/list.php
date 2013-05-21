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
            <?php echo html_anchor(core_settings_locales_add_route(), __ext('add.button.label'), array('class' => 'btn btn-success')) ?>
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
                    <th><?php echo order_anchor('key', __ext('key.label'), 'srit:locale') ?></th>
                    <th><?php echo order_anchor('group', __ext('group.label'), 'srit:locale') ?></th>
                    <th><?php echo order_anchor('value', __ext('value.label'), 'srit:locale') ?></th>
                    <th><?php echo __(extend_locale('actions.label')) ?></th>
                </tr>
                <?php foreach ($crud_objects['srit:locale']['data'] as $locale): ?>
                    <tr>
                        <td width="5%"><?php echo html_checkbox('checked[]', $locale->get_id()) ?></td>
                        <td><?php echo xss_clean($locale->get_key()) ?></td>
                        <td><?php echo xss_clean($locale->get_group()) ?></td>
                        <td><?php echo $locale->cutted_value() ?></td>
                        <td>
                            <?php echo twitter_button_group(array(
                                array('attr' => array(), 'value' => html_anchor(named_route('core_settings_locales_edit', array('id' => $locale->get_id())), __ext('actions.edit.label'))),
                                array('attr' => array(), 'value' => html_anchor(named_route('core_settings_locales_copy', array('id' => $locale->get_id())), __ext('actions.copy.label'))),
                                array('attr' => array(), 'value' => html_anchor(named_route('core_settings_locales_delete', array('id' => $locale->get_id())), __ext('actions.delete.label'))),
                            ), extend_locale('actions.label'), array()); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><?php echo twitter_html_submit_button('deletes', 'deletes', __ext('deletes.button.label'), array(), array('class' => 'btn-danger')) ?></td>
                </tr>
            </table>
            </form>
            <?php echo $pagination['srit:locale']->render(); ?>
        <?php endif; ?>
    </div>
</div>