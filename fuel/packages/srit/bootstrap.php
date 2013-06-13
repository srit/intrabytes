<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */

Autoloader::add_core_namespace('Srit');
Autoloader::add_classes(array(
    'Srit\\Srit' => __DIR__ . '/classes/srit.php',
    'Srit\\Cache' => __DIR__ . '/classes/cache.php',
    'Srit\\Autoloader' => __DIR__ . '/classes/autoloader.php',
    'Srit\\Observer' => __DIR__ . '/classes/observer.php',
    'Srit\\File' => __DIR__ . '/classes/file.php',
    'Srit\\Last_Pages' => __DIR__. '/classes/last_pages.php',
    'Srit\\Model' => __DIR__ . '/classes/model.php',
    'Srit\\CachedModel' => __DIR__ . '/classes/cachedmodel.php',
    'Srit\\ModelList' => __DIR__ . '/classes/modellist.php',
    'Srit\\Exception' => __DIR__ . '/classes/exception.php',
    'Srit\\Date' => __DIR__ . '/classes/date.php',
    'Srit\\Request' => __DIR__ . '/classes/request.php',
    'Srit\\Model_Language' => __DIR__ . '/classes/model/language.php',
    'Srit\\Model_Navigation' => __DIR__ . '/classes/model/navigation.php',
    'Srit\\Model_Locale' => __DIR__ . '/classes/model/locale.php',

    'Srit\\Observer_Typing'      => __DIR__.'/classes/observer/typing.php',
    'Srit\\Observer_I18n' => __DIR__ . '/classes/observer/i18n.php',
    'Srit\\Observer_Localized' => __DIR__ . '/classes/observer/localized.php',
    'Srit\\Observer_Serialized' => __DIR__ . '/classes/observer/serialized.php',
    'Srit\\Observer_Translated' => __DIR__ . '/classes/observer/translated.php',
    'Srit\\Observer_CreatedAt'   => __DIR__.'/classes/observer/createdat.php',
    'Srit\\Observer_UpdatedAt'   => __DIR__.'/classes/observer/updatedat.php',
    'Srit\\Observer_Validation'  => __DIR__.'/classes/observer/validation.php',
    'Srit\\Observer_Self'        => __DIR__.'/classes/observer/self.php',
    'Srit\\Observer_Slug'        => __DIR__.'/classes/observer/slug.php',



    'Srit\\Lang' => __DIR__ . '/classes/lang.php',
    'Srit\\Helper' => __DIR__ . '/classes/helper.php',
    'Srit\\Loc' => __DIR__ . '/classes/loc.php',
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
    'Srit\\HttpPermissionDeniedException' => __DIR__.'/classes/httpexceptions.php',
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
    'Srit\\Controller_Base' => __DIR__ . '/classes/controller/base.php',
    'Srit\\Controller_BaseTemplate' => __DIR__ . '/classes/controller/basetemplate.php',
    'Srit\\Controller_BaseRawTemplate' => __DIR__ . '/classes/controller/baserawtemplate.php',
    'Srit\\Controller_BaseBlankTemplate' => __DIR__ . '/classes/controller/baseblanktemplate.php',
    'Srit\\Controller_BaseBigTemplate' => __DIR__ . '/classes/controller/basebigtemplate.php',
    'Srit\\Controller_CrudBigTemplate' => __DIR__ . '/classes/controller/crudbigtemplate.php',
    'Srit\\Controller_Base_User' => __DIR__ . '/classes/controller/base/user.php',
    'Srit\\Controller_Base_User_Raw' => __DIR__ . '/classes/controller/base/user/raw.php',
    'Srit\\Controller_Base_Template' => __DIR__ . '/classes/controller/base/template.php',
    'Srit\\Controller_Base_Template_Public' => __DIR__ . '/classes/controller/base/template/public.php',
    'Srit\\Controller_Base_Template_Blank' => __DIR__ . '/classes/controller/base/template/blank.php',
    'Srit\\Controller_Base_Template_Blank_Public' => __DIR__ . '/classes/controller/base/template/blank/public.php',
    'Srit\\Uri' => __DIR__ . '/classes/uri.php',
    'Srit\\Pagination' => __DIR__ . '/classes/pagination.php',
    'Srit\\Cache_Storage_File' => __DIR__ . '/classes/cache/storage/file.php',
    'Srit\\Cache_Storage_Memcached' => __DIR__ . '/classes/cache/storage/memcached.php',

    'Srit\\Model_Module' => __DIR__ . '/classes/model/module.php',
    'Srit\\Model_ModuleList' => __DIR__ . '/classes/model/modulelist.php',
    'Srit\\Model_Group' => __DIR__ . '/classes/model/group.php',
    'Srit\\Model_User' => __DIR__ . '/classes/model/user.php',
    'Srit\\Model_Client' => __DIR__ . '/classes/model/client.php',
    'Srit\\Model_Acl' => __DIR__ . '/classes/model/acl.php',
    'Srit\\Model_Role' => __DIR__ . '/classes/model/role.php',
    'Srit\\Model_User_Profile' => __DIR__ . '/classes/model/user/profile.php',
    'Srit\\Model_User_Public_Key' => __DIR__ . '/classes/model/user/public/key.php',
    'Srit\\Model_Userexception' => __DIR__ . '/classes/model/userexception.php',

    /**
     * https://github.com/WanWizard/fuel-nestedsets
     */
    'Nestedsets\\Model'		   			=> __DIR__ . '/vendor/fuel-nestedsets/classes/model.php',
));

require_once 'base.php';
require_once __DIR__ . '/vendor/password_combat/password.php';
\Srit\Lang::init();
\Fuel\Core\Config::load('logger', true);