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
	
	add_action('wp_ajax_typography_settings','videogo_typography_settings');
	
	function videogo_typography_settings(){
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = trim($values);
		}
	
		$videogo_return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');
				
			if(isset($action) AND $action == 'typography_settings'){
				$videogo_typography_xml = '<typography_settings>';
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_font_google',esc_attr($videogo_font_google));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_font_size_normal',esc_attr($videogo_font_size_normal));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_font_google_heading',esc_attr($videogo_font_google_heading));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_menu_font_google',esc_attr($videogo_menu_font_google));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_heading_h1',esc_attr($videogo_heading_h1));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_heading_h2',esc_attr($videogo_heading_h2));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_heading_h3',esc_attr($videogo_heading_h3));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_heading_h4',esc_attr($videogo_heading_h4));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_heading_h5',esc_attr($videogo_heading_h5));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_heading_h6',esc_attr($videogo_heading_h6));
				$videogo_typography_xml = $videogo_typography_xml . videogo_create_xml_tag('videogo_embed_typekit_code',esc_attr($videogo_embed_typekit_code));
				$videogo_typography_xml = $videogo_typography_xml . '</typography_settings>';
	
				$videogo_font_setting_xml = '<typekit_font>';
				
				$videogo_sidebars = $_POST['typekit_font'];
				
				foreach($videogo_sidebars as $keys=>$values){
					$videogo_font_setting_xml = $videogo_font_setting_xml . videogo_create_xml_tag('typekit_font',$values);
				}
				
				$videogo_font_setting_xml = $videogo_font_setting_xml . '</typekit_font>';
				videogo_save_option('typokit_settings', get_option('typokit_settings'), $videogo_font_setting_xml);
				
				
				if(!videogo_save_option('typography_settings', get_option('typography_settings'), $videogo_typography_xml)){
				
					die( json_encode($videogo_return_data) );
					
				}
				
				die(json_encode( array('success'=>'0') ) );
						
			}
		
			$videogo_font_google = '';
			$videogo_font_size_normal = '';
			$videogo_menu_font_google = '';
			$videogo_fonts_array = '';
			$videogo_font_google_heading = '';
			$videogo_heading_h1 = '';
			$videogo_heading_h2 = '';
			$videogo_heading_h3 = '';
			$videogo_heading_h4 = '';
			$videogo_heading_h5 = '';
			$videogo_heading_h6 = '';
			$videogo_embed_typekit_code = '';
			
			$videogo_typography_settings = get_option('typography_settings');
			if($videogo_typography_settings <> ''){
				$videogo_typo = new DOMDocument ();
				$videogo_typo->loadXML ( $videogo_typography_settings );
				$videogo_font_google = esc_attr(videogo_find_xml_value($videogo_typo->documentElement,'videogo_font_google'));
				$videogo_font_size_normal = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_font_size_normal'));
				$videogo_menu_font_google = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_menu_font_google'));
				$videogo_font_google_heading = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_font_google_heading'));
				$videogo_heading_h1 = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_heading_h1'));
				$videogo_heading_h2 = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_heading_h2'));
				$videogo_heading_h3 = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_heading_h3'));
				$videogo_heading_h4 = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_heading_h4'));
				$videogo_heading_h5 = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_heading_h5'));
				$videogo_heading_h6 = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_heading_h6'));
				$videogo_embed_typekit_code = esc_html(videogo_find_xml_value($videogo_typo->documentElement,'videogo_embed_typekit_code'));
			
			}?>		
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
						<li class="font_family" id="active_tab"><?php esc_html_e('Font Family', 'videogo'); ?></li>
						<li class="font_size"><?php esc_html_e('Font Size', 'videogo'); ?></li>
						<li class="type_kit_font"><?php esc_html_e('Type Kit Font', 'videogo'); ?></li>
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
						<div class="panel-element"></div>
						<ul class="typography_class">
							
							<!--- ********** HTML MARKUP : 1 . Font Family Settings ******************* -->
							<li id="font_family" class="active_tab">
								<?php $videogo_fonts_array = videogo_get_font_array();?>
									<ul class="recipe_class row-fluid">
										<li class="panel-input span8">	
											<span class="panel-title">
												<h3 for="videogo_font_google"><?php esc_html_e('Font Family', 'videogo'); ?></h3>
											</span>
											<div class="combobox">
												<select class="videogo_font_google" name="videogo_font_google" id="videogo_font_google">
													<option <?php if( esc_attr($videogo_font_google) == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','videogo');?> </h3></option>
													<optgroup label="GOOGLE FONT">
														<?php 
															foreach($videogo_fonts_array as $font_key =>$font_value){ 
																if(esc_attr($font_value['type']) == 'Google Font'){ ?>
																	<option <?php if( esc_attr($videogo_font_google) == esc_html($font_key) ){ echo 'selected'; }?>><?php echo esc_attr($font_key); ?></option>
																<?php
																}
															}	
														?>
													</optgroup>		
													<!--Typekit Font Start -->
													<optgroup label="Typekit font">
														<?php
														$videogo_fonts_arr = videogo_get_font_array();
														foreach($videogo_fonts_arr as $keys=>$values){
															if(esc_attr($values['type']) == 'Used font'){ ?>
																<option <?php if( esc_attr($videogo_font_google) == esc_html($keys) ){ echo 'selected'; }?>><?php echo esc_attr($keys); ?></option>
																<?php
															}
														}?>
													</optgroup>							
												</select>
											</div>
											<span class="description "><?php esc_html_e('Please Select font family from dropdown for website body text.','videogo');?></span>
										</li>
										<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','videogo');?></p></li>
									</ul>
								
									<ul class="recipe_class row-fluid">
										<li class="panel-input span8">							
											<span class="panel-title">
												<h3 for="videogo_font_google_heading"><?php esc_html_e('Font Family Headings', 'videogo'); ?></h3>
											</span>
											<div class="combobox">
												<select class="font_google" name="videogo_font_google_heading" id="videogo_font_google_heading">
													<option <?php if( esc_attr($videogo_font_google_heading) == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','videogo');?> </h3></option>
													<optgroup label="GOOGLE FONT">
													<?php 
														foreach($videogo_fonts_array as $font_key =>$font_value){ 
																if(esc_attr($font_value['type']) == 'Google Font'){ ?>
																<option <?php if( esc_attr($videogo_font_google_heading) == esc_attr($font_key) ){ echo 'selected'; }?>><?php echo esc_html($font_key); ?></option>
															<?php
															}
														}	
													?>
													<optgroup label="Typekit font">
													<?php
														$videogo_fonts_arr = videogo_get_font_array();
														foreach($videogo_fonts_arr as $keys=>$values){
															if(esc_attr($values['type']) == 'Typekit font'){ ?>
																<option <?php if( esc_attr($videogo_font_google_heading) == esc_attr($keys) ){ echo 'selected'; }?>><?php echo esc_attr($keys); ?></option>
																<?php
															}
														}?>
													</optgroup>							
												</select>
											</div>
											<span class="description"><?php esc_html_e('Please select font family from dropdown for website Headings.','videogo');?></span>
										</li>
										<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','videogo');?></p></li>
									</ul>
									
									<ul class="recipe_class row-fluid">							
										<li class="panel-input span8">	
											<span class="panel-title">
												<h3 for="videogo_menu_font_google"><?php esc_html_e('Menu Font Family', 'videogo'); ?></h3>
											</span>
											<div class="combobox">
												<select class="font_google" name="videogo_menu_font_google" id="videogo_menu_font_google">
													<option <?php if( esc_attr($videogo_menu_font_google) == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','videogo');?> </h3></option>
													
													<div class="clear"></div>
													<optgroup label="GOOGLE FONT">
													<?php 
														foreach($videogo_fonts_array as $font_key =>$font_value){ 
															if(esc_attr($font_value['type']) == 'Google Font'){ ?>
																<option <?php if( esc_attr($videogo_menu_font_google) == esc_attr($font_key) ){ echo 'selected'; }?>><?php echo esc_attr($font_key); ?></option>
															<?php
															}
														}	
													?>
													</optgroup>		
													<optgroup label="Typekit font">
													<?php
														$videogo_fonts_arr = videogo_get_font_array();
														foreach($videogo_fonts_arr as $keys=>$values){
															if(esc_attr($values['type']) == 'Typekit font'){ ?>
																<option <?php if( esc_attr($videogo_menu_font_google) == esc_html($keys) ){ echo 'selected'; }?>><?php echo esc_attr($keys); ?></option>
																<?php
															}
														}
													?>
													</optgroup>							
												</select>
											</div>
											<span class="description"><?php esc_html_e('Please Select font family from dropdown for website Menu.','videogo');?></span>
										</li>
										<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','videogo');?></p></li>
									</ul>
							</li>
							
							<!--- ********** HTML MARKUP : 2 . Font Size Settings ******************* -->
							<li id="font_size">
								<h3><?php esc_attr_e('Font Size Settings','videogo');?></h3>
									<ul class="panel-body recipe_class row-fluid">
										<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="heading_h1" > <?php esc_html_e('Body Font Size', 'videogo'); ?> </h3>
											</span>
											<div id="font_size_normal" class="sliderbar" rel="sliderbar"></div>
											<input type="hidden" name="font_size_normal" value="<?php echo esc_attr($videogo_font_size_normal);?>">
											<span class="description"><?php esc_html_e('Please manage font body size for your website body text.','videogo');?></span>
										</li>
										<li class="span4" id="slidertext"><p><?php echo esc_attr($videogo_font_size_normal);?><?php esc_html_e('px','videogo');?></p></li>
									</ul>
								
									<ul class="panel-body recipe_class row-fluid">
										<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="videogo_heading_h1" > <?php esc_html_e('Heading H1 Size', 'videogo'); ?> </h3>
											</span>	
											<div id="videogo_heading_h1" class="sliderbar" rel="sliderbar"></div>
											<input type="hidden" name="videogo_heading_h1" value="<?php echo esc_attr($videogo_heading_h1);?>">
											<span class="description"><?php esc_html_e('Please manage font size for website Heading - h1','videogo');?></span>
										</li>
										<li class="span4" id="slidertext"><p><?php echo esc_attr($videogo_heading_h1);?><?php esc_html_e('px','videogo');?></p></li>		
										
									</ul>
								
									<ul class="panel-body recipe_class row-fluid">
										
										<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="videogo_heading_h2" > <?php esc_html_e('Heading H2 Size', 'videogo'); ?> </h3>
											</span>	
											<div id="videogo_heading_h2" class="sliderbar" rel="sliderbar"></div>
											<input type="hidden" name="videogo_heading_h2" value="<?php echo esc_attr($videogo_heading_h2);?>">
											<span class="description"><?php esc_html_e('Please manage font size for website Heading - h2','videogo');?></span>
										</li>
										<li class="span4" id="slidertext"><p><?php echo esc_attr($videogo_heading_h2);?><?php esc_html_e('px','videogo');?></p></li>
									</ul>
									
									<ul class="panel-body recipe_class row-fluid">
										<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="videogo_heading_h3" > <?php esc_html_e('Heading H3 Size', 'videogo'); ?> </h3>
											</span>	
											<div id="videogo_heading_h3" class="sliderbar" rel="sliderbar"></div>
											<input type="hidden" name="videogo_heading_h3" value="<?php echo esc_attr($videogo_heading_h3);?>">
											<span class="description"><?php esc_html_e('Please manage font size for website Heading - h3','videogo');?> </span>
										</li>
										<li class="span4" id="slidertext"><p><?php echo esc_attr($videogo_heading_h3);?><?php esc_html_e('px','videogo');?></p></li>
									</ul>
							
									<ul class="panel-body recipe_class row-fluid">
										<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="videogo_heading_h4" > <?php esc_html_e('Heading H4 Size', 'videogo'); ?> </h3>
											</span>	
											<div id="videogo_heading_h4" class="sliderbar" rel="sliderbar"></div>
											<input type="hidden" name="videogo_heading_h4" value="<?php echo esc_attr($videogo_heading_h4);?>">
											<span class="description"><?php esc_html_e('Please manage font size for website Heading - h4','videogo');?></span>
										</li>
										<li class="span4" id="slidertext"><p><?php echo esc_attr($videogo_heading_h4);?><?php esc_html_e('px','videogo');?></p></li>
									</ul>
									
									<ul class="panel-body recipe_class row-fluid">
										<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="videogo_heading_h5" > <?php esc_html_e('Heading H5 Size', 'videogo'); ?> </h3>
											</span>
											<div id="videogo_heading_h5" class="sliderbar" rel="sliderbar"></div>
											<input type="hidden" name="videogo_heading_h5" value="<?php echo esc_attr($videogo_heading_h5);?>">
											<span class="description"><?php esc_html_e('Please manage font size for website Heading - h5','videogo');?></span>
										</li>
										<li class="span4" id="slidertext"><p><?php echo esc_attr($videogo_heading_h5);?><?php esc_html_e('px','videogo');?></p> </li>
									</ul>
								
									<ul class="panel-body recipe_class row-fluid">
										<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="videogo_heading_h6" > <?php esc_html_e('Heading H6 Size', 'videogo'); ?> </h3>
											</span>	
											<div id="videogo_heading_h6" class="sliderbar" rel="sliderbar"></div>
											<input type="hidden" name="videogo_heading_h6" value="<?php echo esc_attr($videogo_heading_h6);?>">
											<span class="description"><?php esc_html_e('Please manage font size for website Heading - h6','videogo');?></span>
										</li>
										<li class="span4" id="slidertext"><p><?php echo esc_attr($videogo_heading_h6);?><?php esc_html_e('px','videogo');?></p></li>
									</ul>					
							</li>	
							
							<!--- ********** HTML MARKUP : 3 . TypeKit Font Settings ******************* -->
							
							<li id="type_kit_font">
								<div class="typekit_font_class">
									<h3> <?php esc_html_e('Typekit Font Upload Settings','videogo');?> </h3>
									<div class="type_kit">
										<ul class="panel-body recipe_class row-fluid">
											<li class="panel-input span8">
											<span class="panel-title">
												<h3 for="videogo_embed_typekit_code" > <?php esc_html_e('TYPEKIT EMBED CODE', 'videogo'); ?> </h3>
											</span>	
												<textarea name="videogo_embed_typekit_code" id="videogo_embed_typekit_code" ><?php echo (esc_attr($videogo_embed_typekit_code) == '')? esc_attr($videogo_embed_typekit_code): esc_attr($videogo_embed_typekit_code);?></textarea>
											</li>
											<li class="span4 right-box-sec"><p><?php esc_html_e('Please paste TypeKit Embeded Code JavaScript Here.','videogo');?></p></li>
										</ul>
										
									</div>
								</div>
							</li>
						</ul>			
			            <div class="clear"></div>
						<div class="panel-element-tail">
						  <div class="tail-save-changes">
							<div class="loading-save-changes"></div>
							<input type="submit" value="<?php echo esc_html_e('Save Changes','videogo') ?>">
							<input type="hidden" name="action" value="typography_settings">
							
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
