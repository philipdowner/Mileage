<?php

/*************************
#PAGE META
**************************/
function get_meta($var) {
	global $pageid;
	
	//PAGE AUTHOR	
	if ($var == 'author') {
		$author = 'Manifest Creative - www.manifestbozeman.com';
		return $author;
	}
	
	//MOBILE VIEWPORT
	if ($var == 'viewport')
	{
		$viewport =   '<!--  Mobile viewport optimized: j.mp/bplateviewport -->';
	  $viewport .= '<meta name="viewport" content="width=device-width; initial-scale=1.0">';

		return $viewport;
	}
	
	//CHROME FRAME
	// Always force latest IE rendering engine (even in intranet) & Chrome Frame
//	if ($var == 'chromeframe')
//	{
//		$chromeframe = '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
//		return $chromeframe;
//	}
	
	//SET WHAT SHOULD BE APPENDED TO TITLES
	if ($pageid == "home" || $pageid == "404")
	{
		$title_append = '';
	} else {
		$title_append = ' | '.get_client('name_display'); // APPEND THIS TEXT TO EACH TITLE
	}
	
	if ($var == 'title_append') {
		return $title_append;
	}

}

?>