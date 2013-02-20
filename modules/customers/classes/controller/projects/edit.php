<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_Projects_Edit extends Controller_Projects {
    
    public function action_index() {
        
        $customer_id = $this->params('customer_id');
        $project_id = $this->params('project_id');
        
        if(\Input::post('cancel', false)) {
            \Response::redirect(\Uri::create('/customers/projects/list/:id', array('id' => (int)$customer_id)));
        }
        
        
        //$this->project = Model_Customer_Project::find_by_customer_id_and_id($customer_id,$project_id);
        $this->project = Model_Customer_Project::forge();
        /**
         * @todo Refaktorieren
         */
        
        if(\Input::post('save', false)) {
            $this->project->set(\Input::post());
            if($this->project->validate()) {
                $this->project->save();
                Messages::instance()->success(__(extend_locale('edit.customer.success')));
                Messages::redirect(\Uri::create('/customers/projects/list/:id', array('id' => (int)$customer_id)));
            }
        }
        
        Theme::instance($this->template)->set_partial('content', 'customers/projects/edit/index')->set('project', $this->project);
    }

}