<?php
/*	
	*	CrunchPress Social Sharing File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file return the Social Sharing to the selected post_type
	*	---------------------------------------------------------------------
	*/
	function videogo_include_social_shares($social_icons=""){
		
		global $videogo_social_settings;
		
		/* Social Sharing */
		$videogo_facebook_sharing = '';
		$videogo_twitter_sharing = '';
		$videogo_googleplus_sharing = '';
		$videogo_social_settings = '';
		
		/* Getting Values from database */
		$videogo_social_settings = get_option('social_settings');
		if($videogo_social_settings <> ''){
			$videogo_social = new DOMDocument ();
			$videogo_social->loadXML ( $videogo_social_settings );
		
			/* Social Sharing Values */
			$videogo_facebook_sharing = videogo_find_xml_value($videogo_social->documentElement,'videogo_facebook_sharing');
			$videogo_twitter_sharing = videogo_find_xml_value($videogo_social->documentElement,'videogo_twitter_sharing');
			$videogo_googleplus_sharing = videogo_find_xml_value($videogo_social->documentElement,'videogo_googleplus_sharing');
		}
		global $wp;
		$videogo_currentUrl = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
		if( is_ssl() ){
			$videogo_currentUrl = "https://" . $videogo_currentUrl;
		}else{
			$videogo_currentUrl = "http://" . $videogo_currentUrl;
		}
		
		$videogo_facebook = 'http://www.facebook.com/share.php?u='.$videogo_currentUrl;
		$videogo_twitter = 'http://twitter.com/home?status='.str_replace(" ", "%20", get_the_title()).'%20-%20'.$videogo_currentUrl;
		$videogo_gplus = 'https://plus.google.com/share?url={'.$videogo_currentUrl.'}';
		
		/* Deprecated Forums From Base Theme
		*
		* $delicious = 'http://delicious.com/post?url='.$videogo_currentUrl.'&#038;title='.get_the_title();
		* $reddit = 'http://reddit.com/submit?url='.$videogo_currentUrl.'&#038;title='.get_the_title();
		* $digg = 'http://digg.com/submit?url='.$videogo_currentUrl.'&#038;title='.get_the_title();
		* $myspace = 'http://www.myspace.com/Modules/PostTo/Pages/?u='.$videogo_currentUrl;
		*
		*/
		
		$videogo_output = '';
		$videogo_output .= '<ul class="cp-social-links">';
		if($videogo_facebook_sharing == 'enable'){ 
		$videogo_output .= '<li><a href="'.esc_url($videogo_facebook).'"><i class="fa fa-facebook-square"></i></a></li>';
		}
		if($videogo_googleplus_sharing == 'enable'){ 
		$videogo_output .= '<li><a href="'.esc_url($videogo_gplus).'"><i class="fa fa-google-plus"></i></a></li>';
		}
		if($videogo_twitter_sharing == 'enable'){ 
		$videogo_output .= '<li><a href="'.esc_url($videogo_twitter).'"><i class="fa fa-twitter"></i></a></li>';
		}
		$videogo_output .= '</ul>';		
		
		return $videogo_output;
	}
?>