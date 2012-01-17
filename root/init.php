<?php

## independent functions
require_once 'independent_functions.php';

## including
require_once 'environments.php';
require_once 'db.php';

## twig
require_once DOCUMENT_ROOT . 'libs/Twig/Autoloader.php';

global $twigStr, $twig;

Twig_Autoloader::register();

$loaderString = new Twig_Loader_String();
$twigStr = new Twig_Environment($loaderString);

$loaderFiles = new Twig_Loader_Filesystem(TWIG_TEMPLATES);
$twig = new Twig_Environment($loader, array(
  'cache' => TWIG_CACHE,
));
