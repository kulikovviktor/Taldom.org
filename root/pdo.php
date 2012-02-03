<?php

if (!defined('MYSQL_DISABLE')) {

try {
	## crerate object
	Registry::Set('DB', new PDO ( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_BASE, MYSQL_USER, MYSQL_PASSWORD )); 
	## charset settings
	if (defined('MYSQL_CHARSET')) {
		Registry::Get('DB')->query ( 'SET character_set_connection = ' . MYSQL_CHARSET . ';' );  
		Registry::Get('DB')->query ( 'SET character_set_client = ' . MYSQL_CHARSET . ';' );  
		Registry::Get('DB')->query ( 'SET character_set_results = ' . MYSQL_CHARSET . ';' );  
	}
	## preconfig
	Registry::Get('DB')->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo $e->getMessage();
	exit;
} 

}
