<?php 

include_once('root/init.php');

if (isset($_GET['reg'])) {
	$ind = Registry::Get('USER')->AddNewUser('test','53b0b511','vk@headhub.ru', true, false);
}

if (isset($_GET['logout'])) {
	Registry::Get('USER')->LogOut();
}

if (!Registry::Get('USER')->IsAuth()) {
	$authMessage = '';
	if (isset($_POST['USER_AUTH'],$_POST['USER_LOGIN'],$_POST['USER_PASSWORD']) &&
		$_POST['USER_AUTH'] == 'Y' && $_POST['USER_LOGIN']!=false && $_POST['USER_PASSWORD']!=false) {
		if (Registry::Get('USER')->LogIn($_POST['USER_LOGIN'],$_POST['USER_PASSWORD'])) {
			Header('Location: /');
			exit;
		} else {
			$authMessage = 'Ошибка авторизации! Неверные логин и/или пароль!';
		}
	}
	$view['auth_form'] = Registry::Get('TWIG')->render('auth_form.html',array('message'=>$authMessage));
} else {
	$view['auth_form'] = 'Добро пожаловать, <strong>'.$_SESSION['AUTH']['LOGIN'].'</strong>';
}

$show = $view['auth_form'];

echo Registry::Get('TWIG')->render('main.html', array(
	'content' => $show,
	'gentime' => show_gen_time(),
	'title' => 'Тестовая разработка'
));
