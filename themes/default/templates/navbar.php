<?php
/**
 * @created 30.09.12 - 21:22
 * @author stefanriedel
 */
?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo \Html::anchor(\Uri::create(Config::get('routes._root_')), \Config::get('project.name'), array('class' => 'brand')) ?>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li>
                        <?php echo \Html::anchor(\Uri::create(Config::get('routes._root_')), '<i class="icon-white icon-home"></i> ' . __('nav.dashboard.label')) ?>
                    </li>
                    <li>
                        <?php echo \Html::anchor(\Uri::create('/customers/list'), '<i class="icon-white icon-list"></i> ' . __('nav.customers.label')) ?>
                    </li>

                </ul>
                <ul class="nav pull-right">
                    <li class="indicator">
                        <?php echo $theme->asset->img('ajax-loader.gif', array('id' => 'indicator', 'class' => 'img-circle')) ?>
                    </li>
                    <li class="dropdown">
                        <?php echo \Html::anchor('#', '<i class="icon-white icon-wrench"></i> ' . __('nav.settings.label') . ' <b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')) ?>
                        <ul class="dropdown-menu">
                            <li><?php echo html_anchor(core_settings_languages_list_route(), '<i class="icon-list-alt"></i> ' . __('nav.settings.language.label')) ?></li>
                            <li><?php echo \Html::anchor(\Uri::create('/redmines/list'), '<i class="icon-list-alt"></i> ' . __('nav.settings.redmines.label')) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-white icon-user"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?php echo \Html::anchor(\Uri::create('/users/settings/dashboard'), __('usernav.dashboard.config.label')) ?></li>
                            <li><?php echo \Html::anchor(\Uri::create('/users/settings/pubkeys/list'), __('usernav.pubkeys.config.label')) ?></li>
                            <li><?php echo \Html::anchor(\Uri::create('/users/logout'), __('usernav.logout.label')) ?></li>
                        </ul>
                        </a></li>
                    <li><?php echo \Html::anchor(\Uri::create('/users/logout'), '<i class="icon-white icon-off"></i> ' . __('nav.logout.label', array(':name' => $user))) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>