<?php
/**
 * @created 22.04.13 - 15:32
 * @author stefanriedel
 */
?>
<div class="row-fluid">
    <?php if (!empty($locale)): ?>
        <div class="span10">
            <?php echo $pagination['module']->render(); ?>
        </div>
    <?php endif; ?>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php if (!empty($module)): ?>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th><?php echo __ext('name.label') ?></th>
                    <th><?php echo __ext('description.label') ?></th>
                    <th><?php echo __ext('sort.label') ?></th>
                    <th><?php echo __ext('actions.label') ?></th>
                </tr>
                <?php foreach ($module as $md): ?>
                    <tr class="<?php echo (bool)$md->get_active() == true ? 'success' : 'warning'?>">
                        <td><?php echo xss_clean($md->get_name()) ?></td>
                        <td><?php echo xss_clean($md->get_description()) ?></td>
                        <td><?php echo xss_clean($md->get_sort()) ?></td>
                        <td><?php
                            $route_name = 'core_settings_modules_';
                            $route_name .= $prefix = (bool)$md->get_active() == true ? 'deactivate' : 'activate';
                            $route = named_route($route_name, array('module' => $md->get_name()));
                            echo twitter_anchor($route, __ext($prefix . '.anchor.label'), array('class' => 'btn btn-mini'));
                            ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $pagination['module']->render(); ?>
        <?php endif; ?>
    </div>
</div>