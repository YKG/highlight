<?php
//Condition for Parent Class
if(class_exists('videogo_function_library')){
	
	add_action( 'plugins_loaded', 'slider_fun_override' );
	function slider_fun_override() {
		$slider_class = new videogo_slider_class;
	}

	class videogo_slider_class extends videogo_function_library{
	
		/* Define Parameters of Size*/
		public function page_builder_size_class(){
		
			
		}

		public function __construct(){
			add_action( 'init', array( $this, 'videogo_create_slider' ) );
			add_action( 'add_meta_boxes', array( $this, 'videogo_add_slider_option' ) );
			add_action( 'save_post', array( $this, 'videogo_save_slider_option_meta' ) );
		}

		public function videogo_create_slider() {
		
			$labels = array(
				'name' => _x('Slider', 'Slider General Name', 'videogo'),
				'singular_name' => _x('Slider Item', 'Slider Singular Name', 'videogo'),
				'add_new' => _x('Add New', 'Add New Slider Name', 'videogo'),
				'add_new_item' => __('Add New Slider', 'videogo'),
				'edit_item' => __('Edit Slider', 'videogo'),
				'new_item' => __('New Slider', 'videogo'),
				'view_item' => '',
				'search_items' => __('Search Slider', 'videogo'),
				'not_found' =>  __('Nothing found', 'videogo'),
				'not_found_in_trash' => __('Nothing found in Trash', 'videogo'),
				'parent_item_colon' => ''
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => '',
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 100,
				"show_in_nav_menus" => false,
				'supports' => array('title','thumbnail','custom-fields'),
				'rewrite' => array('slug' => 'cpslider', 'with_front' => false)
			); 
			  
			register_post_type( 'videogo_slider' , $args);
			
		}
		
		public $slider_meta_box = array(	
			"Slider Picker" => array(
				'type'=>'sliderpicker',
				'title'=> 'SELECT IMAGES',
				'xml'=>'cp-slider-xml',
				'name'=>array(
					'image'=>'slider-option-inside-thumbnail-slider-image',
					'title'=>'slider-option-inside-thumbnail-slider-title',
					'caption'=>'slider-option-cp-slider-caption',
					'subcaption'=>'slider-option-cp-slider-subcaption',
					'link'=>'slider-option-inside-thumbnail-slider-link',
					'contact_url'=>'slider-option-inside-thumbnail-slider-contact_url',
					'linktype'=>'slider-option-inside-thumbnail-slider-linktype',
					
					),
				'hr'=>'none'
			)	
		);
		
		public function page_builder_element_class(){
		
		global $page_meta_boxes;

			$page_meta_boxes['Page Item']['name']['Slider']['slider-slide']['options'] = videogo_function_library::videogo_get_title_list_array('videogo_slider');
			$page_meta_boxes['Top Slider Images']['options'] = videogo_function_library::videogo_get_title_list_array('videogo_slider');
			
			if(class_exists('LS_Sliders')){
				$page_meta_boxes['Page Item']['name']['Slider']['slider-slide-layer']['options'] = videogo_function_library::videogo_layer_slider_id();
				$page_meta_boxes['Top Slider Layer']['options'] = videogo_function_library::videogo_layer_slider_id();
			}
			

			$page_meta_boxes['Page Item']['name']['Slider']['latest-post']['options'] = videogo_function_library::latest_post();
			

			$page_meta_boxes['Page Item']['name']['Slider']['latest-post-filter']['options'] = videogo_function_library::latest_post_filter();
			

			$page_meta_boxes['Page Item']['name']['Slider']['latest-post-filter-category']['options'] = videogo_function_library::latest_post_filter_category();
			$page_meta_boxes['post_slider_category_inner']['options'] = videogo_function_library::latest_post_filter_category();	
			
		}
		
		public function videogo_add_slider_option(){
		
			add_meta_box('videogo_slider_option', __('Slider Images','videogo'), array( $this, 'videogo_add_slider_option_element' ),
				'videogo_slider', 'normal', 'high');
				
		}
		
		public function videogo_add_slider_option_element(){
			$slider_meta_box = $this->slider_meta_box;
			
			global $post;
			echo '<div id="cp-overlay-wrapper">'; ?> 
			
			<div class="gallery-option-meta" id="gallery-option-meta">
			<?php
				foreach($slider_meta_box as $meta_box){
				
					if( $meta_box['type'] == 'sliderpicker' ){
					
						$xml_string = get_post_meta($post->ID, $meta_box['xml'], true);
						if( !empty($xml_string) ){

							$xml_val = new DOMDocument();
							$xml_val->loadXML( $xml_string );
							$meta_box['value'] = $xml_val->documentElement;
							
						}
						self::videogo_print_slider_picker($meta_box);
						
					}else{
					
						$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
						print_meta($meta_box);
					
					}				
					
				}
				
			?> </div> <?php
			
			echo '</div>';
			
		}
		
		public function videogo_save_slider_option_meta($post_id){
			
			$slider_meta_box = $this->slider_meta_box;
			
			$edit_meta_boxes = $slider_meta_box;
			
			/* save */
			foreach ($edit_meta_boxes as $edit_meta_box){
			
				/* save function for slider */
				if( $edit_meta_box['type'] == 'sliderpicker' ){
				
					if(isset($_POST[$edit_meta_box['name']['image']])){
					
						$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;
						
					}else{
					
						$num = -1;
						
					}
					
					$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);
					if(isset($_POST[$edit_meta_box['name']['image']])){
						$slider_xml = "<slider-item>";
						
						for($i=0; $i<=$num; $i++){
						
							$slider_xml = $slider_xml. "<slider>";
							
							$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);
							$slider_xml = $slider_xml. videogo_function_library::videogo_create_xml_tag('image',$image_new);
							
							$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);
							$slider_xml = $slider_xml. videogo_function_library::videogo_create_xml_tag('linktype',$linktype_new);
							
							$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));
							$slider_xml = $slider_xml. videogo_function_library::videogo_create_xml_tag('link',$link_new);
							
							$contact_new = stripslashes($_POST[$edit_meta_box['name']['contact_url']][$i]);
							$slider_xml = $slider_xml. videogo_function_library::videogo_create_xml_tag('contact_url',$contact_new);
							
							
							$title_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['title']][$i]));
							$slider_xml = $slider_xml. videogo_function_library::videogo_create_xml_tag('title',$title_new);
							
							$caption_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['caption']][$i]));
							$slider_xml = $slider_xml. videogo_function_library::videogo_create_xml_tag('caption',$caption_new);

							$sub_caption = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['subcaption']][$i]));
							$slider_xml = $slider_xml. videogo_function_library::videogo_create_xml_tag('subcaption',$sub_caption);
							
							$slider_xml = $slider_xml . "</slider>";
							
						}
						
						$slider_xml = $slider_xml . "</slider-item>";
						videogo_save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);
					}
					
					
				}else{
				
					if(isset($_POST[$edit_meta_box['name']])){
					
						$new_data = stripslashes($_POST[$edit_meta_box['name']]);
						
					}else{
					
						$new_data = '';
						
					}
					
					$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
					save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
					
				}
				
			}
			
		}

		/* gallerypicker => title, name=>array(num,image,title,caption,link) */
		public function videogo_print_slider_picker($args){
		
			extract($args);
			
			global $post;
		?>
			
					<div class="meta-body image-picker-wrapper">
					<div class="meta-input-slider">
						<div class="image-picker" id="image-picker">
							<input type='hidden' class="slider-num" id="slider-num" name='<?php 
							
								echo (isset($name['slider-num']))? $name['slider-num'] . '[]' : '' ; 
							
							?>' value=<?php 
								
								echo empty($value)? 0: $value->childNodes->length;
								
							?> />
							<div class="selected-image" id="selected-image">
								<div id="selected-image-none"><?php esc_html_e('No Image Inserted', 'videogo'); ?></div>
								<ul>
									<li id="default" class="default">
										<div class="selected-image-wrapper">
											<img src="#"/>
											<div class="selected-image-element">
												<div id="edit-image" class="edit-image"></div>
												<div id="unpick-image" class="unpick-image"></div>
												<br class="clear">
											</div>
										</div>
										<input type="hidden" class='slider-image-url' id='<?php echo $name['image']; ?>' />
										
										<div id="slider-detail-wrapper" class="slider-detail-wrapper">									
										<div id="slider-detail" class="slider-detail"> 	
										<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER TITLE', 'videogo'); ?></div> 
											<div class="meta-detail-input meta-input"><input type="text" id='<?php echo $name['title']; ?>' /></div><br class="clear">
											<hr class="separator">
											<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'videogo'); ?></div>
											<div class="meta-detail-input meta-input"><textarea id='<?php echo $name['caption']; ?>' ></textarea></div><br class="clear">
											<hr class="separator">
											<div class="meta-title meta-detail-title"><?php esc_html_e('SUB CAPTION', 'videogo'); ?></div>
											<div class="meta-detail-input meta-input"><textarea id='<?php echo $name['subcaption']; ?>' ></textarea></div><br class="clear">
											<hr class="separator">
											<div class="meta-title meta-detail-title"><?php esc_html_e('LINK TYPE', 'videogo'); ?></div> 
											<div class="meta-input meta-detail-input">
												<div class="combobox">
													<select id='<?php echo $name['linktype']; ?>'>
														<option><?php esc_html_e('No Link', 'videogo'); ?></option>
														<option><?php esc_html_e('Link to URL', 'videogo'); ?></option>	
													</select>
												</div>
											</div><br class="clear">
											<div class="url">
												<div class="meta-title meta-detail-title" rel="url"><?php esc_html_e('URL PATH', 'videogo'); ?></div> 
												<div class="meta-detail-input meta-input"><input class="mt10" type="text"  id='<?php echo $name['link']; ?>' /></div>
											</div>
											<hr class="separator">
											<br class="clear">
											<div class="meta-detail-input meta-input"><input type="text" id='<?php echo $name['contact_url']; ?>' /></div><br class="clear">
											<hr class="separator">
											
											
											<br class="clear">
											<div class="meta-detail-done-wrapper">
												<input type="button" id="cp-detail-edit-done" class="cp-button" value="Done" /><br class="clear">
											</div>
												<input type="hidden" id="cp-detail-edit-done" class="cp-button" name="submit_button" value="submit_button" /><br class="clear">
										</div>
										</div>
									</li>
									
									<?php 
									
										if(!empty($value)){
											
											foreach ($value->childNodes as $slider){ ?> 
											
												<li class="slider-image-init">
													<div class="selected-image-wrapper">
														<img src="<?php 
														
															$videogo_thumb_src_preview = wp_get_attachment_image_src( videogo_function_library::videogo_find_xml_value($slider, 'image'), '160x110');
															echo $videogo_thumb_src_preview[0]; 
															
														?>"/>
														<div class="selected-image-element">
															<div id="edit-image" class="edit-image"></div>
															<div id="unpick-image" class="unpick-image"></div>
															<br class="clear">
														</div>
													</div>
													<input type="hidden" class='slider-image-url' name='<?php echo esc_attr($name['image']); ?>[]' id='<?php echo $name['image']; ?>[]' value="<?php echo videogo_find_xml_value($slider, 'image'); ?>" /> 
													<div id="slider-detail-wrapper" class="slider-detail-wrapper">
													<div id="slider-detail" class="slider-detail">
														<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER TITLE', 'videogo'); ?></div> 
														<div class="meta-detail-input meta-input"><input type="text" name='<?php echo esc_attr($name['title']); ?>[]' id='<?php echo $name['title']; ?>[]' value="<?php echo videogo_find_xml_value($slider, 'title'); ?>" /></div><br class="clear">
														<hr class="separator">
														<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'videogo'); ?></div>
														<div class="meta-detail-input meta-input"><textarea name='<?php echo esc_textarea ($name['caption']); ?>[]' id='<?php echo $name['caption']; ?>[]' ><?php echo videogo_find_xml_value($slider, 'caption'); ?></textarea></div><br class="clear">
														<hr class="separator">
														<div class="meta-title meta-detail-title"><?php esc_html_e('SUB CAPTION', 'videogo'); ?></div>
														<div class="meta-detail-input meta-input"><textarea name='<?php echo esc_textarea ($name['subcaption']); ?>[]' id='<?php echo $name['subcaption']; ?>[]' ><?php echo videogo_find_xml_value($slider, 'subcaption'); ?></textarea></div><br class="clear">
														<hr class="separator">												
														<div class="meta-title meta-detail-title"><?php esc_html_e('LINK TYPE', 'videogo'); ?></div>
														<div class="meta-input meta-detail-input">
															<div class="combobox">
																<?php $linktype_val =  videogo_function_library::videogo_find_xml_value($slider, 'linktype'); ?>
																<select name='<?php echo $name['linktype']; ?>[]' id='<?php echo $name['linktype']; ?>' >
																	<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> ><?php esc_html_e('No Link', 'videogo'); ?></option>
																	<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>><?php esc_html_e('Link to URL', 'videogo'); ?></option>
																</select>
															</div>
														</div><br class="clear">
														<div class="url">
															<div class="meta-title meta-detail-title" rel="url"><?php esc_html_e('URL PATH', 'videogo'); ?></div> 
															<div class="meta-detail-input meta-input"><input class="mt10" type="text" name='<?php echo esc_attr($name['link']); ?>[]' id='<?php echo $name['link']; ?>[]' value="<?php echo esc_url(videogo_find_xml_value($slider, 'link')); ?>" /></div>
														</div>
														<div class="clear"></div>
														
														<div class="meta-title meta-detail-title"><?php esc_html_e('CONTACT URL', 'videogo'); ?></div> 
														<div class="meta-detail-input meta-input"><input type="text" name='<?php echo esc_attr($name['contact_url']); ?>[]' id='<?php echo $name['contact_url']; ?>[]' value="<?php echo videogo_find_xml_value($slider, 'contact_url'); ?>" /></div><br class="clear">
														
														<input type="hidden" value="slider_images" name="slider_images">
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
								<br class="clear">
								<div id="show-media" class="show-media">							
									<span id="show-media-text"></span>
									
									<div id="show-media-image"></div>
								</div>
							</div>
							<div class="media-image-gallery-wrapper">
							<input class="upload_image_button white_color" type="button" value="Upload" />
								<div class="media-image-gallery" id="media-image-gallery">
									<?php videogo_function_library::videogo_get_media_image(); ?>
								</div>
							</div>
						</div>
					</div>
					<br class="clear">
				</div>
				
			<?php
			
		}	

	}
}	