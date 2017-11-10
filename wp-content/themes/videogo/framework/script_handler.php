<?php
	/*	
	*	CrunchPress Include Script File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   Video Go
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file manage to embed the stylesheet and javascript to each page
	*	based on the content of that page.
	*	---------------------------------------------------------------------
	*/
	
	/* Add Scripts To Theme */
	if(is_admin()){
		add_action('admin_enqueue_scripts', 'videogo_register_meta_script');
		add_action('admin_enqueue_scripts','videogo_register_crunchpress_panel_scripts');
		add_action('admin_enqueue_scripts','videogo_register_crunchpress_panel_styles');
	}else{
		add_action('wp_enqueue_scripts','videogo_register_non_admin_styles');
		add_action('wp_enqueue_scripts','videogo_register_non_admin_scripts');
	}
	
	/* 	---------------------------------------------------------------------
	*	This section include the back-end script
	*	---------------------------------------------------------------------
	*/ 
	
	function videogo_register_meta_script(){
		
		global $post_type;
		
		wp_enqueue_style('bootstrap', VIDEOGO_PATH_URL.'/framework/stylesheet/bootstrap.css');
		wp_enqueue_style('thickbox');
		
		/* Font Awesome */
		wp_enqueue_style('videogo_fontAW',VIDEOGO_PATH_URL.'/frontend/videogo_font/css/font-awesome.css');
		wp_enqueue_style('videogo_fontAW',VIDEOGO_PATH_URL.'/frontend/videogo_font/css/font-awesome-ie7.css');
		wp_enqueue_style('videogo_admin',VIDEOGO_PATH_URL.'/framework/stylesheet/admin-css.css');
		
		/* When Accessing Page */
		if( $post_type == 'page' ){
			/* CSS */
			wp_enqueue_style('videogo_meta',VIDEOGO_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('videogo_page-dragging',VIDEOGO_PATH_URL.'/framework/stylesheet/page-dragging.css');
			wp_enqueue_style('videogo_image-picker',VIDEOGO_PATH_URL.'/framework/stylesheet/image-picker.css');
			/* JS */
			wp_enqueue_script( 'videogo_image-picker', VIDEOGO_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_enqueue_script( 'videogo_page-dragging', VIDEOGO_PATH_URL.'/framework/javascript/page-dragging.js', false, '1.0', true);
			wp_enqueue_script( 'videogo_edit-box', VIDEOGO_PATH_URL.'/framework/javascript/edit-box.js', false, '1.0', true);
			wp_enqueue_script( 'videogo_confirm-dialog', VIDEOGO_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			
		/* Enqueues For Post-Type */
		}else if( $post_type == 'event' || $post_type == 'post' || $post_type == 'videogo_slider' || $post_type == 'team'  || $post_type == 'portfolio' || $post_type == 'gallery' || $post_type == 'product' ){
			/* CSS */
			wp_deregister_style('videogo_admin');
			wp_enqueue_style('videogo_meta',VIDEOGO_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('videogo_image-picker',VIDEOGO_PATH_URL.'/framework/stylesheet/image-picker.css');
			wp_enqueue_style('videogo_confirm-dialog',VIDEOGO_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
			/* JS */
			wp_enqueue_script( 'videogo_post-effects', VIDEOGO_PATH_URL.'/framework/javascript/post-effects.js', false, '1.0', true);
			wp_enqueue_script( 'videogo_image-picker', VIDEOGO_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_localize_script('videogo_image-picker', 'URL', array('videogo' => VIDEOGO_PATH_URL ));
			wp_enqueue_script( 'videogo_confirm-dialog', VIDEOGO_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
		
			
		}
		
	}
	
	
	/* Scripts For CrunchPress Panel */
	function videogo_register_crunchpress_panel_scripts(){
		
		global $post_type;
		
		/* On Page */
		if($post_type == 'page'){
		
		}else{
			wp_enqueue_style('videogo_bootstrap',VIDEOGO_PATH_URL.'/framework/stylesheet/bootstrap.css');
			$videogo_script_url = VIDEOGO_PATH_URL.'/framework/javascript/cp-panel.js';
			wp_enqueue_script('videogo_scripts_admin', $videogo_script_url, array('jquery','media-upload','videogo_bootstrap','thickbox', 'jquery-ui-droppable','jquery-ui-datepicker','jquery-ui-tabs', 'jquery-ui-slider','videogo_jquery-timepicker','jquery-ui-position','videogo_mini-color','videogo_confirm-dialog','videogo_dummy_content'));
	
			wp_enqueue_script( 'videogo_bootstrap', VIDEOGO_PATH_URL.'/framework/javascript/bootstrap.js', false, '1.0', true);
			/* Font Awesome */
			wp_enqueue_style('videogo_fontAW',VIDEOGO_PATH_URL.'/frontend/videogo_font/css/font-awesome.css');
			wp_enqueue_style('videogo_fontAW',VIDEOGO_PATH_URL.'/frontend/videogo_font/css/font-awesome-ie7.css');
		
			/* JS */
			wp_enqueue_script('videogo_mini-color', VIDEOGO_PATH_URL.'/framework/javascript/jquery.miniColors.js', false, '1.0', true);
			wp_enqueue_script('videogo_confirm-dialog', VIDEOGO_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('videogo_jquery-timepicker', VIDEOGO_PATH_URL.'/framework/javascript/jquery.ui.timepicker.js', false, '1.0', true);
			wp_enqueue_script('videogo_dummy_content', VIDEOGO_PATH_URL.'/framework/javascript/dummy_content.js', false, '1.0', true);
		}		
	}
	// register style in CrunchPress panel
	function videogo_register_crunchpress_panel_styles(){
	
		wp_enqueue_style('videogo_jquery-ui',VIDEOGO_PATH_URL.'/framework/stylesheet/jquery-ui.css');
		wp_enqueue_style('videogo_panel',VIDEOGO_PATH_URL.'/framework/stylesheet/cp-panel.css');
		wp_enqueue_style('videogo_mini-color',VIDEOGO_PATH_URL.'/framework/stylesheet/jquery.miniColors.css');
		wp_enqueue_style('videogo_confirm-dialog',VIDEOGO_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
		wp_enqueue_style('videogo_jquery-timepicker',VIDEOGO_PATH_URL.'/framework/stylesheet/jquery.ui.timepicker.css');
		
	}
	
	/* 	---------------------------------------------------------------------
	*	this section include the front-end script
	*	---------------------------------------------------------------------
	*/ 
	
	/* Enqueue Your Scripts & Stylesheets  (This will appear on all pages)*/
	function videogo_register_non_admin_styles(){
	
		$videogo_page_xml = '';
		$videogo_slider_type = '';
	
		global $post,$post_id,$videogo_page_xml,$videogo_slider_type,$all_font; 
		
		$videogo_page_xml = get_post_meta($post_id,'page-option-item-xml', true);
		$videogo_slider_type = get_post_meta ( $post_id, "page-option-top-slider-types", true );
		
		/* Default Stylesheet */
		wp_enqueue_style( 'videogo-default-style', get_stylesheet_uri() );  
		
		/* Widgets CSS */
		wp_enqueue_style('videogo_widgets',VIDEOGO_PATH_URL.'/frontend/css/videogo_widgets.css');
		
		
		/* Responsive CSS */
		wp_enqueue_style('videogo_responsive',VIDEOGO_PATH_URL.'/frontend/css/responsive.css');
		
		
		/* Owl Scripts */
		wp_enqueue_script( 'videogo_owl-js', VIDEOGO_PATH_URL.'/frontend/js/owl.carousel.min.js', false, '1.0', true);
		wp_enqueue_style('videogo_owl',VIDEOGO_PATH_URL.'/frontend/css/owl.carousel.css');
		
		
		/* Vector Graphic Css */
		wp_enqueue_style('videogo_svg',VIDEOGO_PATH_URL.'/frontend/css/iconmoon.css');
		
		
		/* Bx Slider Script and CSS file  */
		wp_enqueue_script( 'videogo_bx-slider', VIDEOGO_PATH_URL.'/frontend/js/jquery.bxslider.js', false, '1.0', true);
		wp_enqueue_style('videogo_bx-slider',VIDEOGO_PATH_URL.'/frontend/css/jquery.bxslider.css');
	
		/* Countdown counter Js */
		wp_enqueue_script('videogo_countdown', VIDEOGO_PATH_URL.'/frontend/js/jquery.countdown.js', false, '1.0', true);
		
		/* Custom Js */
		wp_enqueue_script( 'videogo_custom', VIDEOGO_PATH_URL.'/frontend/js/custom.js', false, '1.0', true);
		
		/* Pretty Photo Scripts */
		wp_enqueue_style('videogo_prettyPhoto',VIDEOGO_PATH_URL.'/frontend/css/prettyphoto.css');
		
		wp_enqueue_script( 'videogo_prettyPhoto', VIDEOGO_PATH_URL.'/frontend/js/default/jquery.prettyphoto.js', false, '1.0', true);
		wp_enqueue_script( 'videogo_pscript', VIDEOGO_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
	
		/* Bootstrap Css */
		wp_enqueue_style('videogo_bootstrap',VIDEOGO_PATH_URL.'/frontend/css/bootstrap.css');
		
		
		/* WooCommerce Default CSS */
		wp_enqueue_style('videogo_wp-commerce',VIDEOGO_PATH_URL.'/frontend/css/wp-commerce.css');
		
		/* Font Awesome CSS */
		wp_enqueue_style('videogo_fontAW',VIDEOGO_PATH_URL.'/frontend/videogo_font/css/font-awesome.css');
		wp_enqueue_style('videogo_fontAW',VIDEOGO_PATH_URL.'/frontend/videogo_font/css/font-awesome-ie7.css');
		
		$videogo_rtl_layout = '';
		$videogo_site_loader = '';
		$videogo_element_loader = '';
		//General Settings Values
		$videogo_general_settings = get_option('general_settings');
		if($videogo_general_settings <> ''){
			$videogo_logo = new DOMDocument ();
			$videogo_logo->loadXML ( $videogo_general_settings );
			$videogo_rtl_layout = videogo_find_xml_value($videogo_logo->documentElement,'videogo_rtl_layout');
			$videogo_site_loader = videogo_find_xml_value($videogo_logo->documentElement,'site_loader');
			$videogo_element_loader = videogo_find_xml_value($videogo_logo->documentElement,'element_loader');
		}
		
		/* DeRegister Conflicting Styles */
		wp_deregister_style('woocommerce-general');
		wp_deregister_style('ls-google-fonts');
		wp_deregister_style('woocommerce-layout');
		wp_deregister_style('woocommerce_frontend_styles');		
		wp_deregister_style('events-manager');		
		wp_deregister_style('mm_font-awesome');	
		
		
		//RTL Layouts

		if($videogo_rtl_layout == 'enable'){

			wp_enqueue_style('videogo-rtl',videogo_PATH_URL.'/rtl.css');

		}		
		
		/* Maintenance Page Script */
		$videogo_maintenance_mode_swtich = videogo_get_themeoption_value('videogo_maintenance_mode_swtich','general_settings');				
		if($videogo_maintenance_mode_swtich == 'enable'){		
			wp_enqueue_style('videogo_countdown',VIDEOGO_PATH_URL.'/frontend/css/jquery.countdown.css');
			wp_enqueue_style('videogo_comming_soon_style',VIDEOGO_PATH_URL.'/frontend/css/coming-soon.css');
		}
		
		if( is_search() || is_archive() ){
			/* Yet To Be Implement */
		}else if( isset($post) && $post->post_type == 'post'){ 
			/* Yet To Be Implement */
		}else if( isset($post) && $post->post_type == 'page' ){
			/* Yet To Be Implement */
		}
		
		$videogo_font_google = '';
		$videogo_font_size_normal = '';
		$videogo_menu_font_google = '';
		$videogo_font_google_heading = '';
		$videogo_typography_settings = get_option('typography_settings');
		
		if($videogo_typography_settings <> ''){
			
			$videogo_typo = new DOMDocument ();
			$videogo_typo->loadXML ( $videogo_typography_settings );
			$videogo_font_google = videogo_find_xml_value($videogo_typo->documentElement,'videogo_font_google');
			$videogo_font_size_normal = videogo_find_xml_value($videogo_typo->documentElement,'videogo_font_size_normal');
			$videogo_menu_font_google = videogo_find_xml_value($videogo_typo->documentElement,'videogo_menu_font_google');
			$videogo_font_google_heading = videogo_find_xml_value($videogo_typo->documentElement,'videogo_font_google_heading');
		}
		
		/* Body Font */
		
		if(videogo_get_font_type($videogo_font_google) == 'Google_Font'){
				wp_enqueue_style('googleFonts', videogo_get_google_font_url($videogo_font_google));
		} else{
			/* Adobe Type Kit Font */
			if($videogo_font_google <> ''){
				wp_register_script( 'adobe-edge-font', "http://use.edgefonts.net/".$videogo_font_google.".js", false, '1.0', false);
				wp_enqueue_script('adobe-edge-font');	
			}
		}
		/* Heading Font */
		if(videogo_get_font_type($videogo_font_google_heading) == 'Google_Font'){
			if($videogo_font_google_heading <> ''){				
				wp_enqueue_style('googleFonts-heading', videogo_get_google_font_url($videogo_font_google_heading) );
			}
		}else{
			if($videogo_font_google_heading <> ''){
				wp_enqueue_script( 'adobe-edge-heading', "http://use.edgefonts.net/".$videogo_font_google_heading.".js", false, '1.0', false);
				
			}
		}
		/* Menu Font */
		if(videogo_get_font_type($videogo_menu_font_google) == 'Google_Font'){
			if($videogo_menu_font_google <> ''){
				wp_enqueue_style('menu-googleFonts-heading', videogo_get_google_font_url($videogo_menu_font_google));
			}
		}else{
			if($videogo_menu_font_google <> ''){
				wp_enqueue_script( 'menu-edge-heading', "http://use.edgefonts.net/".$videogo_menu_font_google.".js", false, '1.0', false);
				
			}
		}
		
	}
		 
     
	function videogo_register_non_admin_scripts(){
		global $post,$post_id, $videogo_is_responsive, $crunchpress_element, $wp_scripts;
	
		wp_enqueue_script('jquery');
	
		$videogo_comming_soon_style = videogo_get_themeoption_value('videogo_comming_soon_style','general_settings');	
		$videogo_maintenance_mode_swtich = videogo_get_themeoption_value('videogo_maintenance_mode_swtich','general_settings');				
		if($videogo_maintenance_mode_swtich == 'enable'){
			if($videogo_comming_soon_style == 'Style 1'){			
				wp_enqueue_script('videogo_countdown', VIDEOGO_PATH_URL.'/frontend/js/jquery.countdown.js', false, '1.0', true);
				
			}
		}
		
		//if ( class_exists( 'mega_main_init' ) ) {
			/* Mega Menu CSS */
			wp_enqueue_style('mega-menu',VIDEOGO_PATH_URL.'/frontend/css/mega-menu.css');
			
		//	}
		
		if ( is_singular() && get_option( 'thread_comments' ) ) 	wp_enqueue_script( 'comment-reply' );
		
		/*BootStrap Script Loaded */
		wp_enqueue_script('videogo_bootstrap', VIDEOGO_PATH_URL.'/frontend/js/default/bootstrap.js', array('jquery'), '1.0', true);
		wp_localize_script('videogo_bootstrap', 'ajax_var', array('url' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce('ajax-nonce')));
		
		/* Latest Modernizr */
		wp_enqueue_script('videogo_scripts_modernizr', VIDEOGO_PATH_URL.'/frontend/js/modernizr-latest.js', false, '1.0', true);
		
		/* Custom Script Loaded */
		wp_enqueue_script('videogo_scripts', VIDEOGO_PATH_URL.'/frontend/js/frontend_scripts.js', false, '1.0', true);
		
		/* HTML SHIV */
		global $wp_scripts,$post;
		wp_enqueue_script('videogo_html5shiv',VIDEOGO_PATH_URL.'/frontend/js/html5shive.js',array(),'1.5.1',false);
		$wp_scripts->add_data( 'videogo_html5shiv', 'conditional', 'lt IE 9' );		
					
		/* Search and archive page */
		if( is_search() || is_archive() ){
			
		/* Post post_type */
		}else if(isset($post) &&  $post->post_type == 'event' && !is_home()){
		
			wp_enqueue_script('videogo_countdown', VIDEOGO_PATH_URL.'/frontend/js/default/jquery_countdown.js', false, '1.0', true);
			
		}else if(isset($post) &&  $post->post_type == 'post' && !is_home() ){
		/* Page post_type */
		}else if( isset($post) &&  $post->post_type == 'page' ){
		}
	}
?>