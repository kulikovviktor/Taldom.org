<?php

class ModelUser extends QBE {
	
	const TABLE = 'users';
	
	private $arError = array();
	
	function __construct() {}
	
	private function addError($message) {
		$this->arError[] = $message;
	}
	
	public function getErrors() {
		return $this->arError;
	}
	
	public function getLastError() {
		return $this->arError[count($this->arError)-1];
	}
	
	public function add($arrInsert) {
		if (is_array($arrInsert) && !empty($arrInsert)) {
			$arSql = parent::insert($arrInsert); 
			$STH = Registry::Get('DB')->prepare("INSERT INTO ".$this::TABLE." (".$arSql['names'].") VALUES (".$arSql['values'].")");  
			$STH->execute($arrInsert);  
			return Registry::Get('DB')->lastInsertId();
		}
	}
	
	## get by single paramether
	
	public function GetByLogin($login) {
		$login = trim($login);
		if (strlen($login) > 0) {
			$STH = Registry::Get('DB')->query("SELECT * FROM ".$this::TABLE." WHERE `login`='".$login."' LIMIT 1"); 
			if ($obj = $STH->fetch()) {  
				return $obj;
			} else {
				return false;
			}
		} else {
			$this->addError('Логин не указан!');
			return false;
		}
	}
	
	public function GetByEmail($email) {
		$email = trim($email);
		if (strlen($email) > 0) {
			$STH = Registry::Get('DB')->query("SELECT * FROM ".$this::TABLE." WHERE `email`='".$email."' LIMIT 1"); 
			if ($obj = $STH->fetch()) {  
				return $obj;
			} else {
				return false;
			}
		} else {
			$this->addError('E-mail не указан!');
			return false;
		}
	}
	
	## get auth user by login and password
	
	public function GetAuthorizedUser($login,$password) {
		$login = trim($login);
		$password = trim($password);
		if (strlen($login) > 0 && strlen($password) > 0) {
			$STH = Registry::Get('DB')->query("SELECT * FROM ".$this::TABLE." 
								WHERE `login`='".$login."' AND `password`='".$password."' LIMIT 1"); 
			if ($obj = $STH->fetch()) {  
				return $obj;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
}
