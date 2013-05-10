<?php
/**
 * @created 26.02.13 - 08:14
 * @author stefanriedel
 */


echo $theme->view('core/settings/languages/_partials/filter_form', array('crud_objects' => $crud_objects), false);

?>
<div class="row-fluid">
    <div class="span3">
        <div class="control-group">
            <form method="post" action="<?php echo core_settings_languages_add_route() ?>">
                <div class="input-append">
                    <?php echo security_field(); ?>
                    <?php echo twitter_html_input_text_wo_label('add_plain', '', extend_locale('add.plain.label'), array(), array('class' => 'input-medium', 'required' => 'required')) ?>
                    <?php echo twitter_html_submit_button('add', 'add', extend_locale('add.button.label'), array(), array('class' => 'btn-success')) ?>
                </div>
            </form>
        </div>
    </div>
    <?php if (!empty($crud_objects['srit:language']['data'])): ?>
        <div class="span10">
            <?php echo $pagination['srit:language']->render(); ?>
        </div>
    <?php endif; ?>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php if (!empty($crud_objects['srit:language']['data'])): ?>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th><?php echo __(extend_locale('id.label')) ?></th>
                    <th><?php echo __(extend_locale('locale.label')) ?></th>
                    <th><?php echo __(extend_locale('language.label')) ?></th>
                    <th><?php echo __(extend_locale('plain.label')) ?></th>
                    <th><?php echo __(extend_locale('default.label')) ?></th>
                    <th><?php echo __(extend_locale('actions.label')) ?></th>
                </tr>
                <?php foreach ($crud_objects['srit:language']['data'] as $lang): ?>
                    <tr>
                        <td><?php echo xss_clean($lang->id) ?></td>
                        <td><?php echo xss_clean($lang->locale) ?></td>
                        <td><?php echo xss_clean($lang->language) ?></td>
                        <td><?php echo xss_clean($lang->plain) ?></td>
                        <td><?php echo boolean_icon(xss_clean($lang->default)) ?></td>
                        <td>
                            <?php echo twitter_button_group(array(
                                array('attr' => array(), 'value' => html_anchor(core_settings_languages_edit_route($lang->id), __(extend_locale('actions.edit.label')))),
                                array('attr' => array(), 'value' => html_anchor(core_settings_languages_delete_route($lang->id), __(extend_locale('actions.delete.label')))),
                                array('is_divider' => true),
                                array('attr' => array(), 'value' => html_anchor(core_settings_locales_list_route(), __(extend_locale('actions.locales.label')))),
                            ), extend_locale('actions.label'), array()); ?>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $pagination['srit:language']->render(); ?>
        <?php else: ?>
            <?php echo error_text(__(extend_locale('nodata'))) ?>
        <?php endif; ?>
    </div>
</div>