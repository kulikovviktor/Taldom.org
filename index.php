<?php 

include_once('root/init.php');

if (isset($_GET['reg'])) {
	$ind = Registry::Get('USER')->AddNewUser('tesdt','53b0b511','vdk@headhub.ru', true, false);
}

if (isset($_GET['logout'])) {
	Registry::Get('USER')->LogOut();
}

if (Validator::IsMobile()) {
	print "MobilePhone";
}
if (isset($_GET['addfile'])) {
	$ID_FILE = CFile::Add(array(
		'createt_at' => date('Y-m-d H:i:s'),
		'description' => 'Just a test description file'
	));
	
	pre($ID_FILE);

	pre(CFile::GetByID($ID_FILE));
}

ob_start();

$key = new Rediska_Key('keyName');

if (!$key->getValue()) {
	pre('redis write');
	$text = 'test this';
	$key->setValue($text);
	$key->expire(5 * 60);
	$var = $text;
} else {
	$var = $key->getValue($text);
}

pre ($var);

$textvar = ob_get_clean();

/*
$new = new ImageWorx();
print $new->test();
*/

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
	if (!defined('CONFIG_USE_STANDART_VIEW') && CONFIG_USE_STANDART_VIEW !== false) {
		$view['auth_form'] = Registry::Get('TWIG')->render('auth_form.html',array('message'=>$authMessage));
	} else {
		$view['auth_form'] = Registry::Get('VIEW')->clear()->set('message',$authMessage)->return_display('auth_form.tpl');
	}
} else {
	$view['auth_form'] = 'Добро пожаловать, <strong>'.$_SESSION['AUTH']['LOGIN'].'</strong>';
}

$show = $view['auth_form'].$textvar;
	
if (!defined('CONFIG_USE_STANDART_VIEW') && CONFIG_USE_STANDART_VIEW !== false) {

	echo Registry::Get('TWIG')->render('main.html', array(
		'content' => $show,
		'gentime' => show_gen_time(),
		'title' => 'TWIG: Тестовая разработка'
	));

} else {

Registry::Get('VIEW')->clear()
->set('title', 'NATIVE: Тестовая разработка')
->set('content', $show)
->set('gentime', show_gen_time())
->display('index.tpl');

}