<?php 
	
	/*	
	*	CrunchPress Functions.php
	*	---------------------------------------------------------------------
	* 	@ version	1.0
	*   @ Package   Video Go
	* 	@ author	CrunchPress
	* 	@ link		http://crunchpress.com
	* 	@ copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all important functions and features of the theme.
	*	---------------------------------------------------------------------
	*/	
	
	
					/************** Frequently Used Image Sizes In The Theme *************/
					
	
	add_image_size('videogo_featured_image',845,320, true); 	/* Blog Featured Image (1) */ 
	add_image_size('videogo_banner_large',1800,595, true);		/* Slider Banner (2) */
	add_image_size('videogo_banner_small',900,595, true); 		/* Inner Pages Banner (3) */
	add_image_size('videogo_product',263,500, true); 			/* Products Image (4) */	
	add_image_size('videogo_category_large',457, 337, true); 	/* Video Categories Large (5) */
	add_image_size('videogo_category_small',260, 285, true);	/* Video Categories Small (6) */
	
	
					/************** Defined For the Theme  *************/
	
	if(!defined( 'VIDEOGO_PATH_URL' )){ define('VIDEOGO_PATH_URL', trailingslashit(get_template_directory_uri()));}  	 /* logical location for CP framework */
	
	if(!defined( 'VIDEOGO_PATH_SER' )){define('VIDEOGO_PATH_SER', get_template_directory() );}      	 /* Physical location for CP framework */  
	if(!defined( 'VIDEOGO_FW' )){define( 'VIDEOGO_FW', VIDEOGO_PATH_SER . '/framework' );}			 /* Define server path of framework directory */   
	
	if(!defined( 'AJAX_URL' )){define('AJAX_URL', admin_url( 'admin-ajax.php' ));} 					 		 /* Define admin url */
	// Define ratify path of theme             
	if(!defined( 'VIDEOGO_RATIFY_URL' )){define( 'VIDEOGO_RATIFY_URL', 'http://themeink.com/ratify/videogo/V0RolLUzVuY2hwLXtd.php' );}
	// Define changelog path of theme             
	if(!defined( 'VIDEOGO_CHANGELOG_URL' )){define( 'VIDEOGO_CHANGELOG_URL', 'http://themeink.com/ratify/videogo/changelog-videogo.txt' );}
							/************** SSL Checks *************/
	
		if ( is_ssl() ) {
		
			define('VIDEOGO_HTTP', 'https://');
			
		}else{
		
			define('VIDEOGO_HTTP', 'http://');
			
		}
						/************** File Path If Needed For Child Theme  *************/
						
		if( !function_exists('get_root_directory') ){                               /* Get file path ( to support child theme ) */
			
			function get_root_directory( $path ){
			
				if( file_exists( get_stylesheet_directory() . '/' . $path ) ){
				
					return get_stylesheet_directory() . '/';
					
				}else{
				
					return get_stylesheet_directory() . '/';
				}
			}
		}
					/************** include essential files to enhance framework functionality *************/
					
					
		include_once(VIDEOGO_FW.	'/script_handler.php');							/* It includes all javacript and style in theme */
		include_once(VIDEOGO_FW.	'/extensions/super_object.php'); 				/* Super object function */
		include_once(VIDEOGO_FW.	'/videogo_functions.php'); 					/* Registered CP framework functions */
		
	
					/************** Theme and Framework Essential Files ************************/ 
					
		
		include_once(VIDEOGO_FW.	'/videogo_option.php');							/* CP framework control panel */
		include_once(VIDEOGO_FW.	'/videogo_options_typography.php');				/* CP Typography control panel */
		include_once(VIDEOGO_FW.	'/videogo_options_slider.php');					/* CP Slider control panel */
		include_once(VIDEOGO_FW.	'/videogo_options_social.php');					/* CP Social Sharing */
		include_once(VIDEOGO_FW.	'/videogo_options_sidebar.php');					/* CP Sidebar Option Page */
		include_once(VIDEOGO_FW.	'/videogo_options_default_pages.php');			/* CP Default Options control panel */
		include_once(VIDEOGO_FW.	'/videogo_options_newsletter.php');				/* CP Newsletter control panel */
		include_once(VIDEOGO_FW.	'/videogo_dummy_data_import.php');				/* CP Dummy Data control panel */
	
		/* Backend or Dashboard Options */
		include_once(VIDEOGO_FW. '/options/meta_template.php'); 						/* templates for post portfolio and gallery */
		include_once(VIDEOGO_FW. '/options/post_option.php');						/* Register meta fields for post_type */
		include_once(VIDEOGO_FW. '/options/page_option.php'); 						/* Register meta fields page post_type */
		include_once(VIDEOGO_FW. '/extensions/videogo_resizer.php'); 						/* Resizing of images */
		include_once(VIDEOGO_FW. '/options/product_option.php');						/* WooCommerce Elements */
	
	
					/************** Widgets Included In The Theme ************************/ 
	
		
		include_once(VIDEOGO_FW. '/extensions/widgets/videogo_footer_widget.php'); 				/* Footer Widget */
		include_once(VIDEOGO_FW. '/extensions/widgets/videogo_ad_image_widget.php'); 			/* Custom Advertisement image Widget */
		include_once(VIDEOGO_FW. '/extensions/widgets/videogo_magazine_widget.php'); 			/* Custom Magazine of month Widget */
		include_once(VIDEOGO_FW. '/extensions/widgets/videogo_popular_posts_widget.php'); 		/* Custom Popular Posts */
		include_once(VIDEOGO_FW. '/extensions/widgets/videogo_facebook_widget.php'); 			/* Custom Facebook Widget */
		include_once(VIDEOGO_FW. '/extensions/widgets/videogo_newsletter_widget.php'); 			/* Custom NewsLetter */
		include_once(VIDEOGO_FW. '/extensions/widgets/videogo_category_listing_widget.php'); 	/* Custom Category Listing Widget */
		include_once(VIDEOGO_FW. '/extensions/ratify.php'); 									/* Ratification of theme */
		include_once(VIDEOGO_FW. '/extensions/videogo_theme_info.php'); 						/* Theme info options */	
				
					/************** Plugins and Contact Files ************************/ 
	
					
		if(!is_admin()){
			
			include_once(VIDEOGO_FW. '/extensions/sliders.php');	                            /* Functions to print sliders */
			include_once(VIDEOGO_FW. '/options/page_elements.php');	                        /* Organize page item element */
			include_once(VIDEOGO_FW. '/options/blog_elements.php');							/* Organize blog item element */
			include_once(VIDEOGO_FW. '/extensions/comment.php'); 							/* function to get list of comment */
			include_once(VIDEOGO_FW. '/extensions/pagination.php'); 							/* Register pagination plugin */
			include_once(VIDEOGO_FW. '/extensions/social_shares.php'); 						/* Register social shares  */
			include_once(VIDEOGO_FW.	'/extensions/loadstyle.php');                  			/* Register videogo_breadcrumbs navigation */
			include_once(VIDEOGO_FW.	'/extensions/videogo_breadcrumbs.php');                 		/* Register videogo_breadcrumbs navigation */
			include_once(VIDEOGO_FW.	'/extensions/featured_content.php');                 	/* Register Feature content */
			include_once(VIDEOGO_FW. '/extensions/videogo_headers.php'); 					/* Registered CP Header style */
			include_once(VIDEOGO_FW. '/extensions/videogo_footers.php'); 					/* Registered CP Header style */
		
		}
	
				
				
				/************** Fetch Values From Theme Panel  **************************/ 
		function videogo_get_themeoption_value($videogo_para_val='',$videogo_get_option=''){
		
			/* Fetch Data From Theme Options */
			$videogo_general_settings = get_option($videogo_get_option);
			
			if($videogo_general_settings <> ''){
			
				$videogo_logo = new DOMDocument ();
				
				$videogo_logo->loadXML ( $videogo_general_settings );
				
				return videogo_find_xml_value($videogo_logo->documentElement,$videogo_para_val);
				
			}else{
			
				return $videogo_para_val;
			}
		
		}
		
		
		/* 
			* ThemeForest Recommendation
			* "after_setup_theme" hook added
			* Calling required files/functions through setup function
			* Intialize Custom Functions On Theme Setup
		*/
		
		add_action( 'after_setup_theme', 'videogo_theme_setup' );
		function videogo_theme_setup() {
			/* Decalare WooCommerce Support */
			add_theme_support( 'woocommerce' );
			
			add_action('woocommerce_before_main_content', 'videogo_my_theme_wrapper_start', 10);
		
			add_action('woocommerce_after_main_content', 'videogo_my_theme_wrapper_end', 10);
		
			add_action('woocommerce_before_main_content', 'videogo_woocommerce_remove_breadcrumb');
		
			add_action( 'woo_custom_breadcrumb', 'videogo_woocommerce_custom_breadcrumb' );	
			
			
			/* Filter Required */
			add_filter( 'wpcf7_support_html5_fallback', '__return_true' ); 
			
			/* Theme Customize Class Hooks */
		
			add_action( 'customize_register' , array( 'videogo_MyTheme_Customize' , 'videogo_register' ) );
			
			add_action( 'wp_head' , array( 'videogo_MyTheme_Customize' , 'videogo_header_output' ) );
			
			add_action( 'customize_preview_init' , array( 'videogo_MyTheme_Customize' , 'videogo_live_preview' ) );
			
			
			/* Custom Featured Content */
			
			add_theme_support( 'featured-content', array(
				
				'featured_content_filter' => 'videogo_get_featured_posts',
				
				'max_posts' => 6,
				
				) 
			);
			
			/* User Contact Methods */
			add_filter('user_contactmethods', 'videogo_modify_contact_methods');
			
			/* Remove issues with prefetching adding extra views */
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
			
			/* Register your custom function to override some LayerSlider data */
			add_action('layerslider_ready', 'videogo_my_layerslider_overrides');
			
			/* Maintenance Mode Admin Notice */
			$videogo_maintenance_mode_swtich = videogo_get_themeoption_value('videogo_maintenance_mode_swtich','general_settings');
			
			if($videogo_maintenance_mode_swtich == 'enable'){
				
				add_action( 'admin_notices', 'videogo_admin_notice_maintenance_mode' );
			
			}
			
			/* Theme Dummy Installation */
			add_action('wp_ajax_videogo_themeple_ajax_dummy_data', 'videogo_themeple_ajax_dummy_data');
			
			/* Dummy Importer */
			add_action('wp_ajax_cp_dummy_import', 'videogo_dummy_import');
			
			/* Dequeue LayerSlider Fonts */
			add_action( 'wp_enqueue_scripts', 'videogo_wpse_dequeue_google_fonts', 10 );
			
			videogo_ratification();
			
		}
			
	
				/**************  Custom Function to Show Custom Posts Archive via Default Archives Page  **************************/ 
	
		
		function videogo_namespace_add_custom_types( $videogo_query ) {
		
			if( is_category() || is_tag() || is_author() || is_date() && empty( $videogo_query->query_vars['suppress_filters'] ) ) {
			  
				$videogo_query->set( 'post_type', array(
				
				 'post', 'nav_menu_item', 'practice', 'award', 'event'
				
				));
				  
				  return $videogo_query;
			}
		}
		
		add_filter( 'pre_get_posts', 'videogo_namespace_add_custom_types' );
		
		
				/**************  Declare WooCommerce Support  **************************/ 
				
		function videogo_my_theme_wrapper_start() {
			$videogo_select_layout = '';	
			$videogo_general_settings = get_option('general_settings');
			
			if($videogo_general_settings <> ''){
				$videogo_logo = new DOMDocument ();
				$videogo_logo->loadXML ( $videogo_general_settings );
				$videogo_select_layout = videogo_find_xml_value($videogo_logo->documentElement,'videogo_select_layout_cp');
				
			}
			/* videogo_breadcrumbs Option */
			$videogo_breadcrumbs = '';
			$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
			
			?>
			
			<div class="contant">
			<!--INNER HEADER -->		
				<div class="cp-inner-main-banner top-banner-bg1">
					<div class="container">
						<div class="inner-title">
							<?php if($videogo_breadcrumbs == 'enable'){?>
								<h1><?php if(is_single()){ echo esc_attr(get_the_title());}else{ woocommerce_page_title();};?></h1>
								<h5><?php esc_html_e('WooCommerce','videogo');?></h5>
							<?php } ?>
						</div>
						<div class="col-lg-12 col-md-12">
							 <?php echo do_action('woo_custom_breadcrumb');?>
						</div>
					</div>	
				</div>
			</div>		
			<!-- INNER HEADER ENDS -->	
			<section class="container" id="main-woo">	
			
		<?php } /* Function ends */
		  
		function videogo_my_theme_wrapper_end() {
			
			echo '</section></div></div>';
		}
	
		/*  Reposition WooCommerce breadcrumb */
		function videogo_woocommerce_remove_breadcrumb(){
			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
		}
		/*  Custom WooCommerce breadcrumb */
		function videogo_woocommerce_custom_breadcrumb(){
			woocommerce_breadcrumb();
		}
	
		/* Theme Dummy Installation Function */
		function videogo_themeple_ajax_dummy_data(){
			require_once VIDEOGO_FW . '/extensions/importer/dummy_data.inc.php';
			die('themeple_dummy');
		}
	
	
		/* Theme Dummy Data Installation */
		function videogo_dummy_import(){
			foreach ($_REQUEST as $keys=>$values) {
				$$keys = trim($values);
			}
			$videogo_layout = $layout;
			if(wp_verify_nonce( $videogo_nonce_dummy, 'videogo_nonce_dummy' )){
				require_once VIDEOGO_FW . '/extensions/importer/dummy_data.inc.php';
				die('dummy_import');
			}else{
				die('Not Loaded');
			}
		}
	
	/*
		* Contains methods for customizing the theme customization screen.
		* @link http://codex.wordpress.org/Theme_Customization_API
		* @since MyTheme 1.0
	*/
	class videogo_MyTheme_Customize {
		/*
			* This hooks into 'customize_register' (available as of WP 3.4) and allows
			* you to add new sections and controls to the Theme Customize screen.
			* Note: To enable instant preview, we have to actually write a bit of custom
			* javascript. See live_preview() for more.
			* @see add_action('customize_register',$func)
			* @param \WP_Customize_Manager $wp_customize
			* @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
			* @since MyTheme 1.0
		*/
	  
	  public static function videogo_register ( $wp_customize ) {
			/* 1. Define a new section (if desired) to the Theme Customizer */
			$wp_customize->add_section( 'mytheme_options', 
				array(
					'title' => esc_html__( 'MyTheme Options', 'videogo' ), //Visible title of section
					'priority' => 35, /* Determines what order this appears in */
					'capability' => 'edit_theme_options', /* Capability needed to tweak */
					'description' => esc_html__('Allows you to customize some example settings for crunchpress.', 'videogo'), /* Descriptive tooltip */
				) 
			);
		  
		  /* 2. Register new settings to the WP database... */
		  $wp_customize->add_setting( 'mytheme_options[link_textcolor]', /* Give it a SERIALIZED name (so all theme settings can live under one db record) */
			 array(
				'default' => '#2BA6CB', /* Default setting/value to save */
				'type' => 'option', /* Is this an 'option' or a 'theme_mod'? */
				'capability' => 'edit_theme_options', /* Optional. Special permissions for accessing this setting. */
				'transport' => 'postMessage', /* What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)? */
				'sanitize_callback' => 'esc_attr',
			 ) 
		  );      
				
		  /* 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)... */
		  $wp_customize->add_control( new WP_Customize_Color_Control( /* Instantiate the color control class */
			 $wp_customize, /* Pass the $wp_customize object (required) */
			 'mytheme_link_textcolor', /* Set a unique ID for the control */
			 array(
				'label' => esc_html__( 'Link Color & Button Color', 'videogo' ), /* Admin-visible name of the control */
				'section' => 'colors', /* ID of the section this control should render in (can be one of yours, or a WordPress default section) */
				'settings' => 'mytheme_options[link_textcolor]', /* Which setting to load and manipulate (serialized is okay) */
				'priority' => 10, /* Determines the order this control appears in for the specified section */
			 ) 
		  ) );
		  
		  
		  /* 4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS... */
		  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		  $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	   }
	   /*
		* This will output the custom WordPress settings to the live theme's WP head.
		* 
		* Used by hook: 'wp_head'
		* 
		* @see add_action('wp_head',$func)
		* @since MyTheme 1.0
		*/
	   public static function videogo_header_output() {
	   }
	   
	   /**
		* This outputs the javascript needed to automate the live settings preview.
		* Also keep in mind that this function isn't necessary unless your settings 
		* are using 'transport'=>'postMessage' instead of the default 'transport'
		* => 'refresh'
		* 
		* Used by hook: 'customize_preview_init'
		* 
		* @see add_action('customize_preview_init',$func)
		* @since MyTheme 1.0
		*/
	   public static function videogo_live_preview() {
		  wp_enqueue_script( 
			   'mytheme-themecustomizer', // Give the script a unique ID
			   get_template_directory_uri() . '/frontend/js/theme-customizer.js', // Define the path to the JS file
			   array(  'jquery', 'customize-preview' ), // Define dependencies
			   '', // Define a version (optional) 
			   true // Specify whether to put in footer (leave this true)
		  );
	   }
		/**
		 * This will generate a line of CSS for use in header output. If the setting
		 * ($mod_name) has no defined value, the CSS will not be output.
		 * 
		 * @uses get_theme_mod()
		 * @param string $selector CSS selector
		 * @param string $style The name of the CSS *property* to modify
		 * @param string $mod_name The name of the 'theme_mod' option to fetch
		 * @param string $prefix Optional. Anything that needs to be output before the CSS property
		 * @param string $postfix Optional. Anything that needs to be output after the CSS property
		 * @param bool $echo Optional. Whether to print directly to the page (default: true).
		 * @return string Returns a single line of CSS with selectors and a property.
		 * @since MyTheme 1.0
		 */
		public static function videogo_generate_css( $videogo_selector, $videogo_style, $videogo_mod_name, $videogo_prefix='', $videogo_postfix='', $videogo_echo=true ) {
		  $videogo_return = '';
		  $videogo_mod = get_theme_mod($videogo_mod_name);
		  if ( ! empty( $videogo_mod ) ) {
			 $videogo_return = sprintf('%s { %s:%s; }',
				$videogo_selector,
				$videogo_style,
				$videogo_prefix.$videogo_mod.$videogo_postfix
			 );
			 if ( $videogo_echo ) {
				echo esc_attr($videogo_return);
			 }
		  }
		  return $videogo_return;
		}
	}
	/* Add Custom Field to user profile */
	function videogo_modify_contact_methods($videogo_profile_fields) {
		/* Add new fields */
		
		$videogo_profile_fields['twitter'] = 'Twitter URL';
		$videogo_profile_fields['facebook'] = 'Facebook URL';
		$videogo_profile_fields['gplus'] = 'Google+ URL';
		$videogo_profile_fields['linked'] = 'Linked in URL';
		$videogo_profile_fields['skype'] = 'Skype ID';
		
		return $videogo_profile_fields;
	}
	
	/* Feature Post function */
	function videogo_get_featured_posts() {
		
		return apply_filters( 'videogo_get_featured_posts', array() );
	
	}
	
	/* Feature Post function For Material Mag*/
	function videogo_has_featured_posts() {
	
		return ! is_paged() && (bool) videogo_get_featured_posts();
	
	}
    
	function videogo_my_layerslider_overrides() {
 
        /* Disable auto-updates for LayerSlider */
        $GLOBALS['lsAutoUpdateBox'] = false;
    
	}
	
	/* Admin Dashboard Notice HTML */
	function videogo_admin_notice_framework() { ?>
		
		<div class="updated">
			
			<p><strong><?php esc_html_e( 'Please install theme required plug-ins to use all functionalities of theme', 'videogo' ); ?></strong> - <?php esc_html_e('in case of deactivating the theme required plug-ins you may not able to use theme extra functionality.','videogo');?></p>
		
		</div>
		
		<?php
	}
	
	/* DeQueue LayerSlider Fonts */
	function videogo_wpse_dequeue_google_fonts() {
		
		wp_dequeue_style( 'ls-google-fonts' );
	}
