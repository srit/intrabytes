<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */

Autoloader::add_core_namespace('Srit');
Autoloader::add_classes(array(
    'Srit\\Model' => __DIR__ . '/classes/model.php',
    'Srit\\Model_Language' => __DIR__ . '/classes/model/language.php',
    'Srit\\Model_Locale' => __DIR__ . '/classes/model/locale.php',
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
));

require_once 'base.php';

\Lang::init();
\Config::load('logger', true);