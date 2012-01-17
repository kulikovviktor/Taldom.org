<?php

## DOCUMENT_ROOT

if (!defined('DOCUMENT_ROOT')) {
	if (!empty($_SERVER["DOCUMENT_ROOT"])) {
		define ('DOCUMENT_ROOT', $_SERVER["DOCUMENT_ROOT"]);
	} else {
		$str = str_replace ('/root/environments.php','/',__FILE__);
		define ('DOCUMENT_ROOT', $str);
	}
}

## TWIG

define('TWIG_TEMPLATES', DOCUMENT_ROOT . 'views/twig');
define('TWIG_CACHE', DOCUMENT_ROOT . 'cache/twig_compilations/');
