<?php

class CFile {
	
	const TABLE = 'files';
	
	static public function GetByID($id) {
		global $db;
		$STH = $db->query("SELECT * FROM ".$this::TABLE." WHERE `id`='".$email."' LIMIT 1"); 
		if ($obj = $STH->fetch()) {
			return $obj;
		} else {
			return false;
		}
	}
	
}