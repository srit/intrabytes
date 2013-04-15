<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */

Autoloader::add_core_namespace('Srit');
Autoloader::add_classes(array(
    'Srit\\Last_Pages' => __DIR__. '/classes/last_pages.php',
    'Srit\\Model' => __DIR__ . '/classes/model.php',
    'Srit\\Exception' => __DIR__ . '/classes/exception.php',
    'Srit\\Date' => __DIR__ . '/classes/date.php',
    'Srit\\Request' => __DIR__ . '/classes/request.php',
    'Srit\\Model_Language' => __DIR__ . '/classes/model/language.php',
    'Srit\\Model_Sitemap' => __DIR__ . '/classes/model/sitemap.php',
    'Srit\\Model_Locale' => __DIR__ . '/classes/model/locale.php',
    'Srit\\Observer_I18n' => __DIR__ . '/classes/observer/i18n.php',
    'Srit\\Observer_Localized' => __DIR__ . '/classes/observer/localized.php',
    'Srit\\Observer_Translated' => __DIR__ . '/classes/observer/translated.php',
    'Srit\\Lang' => __DIR__ . '/classes/lang.php',
    'Srit\\Helper' => __DIR__ . '/classes/helper.php',
    'Srit\\Locale' => __DIR__ . '/classes/locale.php',
    'Srit\\L10n' => __DIR__ . '/classes/l10n.php',
    'Srit\\Validation_Error' => __DIR__ . '/classes/validation/error.php',
    'Srit\\Inflector' => __DIR__ . '/classes/inflector.php',
    'Srit\\Debug' => __DIR__ . '/classes/debug.php',
    'Srit\\Controller_Template' => __DIR__ . '/classes/controller/template.php',
    'Srit\\Validation' => __DIR__ . '/classes/validation.php',
    'Srit\\Error' => __DIR__ . '/classes/error.php',
    'ChromePhp' => __DIR__ . '/vendor/chromephp.php',
    'Srit\\Module' => __DIR__ . '/classes/module.php',
    'Srit\\Logger' => __DIR__ . '/classes/logger.php',
    'Srit\\HttpNotFoundException' => __DIR__.'/classes/httpexceptions.php',
    'Srit\\HttpServerErrorException' => __DIR__.'/classes/httpexceptions.php',
    'Srit\\Navigation' => __DIR__ . '/classes/navigation.php',
    'Srit\\Navigation_Elements' => __DIR__ . '/classes/navigation/elements.php',
    'Srit\\Navigation_Element' => __DIR__ . '/classes/navigation/element.php',
    'Srit\\Theme' => __DIR__ . '/classes/theme.php',
    'Srit\\Messages' => __DIR__ . '/classes/messages.php',
    'Srit\\Password' => __DIR__ . '/classes/password.php',
    'Srit\\Messages_Instance' => __DIR__ . '/classes/messages/instance.php',
    'Srit\\Auth_Acl_ICCRMAcl' => __DIR__ . '/classes/auth/acl/iccrmacl.php',
    'Srit\\Auth_Group_ICCRMGroup' => __DIR__ . '/classes/auth/group/iccrmgroup.php',
    'Srit\\Auth_Login_ICCRMAuth' => __DIR__ . '/classes/auth/login/iccrmauth.php',
    'Srit\\Controller_Base_User' => __DIR__ . '/classes/controller/base/user.php',
    'Srit\\Controller_Base_User_Raw' => __DIR__ . '/classes/controller/base/user/raw.php',
    'Srit\\Controller_Base_Template' => __DIR__ . '/classes/controller/base/template.php',
    'Srit\\Controller_Base_Template_Public' => __DIR__ . '/classes/controller/base/template/public.php',
    'Srit\\Controller_Base_Template_Blank' => __DIR__ . '/classes/controller/base/template/blank.php',
    'Srit\\Controller_Base_Template_Blank_Public' => __DIR__ . '/classes/controller/base/template/blank/public.php',
    'Srit\\Uri' => __DIR__ . '/classes/uri.php',
    'Srit\\Pagination' => __DIR__ . '/classes/pagination.php',

    /**
     * https://github.com/kbsali/php-redmine-api
     */
    'Redmine\\Client' => __DIR__ . '/vendor/Redmine/Client.php',
    'Redmine\\Api\\AbstractApi' => __DIR__ . '/vendor/Redmine/Api/AbstractApi.php',
    'Redmine\\Api\\Attachment' => __DIR__ . '/vendor/Redmine/Api/Attachment.php',
    'Redmine\\Api\\Group' => __DIR__ . '/vendor/Redmine/Api/Group.php',
    'Redmine\\Api\\Issue' => __DIR__ . '/vendor/Redmine/Api/Issue.php',
    'Redmine\\Api\\IssueCategory' => __DIR__ . '/vendor/Redmine/Api/IssueCategory.php',
    'Redmine\\Api\\IssuePriority' => __DIR__ . '/vendor/Redmine/Api/IssuePriority.php',
    'Redmine\\Api\\IssueRelation' => __DIR__ . '/vendor/Redmine/Api/IssueRelation.php',
    'Redmine\\Api\\IssueStatus' => __DIR__ . '/vendor/Redmine/Api/IssueStatus.php',
    'Redmine\\Api\\Membership' => __DIR__ . '/vendor/Redmine/Api/Membership.php',
    'Redmine\\Api\\News' => __DIR__ . '/vendor/Redmine/Api/News.php',
    'Redmine\\Api\\Project' => __DIR__ . '/vendor/Redmine/Api/Project.php',
    'Redmine\\Api\\Query' => __DIR__ . '/vendor/Redmine/Api/Query.php',
    'Redmine\\Api\\Role' => __DIR__ . '/vendor/Redmine/Api/Role.php',
    'Redmine\\Api\\TimeEntry' => __DIR__ . '/vendor/Redmine/Api/TimeEntry.php',
    'Redmine\\Api\\TimeEntryActivity' => __DIR__ . '/vendor/Redmine/Api/TimeEntryAcivity.php',
    'Redmine\\Api\\Tracker' => __DIR__ . '/vendor/Redmine/Api/Tracker.php',
    'Redmine\\Api\\User' => __DIR__ . '/vendor/Redmine/Api/User.php',
    'Redmine\\Api\\Version' => __DIR__ . '/vendor/Redmine/Api/Version.php',
    'Redmine\\Api\\Wiki' => __DIR__ . '/vendor/Redmine/Api/Wiki.php',

    /**
     * https://github.com/WanWizard/fuel-nestedsets
     */
    'Nestedsets\\Model'		   			=> __DIR__ . '/vendor/fuel-nestedsets/classes/model.php',
));

require_once 'base.php';
require_once __DIR__ . '/vendor/password_combat/password.php';
\Srit\Lang::init();
\Fuel\Core\Config::load('logger', true);