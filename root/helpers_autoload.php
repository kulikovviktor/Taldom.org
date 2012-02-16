<?php

class HelperClasses {
	static public function inc($class_name) {
		$fname = DOCUMENT_ROOT . 'root'.DIRSEP.'classes'.DIRSEP.'helpers' . DIRSEP . $class_name . '.php';
		if(!file_exists($fname)) {
			throw new Exception('Файла [' . $fname . '] не существует!');
		}
		require_once($fname);
	}
}

## Если твиг отключен, о нашему автолоадеру ничего не мешает работать корректно

if (defined('CONFIG_USE_STANDART_VIEW') && CONFIG_USE_STANDART_VIEW === true) {

	function helpers__autoload($class_name) {
		HelperClasses::inc($class_name);
	}

	spl_autoload_register("helpers__autoload");

}