<?php

class CFile {
	
	const TABLE = 'files';
	
	static public function GetByID($id) {
		$STH = Registry::Get('DB')->query("SELECT * FROM ".$this::TABLE." WHERE `id`='".$email."' LIMIT 1"); 
		if ($obj = $STH->fetch()) {
			return $obj;
		} else {
			return false;
		}
	}
	
}