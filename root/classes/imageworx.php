<?php

class imageworx {
	
	static function resampled($src, $dest, $width_f, $height_f, $rgb = 0xFFFFFF, $quality = 90) {  
	    if (!file_exists($src)) {  
	        return false; 
	    }   
	    $size = getimagesize($src);   
	    if ($size === false) {  
	        return false;  
	    } 
	    if ($size[1]>$size[0]) {
	        $height = $height_f;
	        $width = $width_f;
	    }else{
	        $height = $height_f;
	        $width = $width_f;
	    }      
	    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));  
	    $icfunc = 'imagecreatefrom'.$format;    
	    if (!function_exists($icfunc)) {  
	        return false;  
	    }    
	    $x_ratio = $width  / $size[0];  
	    $y_ratio = $height / $size[1];     
	    if ($height == 0) {       
	        $y_ratio = $x_ratio;  
	        $height  = $y_ratio * $size[1];     
	    } elseif ($width == 0) {       
	        $x_ratio = $y_ratio;                                
	        $width   = $x_ration * $size[0];    
	    }          
	    $ratio       = min($x_ratio, $y_ratio);  
	    $use_x_ratio = ($x_ratio == $ratio);   
	    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);  
	    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);  
	    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);  
	    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);     
	    $isrc  = $icfunc($src);      
	    if ($size[0] > $width_f) {       
	    $idest = imagecreatetruecolor($width, $height); 
	    }else{
	    $idest = imagecreatetruecolor($size[0], $size[1]); 
	    }     
	    imagefill($idest, 0, 0, $rgb);  
	    if ($size[0] > $width_f) {
	    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);   
	    }else{
	    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $size[0] , $size[1], $size[0], $size[1]);        
	    } 
	    imagejpeg($idest, $dest, $quality);     
	    imagedestroy($isrc);  
	    imagedestroy($idest);     
	    return true;  
	} 
}