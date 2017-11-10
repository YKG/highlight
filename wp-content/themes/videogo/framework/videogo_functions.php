<?php
	/*	
	*	Crunchpress Function Registered File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file use to register the wordpress function to the framework,
	*	and also use filter to hook some necessary events.
	*	---------------------------------------------------------------------
	*/
	
	
	if (function_exists('register_sidebar')){	
	
		/* default sidebar array */
		$videogo_sidebar_attr = array(
			'name' => '',
			'description' => '',
			'before_widget' => '<div class="widget sidebar-recent-post sidebar_section %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		);
			
		$videogo_footer_col_layout = '';
		$videogo_footer_col_layout = videogo_get_themeoption_value('videogo_footer_col_layout','general_settings');
		
		$videogo_sidebar_id = 0;
		$videogo_sidebar = array();
		
		/* Intializing Footer Sidebar 
			*
			* $videogo_select_footer_cp: Get Style Value For Multiple Footer Styles
			* Change It to Style 1 if Design Have Upper Footer Too.
			*
		*/
		
		$videogo_select_footer_cp = 'Style 2';
		if($videogo_select_footer_cp == 'Style 1'){
			$videogo_sidebar = array("Footer");
			$videogo_sidebar_upper = array("Upper-Footer");
		}else{
			$videogo_sidebar = array("Footer");
			$videogo_sidebar_upper = array();
		}
		
		/* Footer Columns Configs */
		if($videogo_footer_col_layout == 'footer-style1'){ 
			/* Footer Configuration (4-Col) */
			foreach( $videogo_sidebar as $videogo_sidebar_name ){
				$videogo_sidebar_attr['name'] = $videogo_sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$videogo_sidebar_name));
				$videogo_sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$videogo_sidebar_attr['before_widget'] = '<div class="col-md-3"><div class="widget box-1 %2$s">' ;
				$videogo_sidebar_attr['before_title'] = '<h3>' ;
				$videogo_sidebar_attr['after_widget'] = '</div></div>' ;
				$videogo_sidebar_attr['after_title'] = '</h3>' ;
				$videogo_sidebar_attr['description'] = 'Please Place Widget Here' ;				
				register_sidebar($videogo_sidebar_attr);
			}
		}else{
			/* Footer Configuration (3-Col) */
			foreach( $videogo_sidebar as $videogo_sidebar_name ){
				$videogo_sidebar_attr['name'] = $videogo_sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$videogo_sidebar_name));
				$videogo_sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$videogo_sidebar_attr['before_widget'] = '<div class="col-md-4"><div class="widget box-1 %2$s">' ;
				$videogo_sidebar_attr['after_widget'] = '</div></div>' ;
				$videogo_sidebar_attr['before_title'] = '<h3>';
				$videogo_sidebar_attr['after_title'] = '</h3>' ;
				$videogo_sidebar_attr['description'] = 'Please place widget here' ;
				register_sidebar($videogo_sidebar_attr);
			}
		}
		$videogo_sidebar = '';
		$videogo_sidebar = get_option('sidebar_settings');
		
		if(!empty($videogo_sidebar)){
			$videogo_xml = new DOMDocument();
			$videogo_xml->loadXML($videogo_sidebar);
			foreach( $videogo_xml->documentElement->childNodes as $sidebar_name ){
				$videogo_sidebar_attr['name'] = $sidebar_name->nodeValue;
				$videogo_sidebar_attr['id'] = 'custom-sidebar' . $videogo_sidebar_id++ ;
				$videogo_sidebar_attr['before_widget'] = '<div class="widget sidebar_section sidebar-recent-post %2$s">' ;
				$videogo_sidebar_attr['after_widget'] = '</div>' ;
				$videogo_sidebar_attr['before_title'] = '<h3>' ;
				$videogo_sidebar_attr['after_title'] = '</h3>' ;
				register_sidebar($videogo_sidebar_attr);
			}
		}
		
	}
	
	
	/* Add Theme Support */
	if(function_exists('add_theme_support')){
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list',) );
		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array('aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery') );
		/* enable featured image */
		add_theme_support('post-thumbnails');
		/* enable editor style */
		add_editor_style('editor-style.css');
		/* enable navigation menu */
		add_theme_support('menus');
		/* Register New Menus */
		register_nav_menus(array('header-menu'=>'Header Menu'));
		/* Add Theme Support For Title */
		add_theme_support( 'title-tag' );
		/* Add Widget Text Shortcode Filter */
		add_filter('widget_text', 'do_shortcode');
		/* Add Another theme support */
		add_theme_support( 'automatic-feed-links' );	
	}
	
	/* add filter to hook when user press "insert into post" to include the attachment id */
	add_filter('media_send_to_editor', 'videogo_add_para_media_to_editor', 20, 2);
	
	function videogo_add_para_media_to_editor($videogo_html, $videogo_id){
		if(strpos($videogo_html, 'href')){
			$videogo_pos = strpos($videogo_html, '<a') + 2;
			$videogo_html = substr($videogo_html, 0, $videogo_pos) . ' attid="' . $videogo_id . '" ' . substr($videogo_html, $videogo_pos);
		}
		return $videogo_html ;
	}
	
	
	/* Enable Theme to support the localization */
	add_action('init', 'videogo_word_translation');
	
	function videogo_word_translation(){
		load_theme_textdomain( 'videogo', get_template_directory() . '/languages/' );		
	}
	
	/* Excerpt Length Filter */
	add_filter('excerpt_length','videogo_excerpt_length');
	
	function videogo_excerpt_length(){
		return 1000;
	}
	/* Admin Panel Maintenance Mode Notice */
	function videogo_admin_notice_maintenance_mode() { ?>
		
		<div class="error">
			
			<p><strong><?php esc_html_e( 'Theme has activated maintenance mode!', 'videogo' ); ?></strong> - <?php esc_html_e('Please turn it off from Cp Theme Panel > General Settings > Maintenance Mode Settings > Maintenance Mode (On/Off).','videogo');?></p>
		
		</div>
		
		<?php
	}
	
	/* Google TypeKit Code */
	add_action('wp_footer', 'videogo_add_typekit_code');
	
	function videogo_add_typekit_code(){
		$videogo_embed_typekit_code = '';
		$videogo_typography_settings = get_option('typography_settings');
		if($videogo_typography_settings <> ''){
			$videogo_typo = new DOMDocument ();
			$videogo_typo->loadXML ( $videogo_typography_settings );
			$videogo_embed_typekit_code = videogo_find_xml_value($videogo_typo->documentElement,'videogo_embed_typekit_code');
		}
		echo esc_attr($videogo_embed_typekit_code);
	
	}
	/* ThemeForest Recommendation To Must Use Content Width */
	
	if ( ! isset( $content_width ) ){ $content_width = 980; }
	
	if ( ! isset( $videogo_content_width ) ){ $videogo_content_width = 980; }
	
	
	/* update the option if new value is exists and not equal to old one  */
	function videogo_save_option($videogo_name, $videogo_old_value, $videogo_new_value){
	
		if(empty($videogo_new_value) && !empty($videogo_old_value)){
		
			if(!delete_option($videogo_name)){
				return false;
			}
			
		}else if($videogo_old_value != $videogo_new_value){
		
			if(!update_option($videogo_name, $videogo_new_value)){
				return false;
			}
		}
		
		return true;
		
	}
