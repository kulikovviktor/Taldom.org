<?php

## debug functions

function DebugMessage($message, $title = false, $color = "#008B8B") {
	echo '<table border="0" cellpadding="5" cellspacing="0" style="border:1px solid '.$color.';margin:2px;"><tr><td>';
	if (strlen($title)>0) {		
		echo '<p style="color: '.$color.';font-size:11px;font-family:Verdana;">['.$title.']</p>';
	}
	if (is_array($message) || is_object($message))	{
	   echo '<pre style="color:'.$color.';font-size:11px;font-family:Verdana;">'; print_r($message); echo '</pre>';
	} else {
	   echo '<p style="color:'.$color.';font-size:11px;font-family:Verdana;">'.$message.'</p>';
	}
	echo '</td></tr></table>';
}

function debug($message, $title = false, $color = "#008B8B") { DebugMessage ($message, $title, $color); }
function __d($message, $title = false, $color = "#008B8B") { DebugMessage ($message, $title, $color); }

function pre($array = false, $description = false, $debug_print_trace = false, $vardump = false) {
	
	$debug_trace = debug_backtrace();
	if($debug_print_trace){
		foreach(debug_backtrace() as $k=>$v){
	        if($v['function'] == "include" || $v['function'] == "include_once" || $v['function'] == "require_once" || $v['function'] == "require"){
	            $backtracel .= "#".$k." ".$v['function']."(".$v['args'][0].") called at [".$v['file'].":".$v['line']."]<br />";
	        }else{
	            $backtracel .= "#".$k." ".$v['function']."() called at [".$v['file'].":".$v['line']."]<br />";
	        }
	    } 
	    echo "<br /><b>".$backtracel."</b><br />";
    }
    else {
    	print( "<br /><b>".$debug_trace[0]["file"].": ".$debug_trace[0]["line"]."</b><br />");
    }
     if($description)
    	echo "<b>".$description."</b><br />";
	echo "<pre>";
	if ($vardump) {
		var_dump($array);
	} else {
		print_r($array);
	}
	echo "</pre>";
	return true;
	
}

function pre_vd($array = false, $description = false, $debug_print_trace = false) {
	pre($array,$description,$debug_print_trace,true);
}

## string functions

function stripTextByWords($in, $words = 100) {
	$in = ereg_replace(" +"," ",$in);
	$in = str_ireplace(array('<br>','<br/>','<br />'),array('','',''),$in);
	$wordsArray = explode(' ', $in);
	$countWords = count($wordsArray);
	$strReturn = '';
	if ($countWords>$words) {
		 $i = 0;
		foreach($wordsArray as $k=>$w) {
			$i++;
			$strReturn .= $w.(($i < $words) ? ' ' : '');
			if ($i >= $words) break;
		}
		$strReturn .= '...';
	}else{
		$strReturn = $in;
	}
	return $strReturn;
}

function quotefix($string){
   return str_replace("\"","&quot;",$string);
}

function show_gen_time() {
	return (microtime() - GENERATION_START_TIME);
}
