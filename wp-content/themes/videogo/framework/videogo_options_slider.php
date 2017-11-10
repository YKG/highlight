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
	
	add_action('wp_ajax_slider_settings','videogo_slider_settings');
	function videogo_slider_settings(){
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = trim($values);
		}
	
		$videogo_return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars variable on the server.');
	?>		
	<div class="cp-wrapper bootstrap_admin cp-margin-left">  
		<div class="hbg top_navigation row-fluid">
			<div class="cp-logo span2">
				<img src="<?php echo esc_url(VIDEOGO_PATH_URL.'/framework/images/logo.png');?>" class="logo" />
			</div>
			<div class="sidebar span10">
				<?php echo videogo_top_navigation_html_tooltip();?>
			</div>
		
		</div>
		<div class="content-area-main row-fluid"> 
			<div class="sidebar-wraper span2">
				<div class="sidebar-sublinks">
					<ul id="wp_t_o_right_menu">
						<li class="slide_settings" id="active_tab"><?php esc_attr_e('Slider Settings', 'videogo'); ?></li>
					</ul>
				</div>
			</div>
			<div class="content-area span10">
			<form id="options-panel-form" name="cp-panel-form">
				<div class="panel-elements" id="panel-elements">
					<div class="panel-element" id="panel-element-save-complete">
					  <div class="panel-element-save-text">
						<?php esc_html_e('Save Options Complete', 'videogo'); ?>
						.</div>
					  <div class="panel-element-save-arrow"></div>
					</div>
					<div class="panel-element">
					<?php
						if(isset($action) AND $action == 'slider_settings'){
							$videogo_slider_settings_xml = '<slider_settings>';
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . videogo_create_xml_tag('videogo_select_slider',esc_attr($videogo_select_slider));
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . '<bx_slider_settings>';
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . videogo_create_xml_tag('videogo_slide_order_bx',esc_attr($videogo_slide_order_bx));
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . videogo_create_xml_tag('videogo_auto_play_bx',esc_attr($videogo_auto_play_bx));
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . videogo_create_xml_tag('videogo_pause_on_bx',esc_attr($videogo_pause_on_bx));
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . videogo_create_xml_tag('videogo_show_arrow',esc_attr($videogo_show_arrow));
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . '</bx_slider_settings>';
							$videogo_slider_settings_xml = $videogo_slider_settings_xml . '</slider_settings>';
							if(!videogo_save_option('slider_settings', get_option('slider_settings'), $videogo_slider_settings_xml)){
							
								die( json_encode($videogo_return_data) );
							}
							
							die( json_encode( array('success'=>'0') ) );
						}
					
						$videogo_select_slider = '';
						/* Bx Slider */
						$videogo_slide_order_bx = '';
						$videogo_auto_play_bx = '';
						$videogo_pause_on_bx = '';
						$videogo_show_arrow = '';
						$videogo_slider_settings = get_option('slider_settings');
			
						if($videogo_slider_settings <> ''){
							$videogo_slider = new DOMDocument ();
							$videogo_slider->preserveWhiteSpace = FALSE;
							$videogo_slider->loadXML ( $videogo_slider_settings );
							/* Bx Slider Values */
							$videogo_slide_order_bx = esc_attr(find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','videogo_slide_order_bx'));
							$videogo_auto_play_bx = esc_attr(find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','videogo_auto_play_bx'));
							$videogo_pause_on_bx = esc_attr(find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','videogo_pause_on_bx'));
							$videogo_show_arrow = esc_attr(find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','videogo_show_arrow'));
						} 
					?>
					</div>
					<ul class="slide_settings">
						<li id="slide_settings" class="slider_settings_class active_tab">
							<ul class="recipe_class row-fluid">
								<li class="panel-input span8">	
									<span class="panel-title">
										<h3 for="select_slider"><?php esc_attr_e('Select Slider', 'videogo'); ?></h3>
									</span>
									<div class="combobox">
										<select name="select_slider" id="select_slider">
											<option value="default" selected class="default"> <?php esc_html_e('--No Slider--','videogo');?> </option>
											<option value="bx_slider" class="bx_slider"> <?php esc_html_e('Bx Slider','videogo');?> </option>
										</select>
									</div>
								</li>
								<li class="span4 right-box-sec"><p> <?php esc_html_e('Select slider/Banner for configuration.','videogo');?> </p></li>
							</ul>	
							<div class="clear"></div>
							<div class="bx_slider_box">
								<h4> <?php esc_html_e('BX Slider Configurations','videogo');?> </h4>
								<div class="row-fluid">
									<ul class="recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="videogo_slide_order_bx"><?php esc_html_e('Slider Effect', 'videogo'); ?></h3>
											</span>
											<div class="combobox">
												<select name="videogo_slide_order_bx" id="videogo_slide_order_bx">
													<option value="slide" <?php if( esc_attr($videogo_slide_order_bx) == 'false' ){ echo sanitize_text_field('selected'); }?>> <?php esc_html_e('Slide','videogo');?> </option>
													<option value="fade" <?php if( esc_attr($videogo_slide_order_bx) == 'false' ){ echo sanitize_text_field('selected'); }?>> <?php esc_html_e('Fade','videogo');?> </option>
												</select>
											</div>
											<p><?php esc_html_e('Please Select Effects On Slider Image.','videogo');?></p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="videogo_auto_play_bx" > <?php esc_html_e('Autoplay', 'videogo'); ?> </h3>
											</span>	
											<label for="videogo_auto_play_bx">
												<div class="checkbox-switch <?php echo (esc_attr($videogo_auto_play_bx) =='enable' || (esc_attr($videogo_auto_play_bx) ==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="videogo_auto_play_bx" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="videogo_auto_play_bx" id="videogo_auto_play_bx" class="checkbox-switch" value="enable" <?php echo (esc_attr($videogo_auto_play_bx) =='enable' || (esc_attr($videogo_auto_play_bx) ==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please turn on/off Slider autoplay.','videogo');?><p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="videogo_pause_on_bx"><?php esc_html_e('Pause On Hover', 'videogo'); ?></h3>
											</span>	
											<label for="videogo_pause_on_bx">
												<div class="checkbox-switch <?php echo (esc_attr($videogo_pause_on_bx) =='enable' || (esc_attr($videogo_pause_on_bx) ==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="videogo_pause_on_bx" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="videogo_pause_on_bx" id="videogo_pause_on_bx" class="checkbox-switch" value="enable" <?php echo (esc_attr($videogo_pause_on_bx) =='enable' || (esc_attr($videogo_pause_on_bx) ==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please On/Off slider pause on hover.','videogo');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="videogo_show_arrow"><?php esc_html_e('Navigation Arrows', 'videogo'); ?></h3>
											</span>	
											<label for="videogo_show_arrow">
												<div class="checkbox-switch <?php echo (esc_attr($videogo_show_arrow=='enable') || (esc_attr($videogo_show_arrow=='')))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="videogo_show_arrow" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="videogo_show_arrow" id="videogo_show_arrow" class="checkbox-switch" value="enable" <?php echo (esc_attr($videogo_show_arrow) =='enable' || (esc_attr($videogo_show_arrow) ==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please On/Off slider pause on hover.','videogo');?> </p>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
					<div class="">
						<div class="panel-element-tail">
						  <div class="tail-save-changes">
							<div class="loading-save-changes"></div>
							<input type="submit" value="<?php echo esc_attr__('Save Changes','videogo') ?>">
							<input type="hidden" name="action" value="slider_settings">
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
}	
?>