function videogo_update_notice_arr( $msg = '', $args = array() ) {
      if ( is_array( $msg ) ) {
        $args = $msg;
      }
      $args = wp_parse_args( $args, array(
        'message'     => is_string( $msg ) ? $msg : '',
        'handle'      => false,
        'echo'        => true,
        'class'       => '',
        'dismissible'  => false,
        'ajax_dismiss' => false
      ) );
      extract( $args );
      $script = '';
      if ( is_string( $ajax_dismiss ) ) {
        if ( ! $handle ) {
          $handle = 'tco_' . uniqid();
        }
        ob_start(); 
		
function videogo_admin_ratify_inline_js(){
	echo "<script type='text/javascript'>\n";
	echo "jQuery( function( $ ) {
          $('[data-tco-notice=".$handle."]').on( 'click', '.tud-notice-dismiss', function(){
            $.post('".admin_url('admin-ajax.php?action=' . esc_attr( $ajax_dismiss ) )."');
          });
        } );";
	echo "\n</script>";
}
add_action( 'admin_print_scripts', 'videogo_admin_ratify_inline_js' );		
		
        $script = ob_get_clean();
      }
      $class = ( $dismissible ) ? ' ' . $class . ' is-dismissible' : ' ' . $class;
      $logo_svg = '<img src="'.VIDEOGO_PATH_URL.'/images/cp_logo.jpg" alt="cp-logo" >';
      $logo = "<a class=\"tco-notice-logo\" href=\"https://theme.co/\" target=\"_blank\">{$logo_svg}</a>";
      if ( $handle ) {
      $handle = "data-tco-notice=\"$handle\"";
      }
      $notice = "<div class=\"tud-notice notice notice-success {$class}\" {$handle}>{$logo}<p>{$message}</p></div>{$script}";
      if ( $echo ) {
        echo ($notice);
      }
      return $notice;
    }
