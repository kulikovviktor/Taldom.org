<?php

class Registry {

    static private $vars = array();
	
    static public function Set($key, $var) {
        if (isset(Registry::$vars[$key]) == true) {
                throw new Exception('Unable to set var `' . $key . '`. Already set.');
        }
        Registry::$vars[$key] = $var;
        return true;
	}

	static public function Get($key) {	
	    if (isset(Registry::$vars[$key]) == false) {	
	        return null;	
	    }	
	    return Registry::$vars[$key];	
	}	
	
	static public function Remove($var) {	
	    unset(Registry::$vars[$key]);	
	}
    
}