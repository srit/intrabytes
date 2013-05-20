<?php
/**
 * @created 22.04.13 - 12:29
 * @author stefanriedel
 */

if (!empty($trees)):
    $level = 1;
    echo html_legend(extend_locale('navigation.trees.label'));
    echo html_tag('div', array('class' => 'clearfix'), '');
    ?>
    <div class="accordion" id="accordion2">
        <?php foreach ($trees as $tree_name => $tree): ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                       href="#collapse_<?php echo $tree_name ?>">
                        <?php echo $tree_name ?>
                    </a>
                </div>
                <div id="collapse_<?php echo $tree_name ?>" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        <div class="accordion" id="accordion_<?php echo $tree_name ?>">
                            <?php foreach ($tree as $n => $t): ?>
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                           href="#collapse_<?php echo $tree_name ?>_<?php echo $n ?>">
                                            <?php echo $n ?>
                                        </a>
                                    </div>
                                    <div id="collapse_<?php echo $tree_name ?>_<?php echo $n ?>" class="accordion-body collapse in">
                                        <div class="accordion-inner">
                                            11111
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;
