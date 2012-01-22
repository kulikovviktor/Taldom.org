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
	
}