/* Return header html output according to header style versions */
function videogo_header_style_output($header_style, $post_idz){
	
	$videogo_header_style_output_html = '';
	$videogo_post_idz_header = array();
	if($header_style == 'home-v3'){
		
		$videogo_post_idz_headerv3 = explode(",",$post_idz);
		$videogo_v3_foreach_counter = 1;
		$videogo_header_style_output_html .= '<div class="cp_banner"><ul class="cp-banner-listed">';
		
		foreach($videogo_post_idz_headerv3 as $videogo_post_idv3){    
						
			$videogo_header_post_author = get_post_field( 'post_author', $videogo_post_idv3 );
			$videogo_full_image_url = wp_get_attachment_url( get_post_thumbnail_id($videogo_post_idv3) ); 
			$videogo_post_views = videogo_getPostViews(get_the_ID());
			
			if($videogo_v3_foreach_counter == 1){ $videogo_image_url = aq_resize( $videogo_full_image_url, 432, 595, true ); }
			if($videogo_v3_foreach_counter == 2){ $videogo_image_url = aq_resize( $videogo_full_image_url, 647, 595, true ); }
			if($videogo_v3_foreach_counter == 3){ $videogo_image_url = aq_resize( $videogo_full_image_url, 360, 595, true ); }
			if($videogo_v3_foreach_counter == 4){ $videogo_image_url = aq_resize( $videogo_full_image_url, 360, 595, true ); }
			
			if($videogo_v3_foreach_counter == 1){ $videogo_header_style_output_html .= '<li class="col-1">'; }
			if($videogo_v3_foreach_counter == 2){ $videogo_header_style_output_html .= '<li class="col-2">'; }
			if($videogo_v3_foreach_counter == 3){ $videogo_header_style_output_html .= '<li class="col-3">'; }
			if($videogo_v3_foreach_counter == 4){ $videogo_header_style_output_html .= '<li class="col-3">'; }
			
			$videogo_header_style_output_html .= '<figure class="cp-md-banner-item">';
			$videogo_header_style_output_html .= '<a href="'.get_permalink($videogo_post_idv3).'"><img src="'.$videogo_image_url.'" alt="header v3 image'.$videogo_v3_foreach_counter.' "></a>';
			$videogo_header_style_output_html .= '<figcaption class="cp-caption">';
			$videogo_header_style_output_html .= '<h3><a href="'.get_permalink($videogo_post_idv3).'">'.esc_attr(get_the_title($videogo_post_idv3)).'</a></h3>';
			$videogo_header_style_output_html .= '<ul class="cp-meta-list">';
			$videogo_header_style_output_html .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
			$videogo_header_style_output_html .= '<li>by '.( get_the_author_meta( 'user_nicename', $videogo_header_post_author )).', <span>'.$videogo_post_views.'</span></li>';
			$videogo_header_style_output_html .= '</ul>';
			$videogo_header_style_output_html .= '<a href="'.get_permalink($videogo_post_idv3).'" class="play-video">'.esc_html('Play','videogo').'</a>';
			$videogo_header_style_output_html .= '</figcaption>';
			$videogo_header_style_output_html .= '</figure>';
			$videogo_header_style_output_html .= '</li>';
			
			$videogo_v3_foreach_counter++;
		}
		
		$videogo_header_style_output_html .= '</ul></div>';
		}
	if($header_style == 'home-v4'){
		
		$videogo_post_idz_headerv4 = explode(",",$post_idz);
		$videogo_header_style_output_html .= '<div class="cp_banner pd-t60"><div class="container"><div class="row">';
		
		foreach($videogo_post_idz_headerv4 as $videogo_post_idv4){    
						
			$videogo_header_post_author = get_post_field( 'post_author', $videogo_post_idv4 );
			$videogo_full_image_url = wp_get_attachment_url( get_post_thumbnail_id($videogo_post_idv4) );
			$videogo_post_views = videogo_getPostViews(get_the_ID()); 
			
			$videogo_image_url = aq_resize( $videogo_full_image_url, 360, 555, true ); 
			
			$videogo_header_style_output_html .= '<div class="col-md-4 col-sm-4 col-xs-12">';
			$videogo_header_style_output_html .= '<figure class="cp-md-banner-item">';
			$videogo_header_style_output_html .= '<a href="'.get_permalink($videogo_post_idv4).'"><img src="'.$videogo_image_url.'" alt="header v4 image'.$videogo_post_idv4.'"></a>';
			$videogo_header_style_output_html .= '<figcaption class="cp-caption">';
			$videogo_header_style_output_html .= '<h3><a href="'.get_permalink($videogo_post_idv4).'">'.esc_attr(get_the_title($videogo_post_idv4)).'</a></h3>';
			$videogo_header_style_output_html .= '<ul class="cp-meta-list">';
			$videogo_header_style_output_html .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
			$videogo_header_style_output_html .= '<li>by '.( get_the_author_meta( 'user_nicename', $videogo_header_post_author )).', <span>'.$videogo_post_views.'</span></li>';
			$videogo_header_style_output_html .= '</ul>';
			$videogo_header_style_output_html .= '<a href="'.get_permalink($videogo_post_idv4).'" class="play-video">'.esc_html('Play','videogo').'</a>';
			$videogo_header_style_output_html .= '</figcaption>';
			$videogo_header_style_output_html .= '</figure>';
			$videogo_header_style_output_html .= '</div>';
			
		}
		
		$videogo_header_style_output_html .= '</div></div></div>';
		}
	if($header_style == 'home-v5'){
		
		$videogo_post_idz_headerv5 = explode(",",$post_idz);
		$videogo_header_style_output_html .= '<div class="cp_banner"><div class="owl-carousel" id="cp_banner-slider2">';
		
		foreach($videogo_post_idz_headerv5 as $videogo_post_idv5){    
						
			$videogo_header_post_author = get_post_field( 'post_author', $videogo_post_idv5 );
			$videogo_full_image_url = wp_get_attachment_url( get_post_thumbnail_id($videogo_post_idv5) ); 
			$videogo_post_views = videogo_getPostViews(get_the_ID());
			
			$videogo_image_url = aq_resize( $videogo_full_image_url, 900, 595, true ); 
			
			$videogo_header_style_output_html .= '<div class="item">';
			$videogo_header_style_output_html .= '<figure class="cp-md-banner-item">';
			$videogo_header_style_output_html .= '<a href="'.get_permalink($videogo_post_idv5).'"><img src="'.$videogo_image_url.'" alt="header v5 image'.$videogo_post_idv5.'"></a>';
			$videogo_header_style_output_html .= '<figcaption class="cp-caption">';
			$videogo_header_style_output_html .= '<h3><a href="'.get_permalink($videogo_post_idv5).'">'.esc_attr(get_the_title($videogo_post_idv5)).'</a></h3>';
			$videogo_header_style_output_html .= '<ul class="cp-meta-list">';
			$videogo_header_style_output_html .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
			$videogo_header_style_output_html .= '<li>by '.( get_the_author_meta( 'user_nicename', $videogo_header_post_author )).', <span>'.$videogo_post_views.'</span></li>';
			$videogo_header_style_output_html .= '</ul>';
			$videogo_header_style_output_html .= '<a href="'.get_permalink($videogo_post_idv5).'" class="play-video">'.esc_html('Play','videogo').'</a>';
			$videogo_header_style_output_html .= '</figcaption>';
			$videogo_header_style_output_html .= '</figure>';
			$videogo_header_style_output_html .= '</div>';
                    
		}
		
		$videogo_header_style_output_html .= '</div></div>';
		}
	return $videogo_header_style_output_html;
	
}
/* Retrieves the thumbnail from a youtube or vimeo video */
function videogo_get_video_thumbnail( $src ) {
	$url_pieces = explode('/', $src); 
	$thumbnail = '';
	if($src <> ''){ 
	if ( $url_pieces[2] == 'vimeo.com' ) { 
		$id = $url_pieces[3];
		$response = wp_remote_get('http://vimeo.com/api/v2/video/' . $id . '.php');
		$hash=unserialize(wp_remote_retrieve_body($response));
		$thumbnail = $hash[0]['thumbnail_large'];
	} elseif ( $url_pieces[2] == 'www.youtube.com' ) { // If Youtube
		$extract_id = explode('?', $url_pieces[4]);
		$id = $extract_id[0];
		$thumbnail = 'http://img.youtube.com/vi/' . $id . '/mqdefault.jpg';
	} elseif ( $url_pieces[2] == 'player.vimeo.com' ){
		$id = $url_pieces[4];
		$response = wp_remote_get('http://vimeo.com/api/v2/video/' . $id . '.php'); 
		$hash=unserialize(wp_remote_retrieve_body($response));
		$thumbnail = $hash[0]['thumbnail_large'];
	
	} elseif ( $url_pieces[2] == 'www.dailymotion.com' ){
		$id = $url_pieces[5]; 
		$response= wp_remote_get('https://api.dailymotion.com/video/'.$id .'?fields=thumbnail_large_url');
		$hash=wp_remote_retrieve_body($response);
		$dialymotion_thumb_url = json_decode($hash); 
		$thumbnail = $dialymotion_thumb_url->{'thumbnail_large_url'}; 
	
		}
	}
	return $thumbnail;
}
/* Retrieves the video title from a youtube or vimeo video */
function videogo_get_video_title( $src ) {
	$url_pieces = explode('/', $src); 
	$title = '';
	
	if ( $url_pieces[2] == 'vimeo.com' ) { 
		$id = $url_pieces[3];
		$response = wp_remote_get('http://vimeo.com/api/v2/video/' . $id . '.php');
		$hash=unserialize(wp_remote_retrieve_body($response));
		$title = $hash[0]['title'];
	} elseif ( $url_pieces[2] == 'www.youtube.com' ) { // If Youtube
		$extract_id = explode('?', $url_pieces[4]);
		$title = $extract_id[0]['title'];
	} elseif ( $url_pieces[2] == 'player.vimeo.com' ){
		$id = $url_pieces[4];
		$response = wp_remote_get('http://vimeo.com/api/v2/video/' . $id . '.php');
		$hash=unserialize(wp_remote_retrieve_body($response));
		$title = $hash[0]['title'];
	
		}
	return $title;
}

	/* Returns called menu */
	function videogo_footer_menu($videogo_menu_name=''){
				$defaults = array(
				  'menu'            => $videogo_menu_name, 
				  'container'       => '', 
				  'container_class' => 'menu-{menu slug}-container', 
				  'container_id'    => 'navbar',
				  'menu_class'      => '', 
				  'echo'            => true,
				  'fallback_cb'     => '',
				  'before'          => '',
				  'after'           => '',
				  'link_before'     => '',
				  'link_after'      => '',
				  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				  'depth'           => 0,
				  'walker'          => '');		
					wp_nav_menu( $defaults);
	}
	
	
	/* Default Values Of Theme. */
	global $pagenow;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){
			
			if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Home Sidebar</right_sidebar_default><left_sidebar_default>Left Sidebar</left_sidebar_default><default_excerpt>300</default_excerpt></default_pages_settings>";videogo_save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}if(get_option('general_settings') == ''){$general_settings = "<general_settings><videogo_header_logo_swtich>enable</videogo_header_logo_swtich><videogo_header_logo>4</videogo_header_logo><videogo_logo_text_cp></videogo_logo_text_cp><videogo_logo_subtext></videogo_logo_subtext><videogo_logo_width>247</videogo_logo_width><videogo_logo_height>93</videogo_logo_height><videogo_primary_color>#a80d1f</videogo_primary_color><videogo_secondary_color>#555555</videogo_secondary_color><videogo_select_background_patren>Background-Patren</videogo_select_background_patren><videogo_bg_scheme></videogo_bg_scheme><videogo_body_patren></videogo_body_patren><videogo_color_patren></videogo_color_patren><videogo_body_image></videogo_body_image><videogo_position_image_layout>top</videogo_position_image_layout><videogo_image_repeat_layout>no-repeat</videogo_image_repeat_layout><videogo_image_attachment_layout>fixed</videogo_image_attachment_layout><videogo_header_inner_bg></videogo_header_inner_bg><videogo_top_content_switch>enable</videogo_top_content_switch><videogo_contact_number></videogo_contact_number><videogo_contact_email></videogo_contact_email><videogo_copyright_code>Copyright 2017 Crunchpress VideoGo Theme</videogo_copyright_code><videogo_footer_menu_1>footer-upper</videogo_footer_menu_1><videogo_footer_menu_2>footer-bottom</videogo_footer_menu_2><videogo_footer_col_layout>footer-style1</videogo_footer_col_layout><videogo_breadcrumbs>enable</videogo_breadcrumbs><videogo_rtl_layout>disable</videogo_rtl_layout><videogo_maintenance_mode_swtich>disable</videogo_maintenance_mode_swtich><videogo_comming_soon_style>Style 1</videogo_comming_soon_style><videogo_maintenace_title>Under Construction</videogo_maintenace_title><videogo_mainte_description>Lorem et sit consectetuer ipsum dolor sit amet justo et sit amet justo consectetuer adipiscing elit Suspendisse et justo Praesent.</videogo_mainte_description><videogo_countdown_time>12/20/2017</videogo_countdown_time><videogo_email_maintenance>info@crunchpress.com</videogo_email_maintenance><videogo_social_icons_maintenance>disable</videogo_social_icons_maintenance></general_settings>";videogo_save_option('general_settings', get_option('general_settings'),$general_settings);}if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><videogo_font_google>Roboto</videogo_font_google><videogo_font_size_normal></videogo_font_size_normal><videogo_font_google_heading>Roboto</videogo_font_google_heading><videogo_menu_font_google>Roboto</videogo_menu_font_google><videogo_heading_h1></videogo_heading_h1><videogo_heading_h2></videogo_heading_h2><videogo_heading_h3></videogo_heading_h3><videogo_heading_h4></videogo_heading_h4><videogo_heading_h5></videogo_heading_h5><videogo_heading_h6></videogo_heading_h6><videogo_embed_typekit_code></videogo_embed_typekit_code></typography_settings>";videogo_save_option('typography_settings', get_option('typography_settings'),$typography_settings);}if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><videogo_select_slider></videogo_select_slider><bx_slider_settings><videogo_slide_order_bx>slide</videogo_slide_order_bx><videogo_auto_play_bx>enable</videogo_auto_play_bx><videogo_pause_on_bx>enable</videogo_pause_on_bx><videogo_show_arrow>enable</videogo_show_arrow></bx_slider_settings></slider_settings>";videogo_save_option('slider_settings', get_option('slider_settings'),$slider_settings);}if(get_option('social_settings') == ''){$social_settings = "<social_settings><videogo_facebook_network></videogo_facebook_network><videogo_twitter_network>https://twitter.com/</videogo_twitter_network><videogo_google_plus_network>https://plus.google.com/</videogo_google_plus_network><videogo_dribble_network>https://dribbble.com/</videogo_dribble_network><videogo_linked_in_network>https://www.linkedin.com/</videogo_linked_in_network><videogo_youtube_network></videogo_youtube_network><videogo_flickr_network>https://www.flickr.com/</videogo_flickr_network><videogo_vimeo_network>https://vimeo.com/</videogo_vimeo_network><videogo_pinterest_network>https://www.pinterest.com/</videogo_pinterest_network><videogo_Instagram_network>https://www.instagram.com/</videogo_Instagram_network><videogo_github_network></videogo_github_network><videogo_skype_network></videogo_skype_network><videogo_facebook_sharing>enable</videogo_facebook_sharing><videogo_twitter_sharing>enable</videogo_twitter_sharing><videogo_googleplus_sharing>enable</videogo_googleplus_sharing></social_settings>";videogo_save_option('social_settings', get_option('social_settings'),$social_settings);}if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Default Page Sidebar</sidebar_name><sidebar_name>Post Sidebar</sidebar_name><sidebar_name>Home Sidebar</sidebar_name><sidebar_name>Default Sidebar</sidebar_name><sidebar_name>Contact Sidebar</sidebar_name></sidebar_settings>";videogo_save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}
		}
		/* Custom background Support */
		$args = array(
			'default-color'          => '',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);
		/* Custom Header Support */
		$defaults = array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 950,
			'height'                 => 200,
			'flex-height'            => false,
			'flex-width'             => false,
			'default-text-color'     => '',
			'header-text'            => true,
			'uploads'                => true,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		
		global $wp_version;
		
		if ( version_compare( $wp_version, '3.4', '>=' ) ){ 
			add_theme_support( 'custom-background', $args );
			add_theme_support( 'custom-header', $defaults );
		}
class videogo_Menu_Walker_Ext extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\" role=\"menu\">\n";
  }
// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
  
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
  
    // build html  
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="dropdown-toggle ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
	
	$item_output = '';
	
	if($depth == 0){
  
    $item_output .= sprintf( '%1$s<a aria-expanded="false" role="button" data-toggle="dropdown" %2$s>%3$s%4$s%5$s<span class="caret"></span></a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
	} else {
		
    $item_output .= sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
		
		}
  
    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}  
}