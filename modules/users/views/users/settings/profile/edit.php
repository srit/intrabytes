<?php
/**
 * @created 09.04.13 - 15:21
 * @author stefanriedel
 */
?>
<div class="tabbable">
    <ul class="nav nav-tabs" id="tab">
        <li><a href="#profile"><?php echo __(extend_locale('profile.tab.label')) ?></a></li>
        <li><a href="#password"><?php echo __(extend_locale('password.tab.label')) ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="profile">
            <?php echo $theme->view('users/settings/profile/_partials/profile_form', array('crud_objects' => $crud_objects)); ?>
        </div>
        <div class="tab-pane" id="password">
            <p>lksajhdkajsh</p>
        </div>
    </div>
</div>
