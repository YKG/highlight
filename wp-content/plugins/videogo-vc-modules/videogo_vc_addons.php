<?php

    /*
    Plugin Name: CrunchPress Addons
    Plugin URI: http://www.crunchpress.com
    Description: CrunchPress Addons for Visual Composer
    Author: CrunchPress
    Version: 1.0
    Author URI: http://www.crunchpress.com
    */
	
	//echo site_url();exit;
	
	function cp_addons() {
	}

	register_activation_hook(__FILE__, 'cp_addons');
	
	class CP_VC_Addons{
		var $paths = array();
		var $module_dir;
		var $params_dir;
		var $assets_js;
		var $assets_css;
		var $admin_js;
		var $admin_css;
		var $vc_template_dir;
		var $vc_dest_dir;
		function __construct()
		{
			$this->module_dir = plugin_dir_path( __FILE__ ).'modules/';
			add_action( 'admin_menu', array($this,'register_crunchpress_addons_menu'));
			add_action('after_setup_theme',array($this,'aio_init'));
			add_action( 'init', array($this,'contact_ajax_request') );
		}// end constructor
		
		function register_crunchpress_addons_menu(){
			if(!current_user_can( 'manage_options' ))
				return false;
			global $submenu;
	
		}
		
		function aio_init(){
			// activate addons one by one from modules directory
			$ultimate_modules = get_option('ultimate_modules');
			$ultimate_modules[] = 'ultimate_just_icon';
			$ultimate_modules[] = 'ultimate_functions';
			$ultimate_modules[] = 'ultimate_icon_manager';
			$ultimate_modules[] = 'ultimate_font_manager';
			$ultimate_modules[] = 'videogo_today_best';
			$ultimate_modules[] = 'videogo_blog';
			$ultimate_modules[] = 'videogo_sponser';
			$ultimate_modules[] = 'videogo_contact_form';
			$ultimate_modules[] = 'videogo_contact';
			$ultimate_modules[] = 'videogo_coming_soon';
			$ultimate_modules[] = 'videogo_trends';
			$ultimate_modules[] = 'videogo_facts';
			$ultimate_modules[] = 'videogo_ad_bannerz';
			$ultimate_modules[] = 'videogo_products_collection';
			$ultimate_modules[] = 'videogo_tabs';
			$ultimate_modules[] = 'videogo_most_viewed';
			$ultimate_modules[] = 'videogo_videogo';
			$ultimate_modules[] = 'videogo_video_listings';
			$ultimate_modules[] = 'videogo_notfound';
			
			if(get_option('ultimate_row') == "enable")
				$ultimate_modules[] = 'ultimate_parallax';
			
			//echo "<pre>";print_r(glob($this->module_dir."/*.php"));
			
			foreach(glob($this->module_dir."/*.php") as $module)
			{
				
				$ultimate_file = basename($module);
				$ultimate_fileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $ultimate_file);
				
				if(is_array($ultimate_modules) && !empty($ultimate_modules)){ 
				
					if(in_array(strtolower($ultimate_fileName),$ultimate_modules) ){
						//echo $module;
						require_once($module);
					}
				}
			}
			
			if(in_array("woocomposer",$ultimate_modules) ){
				if(defined('WOOCOMMERCE_VERSION'))
				{
					if(version_compare( '2.1.0', WOOCOMMERCE_VERSION, '<' )) {
						foreach(glob(plugin_dir_path( __FILE__ ).'woocomposer/modules/*.php') as $module)
						{
							require_once($module);
						}
					} else {
						//add_action( 'admin_notices', array($this, 'woocomposer_admin_notice_for_woocommerce'));
					}
				} else {
					//add_action( 'admin_notices', array($this, 'woocomposer_admin_notice_for_woocommerce'));
				}
			}
		}
		
		
		
		function contact_ajax_request(){
			//echo "Enter";
			
			if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'display_contact'){
				$name = $_REQUEST['type'];
				$email = $_REQUEST['email'];
				$subject = $_REQUEST['subject'];
				$message = $_REQUEST['message'];
				$email_to = $_REQUEST['email_to'];
				$to = $email_to;
				
				//$headers = array('Content-Type: text/html; charset=UTF-8');				
				$headers = 'From:'.$email ;

				@mail( $to, $subject, $message, $headers); 
				if(@mail( $to, $subject, $message, $headers) )
					{
					  echo "Mail Sent Successfully";
					}else{
					  echo "Mail Not Sent";
					}
									
				die();
			}
		}
		
	}
	
	new CP_VC_Addons;