<?php

class VIEW_View
{

	private $_path;
	private $_template;
	private $_var = array();

	public function __construct($path = '')
	{
		$this->set_path($path);
	}
	
	public function set_path($path = '') {
		$this->_path = $path;
		return $this;
	}

	public function set($name, $value)
	{
		$this->_var[$name] = $value;
		return $this;
	}
	
	public function clear() {
		$this->_var = array();
		return $this;
	}

	public function __get($name)
	{
		if (isset($this->_var[$name])) return $this->_var[$name];
		return '';
	}

	public function display($template, $strip = true)
	{
		$this->_template = $this->_path . $template;
		if (!file_exists($this->_template)) die('Шаблона ' . $this->_template . ' не существует!');

		ob_start();
		include($this->_template);
		echo ($strip) ? $this->_strip(ob_get_clean()) : ob_get_clean();
	}
	
	public function return_display($template, $strip = true) {
		ob_start();
		$this->display($template,$strip);
		return ob_get_clean();
	}

	private function _strip($data)
	{
		$lit = array("\\t", "\\n", "\\n\\r", "\\r\\n", "  ");
		$sp = array('', '', '', '', '');
		return str_replace($lit, $sp, $data);
	}

	public function xss($data)
	{
		if (is_array($data)) {
			$escaped = array();
			foreach ($data as $key => $value) {
				$escaped[$key] = $this->xss($value);
			}
			return $escaped;
		}
		return htmlspecialchars($data, ENT_QUOTES);
	}
	
}