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
    <?php if (!empty($customers)): ?>
    <table class="table table-striped table-condensed">
        <tr>
            <th><?php echo __(extend_locale('address.label')) ?></th>
            <th><?php echo __(extend_locale('references.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>

        <?php foreach ($customers as $customer): ?>
        <tr>
            <td>
                <address>
                    <?php echo html_anchor(\Uri::create('/customers/show/:id', array('id' => $customer->id)), '<strong>' . xss_clean($customer->company_name) . '</strong>') ?><br>
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
                <?php echo html_anchor(\Uri::create('/customers/contact_persons'), __(extend_locale('count.contacts.label'), array(':amount' => count($customer->customer_contact_persons)))) ?><br>
                <?php echo html_anchor(\Uri::create('/customers/projects'), __(extend_locale('count.projects.label'), array(':amount' => count($customer->customer_projects)))) ?>
            </td>
            <td>
                <?php echo twitter_button_group(array(
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/show/:id', array('id' => $customer->id)), '<i class="icon-list"></i> ' . __(extend_locale('actions.show.label')))),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/edit/:id', array('id' => $customer->id)), '<i class="icon-edit"></i> ' . __(extend_locale('actions.edit.label')))),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/delete/:id', array('id' => $customer->id)), '<i class="icon-trash"></i> ' . __(extend_locale('actions.delete.label')))),
                array('is_divider' => true),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/projects/add'), __(extend_locale('actions.add.project.label')))),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/customers/contact_persons/add'), __(extend_locale('actions.add.contact_persons.label')))),
            ), extend_locale('actions.label'), array()); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <?php echo error_text(extend_locale('nodata')) ?>
    <?php endif; ?>
</div>