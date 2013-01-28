<?php
/**
 * @created 30.09.12 - 21:22
 * @author stefanriedel
 */
?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <?php echo \Html::anchor(\Uri::create(Config::get('routes._root_')), \Config::get('project.name'), array('class' => 'brand')) ?>
            <ul class="nav">
                <li>
                    <?php echo \Html::anchor(\Uri::create(Config::get('routes._root_')), '<i class="icon-white icon-home"></i> '.__('nav.dashboard.label')) ?>
                </li>
            </ul>
            <ul class="nav pull-right">
                <li class="dropdown">
                    <?php echo \Html::anchor('#', '<i class="icon-white icon-wrench"></i> '.__('nav.settings.label').' <b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown' )) ?>

                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-white icon-user"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><?php echo \Html::anchor(\Uri::create('/users/settings/dashboard'), '<i class="icon-dashboard"></i> ' . __('usernav.dashboard.config.label')) ?></li>
                        <li><?php echo \Html::anchor(\Uri::create('/users/logout'), '<i class="icon-off"></i> ' . __('usernav.logout.label')) ?></li>
                    </ul>
                </a></li>
                <li><?php echo \Html::anchor(\Uri::create('/users/logout'), '<i class="icon-white icon-off"></i> ' . __('nav.logout.label', array(':name' => $user))) ?></li>
            </ul>
        </div>
    </div>
</div>