<?php
/**
 * @created 05.02.13 - 11:16
 * @author stefanriedel
 */
?>
<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(named_route('core_customers_add'), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php echo $pagination['customer']->render();?>
    <?php if (!empty($crud_objects['customer']['data'])): ?>
    <table class="table table-striped table-condensed table-bordered">
        <tr>
            <th><?php echo __(extend_locale('address.label')) ?></th>
            <th><?php echo __(extend_locale('references.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>

        <?php foreach ($crud_objects['customer']['data'] as $customer): ?>
        <tr>
            <td>
                <address>
                    <?php echo html_anchor(named_route('core_customers_show', array('id' => $customer->id)), '<strong>' . xss_clean($customer->company_name) . '</strong>') ?><br>
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
                <?php echo html_anchor(named_route('core_customers_contacts_list', array('customer_id' => $customer->id)), __(extend_locale('count.contacts.label'), array(':amount' => count($customer->customer_contacts)))) ?><br>
                <?php echo html_anchor(named_route('core_customers_projects_list', array('customer_id' => $customer->id)), __(extend_locale('count.projects.label'), array(':amount' => $cnt_projects = count($customer->customer_projects)))) ?>
            </td>
            <td>
                <?php
                    $action_links = array(
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_show', array('id' => $customer->id)), __ext('actions.show.label'))),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_edit', array('id' => $customer->id)), __ext('actions.edit.label'))),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_delete', array('id' => $customer->id)), __ext('actions.delete.label'))),
                        array('is_divider' => true),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_projects_list', array('customer_id' => $customer->id)), __ext('actions.list.project.label'))),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_projects_add', array('customer_id' => $customer->id)), __ext('actions.add.project.label'))),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_contacts_list', array('customer_id' => $customer->id)), __ext('actions.list.contact_persons.label'))),
                        array('attr' => array(), 'value' => html_anchor(named_route('core_customers_contacts_add', array('customer_id' => $customer->id)), __ext('actions.add.contact_persons.label'))),
                    );
                    if($customer->customer_projects > 0) {
                        $action_links[] = array('is_divider' => true);
                        foreach($customer->customer_projects as $project) {
                            $action_links[] = array('attr' => array(), 'value' => html_anchor(named_route('core_customers_projects_show', array('id' => $project->id, 'customer_id' => $customer->id)), '' . __ext('show.project.label', array(':extend' => $project->__toString()))));

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