<?php

abstract class QBE {
	
	public function insert($arr) {
		if (is_array($arr) && !empty($arr)) {
			foreach	($arr as $name => $value) {
				$i++;
				$sql_names .= ($i>1?',':'').'`'.$name.'`';
				$sql_values .= ($i>1?',':'').'\''.$value.'\'';
			} 
		}
		return array('names'=>$sql_names, 'values'=>$sql_values);
	}
	
	public function NewBuilder() {
		return new QBE_Builder();
	}
	
}

### New Builder

class QBE_Builder {
	
	# constants
	const SELECT = 100;
	const UPDATE = 200;
	const DELETE = 300;
	const INSERT = 400;
	
	# object property
	private $type;
	
	# tables
	private $tables = array();
	
	# select
	private $select_fields = array();
	private $select_params = array();
	
	# constructor (select by default)
	function __construct($type = 100) {
		$this->type = $type;
	}
	
} 
