<?php
/**
 * @created 29.01.13 - 09:54
 * @author stefanriedel
 */

namespace Core;

class Controller_Settings_Language extends \Core\Controller_Base_User {
    public function action_index() {

        $languages = \Srit\Model_Language::find_all();
        Theme::instance($this->template)->set_partial('content', 'core/settings/language/index')->set('languages', $languages, false);
    }

    public function action_create() {
        $language = \Srit\Model_Language::forge();

        if(\Fuel\Core\Input::post('cancel', false)) {
            \Fuel\Core\Response::redirect(\Fuel\Core\Uri::create('/core/settings/language'));
        } elseif(\Fuel\Core\Input::post('save', false)) {
            $language->set(\Fuel\Core\Input::post());
            if($language->validate()) {
                $language->save();
                Messages::instance()->success(__(extend_locale('save.language.success')));
                Messages::redirect(\Fuel\Core\Uri::create('/core/settings/language'));
            }
        }

        Theme::instance($this->template)->set_partial('content', 'core/settings/language/create')->set('language', $language);
    }

    public function action_edit() {
        $id = $this->param('id');
        $language = \Srit\Model_Language::find($id);

        if(\Fuel\Core\Input::post('cancel', false)) {
            \Fuel\Core\Response::redirect(\Fuel\Core\Uri::create('/core/settings/language'));
        } elseif(\Fuel\Core\Input::post('save', false)) {

            $language->set(\Fuel\Core\Input::post());
            if($language->validate()) {
                $language->save();
                Messages::instance()->success(__(extend_locale('save.language.success')));
                Messages::redirect(\Fuel\Core\Uri::create('/core/settings/language'));
            }

        }

        Theme::instance($this->template)->set_partial('content', 'core/settings/language/edit')->set('language', $language);
    }

}