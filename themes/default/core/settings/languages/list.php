<?php
/**
 * @created 26.02.13 - 08:14
 * @author stefanriedel
 */?>
<form method="post" action="<?php echo \Uri::create('core/settings/languages/add') ?>">
    <div class="input-append">
        <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>
        <?php echo twitter_html_input_text_wo_label('add_plain', '', extend_locale('add.plain.label'), array(), array('class' => 'input-medium', 'required' => 'required')) ?>
        <?php echo twitter_html_submit_button('add', 'add', extend_locale('add.button.label'), array(), array('class' => 'btn-success')) ?>
    </div>
</form>
<?php if (!empty($crud_objects['srit:language']['data'])): ?>
<table class="table table-striped table-condensed">
    <tr>
        <th><?php echo __(extend_locale('id.label')) ?></th>
        <th><?php echo __(extend_locale('locale.label')) ?></th>
        <th><?php echo __(extend_locale('language.label')) ?></th>
        <th><?php echo __(extend_locale('plain.label')) ?></th>
        <th><?php echo __(extend_locale('default.label')) ?></th>
        <th><?php echo __(extend_locale('count.locales.label')) ?></th>
        <th><?php echo __(extend_locale('actions.label')) ?></th>
    </tr>
    <?php foreach ($crud_objects['srit:language']['data'] as $lang): ?>
    <tr>
        <td><?php echo xss_clean($lang->id) ?></td>
        <td><?php echo xss_clean($lang->locale) ?></td>
        <td><?php echo xss_clean($lang->language) ?></td>
        <td><?php echo xss_clean($lang->plain) ?></td>
        <td><?php echo boolean_icon(xss_clean($lang->default)) ?></td>
        <td><?php echo html_anchor(core_settings_locales_list_route(array('language_id' => $lang->id)), count($lang->locales)) ?></td>
        <td>


            <?php echo twitter_button_group(array(
            array('attr' => array(), 'value' => html_anchor(core_settings_languages_edit_route(array('language_id' => $lang->id)), __(extend_locale('actions.edit.label')))),
            array('attr' => array(), 'value' => html_anchor(core_settings_languages_delete_route(array('language_id' => $lang->id)), __(extend_locale('actions.delete.label')))),
            array('is_divider' => true),
            array('attr' => array(), 'value' => html_anchor(core_settings_locales_list_route(array('language_id' => $lang->id)), __(extend_locale('actions.locales.label')))),
        ), extend_locale('actions.label'), array()); ?>


        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<?php echo error_text(__(extend_locale('nodata'))) ?>
<?php endif; ?>