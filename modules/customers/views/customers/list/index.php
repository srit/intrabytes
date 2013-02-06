<?php
/**
 * @created 05.02.13 - 11:16
 * @author stefanriedel
 */
?>
<div class="span12">
    <div class="control-group">
        <?php echo html_anchor(\Uri::create('/projects/add'), extend_locale('add.button.label'), array('class' => 'btn btn-success')) ?>
    </div>
    <?php if (!empty($projects)): ?>
    <table class="table table-striped table-condensed">
        <tr>
            <th><?php echo __(extend_locale('name.label')) ?></th>
        </tr>

        <?php foreach ($projects as $project): ?>
        <tr>
            <td><?php echo xss_clean($project->name) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <?php echo error_text(extend_locale('nodata')) ?>
    <?php endif; ?>
</div>