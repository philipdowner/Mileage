<?php

if ($pageid == "home")
{
	echo '<h1>';
	echo '<a href="'.DOCUMENT_ROOT.'index.php" title="Home page">Home Page</a>';
	echo '</h1>';
} else {
	echo '<a href="'.DOCUMENT_ROOT.'index.php" title="Home page">Home Page</a>';
}

navigation();

?>