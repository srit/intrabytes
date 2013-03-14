<?php
/**
 * @created 02.03.13 - 15:07
 * @author stefanriedel
 */
namespace Redmines;

class Controller_Rest_Projects extends \Controller_Rest {

    public function action_get() {
        $redmine_api = new \Redmine\Client('http://redmine.alphadev.de', 'a6112ee85240a9be87c66d5cc804f479d2e454fb');
        $redmine_projects = $redmine_api->api('project')->listing();
        $projects = array();
        if(!empty($redmine_projects)) {
            foreach($redmine_projects as $project) {
                $projects[] = $project['identifier'];
            }
        }
        return array('options' => $projects);
    }

}