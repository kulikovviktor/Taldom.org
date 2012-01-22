<?php

class MC {
	
	function __construct() {}
	
	private $arError = array();
	
	private function addError($message) {
		$this->arError[] = $message;
	}
	
	public function inc($controller) {
		# models
		if (is_array($controller['models']) && !empty($controller['models'])) {
			foreach ($controller['models'] as $k => $fn) {
				$model_include_file = DOCUMENT_ROOT . 'models' . DIRSEP . $fn . '.php';
				if (file_exists($model_include_file)) {
					include_once($model_include_file);
				} else {
					$this->addError('Model-file Not found: ' . $model_include_file);
				}
			}
		}
		# controllers
		if (is_array($controller['controllers']) && !empty($controller['controllers'])) {
			foreach ($controller['controllers'] as $k => $fn) {
				$controller_include_file = DOCUMENT_ROOT . 'controllers' . DIRSEP . $fn . '.php';
				if (file_exists($controller_include_file)) {
					include_once($controller_include_file);
				} else {
					$this->addError('Controller-file Not found: ' . $controller_include_file);
				}
			}
		}
	}	
	
	public function ShowErrors() {
		return $this->arError;
	}
	
}

global $mc;

$mc = new MC();

## DEFAULT including

$mc->inc(array(
	'models' => array(
		'user'
	),
	'controllers' => array(
		'user'
	)
));
