<?php

class ControllerUser extends ModelUser {
	
	function __construct() {
		parent::__construct();
	}
	
	public function AddNewUser($login, $password, $email, $active = true, $confirm = true) {
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
		if (!parent::GetByLogin($login) && !parent::GetByEmail($email)) {
			$ret = parent::add($insertArray);
		} else {
			$ret = 0;
		}
		return $ret;
	}
	
	public function LogIn($login, $password) {
		$login = trim($login);
		$password = base64_encode($password);
		$user = parent::GetAuthorizedUser($login, $password);
		if ($user!=false && $user['id'] > 0) {
			$_SESSION['AUTH']['LOGIN'] = $login;
			$_SESSION['AUTH']['PASSWORD'] = $password;
		} else {
			$this->LogOut();
		}
	}
	
	public function LogOut() {
		unset($_SESSION['AUTH']);
	}
	
	public function IsAuth() {
		if ($_SESSION['AUTH']['LOGIN']!=false && $_SESSION['AUTH']['PASSWORD']!=false) {
			$user = parent::GetAuthorizedUser($_SESSION['AUTH']['LOGIN'], $_SESSION['AUTH']['PASSWORD']);
			if ($user!=false && $user['id'] > 0) return true; else return false;
		} else return false;
	}
	
}

Registry::Set('USER', new ControllerUser());
