<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */
?>

<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(customers_projects_add_route($customer_id), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($crud_objects['customer_project']['data'])): ?>
        <table class="table table-striped table-condensed table-bordered">
            <tr>
                <th><?php echo __(extend_locale('name.label')) ?></th>
                <th><?php echo __(extend_locale('url.label')) ?></th>
                <th><?php echo __(extend_locale('redmine_project_label.label')) ?></th>
                <th><?php echo __(extend_locale('created_at.label')) ?></th>
                <th><?php echo __(extend_locale('actions.label')) ?></th>
            </tr> 
            <?php foreach ($crud_objects['customer_project']['data'] as $customer_project): ?>
                <tr>
                    <td><?php echo html_anchor(customers_projects_show_route($customer_project->id, $customer_project->customer_id), xss_clean($customer_project->name)) ?></td>
                    <td><?php echo html_anchor(xss_clean($customer_project->url), xss_clean($customer_project->url), array('target' => '_blank')) ?></td>
                    <td>
                        <?php echo xss_clean($customer_project->redmine_project_label) ?>   <br>
                        <?php echo html_anchor(xss_clean($customer_project->redmine_project_url()), extend_locale('redmine_project_url.label'), array('target' => '_blank'))?>
                    </td>
                    <td><?php echo $customer_project->created_at ?></td>
                    <td>
                        <?php echo twitter_button_group(array(
                        array('attr' => array(), 'value' => html_anchor(customers_projects_show_route($customer_project->id, $customer_project->customer_id), __(extend_locale('actions.show.label')))),
                        array('attr' => array(), 'value' => html_anchor(customers_projects_edit_route($customer_project->id, $customer_project->customer_id), __(extend_locale('actions.edit.label')))),
                        array('attr' => array(), 'value' => html_anchor(customers_projects_delete_route($customer_project->id, $customer_project->customer_id), __(extend_locale('actions.delete.label')))),
                        ), extend_locale('actions.label'), array()); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo error_text(__(extend_locale('nodata'))) ?>
    <?php endif; ?>
</div>