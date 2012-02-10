<?php

if (version_compare(phpversion(), '5.2.0', '<') == true) { die ('PHP5.2 min'); }

session_start();

## start counting time of generation page
define('GENERATION_START_TIME', microtime());

#####################
##### including #####
#####################

## independent functions
require_once 'independent_functions.php';

## including environemtns
require_once 'env/environments.php';
require_once 'env/registry.php';
require_once 'db.php';

## classes 
require_once 'classes/valid.php';
require_once 'classes/date.php';
require_once 'classes/qbe.php';
require_once 'classes/file.php';

######################
######## twig ########
######################

if (!defined('TWIG_DISABLED')) {

require_once DOCUMENT_ROOT . 'libs/Twig/Autoloader.php';

Twig_Autoloader::register();

if (defined('TWIG_STRING_ENABLED')) {
	$loaderString = new Twig_Loader_String();
	Registry::Set('TWIG_STRING', new Twig_Environment($loaderString));
}

if (!defined('THEME')) { define('THEME', 'default'); }

$loaderFiles = new Twig_Loader_Filesystem(str_replace('{theme}',THEME,TWIG_TEMPLATES));
Registry::Set('TWIG', new Twig_Environment($loaderFiles, array(
 'cache' => TWIG_CACHE,
)));

}

## model-controller
require_once 'env/mc.php';
