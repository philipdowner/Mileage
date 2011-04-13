<?php

//DOCUMENT SETTINGS
function get_document($var){
	global $pageid;
	
	//DOCTYPE
	if ($var == 'doctype') {
		echo '<!DOCTYPE html">';
	}
	
	//STYLESHEETS
	if ($var == 'stylesheets') {
		$stylesheets = '
		  <!-- CSS : implied media="all" -->
		  <link rel="stylesheet" href="'.CSS_PATH.'/style.css?v=1">
		
		  <!-- Uncomment if you are specifically targeting less enabled mobile browsers
		  <link rel="stylesheet" media="handheld" href="'.CSS_PATH.'/handheld.css?v=1">  -->
		';
		return $stylesheets;
	}
	
	//HEADER JAVASCRIPTS
	if ($var == 'scripts_header') {
		//Modernizr which enables HTML5 elements & feature detects
		$scripts_header = '<script src="'.JS_PATH.'/modernizr-1.5.min.js"></script>';
		
		return $scripts_header;
	}
	
	//FOOTER JAVASCRIPTS
	if ($var == 'scripts_footer') {
		
		// LOAD jQUERY
		// Grab Google CDN's jQuery. Fall back to local if necessary
		if ( get_environment() != "live" )
		{
			$scripts_footer = '<script src="'.JS_PATH.'/jquery-1.4.2.min.js"></script>';
		} else {
			$scripts_footer = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
		  $scripts_footer .= '<script>!window.jQuery && document.write(\'<script src="'.JS_PATH.'/jquery-1.4.2.min.js"><\/script>\')</script>';
		}
	  
	  //Plugins.js file
	  $scripts_footer .= '<script src="'.JS_PATH.'/plugins.js?v=1"></script>';
	  
	  //Script.js file
	  $scripts_footer .= '<script src="'.JS_PATH.'js/script.js?v=1"></script>';
	  
	  //PNG fix for IE6
	  $scripts_footer .= '
		  <!--[if lt IE 7 ]>
	    <script src="'.JS_PATH.'/dd_belatedpng.js?"></script>
	    <script>
	      DD_belatedPNG.fix(\'img, .png_bg\'); //fix any <img> or .png_bg background-images
	    </script>
	  <![endif]-->
	  ';
	  
	  //YUI profiler and profileviewer
	  if ( get_environment() != "live" )
	  {
		  $scripts_footer .= '<script src="'.JS_PATH.'/profiling/yahoo-profiling.min.js"></script>';
			$scripts_footer .= '<script src="'.JS_PATH.'/profiling/config.js?v=1"></script>';
	  }
	  
	  //Asynchronous google analytics
	  //Source: http://mathiasbynens.be/notes/async-analytics-snippet
	  if ( get_environment() == "live" )
	  {
		  $scripts_footer .= '
		  <script>
	   var _gaq = [[\'_setAccount\', \''.get_client('analytics_account').'\'], [\'_trackPageview\']];
	   (function(d, t) {
	    var g = d.createElement(t),
	        s = d.getElementsByTagName(t)[0];
	    g.async = true;
	    g.src = (\'https:\' == location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
	    s.parentNode.insertBefore(g, s);
	   })(document, \'script\');
	  </script>
		  ';
	  }
		
		return $scripts_footer;
	}
	
	if ($var == 'charset') {
		echo '<meta charset="UTF-8">';
	}
	
	if ($var == 'html') {
		
		// CONDITIONAL HTML TAGS
		// Source: paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/
		echo (' 
			<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
			<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
			<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
			<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
			<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->');
	}
}

/***********************************************************************/
/* !HOOKS 
		Hooks exist to allow you to quickly add content to a specific section
		of the site such as the header or footer. */
/***********************************************************************/
function hook_header()
{
	if ( get_environment() == "dev" )
	{
//		echo '<meta http-equiv="refresh" content="10">';
	}
}//end hook_header()

/***********************************************************************/
/* !NAVIGATION 
		A nice little array to build things from. :-)
		
		$return accepts a Boolean. If true will return the array rather
		than echoing it.
		
		$section accepts a numeric array key to build child elements from.
		*/
/***********************************************************************/
function navigation($return=false,$section=null)
{
	global $pageID;
	$pageid = $pageID;
	
	$menu = array(
		array( //0
			'text' => 'Category 1',
			'pageID' => 'cat1',
			'url' => '#',
			'children' => array(
											array(
												'text' => 'Child Page One',
												'pageID' => 'child',
												'url' => '#'
											),
											array(
												'text' => 'Child Page Three',
												'pageID' => 'child',
												'url' => '#'
											),
											array(
												'text' => 'Child Page Three',
												'pageID' => 'child',
												'url' => '#'
											),
											array(
												'text' => 'Child Page Four',
												'pageID' => 'child',
												'url' => '#'
											)
			)
		),
		array( //1
			'text' => 'Category 2',
			'pageID' => 'cat2',
			'url' => '#',
		),
		array( //2
			'text' => 'Category 3',
			'pageID' => 'cat3',
			'url' => '#',
			'children' => array(
											array(
												'text' => 'Blog',
												'pageID' => 'blog',
												'url' => '#'
											),
											array(
												'text' => 'Contact info',
												'pageID' => 'contact',
												'url' => '#'
											)
			)
		)
	);
	
	if ( $return != true ) //Create a menu
	{
		//IF NO SPECIFIC SITE SECTION IS REQUESTED
		//BUILD THE WHOLE MENU
		if ( !isset($section) )
		{
			for( $i = 0; $i < count($menu); $i++ )
			{
				//CHECK IF CURRENT PAGE & ASSIGN CLASS
			  $current = $pageid; //GLOBAL ASSIGNED ON PAGE
			  
			  if ($menu[$i]['pageID'] == $current)
			  {
				  $addclasses = $menu[$i]['pageID'].' current';
				} else { //No extra class needed
					$addclasses = $menu[$i]['pageID'];
				}
				
				//BUILD THE PARENT ITEMS
				echo '<li class="'.$addclasses.'">';
				echo '<a href="'.$menu[$i]['url'].'">';
				echo $menu[$i]['text'];
				echo '</a>';
				
					//BUILD CHILD PAGES AS NEEDED
					if (array_key_exists('children',$menu[$i]))
				  {
					  echo '<ul class="children clearfix">';
					  for ( $child=0; $child < count($menu[$i]['children']); $child++ )
					  {
						 
						 //CHECK IF CURENT PAGE
						 /** NOT SURE IF THIS WILL ACTUALLY ASSIGN 'CURRENT' CLASS TO PARENT PAGE **/
						 if ( $menu[$i]['children'][$child]['pageID'] == $current )
						 {
							 $currentparent = $menu[$i]['pageID'];
						 }//end if current
						 
						 echo '<li class="'.$menu[$i]['children'][$child]['pageID'].$addclasses.'"><a href="'.DOCUMENT_ROOT.$menu[$i]['children'][$child]['url'].'">'.$menu[$i]['children'][$child]['text'].'</a></li>'; 
					  }//end for children
					  
					  echo '</ul><!-- .children -->';
				  }
				
				echo '</li>';
			}
		} else { //OTHERWISE ONLY LIST CHILD REQUESTED
				echo '<ul class="children clearfix">';
				
				if ($menu[$section]['children'])
			  {
				  
				  for ( $child=0; $child < count($menu[$section]['children']); $child++ )
				  {
					 //CHECK IF CURRENT PAGE & ASSIGN CLASS
				  $current = $pageid; //GLOBAL ASSIGNED ON PAGE
				  
				  if ($menu[$section]['children'][$child]['pageID'] == $current )
				  {
					  $addclasses = $menu[$section]['children'][$child]['pageID'].' current';
					} else { //No extra class needed
						$addclasses = '';
					 
					 echo '<li class="'.$menu[$section]['children'][$child]['pageID'].$addclasses.'"><a href="'.DOCUMENT_ROOT.$menu[$section]['children'][$child]['url'].'">'.$menu[$section]['children'][$child]['text'].'</a></li>'; 
					 }
				  }//end for children
				  
			  } else { //NO CHILDREN IN THIS SECTION
				  echo '<li>No child pages in this section</li>';
			  }
			  echo '</ul><!-- .children -->';
		}
		
	} else { //Return the array
		return $menu;
	}
	
}//end navigation()

/***********************************************************************/
/* !BREADCRUMB MENUS */
/***********************************************************************/
function breadcrumb($current='Current page')
{
	echo '<ul id="breadcrumb">
	<li><a href="index.php">Home</a> &gt; </li>
	<li><a href="#">Page Structure</a> &gt; </li>
	<li class="current">'.$current.'</li>
	</ul>';
}//end breadcrumb()

/***********************************************************************/
/* !GET SIDEBAR
		Fetches the sidebar file for the requested section.
*/
/***********************************************************************/
function get_sidebar($sidebar='catalog')
{
	include_once(DOCUMENT_ROOT.'sidebar-'.$sidebar.'.php');

}//end get_sidebar()
?>