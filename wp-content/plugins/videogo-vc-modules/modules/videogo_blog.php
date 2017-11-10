<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_blog")){
	class videogo_blog{
		
		function __construct(){
			add_action("init",array($this,"videogo_blog_init"));
			add_shortcode('videogo_blog',array($this,'videogo_blog_shortcode'));
		}
		
		function videogo_blog_init(){
			if(function_exists("vc_map")){
				global $wpdb;
				
				$query = "SELECT wt.term_id,wt.name FROM $wpdb->terms wt LEFT JOIN $wpdb->term_taxonomy wtt ON wtt.`term_id` = wt.`term_id` WHERE taxonomy = 'category'";
				$categories = $wpdb->get_results($query);
				$no_of_posts = count($categories);
				

				$categoryArray = array();
				foreach($categories as $category_list){
					$categoryArray[$category_list->term_id] = $category_list->name;
				}

				vc_map( array(
					"base" => "videogo_blog",
					"name" => __( "Blog", "js_composer" ),
					"class" => "",
					"icon" => "icon-heart",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Number of Post", "js_composer" ),
							"param_name" => "post_count",
							"description" => __( "Enter number of post.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Number of text characters", "js_composer" ),
							"param_name" => "text_count",
							"description" => __( "Enter number of text characters.", "js_composer" )
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Post Category", "js_composer" ),
							"param_name" => "post_category_name",
							"value" => $categoryArray,
							"description" => __( "Select One for your posts.", "js_composer" )
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Post Display", "js_composer" ),
							"param_name" => "post_display_style",
							"value" => array("Select Style","Column1","Column3"),
							"description" => __( "One, two, three or four?", "js_composer" )
						),
					)
				) );				
			}
		}
		
		function videogo_blog_shortcode( $atts, $content = null ) {
			
			$results = shortcode_atts( array(
				'post_count' => '',
				'text_count' => '',
				'post_category_name' => '',
				'post_display_style' => ''
			), $atts );
			
			extract($results);
			
			if($post_category_name == ''){ $post_category_name = 'Uncategorized'; } 
			$output = '';
			
			$term = get_term_by('name', $post_category_name, 'category');
			$category_id = $term->term_id;
			
			// the query to set the posts per page to 3
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array('posts_per_page' => $post_count,'category_name' => $post_category_name, 'paged' => $paged, 'orderby' => 'date', 'order' => 'DESC' );
			$blog_posts = query_posts($args);
			$argsasc = array('posts_per_page' => $post_count,'category_name' => $post_category_name, 'paged' => $paged, 'orderby' => 'date', 'order' => 'ASC' );
			$blog_postsasc = query_posts($argsasc);

			$css_class1 ="cp-blog-section pd-tb33";
			$css_class2 ="blog-section column-3";
			if(($post_display_style == 'style3') || ($post_display_style == 'style4')) { $css_class = $css_class2; } else { $css_class = $css_class1; }
				
	if($post_display_style == 'Column1'){	
				$output = '<section class="'.$css_class.'">';
				foreach($blog_postsasc as $posts){ 
						$author = get_the_author();
						$videogo_post_views = videogo_getPostViews($posts->ID);
						$feat_image = get_the_post_thumbnail($posts->ID, 'full');
						$videogo_num_comments = get_comments_number($posts->ID);
						$post_detail_xml = get_post_meta( $posts->ID , 'post_detail_xml', true);
							if($post_detail_xml <> ''){
								$videogo_post_xml = new DOMDocument ();
								$videogo_post_xml->loadXML ( $post_detail_xml );
								$videogo_thumbnail_types = videogo_find_xml_value($videogo_post_xml->documentElement,'post_thumbnail');
								$videogo_audio_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'audio_url_type');
								$videogo_video_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
								$videogo_select_slider_type = videogo_find_xml_value($videogo_post_xml->documentElement,'select_slider_type');	
							}

					$videogo_post_format = get_post_format($posts->ID); 
						if($videogo_post_format == ''){ $videogo_post_format = 'standard post'; }
						$is_quote = get_post_format( $posts->ID  );
						
						if (strlen($posts->post_content) > $text_count){
							$post_content = substr($posts->post_content, 0, strrpos(substr($posts->post_content, 0, $text_count), ' ')) . '...';
						} else {
							$post_content = $posts->post_content;
						}
			
					$videogo_image_size = array(845,320);    

	 if(($videogo_post_format == 'audio')){ 
	 
		wp_enqueue_style('audioplayer-css3',videogo_PATH_URL.'/frontend/css/audioplayer.css');
		wp_register_script('audio-js', videogo_PATH_URL.'/frontend/js/audioplayer.js', false, '1.0', true);
		wp_enqueue_script('audio-js');

				$output .= '<!--Blog Audio Item Start-->';
				$output .= '<article class="cp-blog-item">';
				$output .= '<div class="cp-audio-item">';
				$output .= '<div class="mp3-player-box">';
				$output .= '<audio preload="auto" controls>';
                $output .= '<source src="'.esc_url($videogo_audio_url_type).'">';
				$output .= '</audio>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="cp-text">';
				$output .= '<span class="cp-icon-box">';
				$output .= '<i class="fa fa-music"></i>';
				$output .= '</span>';
				$output .= '<div class="cp-inner-holder">';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
				$output .= '</ul>';
                $output .= '<p>'.$post_content.'</p>';
				$output .= '<ul class="cp-meta-post-list">';
				$output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
				$output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
				$output .= '</ul>';
				$output .= '<a href="'.get_permalink($posts->ID).'" class="cp-btn-style1">Read More</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article><!--Blog Audio Item End-->';

 			} 
	if($videogo_post_format == 'standard post'){ 
	
				$output .= '<!--Blog Item Start-->';
                if(videogo_print_blog_thumbnail($posts->ID,$videogo_image_size) <> ''){ 
				$output .= '<article class="cp-blog-item">';
				$output .= '<figure class="cp-thumb">';
				$output .= videogo_print_blog_thumbnail($posts->ID,$videogo_image_size);
				$output .= '</figure>';
				} else {
				$output .= '<article class="cp-blog-item cp-blog-item2">';
                }
				$output .= '<div class="cp-text">';
				$output .= '<span class="cp-icon-box">';
				if($videogo_select_slider_type <> ''){
				$output .= '<i class="fa fa-align-left"></i>';
				} else {
				$output .= '<i class="fa fa-file-text"></i>';
				}
				$output .= '</span>';
				$output .= '<div class="cp-inner-holder">';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
				$output .= '</ul>';
				$output .= '<p>'.$post_content.'</p>';
				$output .= '<ul class="cp-meta-post-list">';
				$output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
				$output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
				$output .= '</ul>';
				$output .= '<a href="'.get_permalink($posts->ID).'" class="cp-btn-style1">Read More</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '<!--Blog Item End-->';
				
 			} 
	if($videogo_post_format == 'quote'){ 
	
				$output .= '<!--Blog Item Start-->';
				$output .= '<article class="cp-blog-item cp-blog-item2">';
				$output .= '<div class="cp-text">';
				$output .= '<span class="cp-icon-box">';
				$output .= '<i class="fa fa-quote-left"></i>';
				$output .= '</span>';
				$output .= '<div class="cp-inner-holder">';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
				$output .= '</ul>';
                $output .= ''.$post_content.'';
				if($text_count <> '') { $output .= '</blockquote>'; }
				$output .= '<ul class="cp-meta-post-list">';
				$output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
				$output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
				$output .= '</ul>';
				$output .= '<a href="'.get_permalink($posts->ID).'" class="cp-btn-style1">Read More</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '<!--Blog Item End-->';

		 	}
	if($videogo_post_format == 'link'){ 
	
				$output .= '<!--Blog Link Item Start-->';
				$output .= '<article class="cp-blog-item cp-blog-item2">';
				$output .= '<div class="cp-text">';
				$output .= '<span class="cp-icon-box">';
				$output .= '<i class="fa fa-link"></i>';
				$output .= '</span>';
				$output .= '<div class="cp-inner-holder">';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
                $output .= '<p>'.$post_content.'</p>';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
				$output .= '</ul>';
				$output .= '<ul class="cp-meta-post-list">';
				$output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
				$output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
				$output .= '</ul>';
				$output .= '<a href="'.get_permalink($posts->ID).'" class="cp-btn-style1">Read More</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '<!--Blog Link Item End-->';
				
			} 
	if($videogo_post_format == 'video'){ 
	
				$output .= '<!--Blog Video Item Start-->';
				$output .= '<article class="cp-blog-item">';
				$output .= '<iframe src="'.esc_url($videogo_video_url_type).'"></iframe>';
				$output .= '<div class="cp-text">';
				$output .= '<span class="cp-icon-box">';
				$output .= '<i class="fa fa-film"></i>';
				$output .= '</span>';
				$output .= '<div class="cp-inner-holder">';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
				$output .= '</ul>';
                $output .= '<p>'.$post_content.'</p>';
				$output .= '<ul class="cp-meta-post-list">';
				$output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
				$output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
				$output .= '</ul>';
				$output .= '<a href="'.get_permalink($posts->ID).'" class="cp-btn-style1">Read More</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '<!--Blog Video Item End-->';
	
			} 					
	if($videogo_post_format == 'image'){ 
	
				$output .= '<!--Blog Image Item Start-->';
				$output .= '<article class="cp-blog-item">';
                if(videogo_print_blog_thumbnail($posts->ID,$videogo_image_size) <> ''){ 
				$output .= '<figure class="cp-thumb">';
				$output .= videogo_print_blog_thumbnail($posts->ID,$videogo_image_size);
				$output .= '</figure>';
				}
				$output .= '<div class="cp-text">';
				$output .= '<span class="cp-icon-box">';
				$output .= '<i class="fa fa-picture-o"></i>';
				$output .= '</span>';
				$output .= '<div class="cp-inner-holder">';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
				$output .= '</ul>';
				if($post_content<>''){
                $output .= '<p>'.$post_content.'</p>';
				}
				$output .= '<ul class="cp-meta-post-list">';
				$output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
				$output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
				$output .= '</ul>';
				$output .= '<a href="'.get_permalink($posts->ID).'" class="cp-btn-style1">Read More</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '<!--Blog Image Item End-->';
	
			} 					


	if($videogo_post_format == 'gallery'){  

			$content = $posts->post_content;
			$regex = '/src="([^"]*)"/';
			preg_match_all( $regex, $content, $matches );
			$matches = array_reverse($matches);
			$total_images = count($matches[0]);
			$loop_internal_counter = 0;
			$img_li_output = '';	
			for ($x = 0; $x < $total_images; $x++) {
				if($loop_internal_counter == 0){
					$image_url = $matches[0][$x];
					$current_li_image = aq_resize( $image_url, 845, 225, true );
					$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
				}
				if($loop_internal_counter == 1){
					$image_url = $matches[0][$x];
					$current_li_image = aq_resize( $image_url, 456, 230, true );
					$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
				}
				if($loop_internal_counter == 2){
					$image_url = $matches[0][$x];
					$current_li_image = aq_resize( $image_url, 389, 230, true );
					$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
				}
				if($loop_internal_counter == 3){
					$image_url = $matches[0][$x];
					$current_li_image = aq_resize( $image_url, 323, 230, true );
					$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
				}
				if($loop_internal_counter == 4){
					$image_url = $matches[0][$x];
					$current_li_image = aq_resize( $image_url, 520, 230, true );
					$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
				}
			$loop_internal_counter++;
			if($loop_internal_counter == 5){ $loop_internal_counter = 0; }
			} 

				$output .= '<!--Blog Gallery Item Start-->';
				$output .= '<article class="cp-blog-item">';
				$output .= '<ul class="cp-image-post-listed">';
				$output .= $img_li_output;
				$output .= '</ul>';
				$output .= '<div class="cp-text">';
				$output .= '<span class="cp-icon-box">';
				$output .= '<i class="fa fa-picture-o"></i>';
				$output .= '</span>';
				$output .= '<div class="cp-inner-holder">';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
				$output .= '</ul>';
				$output .= '<ul class="cp-meta-post-list">';
				$output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
				$output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
				$output .= '</ul>';
				$output .= '<a href="'.get_permalink($posts->ID).'" class="cp-btn-style1">Read More</a>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '<!--Blog Gallery Item End-->';

		}

					} 
					
				} 
	
		if ($post_display_style == 'Column3') {

				$output .= '<div class="cp-latest-outer pd-b60">';
				$output .= '<div class="cp-heading-outer">';
				$output .= '<h2>'.$post_category_name.'</h2>';
				$output .= '</div>';
				$output .= '<div class="row">';
				
				foreach($blog_postsasc as $posts){ 
						$author = get_the_author();
						$videogo_post_views = videogo_getPostViews(get_the_ID());
						$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $posts->ID ), "full" ); 
						$post_detail_xml = get_post_meta( $posts->ID , 'post_detail_xml', true);
							if($post_detail_xml <> ''){
								$videogo_post_xml = new DOMDocument ();
								$videogo_post_xml->loadXML ( $post_detail_xml );
								$videogo_thumbnail_types = videogo_find_xml_value($videogo_post_xml->documentElement,'post_thumbnail');
								$videogo_audio_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'audio_url_type');
								$videogo_video_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
								$videogo_select_slider_type = videogo_find_xml_value($videogo_post_xml->documentElement,'select_slider_type');	
							}

					$videogo_post_format = get_post_format($posts->ID); 
						if($videogo_post_format == ''){ $videogo_post_format = 'standard post'; }
						$is_quote = get_post_format( $posts->ID  );
						
						if (strlen($posts->post_content) > $text_count){
							$post_content = substr($posts->post_content, 0, strrpos(substr($posts->post_content, 0, $text_count), ' ')) . '...';
						} else {
							$post_content = $posts->post_content;
						}
			
				$current_post_image = aq_resize( $feat_image[0], 260, 207, true ); 
				
				$output .= '<div class="col-md-4 col-sm-6 col-xs-12">';
				$output .= '<article class="cp-latest-item">';
				$output .= '<figure class="cp-thumb">';
				if($current_post_image <> ''){
				$output .= '<a href="'.get_permalink($posts->ID).'"><img src="'.$current_post_image.'" alt="video thumbnail"></a>';
				} else {
				$output .= '<a href="'.get_permalink($posts->ID).'"><img src="'.videogo_get_video_thumbnail($videogo_video_url_type).'" alt="video image"></a>';
				}
				$output .= '</figure>';
				$output .= '<div class="cp-text">';
				$output .= '<div class="cp-top">';
				$output .= '<ul class="cp-meta-list">';
				$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
				$output .= '</ul>';
				$output .= '</div>';
				$output .= '<h3><a href="'.get_permalink($posts->ID).'">'.esc_attr(get_the_title($posts->ID)).'</a></h3>';
				$output .= '<p>'.$post_content.' <a class="read-more" href="'.get_permalink($posts->ID).'">{+}</a></p>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '</div>';
				
			}
				
				$output .= '</div>';
				$output .= '</div>';
		
		} 

		if($post_count > 3){
				$output .= '<!--Pagination Start--><div class="cp-pagination-row"><ul class="pagination">'.videogo_pagination().'</ul></div><!--Pagination End-->';
		} 
		
		if ($post_display_style == 'Column1') {
					$output .= '</section>';
		}

				
				if(($post_display_style == '')||($post_display_style == ' ')){ echo '<h3>No style of Blog element is selected.</h3>';	}

			wp_reset_query();
			return $output;
			
		}
	}
	
	NEW videogo_blog;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_blog extends WPBakeryShortCode {
		}
	}
}