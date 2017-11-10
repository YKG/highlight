<?php
	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
	
	// add action to embeded the panel in to dashboard
	add_action('admin_menu','videogo_add_crunchpress_panel');
	function videogo_add_crunchpress_panel(){
	
			add_theme_page('VideoGo Theme Options','VideoGo Theme Options','administrator', 'videogo_general_options', 'videogo_general_options' );
			add_theme_page('Theme Info', 'Theme Info', 'administrator','videogo_theme_info', 'videogo_theme_info' );
			add_theme_page('Typography Settings', 'Typography Settings', 'administrator','videogo_typography_settings', 'videogo_typography_settings' );
			add_theme_page('Slider Settings', 'Slider Settings', 'administrator','videogo_slider_settings', 'videogo_slider_settings' );
			add_theme_page('Social Network', 'Social Network', 'administrator','videogo_social_settings', 'videogo_social_settings' );
			add_theme_page('Sidebar Settings', 'Sidebar Settings', 'administrator','videogo_sidebar_settings', 'videogo_sidebar_settings' );
			add_theme_page('Default Pages Settings', 'Default Pages Settings', 'administrator','videogo_default_pages_settings', 'videogo_default_pages_settings' );
			add_theme_page('Newsletter Settings', 'Newsletter Settings', 'administrator','videogo_newsletter_settings', 'videogo_newsletter_settings' );
			add_theme_page('Import Dummy Data', 'Import Dummy Data', 'administrator','videogo_dummydata_import', 'videogo_dummydata_import' );
	}
	
		
	add_action('wp_ajax_general_options','videogo_general_options');
	
	function videogo_general_options(){
		
		global $submenu, $menu;
		
		foreach($_REQUEST as $keys=>$values) {
			$$keys = trim($values);
		}
		$videogo_return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
		
	<div class="cp-wrapper bootstrap_admin cp-margin-left">
		<!--content area start -->	  
		<div class="hbg top_navigation row-fluid">
			<div class="cp-logo span2">
				<img src="<?php echo esc_url(VIDEOGO_PATH_URL.'/framework/images/logo.png');?>" class="logo" alt="<?php esc_html_e('logo','videogo');?>" />
			</div>
			<div class="sidebar span10">
				<?php echo esc_attr(videogo_top_navigation_html_tooltip());?>
			</div>
		</div>
		<div class="content-area-main row-fluid"> 
			<!--sidebar start -->
			<div class="sidebar-wraper span2">
				<div class="sidebar-sublinks">
				  <ul id="wp_t_o_right_menu">
					<li id="active_tab" class="logo" >
					  <?php esc_html_e('Logo Settings', 'videogo'); ?>
					</li>
					<li class="color_style">
					  <?php esc_html_e('Style & Color Scheme', 'videogo'); ?>
					</li>
					<li class="hr_settings">
					  <?php esc_html_e('Header Settings', 'videogo'); ?>
					  </li>
					<li class="ft_settings">
					  <?php esc_html_e('Footer Settings', 'videogo'); ?>
					  </li>
					<li class="misc_settings">
					  <?php esc_html_e('MISC Settings', 'videogo'); ?>
					  </li>
					  <li class="maintenance_mode_settings">
					  <?php esc_html_e('Maintenance Mode Settings', 'videogo'); ?>
					  </li>
				  </ul>
				</div>
			</div>
			<!--sidebar end --> 
		
			<!--content start -->
			<div class="content-area span10">
				<form id="options-panel-form" name="cp-panel-form">
					<div class="panel-elements" id="panel-elements">
						<div class="panel-element" id="panel-element-save-complete">
						  <div class="panel-element-save-text">
							<?php esc_html_e('Save Options Complete', 'videogo'); ?>
							</div>
						  <div class="panel-element-save-arrow"></div>
						</div>
						<div class="panel-element">
						<?php 
						if(isset($action) AND $action == 'general_options'){
								
							$videogo_general_logo_xml = '<general_settings>';
							
							/*************************************************** CrunchPress Theme Panel Options ******************************************************/
							
							/************** 1. Logo Settings *****************/
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_header_logo_swtich',esc_attr($videogo_header_logo_swtich));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_header_logo',esc_html($videogo_header_logo));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_logo_text_cp',esc_attr($videogo_logo_text_cp));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_logo_subtext',esc_attr($videogo_logo_subtext));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_logo_width',esc_attr($videogo_logo_width));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_logo_height',esc_attr($videogo_logo_height));

							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_retina_header_logo',esc_html($videogo_retina_header_logo));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_retina_logo_width',esc_attr($videogo_retina_logo_width));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_retina_logo_height',esc_attr($videogo_retina_logo_height));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_footer_header_logo',esc_html($videogo_footer_header_logo));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_footer_logo_width',esc_attr($videogo_footer_logo_width));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_footer_logo_height',esc_attr($videogo_footer_logo_height));
							
							/************** 2. Color Scheme Settings *****************/
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_primary_color',esc_attr($videogo_primary_color));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_secondary_color',esc_attr($videogo_secondary_color));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_select_background_patren',esc_attr($videogo_select_background_patren));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_bg_scheme',esc_attr($videogo_bg_scheme));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_body_patren',esc_html($videogo_body_patren));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_color_patren',esc_attr($videogo_color_patren));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_body_image',esc_html($videogo_body_image));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_position_image_layout',esc_html($videogo_position_image_layout));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_image_repeat_layout',esc_html($videogo_image_repeat_layout));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_image_attachment_layout',esc_html($videogo_image_attachment_layout));
							
							
							/************** 3. Header Settings *****************/
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_header_inner_bg',esc_attr($videogo_header_inner_bg));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_top_content_switch',esc_attr($videogo_top_content_switch));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_contact_number',esc_attr($videogo_contact_number));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_contact_email',esc_attr($videogo_contact_email));
							
								
							/************** 4. Footer Settings *****************/
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_copyright_code',esc_attr($videogo_copyright_code));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_footer_menu_1',esc_attr($videogo_footer_menu_1));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_footer_menu_2',esc_attr($videogo_footer_menu_2));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_footer_col_layout',esc_attr($videogo_footer_col_layout));
								
							
							/************** 5. Miscelleanous Settings *****************/
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_breadcrumbs',esc_attr($videogo_breadcrumbs));	
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_rtl_layout',esc_attr($videogo_rtl_layout));
								
							/************** 6. Maintanance Settings *****************/
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_maintenance_mode_swtich',esc_attr($videogo_maintenance_mode_swtich));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_maintenace_title',esc_attr($videogo_maintenace_title));
							$videogo_general_logo_xml = $videogo_general_logo_xml . videogo_create_xml_tag('videogo_mainte_description',esc_attr($videogo_mainte_description));
								
							$videogo_general_logo_xml = $videogo_general_logo_xml . '</general_settings>';
							if(!videogo_save_option('general_settings', get_option('general_settings'), $videogo_general_logo_xml)){
							
								die( json_encode($videogo_return_data) );
								
							}
							
							die( json_encode( array('success'=>'0') ) );
								
						}
						?>
						</div>
				
				<?php
				
				/***** 1. Logo Settings ******/
				$videogo_header_logo_swtich = '';
				$videogo_logo_text_cp = '';
				$videogo_logo_subtext = '';
				$videogo_logo_width = '';
				$videogo_logo_height = '';

				$videogo_retina_header_logo = '';
				$videogo_retina_logo_width = '';
				$videogo_retina_logo_height = '';
				$videogo_footer_header_logo = '';
				$videogo_footer_logo_width = '';
				$videogo_footer_logo_height = '';

				/***** 2. Color Scheme ******/
				$videogo_primary_color = '';
				$videogo_secondary_color = '';
				$videogo_select_background_patren = '';
				$videogo_bg_scheme = '';
				$videogo_body_patren = '';
				$videogo_color_patren = '';
				$videogo_body_image = '';
				$videogo_position_image_layout = '';
				$videogo_image_repeat_layout = '';
				$videogo_image_attachment_layout = '';
				$videogo_options = '';
				
				
				/***** 3. Header Settings ******/
				$videogo_header_inner_bg = '';
				$videogo_top_content_switch = '';
				$videogo_contact_number = '';
				$videogo_contact_email = '';
				
				
				/***** 4. Footer Settings ******/
				$videogo_copyright_code = '';
				$videogo_footer_layout = '';
				$videogo_footer_menu_1 = '';
				$videogo_footer_menu_2 = '';
				
				/***** 5. Misc Settings ******/
				$videogo_breadcrumbs = '';			
				$videogo_rtl_layout = '';
				
				/***** 6. Maintanance Settings ******/
				$videogo_maintenance_mode_swtich = '';
				$videogo_maintenace_title = '';
				$videogo_mainte_description = '';
				$videogo_general_settings = get_option('general_settings');
				if($videogo_general_settings <> ''){
					$videogo_logo = new DOMDocument ();
					$videogo_logo->loadXML ( $videogo_general_settings );
					
					/******** 1. Logo Settings ******/
					$videogo_header_logo_swtich = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_header_logo_swtich'));
					$videogo_logo_text_cp = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_logo_text_cp'));
					$videogo_logo_subtext = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_logo_subtext'));
					$videogo_header_logo = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_header_logo'));
					$videogo_logo_width = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_logo_width'));
					$videogo_logo_height = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_logo_height')); 

					$videogo_retina_header_logo = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_retina_header_logo'));
					$videogo_retina_logo_width = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_retina_logo_width'));
					$videogo_retina_logo_height = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_retina_logo_height')); 
					$videogo_footer_header_logo = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_footer_header_logo'));
					$videogo_footer_logo_width = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_footer_logo_width'));
					$videogo_footer_logo_height = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_footer_logo_height')); 


					/******** 2. Color Scheme Settings ******/
					$videogo_primary_color = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_primary_color'));
					$videogo_secondary_color = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_secondary_color'));					
					$videogo_select_background_patren = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_select_background_patren'));
					$videogo_bg_scheme = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_bg_scheme'));				
					$videogo_body_patren = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_body_patren'));
					$videogo_color_patren = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_color_patren'));
					$videogo_body_image = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_body_image'));
					$videogo_position_image_layout = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_position_image_layout'));
					$videogo_image_repeat_layout = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_image_repeat_layout'));
					$videogo_image_attachment_layout = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_image_attachment_layout'));
					
					
					/******** 3. Header Settings ******/
					$videogo_header_inner_bg = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_header_inner_bg'));
					$videogo_top_content_switch = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_top_content_switch'));
					$videogo_contact_number = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_contact_number'));
					$videogo_contact_email = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_contact_email'));
					
					
					/******** 4. Footer Settings ******/
					$videogo_copyright_code = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_copyright_code'));
					$videogo_footer_col_layout = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_footer_col_layout'));
					$videogo_footer_menu_1 = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_footer_menu_1'));
					$videogo_footer_menu_2 = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_footer_menu_2'));
					
					/******** 5. Misc Settings ******/
					$videogo_breadcrumbs = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_breadcrumbs'));
					$videogo_rtl_layout = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_rtl_layout'));
					
					/******** 6. Maintanance Settings ******/
					$videogo_maintenance_mode_swtich = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_maintenance_mode_swtich'));
					$videogo_maintenace_title = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_maintenace_title'));
					$videogo_mainte_description = esc_html(videogo_find_xml_value($videogo_logo->documentElement,'videogo_mainte_description'));
	
				}
			?>
			<!--- ********** HTML MARKUP : 1. General Logo Settings ******************* -->
            <ul class="logo_tab">
              <li id="logo" class="logo_dimenstion active_tab">
                <div id="videogo_header_logo_cp" class="row-fluid">
					<ul class="panel-body recipe_class span4 videogo_header_logo_swtich">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3><?php esc_html_e('Logo Type', 'videogo'); ?></h3>
							</span>
							<label for="videogo_header_logo_swtich">
								<div class="checkbox-switch
									<?php echo (esc_attr($videogo_header_logo_swtich) == 'enable' || (esc_attr($videogo_header_logo_swtich) == '' && empty($videogo_default)))? 'checkbox-switch-on': 'checkbox-switch-off'; ?>">
								</div>
							</label>
							<input type="checkbox" name="videogo_header_logo_swtich" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="videogo_header_logo_swtich" id="videogo_header_logo_swtich" class="checkbox-switch" value="enable" <?php 
								echo (esc_attr($videogo_header_logo_swtich) =='enable' || (esc_attr($videogo_header_logo_swtich)=='' && empty($videogo_default)))? 'checked': ''; 
							?>>
							<div class="clear"></div>
							<p> <?php esc_html_e('You can switch between header logo image and header logo text, turning it on it will show logo as image, turning it off it will disable image and show text which you have entered in wordpress settings.','videogo');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4 videogo_logo_text">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Logo Text', 'videogo'); ?>
								</h3>
							</span>
							<input type="text" name="videogo_logo_text_cp" id="videogo_logo_text_cp" value="<?php echo (esc_attr($videogo_logo_text_cp) == '')? esc_attr($videogo_logo_text_cp): esc_attr($videogo_logo_text_cp);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please Paste Logo Text.','videogo');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4 videogo_logo_text">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Logo Subtext', 'videogo'); ?>
								</h3>
							</span>
							<input type="text" name="videogo_logo_subtext" id="videogo_logo_subtext" value="<?php echo (esc_attr($videogo_logo_subtext) == '')? esc_attr($videogo_logo_subtext): esc_attr($videogo_logo_subtext);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please Paste Logo Subtext.','videogo');?></p>
						</li>
					</ul>
				</div>
				<ul class="panel-body recipe_class logo_upload row-fluid videogo_logo setheight">
                  <?php 
					$videogo_image_src_head = '';
					if(!empty($videogo_header_logo)){ 
						$videogo_image_src_head = wp_get_attachment_image_src( $videogo_header_logo, 'full' );
						$videogo_image_src_head = (empty($videogo_image_src_head))? '': esc_url($videogo_image_src_head[0]);
					}
					?>
					<li class="panel-input span8 eql_height">
						<span class="panel-title">
							<h3 for="videogo_header_logo" >
							  <?php esc_html_e('Header Logo', 'videogo'); ?>
							</h3>
						</span>
                        <?php wp_enqueue_media(); ?>
						<div class="content_con">
							<input name="videogo_header_logo" type="hidden" class="clearme" id="upload_image_attachment_id" value="<?php echo esc_attr($videogo_header_logo); ?>" />
							<input name="header_link" id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($videogo_image_src_head); ?>" />
							<input class="upload_image_button" name="upload-btn" id="upload-btn" type="button" value="Upload" />
						</div>
						<p> <?php esc_html_e('Upload logo image here, PNG, Gif, JPEG, JPG format supported only.','videogo');?> </p>  
					</li>
					<li class="panel-right-box span4 eql_height">
						<div class="admin-logo-image">
						  <?php 
							if(!empty($videogo_header_logo)){ 
								$videogo_image_src_head = wp_get_attachment_image_src( $videogo_header_logo, 'full' );
								$videogo_image_src_head = (empty($videogo_image_src_head))? '': esc_url($videogo_image_src_head[0]);
								$videogo_thumb_src_preview = wp_get_attachment_image_src( $videogo_header_logo, array(150,150)); ?>
									<img class="clearme img-class" src="<?php if(!empty($videogo_image_src_head)){echo esc_url($videogo_thumb_src_preview[0]);}?>" alt="<?php esc_html__('Save and Refresh, For Uploaded Logo Preview','videogo');?>" />
									<span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid videogo_logo setheight">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="videogo_logo_width" >
						  <?php esc_html_e('Width', 'videogo'); ?>
						</h3>
					  </span>
                    <div id="videogo_logo_width" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="videogo_logo_width" value="<?php echo esc_attr($videogo_logo_width);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image width, you can also use Arrow keys UP,Down - Left,Right.','videogo');?> </p>                  
                  </li>
                  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($videogo_logo_width);?> <?php esc_html_e('px','videogo');?> </li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid videogo_logo setheight">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="videogo_logo_height" >
						  <?php esc_html_e('Height', 'videogo'); ?>
						</h3>
					  </span>
                    <div id="videogo_logo_height" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="videogo_logo_height" value="<?php echo esc_attr($videogo_logo_height);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image height, you can also use Arrow keys UP,Down - Left,Right.','videogo');?> </p>  
                  </li>
				  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($videogo_logo_height);?> <?php esc_html_e('px','videogo');?> </li>
                </ul>
                <div class="clear"></div>
				<ul class="panel-body recipe_class logo_upload row-fluid videogo_logo setheight">
                  <?php 
					$videogo_retina_image_src_head = '';
					if(!empty($videogo_retina_header_logo)){ 
						$videogo_retina_image_src_head = wp_get_attachment_image_src( $videogo_retina_header_logo, 'full' );
						$videogo_retina_image_src_head = (empty($videogo_retina_image_src_head))? '': esc_url($videogo_retina_image_src_head[0]);
					}
					?>
					<li class="panel-input span8 eql_height">
						<span class="panel-title">
							<h3 for="videogo_header_logo" >
							  <?php esc_html_e('Retina Logo', 'videogo'); ?>
							</h3>
						</span>
                        <?php wp_enqueue_media(); ?>
						<div class="content_con">

<input name="videogo_retina_header_logo" type="hidden" class="clearme" id="upload_retina_image_attachment_id" value="<?php echo esc_attr($videogo_retina_header_logo); ?>" />
<input name="header_retina_link" id="upload_retina_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($videogo_retina_image_src_head); ?>" />
<input class="upload_retina_image_button" name="upload-btn" id="upload-btn" type="button" value="Upload" />
						</div>
						<p> <?php esc_html_e('Upload logo image here, PNG, Gif, JPEG, JPG format supported only.','videogo');?> </p>  
					</li>
					<li class="panel-right-box span4 eql_height">
						<div class="admin-logo-image">
						  <?php 
							if(!empty($videogo_retina_header_logo)){ 
								$videogo_retina_image_src_head = wp_get_attachment_image_src( $videogo_retina_header_logo, 'full' );
								$videogo_retina_image_src_head = (empty($videogo_retina_image_src_head))? '': esc_url($videogo_retina_image_src_head[0]);
								$videogo_retina_thumb_src_preview = wp_get_attachment_image_src( $videogo_retina_header_logo, array(150,150)); ?>
									<img class="clearme img-class" src="<?php if(!empty($videogo_retina_image_src_head)){echo esc_url($videogo_retina_thumb_src_preview[0]);}?>" alt="<?php esc_html__('Save and Refresh, For Uploaded Logo Preview','videogo');?>" />
									<span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid videogo_logo setheight">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="videogo_logo_width" >
						  <?php esc_html_e('Width', 'videogo'); ?>
						</h3>
					  </span>
                    <div id="videogo_retina_logo_width" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="videogo_retina_logo_width" value="<?php echo esc_attr($videogo_retina_logo_width);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image width, you can also use Arrow keys UP,Down - Left,Right.','videogo');?> </p>                  
                  </li>
                  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($videogo_retina_logo_width);?> <?php esc_html_e('px','videogo');?> </li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid videogo_logo setheight">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="videogo_logo_height" >
						  <?php esc_html_e('Height', 'videogo'); ?>
						</h3>
					  </span>
                    <div id="videogo_retina_logo_height" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="videogo_retina_logo_height" value="<?php echo esc_attr($videogo_retina_logo_height);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image height, you can also use Arrow keys UP,Down - Left,Right.','videogo');?> </p>  
                  </li>
				  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($videogo_retina_logo_height);?> <?php esc_html_e('px','videogo');?> </li>
                </ul>
                <div class="clear"></div>
				<ul class="panel-body recipe_class logo_upload row-fluid videogo_logo setheight">
                  <?php 
					$videogo_footer_image_src_head = '';
					if(!empty($videogo_footer_header_logo)){ 
						$videogo_footer_image_src_head = wp_get_attachment_image_src( $videogo_footer_header_logo, 'full' );
						$videogo_footer_image_src_head = (empty($videogo_footer_image_src_head))? '': esc_url($videogo_footer_image_src_head[0]);
					}
					?>
					<li class="panel-input span8 eql_height">
						<span class="panel-title">
							<h3 for="videogo_header_logo" >
							  <?php esc_html_e('Footer Logo', 'videogo'); ?>
							</h3>
						</span>
                        <?php wp_enqueue_media(); ?>
						<div class="content_con">
<input name="videogo_footer_header_logo" type="hidden" class="clearme" id="upload_footer_image_attachment_id" value="<?php echo esc_attr($videogo_footer_header_logo); ?>" />
<input name="header_link" id="upload_footer_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($videogo_footer_image_src_head); ?>" />
<input class="upload_footer_image_button" name="upload-btn" id="upload-btn" type="button" value="Upload" />
						</div>
						<p> <?php esc_html_e('Upload logo image here, PNG, Gif, JPEG, JPG format supported only.','videogo');?> </p>  
					</li>
					<li class="panel-right-box span4 eql_height">
						<div class="admin-logo-image">
						  <?php 
							if(!empty($videogo_footer_header_logo)){ 
								$videogo_footer_image_src_head = wp_get_attachment_image_src( $videogo_footer_header_logo, 'full' );
								$videogo_footer_image_src_head = (empty($videogo_footer_image_src_head))? '': esc_url($videogo_footer_image_src_head[0]);
								$videogo_footer_thumb_src_preview = wp_get_attachment_image_src( $videogo_footer_header_logo, array(150,150)); ?>
									<img class="clearme img-class" src="<?php if(!empty($videogo_footer_image_src_head)){echo esc_url($videogo_footer_thumb_src_preview[0]);}?>" alt="<?php esc_html__('Save and Refresh, For Uploaded Logo Preview','videogo');?>" />
									<span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid videogo_logo setheight">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="videogo_logo_width" >
						  <?php esc_html_e('Width', 'videogo'); ?>
						</h3>
					  </span>
                    <div id="videogo_footer_logo_width" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="videogo_footer_logo_width" value="<?php echo esc_attr($videogo_footer_logo_width);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image width, you can also use Arrow keys UP,Down - Left,Right.','videogo');?> </p>                  
                  </li>
                  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($videogo_footer_logo_width);?> <?php esc_html_e('px','videogo');?> </li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid videogo_logo setheight">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="videogo_logo_height" >
						  <?php esc_html_e('Height', 'videogo'); ?>
						</h3>
					  </span>
                    <div id="videogo_footer_logo_height" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="videogo_footer_logo_height" value="<?php echo esc_attr($videogo_footer_logo_height);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image height, you can also use Arrow keys UP,Down - Left,Right.','videogo');?> </p>  
                  </li>
				  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($videogo_footer_logo_height);?> <?php esc_html_e('px','videogo');?> </li>
                </ul>
              </li>
			  
			  <!--- ********** HTML MARKUP : 2. Color Scheme Settings ******************* -->
			  
            <li id="color_style" class="style_videogo_color_scheme">
				<div class="row-fluid">
					<ul class="recipe_class span4">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Primary Color', 'videogo'); ?>
								</h3>
							</span>
							<div class="color-picker-container">
								<input type="text" name="videogo_primary_color" class="color-picker" value="<?php if(esc_attr($videogo_primary_color) <> ''){echo esc_attr($videogo_primary_color);}?>" />
							</div>
							<p> <?php esc_html_e('Please select any color from color palette to use as color scheme (it will effect on all headings and anchors), leaving blank will apply default color.','videogo');?> </p>
						</li>
					</ul>
					<ul class="recipe_class span4">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Secondary Color', 'videogo'); ?>
								</h3>
							</span>
							<div class="color-picker-container">
								<input type="text" name="videogo_secondary_color" class="color-picker" value="<?php if(esc_attr($videogo_secondary_color) <> ''){echo esc_attr($videogo_secondary_color);}?>" />
							</div>
							<p> <?php esc_html_e('Please select any color from color palette to use as secondary color scheme leaving blank will apply default color.','videogo');?> </p>
						</li>
					</ul>
				</div>
            </li>
			
			<!--- ********** HTML MARKUP : 3 . Header Settings ******************* -->
			
            <li id="hr_settings" class="logo_dimenstion">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<?php
								$videogo_images = array(
									'1'=>array('value'=>'header_1', 'image'=>'/frontend/header/header_1.jpg'),									
								);							
								echo '<div class="select_header_img">';
									foreach($videogo_images as $keys=>$val){
										echo '<div class="header_image_cp" id="'.esc_attr($val['value']).'"><img src="'.esc_url(VIDEOGO_PATH_URL.$val['image']).'" atl="header image"></div>';
									}
								echo '</div>';
							?>
						</li>
					</ul>
				</div>
				<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="" >
									<?php esc_html_e('Top Bar Social Links', 'videogo'); ?>
								</h3>
							</span>
							<label for="videogo_top_content_switch">
								<div class="checkbox-switch <?php echo (esc_attr($videogo_top_content_switch)=='enable' || (esc_attr($videogo_top_content_switch)=='' && empty($videogo_default)))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
							</label>
							<input type="checkbox" name="videogo_top_content_switch" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="videogo_top_content_switch" id="videogo_top_content_switch" class="checkbox-switch" value="enable" <?php echo (esc_attr($videogo_top_content_switch) =='enable' || (esc_attr($videogo_top_content_switch)=='' && empty($videogo_default)))? 'checked': ''; ?>>
							<p><?php esc_html_e('You can Enable/Disable Top Bar Social Icons In Header Section.','videogo');?></p>
					  </li>
					</ul>
				</div>
            </li>
			
			<!--- ********** HTML MARKUP : 4 . Footer Settings ******************* -->
			
            <li id="ft_settings" class="logo_dimenstion">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<?php
								$videogo_images = array(
									'1'=>array('value'=>'footer_1', 'image'=>'/frontend/footer/footer_1.jpg')
								);							
								echo '<div class="select_footer_img">';
									foreach($videogo_images as $keys=>$val){
										echo '<div class="footer_image_cp" id="'.esc_attr($val['value']).'"><img src="'.esc_url(VIDEOGO_PATH_URL.$val['image']).'" atl=""></div>';
									}
								echo '</div>';
							?>
						</li>
					</ul>    
				</div>
                <div class="clear"></div>
				<div class="row-fluid">
					<ul class="panel-body recipe_class span5">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="videogo_copyright_code" >
									<?php esc_html_e('Copyright Text', 'videogo'); ?>
								</h3>
							</span>
							<input type="text" name="videogo_copyright_code" id="videogo_copyright_code" value="<?php echo (esc_attr($videogo_copyright_code) == '')? esc_attr($videogo_copyright_code): esc_attr($videogo_copyright_code);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please paste here your copyright text.','videogo');?></p>
						</li>
					</ul>
					<ul class="recipe_class span7 footer_widget">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3 for="">
								  <?php esc_html_e('Footer Widget Layout', 'videogo'); ?>
								</h3>
							</span>
							<?php 
								$videogo_value = '';
								$videogo_options = array(
								'1'=>array('value'=>'footer-style1','image'=>'/framework/images/footer-style1.png'),
								'6'=>array('value'=>'footer-style6','image'=>'/framework/images/footer-style6.png'),
								);
								foreach( $videogo_options as $videogo_option ){ ?>
									<div class='radio-image-wrapper'>
										<label for="<?php echo esc_attr($videogo_option['value']); ?>">
										  <img src=<?php echo esc_url(VIDEOGO_PATH_URL.$videogo_option['image'])?> class="videogo_footer_col_layout" alt="<?php esc_html_e('videogo_footer_col_layout','videogo');?>" />
										  <div id="check-list"></div>
										</label>
										<input type="radio" name="videogo_footer_col_layout" value="<?php echo esc_attr($videogo_option['value']); ?>" id="<?php echo esc_attr($videogo_option['value']); ?>" class="dd"
										<?php if(esc_attr($videogo_footer_col_layout) == esc_attr($videogo_option['value'])){ echo sanitize_text_field('checked');}?>>
									</div>
							<?php } ?>
							<div class="clear"></div>
							<p> <?php esc_html_e('Please Select Footer Widget Layout.','videogo');?></p>
						</li>
					</ul>
				</div>
                <div class="clear"></div>
				<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
								  <?php esc_html_e('Select Dark Menu for Footer', 'videogo'); ?>
								</h3>
							</span>
							<div class="combobox">
	<select name="videogo_footer_menu_1" class="videogo_footer_menu_1" id="videogo_footer_menu_1">
		<?php $menus = get_terms('nav_menu'); foreach($menus as $menu){ ?>
<option <?php if($menu->slug == esc_attr($videogo_footer_menu_1)){echo 'selected';}?> value="<?php echo esc_attr($menu->slug); ?>"><?php echo esc_attr($menu->name); ?></option>
		<?php } ?>                                
	</select>
							</div>
							<p> <?php esc_html_e('Please Select Dark Menu for footer.','videogo');?> </p>
						</li>
					</ul>
                 </div>   
                <div class="clear"></div>
				<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
								  <?php esc_html_e('Select Light Menu for Footer', 'videogo'); ?>
								</h3>
							</span>
							<div class="combobox">
	<select name="videogo_footer_menu_2" class="videogo_footer_menu_2" id="videogo_footer_menu_2">
		<?php $menus = get_terms('nav_menu'); foreach($menus as $menu){ ?>
<option <?php if($menu->slug == esc_attr($videogo_footer_menu_2)){echo 'selected';}?> value="<?php echo esc_attr($menu->slug); ?>"><?php echo esc_attr($menu->name); ?></option>
		<?php } ?>                                
	</select>
							</div>
							<p> <?php esc_html_e('Please Select Light Menu for footer.','videogo');?> </p>
						</li>
					</ul>
				</div>                
            </li>
			
			<!--- ********** HTML MARKUP : 5 . Misc Settings ******************* -->
			
            <li id="misc_settings">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span6">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Breadcrumbs', 'videogo'); ?>
								</h3>
							</span>
							<label for="videogo_breadcrumbs">
								<div class="checkbox-switch <?php echo (esc_attr($videogo_breadcrumbs) =='enable' || (esc_attr($videogo_breadcrumbs) =='' && empty($videogo_default)))? 'checkbox-switch-on': 'checkbox-switch-off'; ?>"></div>
							</label>
							<input type="checkbox" name="videogo_breadcrumbs" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="videogo_breadcrumbs" id="videogo_breadcrumbs" class="checkbox-switch" value="enable" <?php if(esc_attr($videogo_breadcrumbs) =='enable' ){echo '';} echo (esc_attr($videogo_breadcrumbs) =='enable' || (esc_attr($videogo_breadcrumbs) =='' && empty($videogo_default)))? 'checked': ''; ?>>
							<p> <?php esc_html_e('You can turn On/Off breadcrumbs from Top of the page.','videogo');?></p>
						</li>
					</ul>

					<ul class="panel-body recipe_class span6">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="rtl_layout" >
									<?php _e('RTL LAYOUTS', 'videogo'); ?>
								</h3>
							</span>
							<label for="videogo_rtl_layout">
							<div class="checkbox-switch <?php echo ($videogo_rtl_layout=='enable' || ($videogo_rtl_layout=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; ?>"></div>
							</label>
							<input type="checkbox" name="videogo_rtl_layout" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="videogo_rtl_layout" id="videogo_rtl_layout" class="checkbox-switch" value="enable" <?php echo ($videogo_rtl_layout =='enable' || ($videogo_rtl_layout =='' && empty($default)))? 'checked': '';?>>
							<p> <?php _e('You can turn On/Off RTL Layout of website.','videogo');?> </p>
						</li>
					</ul>
				</div>
              </li> 
              
              
              
			  
			  <!--- ********** HTML MARKUP : 6 . Maintainance Settings ******************* -->
			  
			  <li id="maintenance_mode_settings">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span3">
						<li class="panel-input full-width">
						   <span class="panel-title">
								<h3>
								  <?php esc_html_e('Maintenance Mode', 'videogo'); ?>
								</h3>
							</span>
							<label for="videogo_maintenance_mode_swtich">
								<div class="checkbox-switch <?php echo (esc_attr($videogo_maintenance_mode_swtich) =='enable' || (esc_attr($videogo_maintenance_mode_swtich) =='' && empty($videogo_default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 	?>"></div>
							</label>
							<input type="checkbox" name="videogo_maintenance_mode_swtich" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="videogo_maintenance_mode_swtich" id="videogo_maintenance_mode_swtich" class="checkbox-switch" value="enable" 
							<?php if(esc_attr($videogo_maintenance_mode_swtich) =='enable' ){echo '';} echo (esc_attr($videogo_maintenance_mode_swtich) =='enable' || (esc_attr($videogo_maintenance_mode_swtich) =='' && empty($videogo_default)))? 'checked': ''; ?>>
							<p><?php esc_html_e('You can turn On/Off Maintenance mode from here.','videogo');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span3">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Maintenance Title', 'videogo'); ?>
								</h3>
							</span>
							<input type="text" name="videogo_maintenace_title" id="videogo_maintenace_title" value="<?php echo (esc_attr($videogo_maintenace_title) == '')? esc_attr($videogo_maintenace_title): esc_attr($videogo_maintenace_title);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please Add Title To Display On Page.','videogo');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span6">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="videogo_mainte_description" >
									<?php esc_html_e('Description', 'videogo'); ?>
								</h3>
							</span>
							<textarea name="videogo_mainte_description" id="videogo_mainte_description" ><?php if(esc_attr($videogo_mainte_description) <> '') { echo esc_textarea(esc_attr($videogo_mainte_description));}?></textarea>
							<p><?php esc_html_e('Please Add Description Text For The Maintanance Page.','videogo');?></p>
						</li> 
					</ul>    
				</div>
              </li>
            </ul>
            <div class="clear"></div>
            <div class="panel-element-tail">
              <div class="tail-save-changes">
                <div class="loading-save-changes"></div>
                <input type="submit" value="<?php echo esc_html_e('Save Changes','videogo') ?>">
                <input type="hidden" name="action" value="general_options">
              </div>
            </div>
          </div>
        </form>
      </div>
      <!--content End --> 
    </div>
    <!--content area end --> 
	</div>
<?php
	} /* end of General Settings Function */
?>