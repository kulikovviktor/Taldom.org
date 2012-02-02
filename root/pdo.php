<?php

if (!defined('MYSQL_DISABLE')) {

global $db;

try {
	## crerate object
	$db = new PDO ( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_BASE, MYSQL_USER, MYSQL_PASSWORD ); 
	## charset settings
	if (defined('MYSQL_CHARSET')) {
		$db->query ( 'SET character_set_connection = ' . MYSQL_CHARSET . ';' );  
		$db->query ( 'SET character_set_client = ' . MYSQL_CHARSET . ';' );  
		$db->query ( 'SET character_set_results = ' . MYSQL_CHARSET . ';' );  
	}
	## preconfig
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo $e->getMessage();
	exit;
} 

}
