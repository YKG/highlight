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
	
	add_action('wp_ajax_social_settings','videogo_social_settings');
	function videogo_social_settings(){
		
	
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = trim($values);
		}
	
		$videogo_return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
	
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
							<li class="videogo_social_networking" id="active_tab"><?php esc_html_e('Social Networking', 'videogo'); ?></li>
							<li class="social_sharing"><?php esc_html_e('Social Sharing', 'videogo'); ?></li>
						</ul>
					</div>
				</div>
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
						/* Social Sharing and Networking Values Saving as XML */
						if(isset($action) AND $action == 'social_settings'){
							$videogo_social_xml = '<social_settings>';
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_facebook_network',esc_html($videogo_facebook_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_twitter_network',esc_html($videogo_twitter_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_google_plus_network',esc_html($videogo_google_plus_network));								
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_dribble_network',esc_html($videogo_dribble_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_linked_in_network',esc_html($videogo_linked_in_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_youtube_network',esc_html($videogo_youtube_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_flickr_network',esc_html($videogo_flickr_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_vimeo_network',esc_html($videogo_vimeo_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_pinterest_network',esc_html($videogo_pinterest_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_Instagram_network',esc_html($videogo_Instagram_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_github_network',esc_html($videogo_github_network));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_skype_network',esc_html($videogo_skype_network));
							
							/* Social Sharing Buttons */
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_facebook_sharing',esc_html($videogo_facebook_sharing));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_twitter_sharing',esc_html($videogo_twitter_sharing));
							$videogo_social_xml = $videogo_social_xml . videogo_create_xml_tag('videogo_googleplus_sharing',esc_html($videogo_googleplus_sharing));
							
							$videogo_social_xml = $videogo_social_xml . '</social_settings>';
							if(!videogo_save_option('social_settings', get_option('social_settings'), $videogo_social_xml)){
							
								die( json_encode($videogo_return_data) );
								
							}
							
							die( json_encode( array('success'=>'0') ) );
							
						}
						
						/* Social Networking */
						$videogo_facebook_network = '';
						$videogo_twitter_network = '';
						$videogo_google_plus_network = '';
						$videogo_linked_in_network = '';	
						$videogo_youtube_network = '';
						$videogo_flickr_network = '';
						$videogo_vimeo_network = '';
						$videogo_pinterest_network = '';
						$videogo_Instagram_network = '';
						$videogo_github_network = '';
						$videogo_skype_network = '';						
						$videogo_dribble_network = '';
				
						/* Social Sharing Swtich */
						$videogo_facebook_sharing = '';
						$videogo_twitter_sharing = '';
						$videogo_googleplus_sharing = '';
							
				
						/* Getting Values from database */
						$videogo_social_settings = get_option('social_settings');
						if($videogo_social_settings <> ''){
							$videogo_social = new DOMDocument();
							$videogo_social->loadXML ( $videogo_social_settings );
					
							/* Social Networking Values */
							$videogo_facebook_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_facebook_network'));
							$videogo_twitter_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_twitter_network'));
							$videogo_delicious_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_delicious_network'));
							$videogo_google_plus_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_google_plus_network'));$videogo_Instagram_network =	esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_Instagram_network'));								
							$videogo_dribble_network =	esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_dribble_network'));
							$videogo_linked_in_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_linked_in_network'));
							$videogo_youtube_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_youtube_network'));
							$videogo_vimeo_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_vimeo_network'));
							$videogo_pinterest_network = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_pinterest_network'));
					
					
							/* Social Sharing Values */
							$videogo_facebook_sharing = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_facebook_sharing'));
							$videogo_twitter_sharing = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_twitter_sharing'));
							$videogo_googleplus_sharing = esc_html(videogo_find_xml_value($videogo_social->documentElement,'videogo_googleplus_sharing'));
							
						}?>
					</div>
					
					<!-- ************** Profile URI ***************** --->
					<ul class="videogo_social_networking">
						<li id="videogo_social_networking" class="social_network_class active_tab">
							<div class="row-fluid">
								<ul class="panel-body recipe_class span4">											
									<li class="panel-input full-width">
										<span class="panel-title">
											<h3 for="facebook_network" > <?php esc_html_e('Facebook', 'videogo'); ?> </h3>
										</span>	
										<input type="text" name="facebook_network" id="facebook_network" value="<?php if(esc_url($videogo_facebook_network) <> ''){echo esc_url($videogo_facebook_network);};?>" />
										<div class="admin-social-image">
											<span class="facebook"><i class="fa fa-facebook"></i></span>
										</div>
										<p><?php esc_html_e('Please paste your Profile URl','videogo');?></p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width">
										<span class="panel-title">
											<h3 for="videogo_twitter_network" > <?php esc_html_e('Twitter', 'videogo'); ?> </h3>
										</span>
										<input type="text" name="videogo_twitter_network" id="videogo_twitter_network" value="<?php if(esc_url($videogo_twitter_network) <> ''){echo esc_url($videogo_twitter_network);};?>" />
										<div class="admin-social-image">
											<span class="twitter"><i class="fa fa-twitter"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_Instagram_network"> <?php esc_html_e('Instagram', 'videogo'); ?> </h3>
										</span>	
										<input type="text" name="videogo_Instagram_network" id="videogo_Instagram_network" value="<?php if(esc_url($videogo_Instagram_network) <> ''){echo esc_url($videogo_Instagram_network);};?>" />
										<div class="admin-social-image">
											<span class="instagram"><i class="fa fa-instagram"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
							</div>
							<div class="row-fluid">
								<ul class="panel-body recipe_class span4">												
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_google_plus_network" > <?php esc_html_e('Google Plus', 'videogo'); ?> </h3>
										</span>	
										<input type="text" name="videogo_google_plus_network" id="videogo_google_plus_network" value="<?php if(esc_url($videogo_google_plus_network) <> ''){echo esc_url($videogo_google_plus_network);};?>" />
										<div class="admin-social-image">
											<span class="googleplus"><i class="fa fa-google-plus"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_linked_in_network" > <?php esc_html_e('LinkedIn', 'videogo'); ?> </h3>
										</span>	
										<input type="text" name="videogo_linked_in_network" id="videogo_linked_in_network" value="<?php if(esc_url($videogo_linked_in_network) <> ''){echo esc_url($videogo_linked_in_network);};?>" />
										<div class="admin-social-image">
											<span class="linkedin"><i class="fa fa-linkedin"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width">
									<span class="panel-title">
										<h3 for="videogo_youtube_network" > <?php esc_html_e('Youtube', 'videogo'); ?> </h3>
									</span>
										<input type="text" name="videogo_youtube_network" id="videogo_youtube_network" value="<?php if(esc_url($videogo_youtube_network) <> ''){echo esc_url($videogo_youtube_network);};?>" />
										<div class="admin-social-image">
											<span class="youtube"><i class="fa fa-youtube"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
							</div>
							<div class="row-fluid">
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_flickr_network" > <?php esc_html_e('Flickr', 'videogo'); ?> </h3>
										</span>	
										<input type="text" name="videogo_flickr_network" id="videogo_flickr_network" value="<?php if(esc_url($videogo_flickr_network) <> ''){echo esc_url($videogo_flickr_network);};?>" />
										<div class="admin-social-image">
											<span class="flickr"><i class="fa fa-flickr"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_vimeo_network" > <?php esc_html_e('Vimeo', 'videogo'); ?> </h3>
										</span>		
										<input type="text" name="videogo_vimeo_network" id="videogo_vimeo_network" value="<?php if(esc_url($videogo_vimeo_network) <> ''){echo esc_url($videogo_vimeo_network);};?>" />
										<div class="admin-social-image">
											<span class="vimeo"><i class="fa fa-vimeo-square"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">		
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_pinterest_network" > <?php esc_html_e('Pinterest', 'videogo'); ?> </h3>
										</span>	
										<input type="text" name="videogo_pinterest_network" id="videogo_pinterest_network" value="<?php if(esc_url($videogo_pinterest_network) <> ''){echo esc_url($videogo_pinterest_network);};?>" />
										<div class="admin-social-image">
											<span class="pinterest"><i class="fa fa-pinterest"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>	
							</div>
							<div class="row-fluid">
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3> <?php esc_html_e('Github', 'videogo'); ?> </h3>
										</span>		
										<input type="text" name="videogo_github_network" id="videogo_github_network" value="<?php if(esc_url($videogo_github_network) <> ''){echo esc_url($videogo_github_network);};?>" />
										<div class="admin-social-image">
											<span class="github"><i class="fa fa-github"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
									<span class="panel-title">
										<h3> <?php esc_html_e('Skype', 'videogo'); ?> </h3>
									</span>	
										<input type="text" name="videogo_skype_network" id="videogo_skype_network" value="<?php if(esc_url($videogo_skype_network) <> ''){echo esc_url($videogo_skype_network);};?>" />
										<div class="admin-social-image">
											<span class="skype"><i class="fa fa-skype"></i></span>
										</div>
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>
									</li>
								</ul>	
								<ul class="panel-body recipe_class span4">										
									<li class="panel-input full-width ">										
										<span class="panel-title">										
											<h3> <?php esc_html_e('Dribble', 'videogo'); ?> </h3>		
										</span>												
										<input type="text" name="videogo_dribble_network" id="videogo_dribble_network" value="<?php if(esc_url($videogo_dribble_network) <> ''){echo esc_url($videogo_dribble_network);};?>" />											
										<div class="admin-social-image">												
											<span class="dribble"><i class="fa fa-dribbble"></i></span>								
										</div>											
										<p> <?php esc_html_e('Please paste your Profile URl','videogo');?> </p>	
									</li>									
								</ul>	
							</div>																								
						</li>
						<!-- ************** Social Sharing Buttons/Switches ***************** --->
						<li id="social_sharing" class="social_sharing_class">
							<div class="row-fluid">
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_facebook_sharing" > <?php esc_html_e('Facebook Sharing', 'videogo'); ?> </h3>
										</span>
										<label for="videogo_facebook_sharing">
											<div class="checkbox-switch <?php echo (esc_attr($videogo_facebook_sharing) =='enable' || (esc_attr($videogo_facebook_sharing) ==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
										</label>
										<input type="checkbox" name="videogo_facebook_sharing" class="checkbox-switch" value="disable" checked>
										<input type="checkbox" name="videogo_facebook_sharing" id="videogo_facebook_sharing" class="checkbox-switch" value="enable" <?php	echo (esc_attr($videogo_facebook_sharing) =='enable' || (esc_attr($videogo_facebook_sharing) ==''))? 'checked': '';?>>
										<div class="admin-social-image">
											<span class="facebook">&nbsp;</span>
										</div>
										<p> <?php esc_html_e('Please turn On/Off sharing on Post Detail Page.','videogo');?></p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_twitter_sharing" > <?php esc_html_e('Twitter Sharing', 'videogo'); ?> </h3>
										</span>	
										<label for="videogo_twitter_sharing">
											<div class="checkbox-switch <?php echo (esc_attr($videogo_twitter_sharing) =='enable' || (esc_attr($videogo_twitter_sharing) ==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
										</label>
										<input type="checkbox" name="videogo_twitter_sharing" class="checkbox-switch" value="disable" checked>
										<input type="checkbox" name="videogo_twitter_sharing" id="videogo_twitter_sharing" class="checkbox-switch" value="enable" <?php	echo (esc_attr($videogo_twitter_sharing) =='enable' || (esc_attr($videogo_twitter_sharing) ==''))? 'checked': '';?>>
										<div class="admin-social-image">
											<span class="twitter">&nbsp;</span>
										</div>
										<p> <?php esc_html_e('Please turn On/Off sharing on Post Detail Page.','videogo');?> </p>
									</li>
								</ul>
								<ul class="panel-body recipe_class span4">
									<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="videogo_googleplus_sharing" > <?php esc_html_e('Googleplus Sharing', 'videogo'); ?> </h3>
										</span>
										<label for="videogo_googleplus_sharing">
											<div class="checkbox-switch <?php echo (esc_attr($videogo_googleplus_sharing) =='enable' || (esc_attr($videogo_googleplus_sharing) ==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
										</label>
										<input type="checkbox" name="videogo_googleplus_sharing" class="checkbox-switch" value="disable" checked>
										<input type="checkbox" name="videogo_googleplus_sharing" id="videogo_googleplus_sharing" class="checkbox-switch" value="enable" <?php	echo (esc_attr($videogo_googleplus_sharing) =='enable' || (esc_attr($videogo_googleplus_sharing) ==''))? 'checked': '';?>>
										<div class="admin-social-image">
											<span class="googleplus">&nbsp;</span>
										</div>
										<p> <?php esc_html_e('Please turn On/Off sharing on Post Detail Page.','videogo');?> </p>
									</li>
								</ul>										
							</div>								
						</li>
						<div class="panel-element-tail">
							<div class="tail-save-changes">
								<div class="loading-save-changes"></div>
								<input type="submit" value="<?php echo esc_html_e('Save Changes','videogo') ?>">
								<input type="hidden" name="action" value="social_settings">
								
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