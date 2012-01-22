<?php

define ('DIRSEP', DIRECTORY_SEPARATOR);

## DOCUMENT_ROOT

// Узнаём путь до файлов сайта

if (!defined('DOCUMENT_ROOT')) {
	$str = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;
	define ('DOCUMENT_ROOT', $str);
}

## TWIG

define('TWIG_TEMPLATES', DOCUMENT_ROOT . 'views/{theme}/twig');
define('TWIG_CACHE', DOCUMENT_ROOT . 'cache/twig_compilations/');
