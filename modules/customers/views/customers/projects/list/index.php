<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */
?>

<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(\Uri::create('/customers/projects/add/:customer_id', array('customer_id' => $customer_id)), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($crud_objects['customer_project']['data'])): ?>
        <table class="table table-striped table-condensed">
            <tr>
                <th><?php echo __(extend_locale('name.label')) ?></th>
                <th><?php echo __(extend_locale('url.label')) ?></th>
                <th><?php echo __(extend_locale('redmine_project_label.label')) ?></th>
                <th><?php echo __(extend_locale('created_at.label')) ?></th>
                <th><?php echo __(extend_locale('actions.label')) ?></th>
            </tr> 
            <?php foreach ($crud_objects['customer_project']['data'] as $customer_project): ?>
                <tr>
                    <td><?php echo \Html::anchor(\Uri::create('/customers/projects/show/:customer_id/:id', array('customer_id' => $customer_project->customer_id, 'id' => $customer_project->id)), xss_clean($customer_project->name)) ?></td>
                    <td><?php echo xss_clean($customer_project->url) ?></td>
                    <td><?php echo xss_clean($customer_project->redmine_project_label) ?></td>
                    <td><?php echo format_from_object('created_at', $customer_project)?></td>
                    <td>
                        <?php echo twitter_button_group(array(
                        array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/projects/show/:customer_id/:id', array('customer_id' => $customer_project->customer_id, 'id' => $customer_project->id)), __(extend_locale('actions.show.label')))),
                        array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/projects/edit/:customer_id/:id', array('customer_id' => $customer_project->customer_id, 'id' => $customer_project->id)), __(extend_locale('actions.edit.label')))),
                        array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/projects/delete/:customer_id/:id', array('customer_id' => $customer_project->customer_id, 'id' => $customer_project->id)), __(extend_locale('actions.delete.label')))),
                        ), extend_locale('actions.label'), array()); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo error_text(extend_locale('nodata')) ?>
    <?php endif; ?>
</div>