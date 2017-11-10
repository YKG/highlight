<?php 
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_most_viewed")){
	class videogo_most_viewed{
		
		function __construct(){
			add_action("init",array($this,"videogo_most_viewed_init"));
			add_shortcode('videogo_most_viewed',array($this,'videogo_most_viewed_shortcode'));
		}
		
		function videogo_most_viewed_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_most_viewed',
					"name" => __( "Most Viewed", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(    
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Most viewed Title", "js_composer" ),
							"param_name" => "most_viewed_title",
							"description" => __( "Enter Title for section.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Post id's", "js_composer" ),
							"param_name" => "most_viewed_idz",
							"description" => __( "Enter ids of post, comma seperated. e.g '261,267,777'", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Word Count", "js_composer" ),
							"param_name" => "videogo_words_count",
							"description" => __( "Enter how many word you want to display.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"heading" => __( "Extra class name", "js_composer" ),
							"param_name" => "el_class",
							"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
						)
					)
				) );
			}
		}
		
		function videogo_most_viewed_shortcode( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'most_viewed_title' => '',
				'most_viewed_idz' => '',
				'videogo_words_count' => '',
				'el_class' => ''
			), $atts ) );
			$post_idz = explode(',', $most_viewed_idz); 
			$number_of_posts = count($post_idz); 
			$output = ''; 
						
				if($number_of_posts < 2){
							
						$current_post_id = $post_idz[0];
						$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $current_post_id ), "full" ); 
						$image_url = $image_full[0];
						$post_image = aq_resize( $image_url, 457, 337, true );
						
						$content_post = get_post($current_post_id);
						
						if (strlen($content_post->post_content) > $videogo_words_count){
							$video_content = substr($content_post->post_content, 0, strrpos(substr($content_post->post_content, 0, $videogo_words_count), ' ')) . '...';
						} else {
							$video_content = $videoz->video_content;
						}


						$output .= '<section class="cp-section pd-t60'.$el_class.'">';
						$output .= '<!--Outer Holder Start-->';
						$output .= '<div class="cp-outer-holder">';
						
						if($most_viewed_title <> ''){
							$output .= '<div class="cp-heading-outer category-title">';
							$output .= '<h2>'.$most_viewed_title.'</h2>';
							$output .= '</div>';
						}
						
						$videogo_dz_post_views = videogo_getPostViews($current_post_id);
						$output .= '<!--Categpries Outer Start-->';
						$output .= '<ul class="cp-categories-outer">';
						
						$output .= '<li>';
						$output .= '<div class="cp-most-listed">';
						$output .= '<figure class="cp-thumb">';
						$output .= '<a href="'.get_permalink($current_post_id).'"><img src="'.$post_image.'" alt="most viewed '.$current_post_id.'"></a>';
						$output .= '<figcaption class="cp-caption">';
						$output .= '<a href="'.get_permalink($current_post_id).'" class="play-video">Play</a>';
						$output .= '</figcaption>';
						$output .= '</figure>';
						$output .= '<div class="cp-text">';
						$output .= '<h3><a href="'.get_permalink($current_post_id).'">'.esc_attr(get_the_title($current_post_id)).'</a></h3>';
						$output .= '<ul class="cp-meta-list">';
						$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
						$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_dz_post_views.'</span></li>';
						$output .= '</ul>';
						$output .= '<p>'.$video_content.'</p>';
						$output .= '<a class="read-more" href="'.get_permalink($current_post_id).'">{+}</a>';
						$output .= '</div>';
						$output .= '</div>';
						$output .= '</li>';
						
						$output .= '</ul>';
						$output .= '<!--Categpries Outer End-->';
						$output .= '</div>';
						$output .= '<!--Outer Holder Start-->';
						$output .= '</section>';
				}

				if($number_of_posts > 2){ 
							
						$output .= '<div class="cp-most-view-outer pd-b60 pd-t60'.$el_class.'">';
						$output .= '<div class="cp-heading-outer">';
						if($most_viewed_title <> ''){
							$output .= '<h2>Most Viewed</h2>';
						}
						$output .= '<ul class="cp-listed">';
						$output .= '<li class="view-all"><a href="#">View All</a></li>';
						$output .= '</ul>';
						$output .= '</div>';
						$output .= '<div class="cp_viewed-slider">';
						
						
						foreach($post_idz as $current_slider_post_id){

						$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $current_slider_post_id ), "full" ); 
						$image_url = $image_full[0];
						$post_image = aq_resize( $image_url, 457, 337, true );
						
						$content_post = get_post($current_slider_post_id);
						
						if (strlen($content_post->post_content) > $videogo_words_count){
							$video_content = substr($content_post->post_content, 0, strrpos(substr($content_post->post_content, 0, $videogo_words_count), ' ')) . '...';
						} else {
							$video_content = $videoz->video_content;
						}
							$videogo_dz_post_views = videogo_getPostViews($current_slider_post_id);
							
							$output .= '<div class="item">';
							$output .= '<div class="cp-most-listed">';
							$output .= '<figure class="cp-thumb">';
							$output .= '<a href="'.get_permalink($current_slider_post_id).'"><img src="'.$post_image.'" alt="most viewed slider '.$current_slider_post_id.'"></a>';
							$output .= '<figcaption class="cp-caption">';
							$output .= '<a href="'.get_permalink($current_slider_post_id).'" class="play-video">Play</a>';
							$output .= '</figcaption>';
							$output .= '</figure>';
							$output .= '<div class="cp-text">';
							$output .= '<h3><a href="'.get_permalink($current_slider_post_id).'">'.esc_attr(get_the_title($current_slider_post_id)).'</a></h3>';
							$output .= '<ul class="cp-meta-list">';
							$output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
							$output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_dz_post_views.'</span></li>';
							$output .= '</ul>';
							$output .= '<p>'.$video_content.'</p>';
							$output .= '<a class="read-more" href="'.get_permalink($current_slider_post_id).'">{+}</a>';
							$output .= '</div>';
							$output .= '</div>';
							$output .= '</div>';
						
						}
						
						$output .= '</div>';
						$output .= '</div>';

						
				}


			return $output;
		}

	}
	new videogo_most_viewed;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_most_viewed extends WPBakeryShortCode {
		}
	}
}
?>