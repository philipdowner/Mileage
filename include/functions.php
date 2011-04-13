<?php

/***********************************************************************/
/* !DUMMY CONTENT */
/***********************************************************************/
function get_dummy_content(){
	include(DOCUMENT_ROOT.'dummy-content.php');
}

function get_dummy_img($width,$height,$text,$class)
{
	echo '<img class="'.$class.'" src="http://dummyimage.com/'.$width.'x'.$height.'/757368/fff.jpg&amp;text='.$text.' ('.$width.'x'.$height.')" alt="'.$text.'" width="'.$width.'" height="'.$height.'" />';
}// end dummy_img()

function lorem($length=200,$paragraphs=1,$html=false)
{
	//GRAB SOME TEXT
	$source = 'Aliquam erat volutpat. Mauris vel neque sit amet nunc gravida congue sed sit amet purus. Quisque lacus quam, egestas ac tincidunt a, lacinia vel velit. Aenean facilisis nulla vitae urna tincidunt congue sed ut dui. Morbi malesuada nulla nec purus convallis consequat. Vivamus id mollis quam. Morbi ac commodo nulla. In condimentum orci id nisl volutpat bibendum. Quisque commodo hendrerit lorem quis egestas. Maecenas quis tortor arcu. Vivamus rutrum nunc non neque consectetur quis placerat neque lobortis. Nam vestibulum, arcu sodales feugiat consectetur, nisl orci bibendum elit, eu euismod magna sapien ut nibh. Donec semper quam scelerisque tortor dictum gravida. In hac habitasse platea dictumst. Nam pulvinar, odio sed rhoncus suscipit, sem diam ultrices mauris, eu consequat purus metus eu velit. Proin metus odio, aliquam eget molestie nec, gravida ut sapien. Phasellus quis est sed turpis sollicitudin venenatis sed eu odio. Praesent eget neque eu eros interdum malesuada non vel leo. Sed fringilla porta ligula egestas tincidunt. Nullam risus magna, ornare vitae varius eget, scelerisque a libero. Morbi eu porttitor ipsum. Nullam lorem nisi, posuere quis volutpat eget, luctus nec massa. Pellentesque aliquam lacinia tellus sit amet bibendum. Ut posuere justo in enim pretium scelerisque. Etiam ornare vehicula euismod. Vestibulum at risus augue. Sed non semper dolor. Sed fringilla consequat velit a porta. Pellentesque sed lectus pharetra ipsum ultricies commodo non sit amet velit. Suspendisse volutpat lobortis ipsum, in scelerisque nisi iaculis a. Duis pulvinar lacinia commodo. Integer in lorem id nibh luctus aliquam. Sed elementum, est ac sagittis porttitor, neque metus ultricies ante, in accumsan massa nisl non metus. Vivamus sagittis quam a lacus dictum tempor. Nullam in semper ipsum. Cras a est id massa malesuada tincidunt. Etiam a urna tellus. Ut rutrum vehicula dui, eu cursus magna tincidunt pretium. Donec malesuada accumsan quam, et commodo orci viverra et. Integer tincidunt sagittis lectus. Mauris ac ligula quis orci auctor tincidunt. Suspendisse odio justo, varius id posuere sit amet, iaculis sit amet orci. Suspendisse potenti. Suspendisse potenti. Aliquam erat volutpat. Sed posuere dignissim odio, nec cursus odio mollis.';
	
	//HOW LONG IS IT?
	$source_length = strlen($source);
	
	//IS REQUESTED LENGTH TOO LONG?
	if ( $length > $source_length)
	{
		$length = ($source_length - 2);
	}
	
	//GENERATE NEEDED PARAGRAPHS
	for($i=1;$i<=$paragraphs;$i++)
	{
		if($html)
		{
			echo '<p class="lorem">';
		}
		
		$shortened = substr( $source,0,($length - 2) ).'. ';
		echo $shortened;
		echo '('.str_word_count($shortened).'/'.strlen($shortened).')';
		
		if($html)
		{
			echo '</p>';
		}
	}

}//end lorem();

/***********************************************************************/
/* !TWITTER BUTTON */
/***********************************************************************/
function twitter_button($posturi)
{
	
	// Primary account holder; required.
	$username = get_client('twitter_username');
	
	// Additional user to suggest. Leave blank for no user.
	$suggested_user = 'manifestphil';
	
	// Description of suggested user
	$suggested_user_desc = 'Bozeman\'s web designer';
	
	//Button Layout and tweet count - Required - 'horizontal', 'vertical' or 'none'
	$data_count = "horizontal";
	
	//The text you want tweeted. Leave blank for page title.
	$data_text = "";
	
	//The URL you want shortened and tweeted. Leave blank for current page.
	$data_url = "";
	
	
	//Construct the button
	$button = '<a href="http://twitter.com/share" class="twitter-share-button" id="twitter-button"';
	$button .= ' data-via="'.$username.'"';
	
		//SUGGESTED USER?
		if ( $suggested_user !== "" )
		{
			$button .= ' data-related="';
			$button .= $suggested_user;
				if ($suggested_user_desc !== "" )
				{
					$button .= ':'.$suggested_user_desc;
				}
			$button .= '"';
		}
		
		//CUSTOM TEXT?
		if ( $data_text !== "" )
		{
			$button .= ' data-text="'.$data_text.'"';
		}
		
		//CUSTOM URL?
		if ( $data_url !== "" )
		{
			$button .= ' data-url="'.$data_url.'"';
		} else {
			$button .= ' data-url="'.$posturi.'"';
		}
	
	$button .= ' data-count="'.$data_count.'"';
	$button .= '>Tweet</a>';
	$button .= '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
	
	//SETUP THE LAYOUT
	echo $button;

}//end FUNCTION

/***********************************************************************/
/* !FACEBOOK LIKE BUTTON */
/***********************************************************************/
function facebook_like($posturi)
{
	echo '<iframe class="facebook_like" src="http://www.facebook.com/plugins/like.php?href='.$posturi.'&amp;layout=standard&amp;show_faces=true&amp;width=300&amp;height=35&amp;action=like&amp;font=arial&amp;colorscheme=light" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px;height:35px;" allowTransparency="true"></iframe>';
}

/***********************************************************************/
/* !GOOGLE BUZZ BUTTON */
/***********************************************************************/
function buzz_button($posturi)
{
 echo '<a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="'.$posturi.'"></a>
		 <script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>';

}//end buzz_button()
?>