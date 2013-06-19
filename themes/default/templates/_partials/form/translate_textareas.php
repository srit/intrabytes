<?php
/**
 * @created 15.04.13 - 09:45
 * @author stefanriedel
 */
?>
<div class="tabbable">
    <ul class="nav nav-tabs" id="<?php echo $tab_id ?>">
        <?php foreach ($textareas as $name => $t): ?>
            <li><a href="#<?php echo $name ?>"><?php echo __(extend_locale('tab.' . $t['language'] . '.label')) ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <?php foreach ($textareas as $name => $t): ?>
            <div class="tab-pane" id="<?php echo $name ?>">
                <div class="control-group">
                    <?php echo $t['textarea'] ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>