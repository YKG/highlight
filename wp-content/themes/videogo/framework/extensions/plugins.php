<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Video Go
 * @version	   2.5.2
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'videogo_my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function videogo_my_theme_register_required_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
            'name'      => esc_html__('Wordpress Importer','videogo'),       
            'slug'      => 'wordpress-importer',
            'required'  => true,
			'force_activation' => true,
        ),
		array(
            'name'      => esc_html__('WooCommerce Shopping','videogo'),
            'slug'      => 'woocommerce',
            'required'  => false,
        ),
		array(
            'name'      => esc_html__('Frontend Uploader','videogo'), 
            'slug'      => 'frontend-uploader',
            'required'  => false,
        ),
		array(
            'name'      => esc_html__('contact-form7','videogo'),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
		array(
            'name'      => esc_html__('a3 Lazy Load','videogo'),
            'slug'      => 'a3-lazy-load',
            'required'  => false,
        ),
		array(
            'name'      => esc_html__('Widgets Importer And Exporter','videogo'),
            'slug'      => 'widget-importer-exporter',
            'required'  => true,
			'force_activation' => true,
        ),
	
		array(
			'name'     				=> esc_html__('Mega Menu','videogo'), // The plugin name
			'slug'     				=> 'mega_main_menu', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/framework/extensions/plugins/mega_main_menu.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> esc_html__('WPBakery Visual Composer','videogo'), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> 'http://crunchpress.com/pre-package/videogo/js_composer.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> esc_html__('CrunchPress Framework','videogo'), // The plugin name
			'slug'     				=> 'cp-framework', // The plugin slug (typically the folder name)			
			'source'   				=> get_stylesheet_directory() . '/framework/extensions/plugins/cp-framework.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> esc_html__('CrunchPress VC Addons','videogo'), // The plugin name
			'slug'     				=> 'videogo-vc-modules', // The plugin slug (typically the folder name)			
			'source'   				=> get_stylesheet_directory() . '/framework/extensions/plugins/videogo-vc-modules.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
	);
	
	/* Change this to your theme text domain, used for internationalising strings */
	$theme_text_domain = 'videogo';
	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'videogo',         		// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'videogo' ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'videogo' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'videogo' ),
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'videogo' ),
			'notice_can_install_required'     			=> _n_noop( esc_html__('This theme requires the following plugin: %1$s.', 'videogo'), esc_html__('This theme requires the following plugins: %1$s.', 'videogo' )),
			'notice_can_install_recommended'			=> _n_noop( esc_html__('This theme recommends the following plugin: %1$s.', 'videogo'), esc_html__('This theme recommends the following plugins: %1$s.', 'videogo' )),
			'notice_cannot_install'  					=> _n_noop( esc_html__('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'videogo'), esc_html__('Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'videogo' )), 
			'notice_can_activate_required'    			=> _n_noop( esc_html__('The following required plugin is currently inactive: %1$s.', 'videogo'), esc_html__('The following required plugins are currently inactive: %1$s.', 'videogo' )),
			'notice_can_activate_recommended'			=> _n_noop( esc_html__('The following recommended plugin is currently inactive: %1$s.', 'videogo'), esc_html__('The following recommended plugins are currently inactive: %1$s.', 'videogo' )),
			'notice_cannot_activate' 					=> _n_noop( esc_html__('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'videogo'), esc_html__('Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'videogo' )), 
			'notice_ask_to_update' 						=> _n_noop( esc_html__('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'videogo'), esc_html__('The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'videogo' )),
			'notice_cannot_update' 						=> _n_noop( esc_html__('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'videogo'), esc_html__('Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'videogo' )), 
			'install_link' 					  			=> _n_noop( esc_html__('Begin installing plugin', 'videogo'), esc_html__('Begin installing plugins', 'videogo' )),
			'activate_link' 				  			=> _n_noop( esc_html__('Activate installed plugin', 'videogo'), esc_html__('Activate installed plugins', 'videogo' )),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'videogo' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'videogo' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'videogo' ),
			'nag_type'									=> 'updated' 
		)
	);
	tgmpa( $plugins, $config );
}