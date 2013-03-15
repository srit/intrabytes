<?php
/**
 * @created 22.02.13 - 14:01
 * @author stefanriedel
 */
$project = $crud_objects['customer_project']['data'];

$project_redmine_url = $project->redmine->url;

?>

<div class="tabbable">
    <ul class="nav nav-tabs" id="tab">
        <li><a href="#project"><?php echo __(extend_locale('project.tab.label')) ?></a></li>
        <?php if (!empty($redmine_project)): ?>
            <li><a href="#redmine"><?php echo __(extend_locale('redmine.tab.label')) ?></a></li>
        <?php endif; ?>
        <?php if (!empty($redmine_tickets)): ?>
            <li><a href="#redmine_tickets"><?php echo __(extend_locale('redmine.project.tickets.tab.label')) ?></a></li>
        <?php endif; ?>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="project">
            <?php echo h3(xss_clean($project->name)) ?>
            <?php echo xss_clean($project->description) ?>
            <div class="clearfix" style="margin-bottom: 10px;"></div>
            <strong>Projekt URL:</strong> <a href="#"><i class="icon-share"></i>http://www.sonatex.de</a>

            <div class="clearfix" style="margin-bottom: 10px;"></div>
            <?php echo twitter_anchor(customers_projects_edit_route($project->id, $project->customer_id), __(extend_locale('actions.edit.label'))) ?>
            <?php echo twitter_anchor(customers_projects_delete_route($project->id, $project->customer_id), __(extend_locale('actions.delete.label'))) ?>
        </div>
        <?php if (!empty($redmine_project)): ?>
            <div class="tab-pane" id="redmine">
                <?php echo h3(__(extend_locale('redmine.project.overview.label'))) ?>
                <table class="table table-striped table-condensed">
                    <?php foreach ($redmine_project['project'] as $key => $value):

                        if (in_array($key, array('trackers', 'issue_categories'))):
                            continue;
                        endif;

                        ?>
                        <tr>
                            <th width="35%"><?php echo __(extend_locale($key)) ?></th>
                            <td>
                                <?php
                                if ($key == 'updated_on' || $key == 'created_on'):
                                    echo format_datetime($value); elseif ($key == 'homepage'):
                                    echo html_anchor(xss_clean($value), null, array('target' => '_blank')); else:
                                    echo xss_clean($value);
                                endif;
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (!empty($redmine_versions)): ?>
                        <tr>
                            <th><?php echo __(extend_locale('redmine.project.versions.label')) ?></th>
                            <td>
                                <?php //var_dump($redmine_versions) ?>
                                <?php foreach ($redmine_versions['versions'] as $version):

                                    $version_url = $project_redmine_url . '/versions/' . $version['id'];

                                    ?>
                                    <?php echo __(extend_locale('redmine.project.versions.name.label')) ?> <?php echo html_anchor($version_url, xss_clean($version['name'])); ?>
                                    <br>
                                    <?php if (isset($version['due_date'])): ?>
                                    <small><?php echo __(extend_locale('redmine.project.versions.duedate.label')) ?>
                                        - <strong><?php echo format_date($version['due_date']) ?></strong></small><br>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        <?php endif; ?>
        <?php if (!empty($redmine_tickets)): ?>
            <div id="redmine_tickets" class="tab-pane">
                <?php echo h3(__(extend_locale('redmine.project.tickets.overview.label'))) ?>
                <table class="table table-striped table-condensed">
                    <tr>
                        <th><?php echo __(extend_locale('redmine.project.count.tickets.label')) ?></th>
                        <td><?php echo (int)$redmine_tickets['total_count'] ?></td>
                    </tr>
                    <tr>
                        <th><?php echo __(extend_locale('redmine.project.tickets.label')) ?></th>
                        <td>
                            <?php foreach ($redmine_tickets['issues'] as $ticket):
                                $ticket_url = $project_redmine_url . '/issues/' . $ticket['id'];
                                echo html_anchor($ticket_url, xss_clean($ticket['subject'])); ?><br>
                                <?php echo html_tag('small', array(), xss_clean($ticket['description'])); ?><br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>