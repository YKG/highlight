<?php
	/*
	*	CrunchPress Misc File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all of the necessary function for the front-end to
	*	easily used. You can see the description of each function below.
	*	---------------------------------------------------------------------
	*/
	
	/* Check if url is from youtube or vimeo */
	function videogo_get_video($videogo_url, $videogo_width = 640, $videogo_height = 480){
	
		$videogo_videoHtml = '';
		
		if(strpos($videogo_url,'youtube')){		
		
			$videogo_videoHtml = videogo_get_youtube($videogo_url, $videogo_width, $videogo_height);
		
		}else if(strpos($videogo_url,'youtu.be')){
		
			$videogo_videoHtml = videogo_get_youtube($videogo_url, $videogo_width, $videogo_height, 'youtu.be');
			
		}else{
		
			$videogo_videoHtml = videogo_get_vimeo($videogo_url, $videogo_width, $videogo_height);
		}
		
		return $videogo_videoHtml;
	}
	
	/* Print youtube video */
	function videogo_get_youtube($videogo_url, $videogo_width = 640, $videogo_height = 480, $videogo_type = 'youtube'){
		
		if( $videogo_type == 'youtube' ){
			preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$videogo_url,$videogo_id);
		}else{
			preg_match('/youtu.be\/([^\\?\\&]+)/', $videogo_url, $videogo_id);
		}
		
		$videogo_width_html = '';
		if($videogo_width  == '100%'){
			$videogo_width_html .= 'class="full-width-video"   ';
			$videogo_width_html .= 'width="100"';
		}else{
			$videogo_width_html = 'width='.$videogo_width;
		}
		
		return esc_html__('URL NOT FOUND','videogo');
	}
	
	/* Get Audio Player OR SoundCloud */
	function videogo_get_audio_track($videogo_url,$videogo_counter_track){
		
		$videogo_audio_html = '';
		
		if(strpos($videogo_url,'soundcloud')){
			
			$videogo_audio_html .= '<iframe src="https://w.soundcloud.com/player/?url='.$videogo_url.'&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>';
		
		}else{
			if($videogo_url <> '' ){
				$videogo_audio_html  .= do_shortcode('[audio mp3="'.$videogo_url.'"][/audio]');
			}
		}
		
		return $videogo_audio_html;
	}
	
	
	/* Print vimeo video */
	function videogo_get_vimeo($videogo_url, $videogo_width = 640, $videogo_height = 480){
		
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $videogo_url, $videogo_id);
		
		$videogo_width_html = '';
		
		if($videogo_width  == '100%'){
			
			$videogo_width_html .= 'class="full-width-video"  ';
			$videogo_width_html .= 'width="100"';
		
		}else{
			
			$videogo_width_html = esc_html('width='.strip_tags($videogo_width));
		}
		
		if(!empty($videogo_id)){
		
		return '
		<object type="video/x-ms-wmv" '.$videogo_width_html.' height="'.strip_tags($videogo_height).'">
			<param name="allowscriptaccess" value="always" >
			<param name="allowfullscreen" value="true" >
			<param name="wmode" value="transparent" >
			<param name="bgcolor" value="#000000" >
			<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id='.$videogo_id[1].'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" />
			<embed src="http://vimeo.com/moogaloop.swf?clip_id='.$videogo_id[1].'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" '.$videogo_width_html.' height="'.$videogo_height.'" wmode="transparent" bgcolor="#000000">
		</object>';
		}
		
	}
	
	/* Bx Slider */
	function videogo_print_bx_slider($videogo_slider_xml,$videogo_size,$videogo_slider_id){
		
		global $post;
		
		$videogo_slider_html = '';
		$videogo_slide_order_bx = '';
		$videogo_auto_play_bx = '';
		$videogo_pause_on_bx = '';
		$videogo_show_arrow = '';
		$videogo_anchor_hr = '';
		
		$videogo_slider_settings = get_option('slider_settings');
		if($videogo_slider_settings <> ''){
			$videogo_slider = new DOMDocument ();
			$videogo_slider->loadXML ( $videogo_slider_settings );
			/* Bx Slider Values */
			$videogo_slide_order_bx = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','slide_order_bx');
			$videogo_auto_play_bx = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','auto_play_bx');
			if($videogo_auto_play_bx == 'enable'){$videogo_auto_play_bx = 'true';}else{$videogo_auto_play_bx = 'true';}
			$videogo_pause_on_bx = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','pause_on_bx');
			if($videogo_pause_on_bx == 'enable'){$videogo_pause_on_bx = 'true';}else{$videogo_pause_on_bx = 'false';}
			$videogo_show_arrow = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','show_arrow');
		}
		
		$videogo_mode_slide = '';
		
		if($videogo_slide_order_bx == 'slide'){}else{$videogo_mode_slide = "mode: 'fade',";}
		if($videogo_show_arrow == 'enable'){$videogo_show_arrow = 'true';}else{$videogo_show_arrow = 'false';}
		
		if(!empty($videogo_slider_xml)){
		$videogo_slider_html = '';
		
		/* Slider JS */
			$videogo_data = 'jQuery(document).ready(function($){
					$("#cp-home-banner").bxSlider({
						auto: true,
						pager: false,
						controls: false
						});
					});';
			$videogo_handle = 'videogo_custom';
			wp_add_inline_script( $videogo_handle, $videogo_data, $videogo_position = 'after' ); 
			$videogo_slider_html = $videogo_slider_html . '<div class="cp-slider-block"><div class="cp_banner"><div class="owl-carousel" id="cp-video-slider">';
				
				foreach($videogo_slider_xml->childNodes as $videogo_slider){
					$videogo_title = videogo_find_xml_value($videogo_slider, 'title');
					$videogo_caption = html_entity_decode(videogo_find_xml_value($videogo_slider, 'caption'));
					$videogo_link = videogo_find_xml_value($videogo_slider, 'link');
					$videogo_contact_url = videogo_find_xml_value($videogo_slider, 'contact_url');
					$videogo_link_type = videogo_find_xml_value($videogo_slider, 'linktype');
					$videogo_btn_txt = videogo_find_xml_value($videogo_slider, 'btn_txt');
					if(videogo_get_width($videogo_size) == '5000'){
						$videogo_image_url = wp_get_attachment_image_src(videogo_find_xml_value($videogo_slider, 'image'),'full');
					}else{
						$videogo_image_url = wp_get_attachment_image_src(videogo_find_xml_value($videogo_slider, 'image'), 'full');
					}
					$videogo_alt_text = get_post_meta(videogo_find_xml_value($videogo_slider, 'image') , '_wp_attachment_image_alt', true);
					
					/* for link case */	
					if($videogo_link_type == 'No Link'){
						$videogo_anchor_hr = '';
					}else if($videogo_link_type == 'Link to URL' && isset($videogo_link)){
						$videogo_anchor_hr = '<a href="'.esc_url($videogo_link).'" class="cp-btn-style1">'.esc_html('Watch Video','videogo').'</a> ';
					}else{
						$videogo_anchor_hr = '';
					}
					
					/* contact URl case */
					if($videogo_link_type == 'No Link'){
						$videogo_contact_url = '';
					}else if($videogo_link_type == 'Link to URL' && isset($videogo_contact_url)){
						$videogo_contact_url = '<a href="'.$videogo_contact_url.'" class="cp-btn-style1">'.esc_html('Watch Video','videogo').'</a> ';
					}else{
						$videogo_contact_url = '';
					}
					
					/* If Title & Caption is Not Empty */
					if($videogo_title <> '' AND $videogo_caption <> ''){
							$videogo_slider_html = $videogo_slider_html  .'
							  <div class="item"> <a href="'.esc_url($videogo_link).'">
							  <img src="'. esc_url($videogo_image_url[0]).'" alt="'.esc_attr('img','videogo').'"> </a>
								<!--Banner Caption Start-->
								<div class="cp-banner-caption">
									<div class="inner-holder">
									  <div class="banner-top-text"> <strong class="banner-title">'.$videogo_title.'</strong>
										<p>'. $videogo_caption.'</p>
									  </div>
									  '.$videogo_anchor_hr.'
									</div>
								</div>
								<!--Banner Caption End--> 
							  </div>';
					}
					else{
					
					/* If title & Description is empty */
							$videogo_slider_html = $videogo_slider_html  .'<div class="item">';							
							$videogo_slider_html = $videogo_slider_html  .'<img src="'. esc_url($videogo_image_url[0]).'" alt="'.esc_attr('img','videogo').'"/>
														  </div>';
					}
				}/* end for each */
				
				$videogo_slider_html = $videogo_slider_html . '</div></div></div>';
				
		}
	return $videogo_slider_html;
	
	}
	/* Home V6 Slider */
	function videogo_home_v6_slider($videogo_slider_xml,$videogo_size,$videogo_slider_id){ 
		
	global $post;
		
		$videogo_slider_off = '';
		$videogo_slider_type = '';
		$videogo_slider_slide = '';
		$videogo_slider_height = '';
		$videogo_slider_off = get_post_meta ( $post->ID, "page-option-top-slider-on", true );
		
			/* Get Page Main Slider Values */
			$videogo_slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$videogo_slider_layer_id = get_post_meta ( $post->ID, "page-option-top-slider-layer", true );
			$videogo_slider_shortcode = get_post_meta ( $post->ID, "page-option-top-slider-shortcode", true );
			
				$videogo_slider_slide = get_post_meta ( $post->ID, "page-option-top-slider-images", true );
				$videogo_slider_height = get_post_meta ( $post->ID, "page-option-top-slider-height", true );
				$videogo_size_new = '';
				
					$videogo_slider_input_xml = get_post_meta( $videogo_slider_slide, 'cp-slider-xml', true);
					if($videogo_slider_input_xml <> ''){
					$videogo_slider_xml_dom = new DOMDocument ();
					$videogo_slider_xml_dom->loadXML ( $videogo_slider_input_xml );
					}
					$videogo_slider_xml = $videogo_slider_xml_dom->documentElement;
		
		$videogo_slider_html = '';
		$videogo_slide_order_bx = '';
		$videogo_auto_play_bx = '';
		$videogo_pause_on_bx = '';
		$videogo_show_arrow = '';
		$videogo_anchor_hr = '';   
		
		$videogo_slider_settings = get_option('slider_settings');
		if($videogo_slider_settings <> ''){
			$videogo_slider = new DOMDocument ();
			$videogo_slider->loadXML ( $videogo_slider_settings );
			/* Bx Slider Values */
			$videogo_slide_order_bx = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','slide_order_bx');
			$videogo_auto_play_bx = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','auto_play_bx');
			if($videogo_auto_play_bx == 'enable'){$videogo_auto_play_bx = 'true';}else{$videogo_auto_play_bx = 'true';}
			$videogo_pause_on_bx = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','pause_on_bx');
			if($videogo_pause_on_bx == 'enable'){$videogo_pause_on_bx = 'true';}else{$videogo_pause_on_bx = 'false';}
			$videogo_show_arrow = find_xml_child_nodes($videogo_slider_settings,'bx_slider_settings','show_arrow');
		}
		
		$videogo_mode_slide = '';
		
		if($videogo_slide_order_bx == 'slide'){}else{$videogo_mode_slide = "mode: 'fade',";}
		if($videogo_show_arrow == 'enable'){$videogo_show_arrow = 'true';}else{$videogo_show_arrow = 'false';}
		
		if(!empty($videogo_slider_xml)){
		$videogo_slider_html = '';
		
		/* Slider JS */
		$videogo_data = 'jQuery(document).ready(function($){
					$("#cp-home-banner").bxSlider({
						auto: true,
						pager: false,
						controls: false
						});
					});';
		$videogo_handle = 'videogo_custom';
		wp_add_inline_script( $videogo_handle, $videogo_data, $videogo_position = 'after' ); 
			$videogo_slider_html = '<div class="cp-slider-block"><div class="cp_banner"><div class="owl-carousel" id="cp_banner-slider">';
				
				foreach($videogo_slider_xml->childNodes as $videogo_slider){ 
					$videogo_title = videogo_find_xml_value($videogo_slider, 'title');
					$videogo_caption = html_entity_decode(videogo_find_xml_value($videogo_slider, 'caption'));
					$videogo_subcaption = html_entity_decode(videogo_find_xml_value($videogo_slider, 'subcaption'));
					$videogo_link = videogo_find_xml_value($videogo_slider, 'link');
					$videogo_contact_url = videogo_find_xml_value($videogo_slider, 'contact_url');
					$videogo_link_type = videogo_find_xml_value($videogo_slider, 'linktype');
					$videogo_btn_txt = videogo_find_xml_value($videogo_slider, 'btn_txt');
					if(videogo_get_width($videogo_size) == '5000'){
						$videogo_image_url = wp_get_attachment_image_src(videogo_find_xml_value($videogo_slider, 'image'),'full');
					}else{
						$videogo_image_url = wp_get_attachment_image_src(videogo_find_xml_value($videogo_slider, 'image'), 'full');
					}
					$videogo_alt_text = get_post_meta(videogo_find_xml_value($videogo_slider, 'image') , '_wp_attachment_image_alt', true);
					
					/* for link case */	
					if($videogo_link_type == 'No Link'){
						$videogo_anchor_hr = '';
					}else if($videogo_link_type == 'Link to URL' && isset($videogo_link)){
						$videogo_anchor_hr = '<a href="'.esc_url($videogo_link).'" class="cp-btn-style1">'.esc_html('Watch Video','videogo').'</a> ';
					}else{
						$videogo_anchor_hr = '';
					}
					
					/* contact URl case */
					if($videogo_link_type == 'No Link'){
						$videogo_contact_url = '';
					}else if($videogo_link_type == 'Link to URL' && isset($videogo_contact_url)){
						$videogo_contact_url = '<a href="'.$videogo_contact_url.'" class="cp-btn-style1">'.esc_html('Watch Video','videogo').'</a> ';
					}else{
						$videogo_contact_url = '';
					}
					
					/* If Title & Caption is Not Empty */
					if($videogo_title <> '' AND $videogo_caption <> ''){
							$videogo_slider_html = $videogo_slider_html  .'
							  <div class="item"> 
							  <a href="'.esc_url($videogo_link).'">
							  	<img src="'. esc_url($videogo_image_url[0]).'" alt="'.esc_attr('img','videogo').'"> 
								</a>
								<!--Banner Caption Start-->
								<div class="cp-banner-caption">
									<div class="inner-holder">
									  <div class="banner-top-text"> <strong class="banner-title">'.$videogo_title.'</strong>
										<p>'. $videogo_caption.'</p>
									  </div>
									  '.$videogo_anchor_hr.'
									  <h3>'.$videogo_subcaption.'</h3>
									</div>
								</div>
								<!--Banner Caption End--> 
							  </div>';
					}
					else{
					
					/* If title & Description is empty */
							$videogo_slider_html = $videogo_slider_html  .'<div class="item">';							
							$videogo_slider_html = $videogo_slider_html  .'<img src="'. esc_url($videogo_image_url[0]).'" alt="'.esc_attr('img','videogo').'"/>
														  </div>';
					}
				}/* end for each */
				
				$videogo_slider_html = $videogo_slider_html . '</div></div></div>';
				
		}
	return $videogo_slider_html;
	
	}
	
	/* Owl - Slider For Lawyer Theme News Page */
	function videogo_inner_owl_slider(){
		
		global $post;
		
		$videogo_args = array();
		$videogo_stack = array();
		$videogo_stack_cat_all = array();
		$videogo_category_id = "";		
		
		$videogo_number_of_post = get_post_meta ( $post->ID, "page-option-number-of-post", true );
		$videogo_category_id = get_post_meta ( $post->ID, "page-option-post-category-forslider", true );
			
		$videogo_stack_cat_all = array('tax_query' => array(
			
			array(
					'taxonomy' => 'category',
					'terms' => $videogo_category_id,
					'field' => 'term_id',
				)
			),
		);
		$args = array( 
					'post_type' 		=> 'post',
					'posts_per_page' 	=> $videogo_number_of_post,
					'post_status'       => 'publish',
					'orderby' 			=> 'date',
					'order' 			=> 'DESC'
				);
		
		$videogo_push_args = array_slice($args, 0, 2, true) + $videogo_stack + $videogo_stack_cat_all + array_slice($args, 2, count($args) - 1, true) ;
		
		$videogo_the_post = query_posts($videogo_push_args);	
		
		?>
		
		<div class="cp-news-listing-slider">
          <div id="blog-slider" class="owl-carousel owl-theme">
			<?php
			if ( have_posts() ) {
			
				while ( have_posts() ) { the_post();
					$videogo_categoryone = get_the_category( $post->ID );
					$videogo_categories = get_the_category();
					
					$videogo_catArray = array();
					
					foreach($videogo_categories as $videogo_category) {	
						$videogo_catArray[] = '<a class = "" href="'.esc_url(get_category_link( $videogo_category->term_id )).'" title="' . esc_attr( $videogo_category->name  ) . '">'.esc_attr($videogo_category->cat_name).'</a>';
					}
					
					$videogo_category_csv = implode(', ',$videogo_catArray);
					
					$videogo_archive_year  = get_the_time('Y'); 
					$videogo_archive_month = get_the_time('m'); 
					$videogo_archive_day   = get_the_time('d');
					
					?>
					<div class="item">
					  <div class="frame"> <?php echo get_the_post_thumbnail($post->ID, array(1170,600)); ?>
						<div class="caption">
						  <div class="holder"> 
							<strong class="title"><?php echo get_the_title();?></strong>
							<div class="detail-row">
							  <ul>
								<li><a href="<?php echo get_day_link( $videogo_archive_year, $videogo_archive_month, $videogo_archive_day)?>"> <?php echo get_the_date()?> </a></li>
								<li><?php echo esc_attr('By: ','videogo');?><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"> <?php echo get_the_author()?></a></li>
								<li>
									<?php
										/* Get Post Comment */
										comments_popup_link( esc_html__('0 Comment','videogo'),
										esc_html__('1 Comment','videogo'),
										esc_html__('% Comments','videogo'), '',
										esc_html__('Comments are off','videogo') );
									?>
								</li>
							  </ul>
							</div>
						  </div>
						</div>
					  </div>
					</div>
					<?php
				} /* endwhile */
				
				wp_reset_query();
				wp_reset_postdata();
			} /* endif */ 
			?>	
			</div>
		</div>
		<?php
	}