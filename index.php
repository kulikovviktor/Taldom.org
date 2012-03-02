<?php 

include_once('root/init.php');

Registry::Get('MC')->inc(array(
	'models' => array(
		'weather/weather'
	)
));

$weather = new CWeather;
$weather->get_xml();

echo Registry::Get('TWIG')->render('index/main.html', array(
	'content' => '',
	'gentime' => show_gen_time(),
	'title' => 'Welcome'
));

pre ($weather->extract_forecast()->get_forecast()->attributes());