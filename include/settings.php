<?php

/***********************************************************************

SETTINGS.PHP

Author: Philip Downer

NOTES:
Used to contain all client-specific settings such as API keys, account
numbers, contact info etc. Allows functions to be extended without 
requiring updates to each.

***********************************************************************/


/*************************
#CLIENT DISPLAY SETTINGS
**************************/
function get_client($var)
{
	$client = array(
		'name_display' => 'Manifest Creative',
		'name_web' => 'manifest-creative',
		'email' => 'philip@manifestbozeman.com',
		'address' => '21000 Frontage Rd.',
		'address_2' => 'Suite 6',
		'city' => 'Bozeman',
		'state' => 'MT',
		'zip' => '59714',
		'telephone' => '(406) 585-9406',
		'fax' => '(406) 522-0741',
		'analytics_account' => 'UA-XXXXX-X'
	);
	
	//RETURN THE STRING
	if ( array_key_exists($var,$client)) {
		return $client[$var];
	}
	
	//FORMAT ADDRESS STRING BEFORE RETURNING
	if ($var == 'address_formatted')
	{
		$address = $client['address'].'<br/>';
		if ($client['address_2'])
		{
			$address .= $client['address_2'].'<br/>';
		}
		$address .= $client['city'].', '.$client['state'].'&nbsp;'.$client['zip'].'<br/>';
		
		return $address;
	}
}

//Echoes get_client() rather than returning it.
function the_client($var)
{
	get_client($var);
	echo $client;
}

/***********************************************************************/
/* !BASE DIRECTORIES */
/***********************************************************************/
define('DOCUMENT_ROOT','');
define('INCLUDE_PATH',DOCUMENT_ROOT.'include');
define('IMG_PATH',DOCUMENT_ROOT.'images');
define('JS_PATH',DOCUMENT_ROOT.'js');
define('CSS_PATH',DOCUMENT_ROOT.'css');
?>