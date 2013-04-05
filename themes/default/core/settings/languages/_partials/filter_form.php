<?php
/**
 * @created 04.04.13 - 20:10
 * @author stefanriedel
 */
?>
<div class="row-fluid">
    <div class="span12">
        <form method="get" accept-charset="utf-8" action="<?php current_uri() ?>">
            <table class="table table-striped table-condensed">
                <tr>
                    <td><?php echo twitter_html_input_text_wo_label('locale', isset($crud_objects['srit:language']['filter']['locale']) ? html_entities($crud_objects['srit:locale']['filter']['key']) : '') ?></td>
                    <td><?php echo twitter_html_input_text_wo_label('language', isset($crud_objects['srit:language']['filter']['language']) ? html_entities($crud_objects['srit:locale']['filter']['group']) : '', null, array(), array('autocomplete' => 'off', 'data-provide' => 'typeahead', 'data-link' => \Uri::create('/core/settings/locales/rest/search'))) ?></td>
                    <td><?php echo twitter_html_input_text_wo_label('plain', isset($crud_objects['srit:language']['filter']['plain']) ? html_entities($crud_objects['srit:locale']['filter']['value']) : '') ?></td>
                    <td>
                        <?php echo html_hidden('filter_type', 'filter') ?>
                        <?php echo twitter_button_group(array(
                            array('attr' => array(), 'value' => html_js_void_anchor(__(extend_locale('filter.button.label')), 'filter')),
                            array('attr' => array(), 'value' => html_js_void_anchor(__(extend_locale('filter_like.button.label')), 'filter_like')),
                        ), extend_locale('actions.label'), array()); ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>