<?php

class CUser extends QBE {
	
	const TABLE = 'users';
	
	public function __construct() {}
	
	public function Add($arrInsert) {
		if (is_array($arrInsert) && !empty($arrInsert)) {
			$arSql = parent::insert($arrInsert); 
			$STH = Registry::Get('DB')->prepare("INSERT INTO ".$this::TABLE." (".$arSql['names'].") VALUES (".$arSql['values'].")");  
			$STH->execute($arrInsert);  
			return Registry::Get('DB')->lastInsertId();
		}
	}
	
	public function CreateUser($login, $password, $email, $active = true, $confirm = true) {
		$login = trim($login); 
		$email = trim($email);
		$password = trim($password);
		$active = ($active ? 'Y' : 'N');
		$confirm = ($confirm ? 'Y' : 'N');
		$insertArray = array(
			'login' => $login,
			'password' => base64_encode($password),
			'email' => $email,
			'active' => $active,
			'confirm' => $confirm,
			'created_at' => date('Y-m-d H:i:s')
		);		
		if (!$this->IsUserExists(array('login'=>$login,'email'=>$email))) {
			$ret = $this->Add($insertArray);
		} else {
			$ret = 0;
		}
		return $ret;
	}
	
	public function IsUserExists($filter, $logic = 'or') {
		$whblock = parent::where(array(
			'logic' => $logic,
			'filter' => $filter
		));
		$STH = Registry::Get('DB')->query("SELECT `id` FROM ".$this::TABLE." WHERE ".$whblock." LIMIT 1"); 
		if ($obj = $STH->fetch()) {
			return $obj['id'];
		} else {
			return 0;
		}
	}
	
}

Registry::Set('USER', new CUser());