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
                    <?php echo twitter_html_input_text_wo_label('add_plain', '', __ext('add.plain.label'), array(), array('class' => 'input-medium', 'required' => 'required')) ?>
                    <?php echo twitter_html_submit_button('add', 'add', __ext('add.button.label'), array(), array('class' => 'btn-success')) ?>
                </div>
            </form>
        </div>
    </div>
    <?php if (!empty($language)): ?>
        <div class="span10">
            <?php echo $pagination['language']->render(); ?>
        </div>
    <?php endif; ?>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php if (!empty($language)): ?>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th><?php echo __ext('id.label') ?></th>
                    <th><?php echo __ext('locale.label') ?></th>
                    <th><?php echo __ext('language.label') ?></th>
                    <th><?php echo __ext('plain.label') ?></th>
                    <th><?php echo __ext('default.label') ?></th>
                    <th><?php echo __ext('missing_translations.label') ?></th>
                    <th><?php echo __ext('actions.label') ?></th>
                </tr>
                <?php foreach ($language as $lang):

                    $missing_translations = $lang->get_missing_translations()

                    ?>
                    <tr>
                        <td><?php echo xss_clean($lang->get_id()) ?></td>
                        <td><?php echo xss_clean($lang->get_locale()) ?></td>
                        <td><?php echo xss_clean($lang->get_language()) ?></td>
                        <td><?php echo xss_clean($lang->get_plain()) ?></td>
                        <td><?php echo boolean_icon(xss_clean($lang->get_default())) ?></td>
                        <td><?php echo xss_clean($missing_translations) ?></td>
                        <td>
                            <?php
                            $goto_missing_translations = array();
                            if ($missing_translations > 0) {
                                $goto_missing_translations = array('attr' => array(), 'value' => html_anchor(named_route('core_settings_locales_list') . '?value=empty&value_field=value_' . $lang->get_language() . '&filter_type=filter', __ext('actions.missing_locales.label')));
                            }

                            echo twitter_button_group(array(
                                array('attr' => array(), 'value' => html_anchor(core_settings_languages_edit_route($lang->get_id()), __ext('actions.edit.label'))),
                                array('attr' => array(), 'value' => html_anchor(core_settings_languages_delete_route($lang->get_id()), __ext('actions.delete.label'))),
                                array('is_divider' => true),
                                array('attr' => array(), 'value' => html_anchor(core_settings_locales_list_route(), __ext('actions.locales.label'))),
                                $goto_missing_translations
                            ), extend_locale('actions.label'), array()); ?>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $pagination['language']->render(); ?>
        <?php else: ?>
            <?php echo error_text(__ext('nodata')) ?>
        <?php endif; ?>
    </div>
</div>