<?php
/**
 * @created 29.01.13 - 10:12
 * @author stefanriedel
 */
?>
<div class="span9">
    <?php if (!empty($languages)): ?>
    <table class="table table-striped table-condensed">
        <tr>
            <th><?php echo __(extend_locale('id.label')) ?></th>
            <th><?php echo __(extend_locale('locale.label')) ?></th>
            <th><?php echo __(extend_locale('language.label')) ?></th>
            <th><?php echo __(extend_locale('plain.label')) ?></th>
            <th><?php echo __(extend_locale('actions.label')) ?></th>
        </tr>
        <?php foreach ($languages as $lang): ?>
        <tr>
            <td><?php echo $lang->id ?></td>
            <td><?php echo $lang->locale ?></td>
            <td><?php echo $lang->language ?></td>
            <td><?php echo $lang->plain ?></td>
            <td>

                <?php echo twitter_button_group(array(
                    array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/core/settings/language/edit/:id', array('id' => $lang->id)), '<i class="icon-edit"></i> ' . __(extend_locale('actions.edit.label')))),
                    array('attr' => array(), 'value' => \Html::anchor(\Uri::create('/core/settings/language/delete/:id', array('id' => $lang->id)), '<i class="icon-remove"></i> ' . __(extend_locale('actions.delete.label')))),
                ), extend_locale('actions.label'), array()); ?>


            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>

    <?php endif; ?>

</div>
<div class="span3">
    <form method="post">
        <div class="input-append">
            <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>
            <?php echo twitter_html_input_text_wo_label('plain', '', extend_locale('add.plain.label'), array(), array('class' => 'input-medium', 'required' => 'required')) ?>
            <?php echo twitter_html_submit_button('add', 'add', extend_locale('add.button.label'), array(), array('class' => 'btn-success')) ?>
        </div>
    </form>
</div>