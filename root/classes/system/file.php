<?php

class CFile {
	
	const TABLE = 'files';
	
	static public function GetByID($id) {
		$STH = Registry::Get('DB')->query("SELECT * FROM ".CFile::TABLE." WHERE `id`='".$id."' LIMIT 1"); 
		if ($obj = $STH->fetch()) {
			return $obj;
		} else {
			return false;
		}
	}
	
	static public function Add($insert_array) {
		if (is_array($insert_array) && !empty($insert_array)) {
			foreach	($arr as $name => $value) {
				$i++;
				$sql_names .= ($i>1?',':'').'`'.$name.'`';
				$sql_values .= ($i>1?',':'').'\''.$value.'\'';
			}
			$STH = Registry::Get('DB')->prepare("INSERT INTO ".CFile::TABLE." (".$sql_names.") VALUES (".$sql_values.")");  
			$STH->execute($insert_array);  
			return Registry::Get('DB')->lastInsertId();
		}
	}
	
	static public function Upload() {
	
	}
	
}
