<?php 

include_once('root/init.php');

if (isset($_GET['reg'])) {
	$ind = $USER->AddNewUser('test','53b0b511','vk@headhub.ru', true, false);
}

if (isset($_GET['logout'])) {
	$USER->LogOut();
}

$m = new QBE_Builder();

if (!$USER->IsAuth()) {
	$authMessage = '';
	if (isset($_POST['USER_AUTH'],$_POST['USER_LOGIN'],$_POST['USER_PASSWORD']) &&
		$_POST['USER_AUTH'] == 'Y' && $_POST['USER_LOGIN']!=false && $_POST['USER_PASSWORD']!=false) {
		if ($USER->LogIn($_POST['USER_LOGIN'],$_POST['USER_PASSWORD'])) {
			Header('Location: /');
			exit;
		} else {
			$authMessage = 'Ошибка авторизации! Неверные логин и/или пароль!';
		}
	}
	$view['auth_form'] = $twig->render('auth_form.html',array('message'=>$authMessage));
} else {
	$view['auth_form'] = 'Добро пожаловать, <strong>'.$_SESSION['AUTH']['LOGIN'].'</strong>';
}

$show = $view['auth_form'];

echo $twig->render('main.html', array(
	'content' => $show,
	'gentime' => show_gen_time(),
	'title' => 'Тестовая разработка'
));
