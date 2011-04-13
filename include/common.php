<?php

/************************************************************************
PROJECT NAME: 
START DATE: 

GENERAL CONTACT: Manifest Creative
DESIGNER:
FRONT-END PROGRAMMER: Philip Downer
BACK-END PROGRAMMER:

SITE URL: 
************************************************************************/

function get_environment()
{
	$environment = "dev"; // 'dev' or 'live';
	return $environment;
}

/***********************************************************************
MANIFEST INCLUDES
Extra layer intended to allow extensibility by PoCo
***********************************************************************/
include('settings.php'); //CLIENT SPECIFIC SETTINGS
include('layout/document.php'); //ANYTHING RELATED TO SETING UP THE DOCUMENT STRUCTURE
include('layout/meta.php'); //PAGE TITLES, DESCRIPTIONS, ETC.
include('functions.php'); //GENERAL SITE FUNCTIONS

?>