function videogo_getPostViews($videogo_postID){
    $videogo_count_key = 'post_views_count';
    $videogo_count = get_post_meta($videogo_postID, $videogo_count_key, true);
    if($videogo_count==''){
        delete_post_meta($videogo_postID, $videogo_count_key);
        add_post_meta($videogo_postID, $videogo_count_key, '0');
        return "浏览 0";
    }
    return '浏览 ' . $videogo_count;
}
function videogo_setPostViews($videogo_postID) {
    $videogo_count_key = 'post_views_count';
    $videogo_count = get_post_meta($videogo_postID, $videogo_count_key, true);
    if($videogo_count==''){
        $videogo_count = 0;
        delete_post_meta($videogo_postID, $videogo_count_key);
        add_post_meta($videogo_postID, $videogo_count_key, '0');
    }else{
        $videogo_count++;
        update_post_meta($videogo_postID, $videogo_count_key, $videogo_count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
function videogo_update_notice() {
    videogo_update_notice_arr( array(
      'message' => sprintf( esc_html__( 'There is an <strong>update</strong> available for This Theme.<a href="%s">Dismiss this notice</a>', 'videogo' ), videogo_get_home_link() ),
      'dismissible' => true,
      'ajax_dismiss' => 'videogo_dismiss_theme_update_notice'
    ) );
}
add_action('wp_ajax_videogo_dismiss_theme_update_notice','videogo_dismiss_update_notice_func');
function videogo_dismiss_update_notice_func() { 
    delete_option( 'videogo_dismiss_update_notice' );
    wp_send_json_success(); 
  }
  
function videogo_change_submenu_class($menu) {  
  $menu = preg_replace('/ class="sub-menu"/','/ class="drop-down one-column hover-expand" /',$menu);  
  return $menu;  
}  
add_filter('wp_nav_menu','videogo_change_submenu_class');   
function videogo_get_avatar_url($videogo_get_avatar){
    preg_match("/src='(.*?)'/i", $videogo_get_avatar, $videogo_matches);
    return $videogo_matches[1];
}
function videogo_comment($comment, $args, $depth) {
	
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <?php if ( 'div' != $args['style'] ) : ?>
        <li><div id="div-comment-<?php comment_ID() ?>" class="cp-author-info-holder">
    <?php endif; ?>
    <div class="cp-thumb">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 95 ); ?>
    </div>    
<div class="cp-text">
        <?php echo '<h4>'; printf( esc_html( '%s','videogo' ), get_comment_author_link() ); echo '</h4>'; ?>
    
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','videogo' ); ?></em>
          <br />
    <?php endif; ?>
<ul class="cp-meta-list">
	<li>
        <?php
        /* translators: 1: date, 2: time */
        printf( esc_html('%1$s at %2$s','videogo'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( esc_html( '(Edit)','videogo' ), '  ', '' );
        ?>
    </li>
</ul>    
    <?php comment_text(); ?>
    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
</div>
    <?php
}
function videogo_header_video_scripts() {
    if ( is_admin() ) {
        return;
    }
    if (is_page()) { 
		wp_enqueue_style('videogo-video-player',VIDEOGO_PATH_URL.'/frontend/css/video-player.css');
		wp_enqueue_script('videogo-js-video-player', VIDEOGO_PATH_URL.'/frontend/js/video-player.js', false, '1.0', true);
    }
} 
add_action( 'wp_print_scripts', 'videogo_header_video_scripts' );