<?php

if (version_compare(phpversion(), '5.3.0', '<') == true) { die ('PHP5.3 min'); }

session_start();

## start counting time of generation page
define('GENERATION_START_TIME', microtime());

#####################
##### including #####
#####################

require_once 'init_config.php';

## independent functions
require_once 'independent_functions.php';

## including environemtns
require_once 'env/environments.php';
require_once 'env/registry.php';
require_once 'db.php';

## helper autoload include
require_once 'helpers_autoload.php';

## classes 
require_once 'classes/system/valid.php';
require_once 'classes/system/date.php';
require_once 'classes/system/qbe.php';
require_once 'classes/system/file.php';
require_once 'classes/system/user.php';

// Redis
require_once DOCUMENT_ROOT . '/libs/redis/library/Rediska.php';

Registry::Set('REDIS', new Rediska());

## VIEWS Engines

if (!defined('THEME')) { define('THEME', 'default'); }

if (defined('CONFIG_USE_STANDART_VIEW') && CONFIG_USE_STANDART_VIEW == true) {

########################
######## native ########
########################

require_once 'classes/system/view.php';

Registry::Set('VIEW', new VIEW_View(str_replace('{theme}',THEME,VIEW_TEMPLATES)));

} else {

######################
######## twig ########
######################

if (!defined('TWIG_DISABLED')) {

require_once DOCUMENT_ROOT . '/libs/Twig/lib/Twig/Autoloader.php';

Twig_Autoloader::register();

if (defined('TWIG_STRING_ENABLED')) {
	$loaderString = new Twig_Loader_String();
	Registry::Set('TWIG_STRING', new Twig_Environment($loaderString));
}

$loaderFiles = new Twig_Loader_Filesystem(str_replace('{theme}',THEME,TWIG_TEMPLATES));

$arTwigSettings = array();

if (!defined('TWIG_DEVELOP_MODE') && TWIG_DEVELOP_MODE !== true) {
	$arTwigSettings['cache'] = TWIG_CACHE;
}

Registry::Set('TWIG', new Twig_Environment($loaderFiles, $arTwigSettings));

}

}

## model-controller
require_once 'env/mc.php';
