<?php
/**
 * @created 11.02.13 - 19:44
 * @author stefanriedel
 */
?>
<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(\Uri::create('/users/settings/pubkeys/add'), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($user_public_keys)): ?>
    <table class="table table-striped table-condensed">
        <tr>
            <th><?php echo __(extend_locale('name.label')) ?></th>
            <th><?php echo __(extend_locale('value.label')) ?></th>
            <th><?php echo __(extend_locale('created_at.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>
        <?php foreach ($user_public_keys as $pub_key): ?>
        <tr>
            <td><?php echo xss_clean($pub_key->name) ?></td>
            <td><?php echo substr(xss_clean($pub_key->value), 0, 50) . '...' ?></td>
            <td><?php echo format_from_object('created_at', $pub_key) ?></td>
            <td>

                <?php echo twitter_button_group(array(
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/users/settings/pubkeys/edit/id/:id', array('id' => $pub_key->id)), '<i class="icon-edit"></i> ' . __(extend_locale('actions.edit.label')))),
                array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/users/settings/pubkeys/delete/id/:id', array('id' => $pub_key->id)), '<i class="icon-trash"></i> ' . __(extend_locale('actions.delete.label')))),
            ), extend_locale('actions.label'), array()); ?>

            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>