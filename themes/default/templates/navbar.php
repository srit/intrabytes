<?php
/**
 * @created 30.09.12 - 21:22
 * @author stefanriedel
 */
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo html_anchor(base_route(), \Config::get('project.name'), array('class' => 'brand')) ?>

            <div class="nav-collapse collapse">
                <?php echo $top_left->render() ?>
                <?php echo $top_right->render() ?>
            </div>
        </div>
    </div>
</div>