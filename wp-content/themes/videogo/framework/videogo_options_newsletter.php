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
	
	add_action('wp_ajax_newsletter_settings','videogo_newsletter_settings');
	function videogo_newsletter_settings(){
	
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = trim($values);
		}
	
		$videogo_return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');
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
						<li id="active_tab" class="news_letter" ><?php esc_html_e('Newsletter Settings', 'videogo'); ?></li>
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
						if(isset($action) AND $action == 'newsletter_settings'){
							$videogo_newsletter_xml = '<newsletter_settings>';
							$videogo_newsletter_xml = $videogo_newsletter_xml . create_xml_tag('videogo_newsletter_config',html_entity_decode($videogo_newsletter_config));
							$videogo_newsletter_xml = $videogo_newsletter_xml . create_xml_tag('videogo_feed_burner_text',html_entity_decode($videogo_feed_burner_text));
							$videogo_newsletter_xml = $videogo_newsletter_xml . '</newsletter_settings>';
							if(!videogo_save_option('newsletter_settings', get_option('newsletter_settings'), html_entity_decode($videogo_newsletter_xml))){
							
								die( json_encode($videogo_return_data) );
								
							}
							
							die( json_encode( array('success'=>'0') ) );
							
						}
						$videogo_newsletter_config = '';
						$videogo_feed_burner_text = '';
						$videogo_newsletter_settings = get_option('newsletter_settings');
						if($videogo_newsletter_settings <> ''){
							$videogo_newsletter = new DOMDocument ();
							$videogo_newsletter->loadXML ( $videogo_newsletter_settings );
							$videogo_newsletter_config = esc_attr(videogo_find_xml_value($videogo_newsletter->documentElement,'videogo_newsletter_config'));
							$videogo_feed_burner_text = esc_attr(videogo_find_xml_value($videogo_newsletter->documentElement,'videogo_feed_burner_text'));
						}
						?>
					</div>
					<ul class="newsletter_class">
						<li id="news_letter" class="active_tab">
							<ul class="feedburner_id recipe_class row-fluid">
								<li class="panel-input span8">
									<span class="panel-title">
										<h3> <?php esc_html_e('Feed Burner ID', 'videogo'); ?> </h3>
									</span>
									<input type="text" name="videogo_feed_burner_text" id="videogo_feed_burner_text" value="<?php if(esc_attr($videogo_feed_burner_text) <> ''){echo esc_attr($videogo_feed_burner_text);};?>" />
								</li>
								<li class="right-box-sec span4"><?php esc_html_e('Please enter your google feed burner id in text field.','videogo');?></li>
							</ul>
						</li>				
					</ul>
					<div class="panel-element-tail">
					  <div class="tail-save-changes">
						<div class="loading-save-changes"></div>
						<input type="submit" value="<?php echo esc_attr__('Save Changes','videogo') ?>">
						<input type="hidden" name="action" value="newsletter_settings">
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
