<?php
/**
 * @created 05.02.13 - 11:16
 * @author stefanriedel
 */
?>
<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(\Uri::create('/customers/add'), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php echo $pagination['customer']->render();?>
    <?php if (!empty($crud_objects['customer']['data'])): ?>
    <table class="table table-striped table-condensed">
        <tr>
            <th><?php echo __(extend_locale('address.label')) ?></th>
            <th><?php echo __(extend_locale('references.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>

        <?php foreach ($crud_objects['customer']['data'] as $customer): ?>
        <tr>
            <td>
                <address>
                    <?php echo html_anchor(customers_show_route($customer->id), '<strong>' . xss_clean($customer->company_name) . '</strong>') ?><br>
                    <?php if (!empty($customer->firstname) && !empty($customer->lastname)): ?>
                    <?php echo concat(' ', xss_clean($customer->salutation->salutation), xss_clean($customer->firstname), xss_clean($customer->lastname)) ?>
                    <br>
                    <?php endif; ?>
                    <?php echo concat(' ', xss_clean($customer->street), xss_clean($customer->housenumber)) ?><br>
                    <?php echo concat(' ', xss_clean($customer->postalcode->postalcode), xss_clean($customer->postalcode->city)) ?>
                    <br>
                    <?php echo xss_clean($customer->postalcode->country->name) ?>
                </address>
            </td>
            <td>
                <?php echo html_anchor(customers_customer_contacts_list_route($customer->id), __(extend_locale('count.contacts.label'), array(':amount' => count($customer->customer_contacts)))) ?><br>
                <?php echo html_anchor(customers_projects_list_route($customer->id), __(extend_locale('count.projects.label'), array(':amount' => $cnt_projects = count($customer->customer_projects)))) ?>
            </td>
            <td>
                <?php
                    $action_links = array(
                        array('attr' => array(), 'value' => html_anchor(customers_show_route($customer->id), '<i class="icon-list"></i> ' . __(extend_locale('actions.show.label')))),
                        array('attr' => array(), 'value' => html_anchor(customers_edit_route($customer->id), '<i class="icon-edit"></i> ' . __(extend_locale('actions.edit.label')))),
                        array('attr' => array(), 'value' => html_anchor(customers_delete_route($customer->id), '<i class="icon-trash"></i> ' . __(extend_locale('actions.delete.label')))),
                        array('is_divider' => true),
                        array('attr' => array(), 'value' => html_anchor(customers_projects_add_route($customer->id), __(extend_locale('actions.add.project.label')))),
                        array('attr' => array(), 'value' => html_anchor(customers_customer_contacts_add_route($customer->id), __(extend_locale('actions.add.contact_persons.label')))),
                    );
                    if($customer->customer_projects > 0) {
                        $action_links[] = array('is_divider' => true);
                        foreach($customer->customer_projects as $project) {
                            $action_links[] = array('attr' => array(), 'value' => html_anchor(customers_projects_show_route($project->id, $project->customer_id), '' . __(extend_locale('show.project.label'), array('name' => $project->name))));

                        }
                    }




                echo twitter_button_group($action_links, extend_locale('actions.label'), array()); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <?php echo error_text(__(extend_locale('nodata'))) ?>
    <?php endif; ?>
</div>