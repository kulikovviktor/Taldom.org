<?php 

include_once('root/init.php');

/*
HelperClasses::inc('Twitter');
$tw = new Twitter();
$tw->addMessage("Тестовое сообщение из системы");
pre($tw->getLastError());
*/

// $show = ( Registry::Get('USER')->CreateUser('1BlackWeb','v4nf77fh','b2ezdoom@foxconn.ru') );

echo Registry::Get('TWIG')->render('index/main.html', array(
	'content' => $show,
	'gentime' => show_gen_time(),
	'title' => 'Welcome'
));
