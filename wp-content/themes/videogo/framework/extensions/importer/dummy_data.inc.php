<?php
/** 
     * @author Roy Stone
     * @copyright roshi[www.themeforest.net/user/crunchpress]
     * @version 2013
     */
if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
require_once ABSPATH . 'wp-admin/includes/import.php';
$import_filepath = get_template_directory()."/framework/extensions/importer/dummy_data";
$errors = false;
if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
	{
		require_once($class_wp_importer);
	}
	else
	{
		$errors = true;
	}
}
if ( !class_exists( 'WP_Import' ) ) {
	$wp_importer = VIDEOGO_FW. '/extensions/importer/wordpress-importer.php';
	if ( file_exists( $wp_importer ) )
	{
		require_once($wp_importer);
	}
	else
	{
		$errors = true;
	}
}
if($errors){
   echo "Errors while loading classes. Please use the standart wordpress importer."; 
}else{
    
    
	include_once('default_dummy_data.inc.php');
	if(!is_file($import_filepath.'_1.xml'))
	{
		echo "Problem with dummy data file. Please check the permisions of the xml file";
	}
	else
	{  
	   if(class_exists( 'WP_Import' )){
	       global $wp_version;
			
			$our_class = new themeple_dummy_data();
			$our_class->fetch_attachments = true;
			$our_class->import($import_filepath.'_1.xml');
		
$widget_archives = array (
  2 => 
  array (
    'title' => 'Archives',
    'count' => 1,
    'dropdown' => 1,
  ),
  3 => 
  array (
    'title' => 'Archives',
    'count' => 1,
    'dropdown' => 1,
  ),
  '_multiwidget' => 1,
);
$widget_recent = false;
$widget_em_widget = array (
  2 => 
  array (
    'title' => 'Events',
    'limit' => '5',
    'scope' => 'future',
    'orderby' => 'event_start_date,event_start_time,event_name',
    'order' => 'ASC',
    'category' => '0',
    'all_events_text' => 'all events',
    'format' => '<li>#_EVENTLINK<ul><li>#_EVENTDATES</li><li>#_LOCATIONTOWN</li></ul></li>',
    'nolistwrap' => false,
    'all_events' => 0,
    'no_events_text' => '<li>No events</li>',
  ),
  '_multiwidget' => 1,
);$widget_facebook_widget = array (
  1 => 
  array (
  ),
  2 => 
  array (
    'title' => 'Facebook Widget',
    'pageurl' => 'http://facebook.com/crunchpress.themes',
    'showfaces' => 'true',
    'showstream' => 'true',
    'showheader' => NULL,
    'likebox_width' => '350',
    'likebox_height' => '350',
  ),
  '_multiwidget' => 1,
);$widget_gallery_image_show = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Gallery Widget',
    'select_gallery' => '474',
    'nofimages' => '9',
    'externallink' => NULL,
  ),
  '_multiwidget' => 1,
);$widget_videogo_newsletter_widget = array (
  2 => 
  array (
    'title' => 'Newsletter',
    'show_name' => NULL,
    'news_letter_des' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
  ),
  '_multiwidget' => 1,
);$widget_categories = array (
  2 => 
  array (
    'title' => '',
    'count' => 0,
    'hierarchical' => 0,
    'dropdown' => 0,
  ),
  3 => 
  array (
    'title' => 'Categories',
    'count' => 1,
    'hierarchical' => 1,
    'dropdown' => 1,
  ),
  '_multiwidget' => 1,
);$widget_search = array (
  7 => 
  array (
    'title' => 'Search',
  ),
  9 => 
  array (
    'title' => 'Search',
  ),
  '_multiwidget' => 1,
);$widget_tag_cloud = array (
  1 => 
  array (
  ),
  5 => 
  array (
    'title' => 'Tags',
    'taxonomy' => 'post_tag',
  ),
  6 => 
  array (
    'title' => 'Tags',
    'taxonomy' => 'post_tag',
  ),
  7 => 
  array (
    'title' => 'Tags',
    'taxonomy' => 'post_tag',
  ),
  '_multiwidget' => 1,
);$sidebars_widgets=array (
  'custom-sidebar8' => 
  array (
    0 => 'archives-2',
    1 => 'recent-comments-2',
    2 => 'em_widget-2',
    3 => 'facebook_widget-2',
    4 => 'gallery_image_show-2',
    5 => 'videogo_newsletter_widget-2',
  ),
  'wp_inactive_widgets' => 
  array (
  ),
  'sidebar-footer' => 
  array (
    0 => 'categories-3',
    1 => 'recent-posts-3',
    2 => 'archives-3',
  ),
  'custom-sidebar0' => 
  array (
    0 => 'search-7',
    1 => 'tag_cloud-5',
  ),
  'custom-sidebar1' => 
  array (
  ),
  'custom-sidebar2' => 
  array (
    0 => 'tag_cloud-6',
  ),
  'custom-sidebar3' => 
  array (
  ),
  'custom-sidebar4' => 
  array (
    0 => 'search-9',
    1 => 'tag_cloud-7',
  ),
  'custom-sidebar5' => 
  array (
  ),
  'custom-sidebar6' => 
  array (
  ),
  'custom-sidebar7' => 
  array (
  ),
  'array_version' => 3,
);
$show_on_front = 'posts';
$page_on_front = '0';
$theme_mods_base_theme = array (
  0 => false,
  'nav_menu_locations' => 
  array (
    'header-menu' => '176',
  ),
);
			/* Default Widgets */
			videogo_save_option_widgets('sidebars_widgets','', $sidebars_widgets);
			videogo_save_option_widgets('widget_archives','', $widget_archives);
			videogo_save_option_widgets('widget_recent','', $widget_recent);	
			videogo_save_option_widgets('widget_em_widget','', $widget_em_widget);			
			videogo_save_option_widgets('widget_facebook_widget','', $widget_facebook_widget);			
			videogo_save_option_widgets('widget_gallery_image_show','', $widget_gallery_image_show);	
			videogo_save_option_widgets('widget_videogo_newsletter_widget','', $widget_videogo_newsletter_widget);	
			videogo_save_option_widgets('widget_categories','', $widget_categories);
			videogo_save_option_widgets('widget_search','', $widget_search);
			videogo_save_option_widgets('widget_tag_cloud','', $widget_tag_cloud);
			
				
			/* Default Selective Options */
			videogo_save_option_widgets('show_on_front','', $show_on_front);
			videogo_save_option_widgets('page_on_front','', $page_on_front);
			videogo_save_option_widgets('theme_mods_base_theme','', $theme_mods_base_theme);			
		
        }
	}    
}
?>