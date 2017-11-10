<?php
	/*	
	*	CrunchPress Meta Template File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the template of meta box for each input type.
	* 	The framework will use it when create meta box for each post_type.
	*	---------------------------------------------------------------------
	*/
	
	/* Decide to print each meta box type */
	function videogo_print_meta($videogo_meta_box){
		if(empty($videogo_meta_box['default'])) $videogo_meta_box['default'] = '';
		
		switch(@$videogo_meta_box['type']){
		
			case "open" : videogo_print_meta_open_div($videogo_meta_box); break;
			case "close" : videogo_print_meta_close_div($videogo_meta_box); break;
			case "header": videogo_print_meta_header($videogo_meta_box); break;
			case "text": videogo_print_meta_text($videogo_meta_box); break;
			case "description": videogo_print_description($videogo_meta_box); break;
			case "inputtext": videogo_print_meta_input_text($videogo_meta_box); break;
			case "upload": videogo_print_meta_upload($videogo_meta_box); break;
			case "textarea": videogo_print_meta_input_textarea($videogo_meta_box); break;
			case "checkbox": videogo_print_meta_input_checkbox($videogo_meta_box); break;
			case "combobox": videogo_print_meta_input_combobox($videogo_meta_box); break;
			case "combobox_category": videogo_print_meta_input_combobox_category($videogo_meta_box); break;
			case "combobox_category_main": videogo_print_meta_input_combobox_category_main($videogo_meta_box); break;
			case "combobox_post": videogo_print_meta_input_combobox_post($videogo_meta_box); break;
			case "combobox_revolution": videogo_print_meta_input_combobox_revolution($videogo_meta_box); break;
			case "combobox_owl": videogo_print_meta_input_combobox_owl($videogo_meta_box); break;
			case "combobox_latest": videogo_print_meta_input_combobox_latest($videogo_meta_box); break;
			case "combobox_latest_filter": videogo_print_meta_input_combobox_latest_filter($videogo_meta_box); break;
			case "combobox_latest_filter_category": videogo_print_meta_input_combobox_latest_filter_category($videogo_meta_box); break;
			case "combobox_number_of_post": videogo_print_meta_input_combobox_number_of_post($videogo_meta_box); break;
			case "radioenabled": videogo_print_meta_input_radioenabled($videogo_meta_box); break;
			case "radioimage": videogo_print_meta_input_radioimage($videogo_meta_box); break;
			case "imagepicker": videogo_print_image_picker($videogo_meta_box); break;
			case "image": videogo_print_set_image_picker($videogo_meta_box); break;
			case "colorpicker": videogo_print_set_color_picker($videogo_meta_box); break;
		} 
		
	}
	
	/* Setting Nonce */
	function videogo_set_nonce(){
	
		wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename');
		
	}
	
	/* Only Stub */
	function videogo_print_set_image_picker(){
	
		/* Yet To implement */
	}
	
	/* Select Color */
	function videogo_print_set_color_picker($videogo_meta_box){
	
	extract($videogo_meta_box); ?>
	
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>" ><?php echo esc_attr($title); ?></label>
				</div>
			
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<input class="color-picker" type="text" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="<?php 
						echo ($value == '')? esc_html($default): esc_html($value);
						?>" />
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"> <?php echo esc_attr($description); ?> </div>
				<?php } ?>
			</div>
	<?php
	
	}
	
	
	/* header => name, title */
	function videogo_print_meta_header($args){
	
		extract($args);
		$meta_id = (isset($meta_id))? $meta_id : '';
		if($inner == 'Yes'){echo '</div>';}
		?>	
			
			<div id="meta-header" class="<?php echo 'cp-options-'.esc_attr($class); ?>">
				<h2 class="heading"><span class="font-aw-hr"><i class="fa fa-hand-up"></i></span><?php echo esc_attr($title); ?></h2>
				<a id="no-active" class="<?php echo 'cp-options-'.esc_attr($class); ?>"><span class="font-aw"><i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i></span></a>
			</div>
			
		<?php 
		if($inner == 'Yes'){echo '<div id="cp-options-'.esc_attr($class).'" class="container-fluid">';}
		
	}
	/* text => name, text */
	function videogo_print_meta_text($args){
	
		extract($args); ?>
			<div class="meta-body span4">
				<div class="meta-title pb10">
					<?php echo esc_attr($title);?>
				</div>
			</div>
			
		<?php 
	}
	
	/* text => name, title, value, default */
	function videogo_print_meta_input_text($videogo_args){
		
		$class = '';
		extract($videogo_args); ?>
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>" ><?php echo esc_attr($title); ?></label>
				</div>
			
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<input type="text" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="<?php 
						echo ($value == '')? esc_html($default): esc_html($value);
						?>" />
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"> <?php echo esc_attr($description); ?> </div>
				<?php } ?>
			</div>
			
		<?php
		
	}
	/* text => name, title, value, default */
	function videogo_print_description($videogo_args){
		
		extract($videogo_args); ?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label><?php echo esc_attr($title); ?></label>
				</div>
				<div class="only-description"> <?php echo esc_attr($description); ?> </div>
				
			</div>
			
		<?php
		
	}	
		
	/* text => name, title, value */
	function videogo_print_meta_upload($videogo_args){
	
		extract($videogo_args); ?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>" ><?php echo esc_attr($title); ?></label>
				</div>
				
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="meta-input-example-image" id="meta-input-example-image">
						<?php 
							$videogo_image_src = '';
							if(!empty($value)){
							
								$videogo_image_src = wp_get_attachment_image_src( $value, array(60,60) );
								$videogo_thumb_src_preview = wp_get_attachment_image_src( $value, array(60,60));
								echo '<img src="' . esc_url($videogo_thumb_src_preview[0]) . '" />';
							} 
							
						?>		
					</div>
					<input name="<?php echo esc_attr($name); ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
						echo (empty($value))? esc_html($default): esc_html($value);
					?>" />
					<input id="upload_image_text_meta" class="upload_image_text_meta" type="text" value="<?php echo (empty($videogo_image_src[0]))? '': $videogo_image_src[0]; ?>" />
					<input class="upload_image_button_meta" type="button" value="Upload" />
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	/* textarea => name, title, value, default */
	function videogo_print_meta_input_textarea($videogo_args){
	
		extract($videogo_args); ?>
			<div class="meta-body <?php if(isset($class) AND $class == 'cp-full-width'){echo 'span12';}else{echo 'span4';}?> <?php echo str_replace('[]','',$name); ?>-wrapper">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';}?>">
					<textarea name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" class="<?php echo str_replace('[]','',$name); ?>"><?php
						echo ($value == '')? esc_html($default): esc_html($value);
					?></textarea>
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	/*  checkbox => name, title, value */
	function videogo_print_meta_input_checkbox($args){
	
		extract($args); ?>
		
			<div class="meta-body span4">
			
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<?php echo esc_html__('Not yet implement','videogo'); ?>
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
				
			</div>
			
		<?php
	}	
	
	/* combobox => name, title, value, options[] */
	function videogo_print_meta_input_combobox($videogo_args){
		
		$class= '';
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
		
			<div class="meta-body <?php if($class == 'full-width'){echo 'cp-full-width';}else{echo 'span4';}?>">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class) AND $class <> 'full-width'){echo esc_attr($class);}else{$class = '';};?>">	
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<?php 
							foreach($options as $option){ ?>
								<option rel="<?php echo esc_attr($option) ; ?>" <?php if( $option==esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	
	
	/* combobox => name, title, value, options[] */
	function videogo_print_meta_input_combobox_category($videogo_args){
	
		extract($videogo_args);
		if($value <> ''){
			$fetched_value = $value;
		}else{
			$fetched_value = '';
		}
		?>
			
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0" rel="0" <?php if( esc_html($fetched_value) == '0' ){ echo 'selected'; }?> ><?php echo esc_html__('All','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->term_id); ?>" rel="<?php echo esc_attr($option->term_id); ?>" <?php if( $option->term_id == esc_html($fetched_value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->name) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	
	
	
	/* combobox => name, title, value, options[] */
	function videogo_print_meta_input_combobox_category_main($videogo_args){
	
		extract($videogo_args);
		if($value <> ''){
			$fetched_value = $value;
		}else{
			$fetched_value = '';
		}
		?>
			
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="78612" rel="78612" <?php if( esc_html($fetched_value) == '78612' ){ echo 'selected'; }?> ><?php echo esc_html__('All','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->term_id); ?>" rel="<?php echo esc_attr($option->term_id); ?>" <?php if( $option->term_id == esc_html($fetched_value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->name) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	
	
	/* combobox => name, title, value, options[] */
	function videogo_print_meta_input_combobox_post($videogo_args){
	
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0"><?php echo esc_html__('--Select Any--','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->ID) ; ?>" rel="<?php echo esc_attr($option->ID) ; ?>" <?php if( $option->ID == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->post_title) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	function videogo_print_meta_input_combobox_revolution($videogo_args){
	
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0"><?php echo esc_html__('--Select Any--','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->id) ; ?>" rel="<?php echo esc_attr($option->id) ; ?>" <?php if( $option->id == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->alias) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	function videogo_print_meta_input_combobox_owl($videogo_args){
	
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0"><?php echo esc_html__('--Select Any--','videogo'); ?></option>
							<?php foreach($options as $key=>$option){ ?>
								<option value="<?php echo esc_attr($option) ; ?>" rel="<?php echo esc_attr($option) ; ?>" <?php if( $option == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($key) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	function videogo_print_meta_input_combobox_latest($videogo_args){
	
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0" rel="0"><?php echo esc_html__('--Select Any--','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option) ; ?>" rel="<?php echo esc_attr($option) ; ?>" <?php if( $option == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	function videogo_print_meta_input_combobox_latest_filter($videogo_args){
	
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0"><?php echo esc_html__('--Select Any--','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option) ; ?>" rel="<?php echo esc_attr($option) ; ?>" <?php if( $option == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	function videogo_print_meta_input_combobox_latest_filter_category($videogo_args){
	
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0"><?php echo esc_html__('--Select Any--','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->term_id) ; ?>" rel="<?php echo esc_attr($option->term_id) ; ?>" <?php if( $option->term_id == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->name) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	function videogo_print_meta_input_combobox_number_of_post($videogo_args){
		
		extract($videogo_args);
		
		$value = (empty($value))? $default: $value; ?>
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0"><?php echo esc_html__('--Select Any--','videogo'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option) ; ?>" rel="<?php echo esc_attr($option) ; ?>" <?php if( $option == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
	}
	
	/* radioenabled => name, title, value */
	function videogo_print_meta_input_radioenabled($videogo_args){
	
		extract($videogo_args); ?>
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<input type="radio" name="<?php echo esc_attr($name); ?>" value="enabled" <?php if($value=='enabled' || $value=='') echo 'checked'; ?>><?php echo esc_html__('Enable','videogo'); ?>  &nbsp&nbsp&nbsp
					<input type="radio" name="<?php echo esc_attr($name); ?>" value="disable" <?php if($value=='disable') echo 'checked'; ?>><?php echo esc_html__('Disable','videogo'); ?> 
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	
	
	/* radioimage => name, title, type, value, option=>array(value, image) */
	function videogo_print_meta_input_radioimage($videogo_args){
	
		extract($videogo_args); ?>
		
			<div class="meta-body span12">
				
				<div class="meta-input row-fluid">
					<?php foreach( $options as $option ){ ?>
						<div class='radio-image-wrapper span2'>
						<span class="head-sec-sidebar"><?php echo str_replace('-',' ',$option['value']); ?></span>
							<label for="<?php echo esc_attr($option['value']); ?>">
								<img src=<?php echo VIDEOGO_PATH_URL.$option['image']?> alt=<?php echo esc_attr($name);?>>
								<div id="check-list"></div>
							</label>
							<input type="radio" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($option['value']);?>" <?php 
								if($value == $option['value']){
									echo 'checked';
								}else if($value == '' && $default == $option['value']){
									echo 'checked';
								}
							?> id="<?php echo esc_attr($option['value']); ?>" class="<?php echo esc_attr($name); ?>" > 
						</div>
					<?php } ?>
					
				</div>
				
			</div>
		<?php
	}	
	
	/* imagepicker => title, name=>array(num,image,title,caption,link) */
	function videogo_print_image_picker($videogo_args){
		
		extract($videogo_args); ?>
			
			<div class="meta-body image-picker-wrapper">
				<div class="meta-input-slider">
					<div class="image-picker" id="image-picker">
						<input type='hidden' class="slider-num" id="slider-num" name='<?php 
							echo (isset($name['slider-num']))? $name['slider-num'] . '[]' : '' ; 
						?>' value=<?php 
							echo empty($value)? 0: $value->childNodes->length;
						?> />
						<div class="selected-image" id="selected-image">
							<div id="selected-image-none"><?php echo esc_html__('No Gallery Items Inserted','videogo'); ?></div>
							<ul>
								<li id="default" class="default">
									<div class="selected-image-wrapper">
										<img src="" alt="<?php esc_html('image','videogo');?>" />
										<div class="selected-image-element">
											<div id="edit-image" class="edit-image"></div>
											<div id="unpick-image" class="unpick-image"></div>
											<br class="clear">
										</div>
									</div>
									<input type="hidden" class='slider-image-url' id='<?php echo esc_attr($name['image']); ?>' />
									<div id="slider-detail-wrapper" class="slider-detail-wrapper">
									<div id="slider-detail" class="slider-detail"> 	
										<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER TITLE', 'videogo'); ?></div> 
										<div class="meta-detail-input meta-input"><input type="text" id='<?php echo esc_attr(esc_html($name['title'])); ?>' /></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'videogo'); ?></div>
										<div class="meta-detail-input meta-input"><textarea id='<?php echo esc_attr(esc_html($name['caption'])); ?>' ></textarea></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php esc_html_e('LINK TYPE', 'videogo'); ?></div> 
										<div class="meta-input meta-detail-input">
											<div class="combobox">
												<select id='<?php echo esc_attr($name['linktype']); ?>'>
													<option selected ><?php echo esc_html__('No Link','videogo'); ?></option>
													<option><?php echo esc_html__('Lightbox','videogo'); ?></option>
													<option><?php echo esc_html__('Link to URL','videogo'); ?></option>	
													<option><?php echo esc_html__('Link to Video','videogo'); ?></option>
												</select>
											</div>
											<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php esc_html_e('URL PATH', 'videogo'); ?></div> 
											<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php esc_html_e('VIDEO PATH (ONLY FOR ANYTHING SLIDER)', 'videogo'); ?></div> 
											<div><input class="mt10" type="text"  id='<?php echo esc_attr($name['link']); ?>' /></div>
										</div>
										<br class="clear">
										<div class="meta-detail-done-wrapper">
											<input type="button" id="cp-detail-edit-done" class="cp-button" value="Done" /><br class="clear">
										</div>
									</div>
									</div>
								</li>
								
								<?php 								
									if(!empty($value)){
										
										foreach ($value->childNodes as $slider){ ?> 
										
											<li class="slider-image-init">
												<div class="selected-image-wrapper">
													<img src="<?php 
													
														$videogo_thumb_src_preview = wp_get_attachment_image_src( videogo_find_xml_value($slider, 'image'), '160x110');
														echo esc_url($videogo_thumb_src_preview[0]); 
														
													?>"/>
													<div class="selected-image-element">
														<div id="edit-image" class="edit-image"></div>
														<div id="unpick-image" class="unpick-image"></div>
														<br class="clear">
													</div>
												</div>
												<input type="hidden" class='slider-image-url' name='<?php echo esc_attr($name['image']); ?>[]' id='<?php echo esc_attr($name['image']); ?>[]' value="<?php echo esc_url(videogo_find_xml_value($slider, 'image')); ?>" /> 
												<div id="slider-detail-wrapper" class="slider-detail-wrapper">
												<div id="slider-detail" class="slider-detail">								
													<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER TITLE', 'videogo'); ?></div> 
													<div class="meta-detail-input meta-input"><input type="text" name='<?php echo esc_attr($name['title']); ?>[]' id='<?php echo esc_attr($name['title']); ?>[]' value="<?php echo esc_attr(videogo_find_xml_value($slider, 'title')); ?>" /></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'videogo'); ?></div>
													<div class="meta-detail-input meta-input"><textarea name='<?php echo esc_attr($name['caption']); ?>[]' id='<?php echo esc_attr($name['caption']); ?>[]' ><?php echo esc_attr(videogo_find_xml_value($slider, 'caption')); ?></textarea></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php esc_html_e('LINK TYPE', 'videogo'); ?></div>
													<div class="meta-input meta-detail-input">
														<div class="combobox">
															<?php $linktype_val =  videogo_find_xml_value($slider, 'linktype'); ?>
															<select name='<?php echo esc_attr($name['linktype']); ?>[]' id='<?php echo esc_attr($name['linktype']); ?>' >
																<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> ><?php echo esc_html__('No Link','videogo'); ?></option>
																<option <?php echo ($linktype_val == 'Lightbox')? "selected" : ''; ?>><?php echo esc_html__('Lightbox','videogo'); ?></option>
																<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>><?php echo esc_html__('Link to URL','videogo'); ?></option>
																<option <?php echo ($linktype_val == 'Link to Video')?  "selected" : ''; ?>><?php echo esc_html__('Link to Video','videogo'); ?></option>
															</select>
														</div>
														<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php esc_html_e('URL PATH', 'videogo'); ?></div> 
														<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php esc_html_e('VIDEO PATH (ONLY FOR ANYTHING SLIDER)', 'videogo'); ?></div> 
														<div><input class="mt10" type="text" name='<?php echo esc_attr($name['link']); ?>[]' id='<?php echo esc_attr($name['link']); ?>[]' value="<?php echo videogo_find_xml_value($slider, 'link'); ?>" /></div>
													</div>
													
													<br class="clear">
													
													<div class="meta-detail-done-wrapper">
														<input type="button" id="cp-detail-edit-done" class="cp-button" value="Done" /><br class="clear">
													</div>
												</div>
												</div>
												</li> 
												
											<?php
											
										}
										
									}
									
								?>	
								
							</ul>
							
							<div id="show-media" class="show-media">
								<span id="show-media-text"></span>
								<div id="show-media-image"></div>
							</div>
						</div>
						<div class="media-image-gallery-wrapper">
							<div class="media-image-gallery" id="media-image-gallery">
								<?php videogo_get_media_image(); ?>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
<?php }
	/* open => id */
	function videogo_print_meta_open_div($videogo_args){
		
		extract($videogo_args); ?>
		
	<div id="<?php echo esc_attr($id); ?>" class="<?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>" >
	<?php }
	
	/* close */
	function videogo_print_meta_close_div($videogo_args){ ?>		 
		
	</div>			
	<?php }
	
	/* save option function that trigger when saving each post */
	add_action('save_post','videogo_save_option_meta');
	
	function videogo_save_option_meta($post_id){
	
		/* Verification */
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		if(!isset($_POST['myplugin_noncename'])) return;
		if(!wp_verify_nonce($_POST['myplugin_noncename'], plugin_basename( __FILE__ ))) return;
		
		/* Save data of page */
		if('page' == $_POST['post_type']){
			if(!current_user_can('edit_page', $post_id)) return;
			videogo_save_page_option_meta($post_id);
		/* Save data of post */
		}else if('post' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_post_option_meta($post_id);
		}else if('portfolio' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_portfolio_option_meta($post_id);
		}else if('testimonial' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_testimonial_option_meta($post_id);
		}else if('price_table' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_price_table_option_meta($post_id);
		}else if('gallery' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_gallery_option_meta($post_id);
					
		}
	}
	
	/* function that save the meta to database if new data exists and is not equals to old one */
	function videogo_save_meta_data($post_id, $new_data, $old_data, $name){
		if($new_data == $old_data){
			add_post_meta($post_id, $name, $new_data, true);
		}else if(!$new_data){
			delete_post_meta($post_id, $name, $old_data);
		}else if($new_data != $old_data){
			update_post_meta($post_id, $name, $new_data, $old_data);
		}
	}
?>