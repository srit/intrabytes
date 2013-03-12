<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Customers;

class Controller_Projects_Show extends Controller_Projects
{

    public function action_index()
    {
        $project = $this->_crud_objects['customer_project']['data'];
        $project_label = $project->redmine_project_label;

        $redmine_project = array();
        $redmine_tickets = array();
        $redmine_versions = array();

        if (!empty($project_label)) {
            $redmine_project_url = $project->redmine->url;
            $redmine_api_key = $project->redmine->api_key;
            $redmine = new \Redmine\Client($redmine_project_url,$redmine_api_key);
            $redmine_project = $redmine->api('project')->show($project_label);
            $redmine_tickets = $redmine->api('issue')->all(array('project_id' => $project_label));
            $redmine_versions = $redmine->api('version')->all($project_label);
        }

        $this->_get_content_template()
            ->set('redmine_project', $redmine_project, false)
            ->set('redmine_tickets', $redmine_tickets, false)
            ->set('redmine_versions', $redmine_versions, false);
    }

}