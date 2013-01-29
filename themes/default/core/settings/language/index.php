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
            <th><?php echo __('core.settings.language.id.label') ?></th>
            <th><?php echo __('core.settings.language.locale.label') ?></th>
            <th><?php echo __('core.settings.language.language.label') ?></th>
            <th><?php echo __('core.settings.language.plain.label') ?></th>
            <th><?php echo __('core.settings.language.actions.label') ?></th>
        </tr>
        <?php foreach ($languages as $lang): ?>
        <tr>
            <td><?php echo $lang->id ?></td>
            <td><?php echo $lang->locale ?></td>
            <td><?php echo $lang->language ?></td>
            <td><?php echo $lang->plain ?></td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-mini"><?php echo __('core.settings.language.actions.label') ?></button>
                    <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?php echo \Html::anchor(\Uri::create('/core/settings/language/edit/:id', array('id' => $lang->id)), '<i class="icon-edit"></i> ' . __('core.settings.language.actions.edit.label')) ?></li>
                        <li><?php echo \Html::anchor(\Uri::create('/core/settings/language/delete/:id', array('id' => $lang->id)), '<i class="icon-remove"></i> ' . __('core.settings.language.actions.delete.label')) ?></li>
                    </ul>
                </div>
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
            <input class="input-medium" type="text" id="schecknummer"
                   placeholder="<?php echo __('core.settings.language.new.name.label') ?>" name="plain">
            <button class="btn btn-warning"
                    type="submit"><?php echo __('core.settings.language.add.button.label') ?></button>
        </div>
    </form>
</div>