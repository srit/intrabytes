<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */
?>

<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(named_route('core_customers_projects_add', array('customer_id' => $customer_id)), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($customer_project)): ?>
        <table class="table table-striped table-condensed table-bordered">
            <tr>
                <th><?php echo __(extend_locale('name.label')) ?></th>
                <th><?php echo __(extend_locale('url.label')) ?></th>
                <th><?php echo __(extend_locale('created_at.label')) ?></th>
                <th><?php echo __(extend_locale('actions.label')) ?></th>
            </tr> 
            <?php foreach ($customer_project as $cust_project): ?>
                <tr>
                    <td><?php echo html_anchor(named_route('core_customers_projects_show', array('id' => $cust_project->id, 'customer_id' => $cust_project->customer_id)), xss_clean($cust_project->name)) ?></td>
                    <td><?php echo html_anchor(xss_clean($cust_project->url), xss_clean($cust_project->url), array('target' => '_blank')) ?></td>
                    <td><?php echo $cust_project->created_at ?></td>
                    <td>
                        <?php echo twitter_button_group(array(
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_projects_show', array('id' => $cust_project->id, 'customer_id' => $cust_project->customer_id)), __(extend_locale('actions.show.label')))),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_projects_edit', array('id' => $cust_project->id, 'customer_id' => $cust_project->customer_id)), __(extend_locale('actions.edit.label')))),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_projects_delete', array('id' => $cust_project->id, 'customer_id' => $cust_project->customer_id)), __(extend_locale('actions.delete.label')))),
                        ), extend_locale('actions.label'), array()); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo error_text(__ext('nodata')) ?>
    <?php endif; ?>
</div>