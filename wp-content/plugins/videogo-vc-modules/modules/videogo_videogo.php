<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_videogo")){
	class videogo_videogo{
		
		function __construct(){
			add_action("init",array($this,"videogo_videogo_init"));
			add_shortcode('videogo_videogo',array($this,'videogo_videogo_shortcode'));
		}
		
		function videogo_videogo_init(){
			$catarray = array();
			if(function_exists("vc_map")){
				global $wpdb;

				$query = "SELECT wt.term_id,wt.name FROM $wpdb->terms wt LEFT JOIN $wpdb->term_taxonomy wtt ON wtt.`term_id` = wt.`term_id` WHERE taxonomy = 'category'";
				$term = $wpdb->get_results($query);

					foreach($term as $t){
						$catarray[$t->name] = $t->name;
					}	
					
					vc_map( array(
					'base' => 'videogo_videogo',
					"name" => __( "Video Go", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "No of Posts", "js_composer" ),
							"param_name" => "videogo_count",
							"description" => __( "Enter Videos count.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "No of Words", "js_composer" ),
							"param_name" => "videogo_words_count",
							"description" => __( "Enter Content Words count.", "js_composer" )
						),
						array(
							"type" => "dropdown",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Video Go Category", "js_composer" ),
							"param_name" => "videogo_category",
							"value" => $catarray,
							"description" => __( "Select category Title.", "js_composer" )
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Video Category Display", "js_composer" ),
							"param_name" => "videogo_style",
							"value" => array("Select Style","style1","style2","style3"),
							"description" => __( "Single Col, Two Col or Three Col", "js_composer" )
						),	
						array(
							"type" => "attach_image",
							"heading" => __( "Select Background Image", "js_composer" ),
							"param_name" => "videogo_image",
							"value" => "",
							"description" => __( "Select Image from Media Library.", "js_composer" ),
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Pagination", "js_composer" ),
							"param_name" => "videogo_pagination_yesno",
							"value" => array("Select pagination","No","Yes"),
							"description" => __( "Yes / No", "js_composer" )
						),	
						array(
							"type" => "textfield",
							"heading" => __( "Extra class name", "js_composer" ),
							"param_name" => "el_class",
							"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
						),
					)
				) );
		
			}
		}
		
		function videogo_videogo_shortcode( $atts, $content = null ) {
			$atts['videogo_words_count'] = '140'; # YKG DIRTY FIX

			extract( shortcode_atts( array(
			'videogo_count' => '',
			'videogo_words_count' => '',
			'videogo_category' => '',
			'videogo_style' => '',
			'videogo_image' => '',
			'videogo_pagination_yesno' => '',
			'el_class' => ''
		), $atts ) );

			$term = get_term_by('name', $videogo_category, 'category');
			$category_id = $term->term_id;
			$output = '';
																			 
			 global $wpdb;
			 global $post,$paged;
		
		$query = "SELECT wpp.ID video_id,wpp.post_title video_title,wpp.post_content video_content FROM wp_posts AS wpp   INNER JOIN wp_term_relationships AS wtr ON wpp.ID = wtr.object_id INNER JOIN wp_postmeta wppm ON wppm.post_id = wpp.ID WHERE wtr.term_taxonomy_id = $category_id group by wppm.post_id LIMIT 0,$videogo_count";
			$videogo_posts = $wpdb->get_results($query);

			if($videogo_style == 'style1'){

      				$output .= '<section class="cp-section pd-tb60 '.$el_class.'" style="background:rgba(0, 0, 0, 0) url('.$videogo_image.') no-repeat scroll right bottom">';
					$output .= '<div class="">';
					$output .= '<!--Outer Holder Start-->';
					$output .= '<div class="cp-outer-holder">';
					$output .= '<div class="">';
					$output .= '<div class="">';
					$output .= '<!--Categories Outer Start-->';
					$output .= '<ul class="cp-categories-outer pd-b60">';
				
				foreach($videogo_posts as $videoz){
					
					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
					
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
					$image_url = $image_full[0];
					
					if($image_url <> ''){
						$video_image = aq_resize( $image_url, 457, 337, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" class="video-image" alt="video image '.$videoz->video_id.'"></a>';
					}
					
					if (strlen($videoz->video_content) > $videogo_words_count){
						$video_content = substr($videoz->video_content, 0, $videogo_words_count) . '...';
					} else {
						$video_content = $videoz->video_content;
					}

					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$output .= '<li>';
					$output .= '<div class="cp-most-listed">';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image;
					$output .= '<figcaption class="cp-caption">';
					$output .= '<a href="'.get_permalink($videoz->video_id).'" class="play-video">Play</a>';
					$output .= '</figcaption>';
					$output .= '</figure>';
					$output .= '<div class="cp-text">';
					$output .= '<h3><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h3>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li>'.esc_attr(get_the_date('Y.n.j G:i')).'</li>';
					$output .= '<li><span>'.$videogo_post_views.'</span></li>';
					$output .= '</ul>';
					$output .= '<p>'.$video_content.'</p>';
					$output .= '<a class="read-more" href="'.get_permalink($videoz->video_id).'">{+}</a>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</li>';

				}
				
				$output .= '</ul>';
				$output .= '<!--Categories Outer End-->';
				
				if($videogo_pagination_yesno == 'Yes'){ 
					$output .= '<!--Pagination Start--><div class="cp-pagination-row">'.videogo_pagination().'</div><!--Pagination End-->';
				}
				
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<!--Outer Holder End-->';
				$output .= '</div>';
				$output .= '</section>';	
				
			} else if($videogo_style == 'style2'){
				
				$videogo_image = wp_get_attachment_url( $videogo_image );

      				$output .= '<section class="cp-section '.$el_class.'" style="background:rgba(0, 0, 0, 0) url('.$videogo_image.') no-repeat scroll right bottom">';
					$output .= '<ul class="cp-categories-listed">';
					
				foreach($videogo_posts as $videoz){
					
					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
					
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
					$image_url = $image_full[0];
					
					if($image_url <> ''){
						$video_image = aq_resize( $image_url, 423, 347, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" class="video-image" alt="video 2 col image '.$videoz->video_id.'"></a>';
					}
					
					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$output .= '<li>';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image;
					$output .= '<figcaption class="cp-caption">';
					$output .= '<a href="'.get_permalink($videoz->video_id).'" class="play-video">Play</a>';
					$output .= '<div class="cp-text">';
					$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li>'.esc_attr(get_the_date('Y.n.j G:i')).'</li>';
					$output .= '<li><span>'.$videogo_post_views.'</span></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</figcaption>';
					$output .= '</figure>';
					$output .= '</li>';
					
				}
					
					$output .= '</ul></section>';
				
			} else if($videogo_style == 'style3'){
				
				$videogo_image = wp_get_attachment_url( $videogo_image );
				
      				$output .= '<div class="cp-categories-listed-outer '.$el_class.'" style="background:rgba(0, 0, 0, 0) url('.$videogo_image.') no-repeat scroll right bottom">';
					$output .= '<ul class="row">';
					
					
					foreach($videogo_posts as $videoz){
						
						$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
							if($post_detail_xml <> ''){
								$videogo_post_xml = new DOMDocument ();
								$videogo_post_xml->loadXML ( $post_detail_xml );
								$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
							}
						
						$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
						$image_url = $image_full[0];
						
						if($image_url <> ''){
							$video_image = aq_resize( $image_url, 260, 285, true );
							$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
						} else {
							$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
							$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" class="video-image" alt="video 2 col image '.$videoz->video_id.'"></a>';
						}
						
						$videogo_post_views = videogo_getPostViews($videoz->video_id);
						$output .= '<li class="col-md-4 col-sm-4 col-xs-12">';
						$output .= '<!-- Video Item Start-->';
						$output .= '<div class="cp-video-item">';
						$output .= '<figure class="cp-thumb">';
						$output .= $video_image;
						$output .= '<figcaption class="cp-caption">';
						$output .= '<a href="'.get_permalink($videoz->video_id).'" class="play-video">Play</a>';
						$output .= '</figcaption>';
						$output .= '</figure>';
						$output .= '<div class="cp-text">';
						$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
						$output .= '<ul class="cp-meta-list">';
						$output .= '<li>'.esc_attr(get_the_date('Y.n.j G:i')).'</li>';
						$output .= '<li><span>'.$videogo_post_views.'</span></li>';
						$output .= '</ul>';
						$output .= '</div>';
						$output .= '</div><!-- Video Item End-->';
						$output .= '</li>';
												
				}
					$output .= '</ul>';
					$output .= '</div>';
				if($videogo_pagination_yesno == 'Yes'){ 
					$output .= '<!--Pagination Start--><div class="cp-pagination-row">'.videogo_pagination().'</div><!--Pagination End-->';
				}
			
			}
			
			if(($videogo_style == '')||($videogo_style == ' ')){ echo '<h3>No style of this element is selected.</h3>';	}
			
			return $output;
			
		}

	}
	new videogo_videogo;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_videogo extends WPBakeryShortCode {
		}
	}
}
?>