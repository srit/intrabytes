<?php
/**
 * @created 22.02.13 - 14:01
 * @author stefanriedel
 */
$project = $crud_objects['customer_project']['data']
?>

<div class="tabbable">
    <ul class="nav nav-tabs" id="tab">
        <li><a href="#project"><?php echo __(extend_locale('project.tab.label')) ?></a></li>
        <li><a href="#redmine"><?php echo __(extend_locale('redmine.tab.label')) ?></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="project">
            <?php echo h3(xss_clean($project->name)) ?>
            <?php echo xss_clean($project->description) ?>
            <div class="clearfix" style="margin-bottom: 10px;"></div>
            <strong>Projekt URL:</strong> <a href="#"><i class="icon-share"></i>http://www.sonatex.de</a>
            <div class="clearfix" style="margin-bottom: 10px;"></div>
            <a href="#" class="btn btn-info"><i class="icon-white icon-edit"></i> Projekt Bearbeiten</a> <a href="#" class="btn btn-danger"><i class="icon-white icon-trash"></i> Projekt Löschen</a>
        </div>
        <div class="tab-pane" id="redmine">
            ...
        </div>
    </div>
</div>