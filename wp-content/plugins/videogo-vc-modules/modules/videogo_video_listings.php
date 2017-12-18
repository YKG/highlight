<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_video_listings")){
	class videogo_video_listings{
		
		function __construct(){
			add_action("init",array($this,"videogo_video_listings_init"));
			add_shortcode('videogo_video_listings',array($this,'videogo_video_listings_shortcode'));
		}
		
		function videogo_video_listings_init(){
			$catarray = array();
			if(function_exists("vc_map")){
				global $wpdb;

				$query = "SELECT wt.term_id,wt.name FROM $wpdb->terms wt LEFT JOIN $wpdb->term_taxonomy wtt ON wtt.`term_id` = wt.`term_id` WHERE taxonomy = 'category'";
				$term = $wpdb->get_results($query);

					foreach($term as $t){
						$catarray[$t->name] = $t->name;
					}	
					
					vc_map( array(
					'base' => 'videogo_video_listings',
					"name" => __( "Video Listing", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "No of Posts", "js_composer" ),
							"param_name" => "videogo_listing_count",
							"description" => __( "Enter Videos count.", "js_composer" )
						),
						array(
							"type" => "dropdown",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Videos Listing Category", "js_composer" ),
							"param_name" => "videogo_listing_category",
							"value" => $catarray,
							"description" => __( "Select category as Title for listing.", "js_composer" )
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Video Category Display", "js_composer" ),
							"param_name" => "videogo_style",
							"value" => array("Select Style","style1","style2","style3","style4","style5","style6"),
							"description" => __( "Single Col, Two Col or Three Col", "js_composer" )
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
		
		function videogo_video_listings_shortcode( $atts, $content = null ) {
		
		extract( shortcode_atts( array(
			'videogo_listing_count' => '',
			'videogo_listing_category' => '',
			'videogo_style' => '',
			'el_class' => ''
		), $atts ) );

			$term = get_term_by('name', $videogo_listing_category, 'category');
			$category_id = $term->term_id;
		    $category_link = get_category_link( $category_id );
			
			$output = '';	
																				 
			 global $wpdb;
			 global $post,$paged;

//            $query = "SELECT wpp.ID video_id,wpp.post_title video_title,wpp.post_content video_content FROM wp_posts AS wpp   INNER JOIN wp_term_relationships AS wtr ON wpp.ID = wtr.object_id INNER JOIN wp_postmeta wppm ON wppm.post_id = wpp.ID WHERE wtr.term_taxonomy_id = $category_id group by wppm.post_id LIMIT 0,$videogo_listing_count";
            $query = "SELECT wpp.ID video_id,wpp.post_title video_title,wpp.post_content video_content FROM wp_posts AS wpp   INNER JOIN wp_term_relationships AS wtr ON wpp.ID = wtr.object_id INNER JOIN wp_postmeta wppm ON wppm.post_id = wpp.ID WHERE wtr.term_taxonomy_id = $category_id group by wppm.post_id DESC LIMIT 0,$videogo_listing_count";
			$videogo_posts = $wpdb->get_results($query);

			if($videogo_style == 'style1'){
				
      				$output .= '<section class="cp-section pd-tb60 '.$el_class.'" >';
					$output .= '<div class="cp-outer-holder cp-featured-video">';
					$output .= '<div class="row">';
					$output .= '<div class="col-md-12 cp-heading-outer">';
					$output .= '<h2>'.$videogo_listing_category.'</h2>';
					$output .= '<ul class="cp-listed">';
					$output .= '<li class="view-all"><a href="'.esc_url( $category_link ).'">View All</a></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<div id="featured-video">';
					
				foreach($videogo_posts as $videoz){
					
					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}

					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" );
					$image_url = $image_full[0];
					
					if($image_url <> ''){
						$video_image = aq_resize( $image_url, 260, 285, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" alt="video listing image '.$videoz->video_id.'"></a>';
					}
					
					$output .= '<div class="item">';
					$output .= '<div class="cp-video-item">';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image; 
					$output .= '<figcaption class="cp-caption"> <a href="'.get_permalink($videoz->video_id).'" class="play-video">Play</a> </figcaption>';
					$output .= '</figure>';
					$output .= '<div class="cp-text">';
					$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li><span>' . $videogo_post_views . '</span></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					
				}
					
					$output .= '</div>';
					$output .= '</div>';
				$output .= '</section>';	
				
			} else if($videogo_style == 'style2'){

      				$output .= '<div class="cp-outer-holder '.$el_class.'">';
					$output .= '<div class="cp-most-view-outer pd-b60">';
					$output .= '<div class="cp-heading-outer">';
					$output .= '<h2>'.$videogo_listing_category.'</h2>';
					$output .= '<ul class="cp-listed">';
					$output .= '<li class="view-all"><a href="'.esc_url( $category_link ).'">View All</a></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '<div class="cp_viewed-slider">';
					
				foreach($videogo_posts as $videoz){

					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
					
					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
					$image_url = $image_full[0];
					
					if($image_url <> ''){
						$video_image = aq_resize( $image_url, 457, 337, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" alt="video listing image '.$videoz->video_id.'"></a>';
					}
					
						$video_content = substr($videoz->video_content, 0, strrpos(substr($videoz->video_content, 0, 315), ' ')) . '...';

					$output .= '<div class="item">';
					$output .= '<div class="cp-most-listed">';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image;
					$output .= '<figcaption class="cp-caption"> <a href="'.get_permalink($videoz->video_id).'" class="play-video">Play</a> </figcaption>';
					$output .= '</figure>';
					$output .= '<div class="cp-text">';
					$output .= '<h3><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h3>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li><span>' . $videogo_post_views . '</span></li>';
					$output .= '</ul>';
					$output .= '<p>'.$video_content.'</p>';
					$output .= '<p><a class="read-more" href="'.get_permalink($videoz->video_id).'">{+}</a></p>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					
				}
					
					$output .= '</div>';
					$output .= '</div>';
      				$output .= '</div>';
			
			} else if($videogo_style == 'style3'){
				
      				$output .= '<div class="cp-categories-outer '.$el_class.'">';
					$output .= '<div class="cp-heading-outer">';
					$output .= '<h2>'.$videogo_listing_category.'</h2>';
					$output .= '<ul class="cp-listed">';
					$output .= '<li class="view-all"><a href="'.esc_url( $category_link ).'">View All</a></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '<ul class="cp-categories-listed">';
					
				foreach($videogo_posts as $videoz){
					
					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
					
					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
					$image_url = $image_full[0];
					
					if($image_url <> ''){
						$video_image = aq_resize( $image_url, 423, 347, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" alt="video listing image '.$videoz->video_id.'"></a>';
					}
					
					$output .= '<li>';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image;
					$output .= '<figcaption class="cp-caption"> <a href="'.get_permalink($videoz->video_id).'" class="play-video">Play</a>';
					$output .= '<div class="cp-text">';
					$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li><span>' . $videogo_post_views . '</span></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</figcaption>';
					$output .= '</figure>';
					$output .= '</li>';
					
				}
					
					$output .= '</ul>';
					$output .= '</div>';
				
			} else if($videogo_style == 'style4'){
				
      				$output .= '<div class="cp-comedy-video '.$el_class.'">';
					$output .= '<div class="cp-heading-outer">';
					$output .= '<h2>'.$videogo_listing_category.'</h2>';
					$output .= '<ul class="cp-listed">';
					$output .= '<li class="view-all"><a href="'.esc_url( $category_link ).'">View All</a></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '<div id="comedy-videos">';
					
				foreach($videogo_posts as $videoz){
					
					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
					
					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
					$image_url = $image_full[0];
					
					if($image_url <> ''){
						$video_image = aq_resize( $image_url, 260, 285, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" alt="video listing image '.$videoz->video_id.'"></a>';
					}
				
					$output .= '<div class="item">';
					$output .= '<div class="cp-video-item">';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image;
					$output .= '<figcaption class="cp-caption"> <a href="'.get_permalink($videoz->video_id).'" class="play-video">Play</a> </figcaption>';
					$output .= '</figure>';
					$output .= '<div class="cp-text">';
					$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li><span>' . $videogo_post_views . '</span></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					
				}
					
					$output .= '</div>';
					$output .= '</div>';
			
			} else if($videogo_style == 'style5'){
				
      				$output .= '<div class="cp-featured-block m60 '.$el_class.'">';
					$output .= '<div class="row">';
					$output .= '<div class="col-md-12 cp-heading-outer">';
					$output .= '<h2>'.$videogo_listing_category.'</h2>';
					$output .= '<ul class="cp-listed">';
					$output .= '<li class="view-all"><a href="'.esc_url( $category_link ).'">View All</a></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '<div class="featured-blocks">';
					
				foreach($videogo_posts as $videoz){
					
					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
					
					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
					$image_url = $image_full[0];
					
					if($image_url <> ''){
						$video_image = aq_resize( $image_url, 260, 252, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image_url = videogo_get_video_thumbnail($videogo_video_url); 
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image_url.'" alt="video listing image '.$videoz->video_id.'"></a>';
					}
				
					$output .= '<div class="col-md-4">';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image;
					$output .= '<figcaption class="cp-caption"> <a class="play-video" href="'.get_permalink($videoz->video_id).'">Play</a>';
					$output .= '<div class="cp-text">';
					$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li><span>' . $videogo_post_views . '</span></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</figcaption>';
					$output .= '</figure>';
					$output .= '</div>';
				}
					
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';

			} else if($videogo_style == 'style6'){
				
					$output .= '<div class="cp-music-video '.$el_class.'">';
					$output .= '<div class="cp-music-holder">';
					$output .= '<div class="cp-heading-outer">';
					$output .= '<h2>'.$videogo_listing_category.'</h2>';
					$output .= '<ul class="cp-listed">';
					$output .= '<li class="view-all"><a href="'.esc_url( $category_link ).'">View All</a></li>';
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '<div class="row">';
					$output .= '<div class="col-md-5">';
                  
                  	$videogo_post_counter = 0;
				foreach($videogo_posts as $videoz){ 
					
					$post_detail_xml = get_post_meta( $videoz->video_id , 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
					
					$videogo_post_views = videogo_getPostViews($videoz->video_id);
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $videoz->video_id ), "full" ); 
					$image_url = $image_full[0];
					
					if($videogo_post_counter == 0){
						$video_image = aq_resize( $image_url, 261, 265, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					} else {
						$video_image = aq_resize( $image_url, 107, 71, true );
						$video_image = '<a href="'.get_permalink($videoz->video_id).'"><img src="'.$video_image.'" alt="video image '.$videoz->video_id.'"></a>';
					}
					
						$video_content = substr($videoz->video_content, 0, strrpos(substr($videoz->video_content, 0, 220), ' ')) . '...';
                  
                  if($videogo_post_counter == 0){
					  
	                $output .= '<div class="cp-video-item">';
					$output .= '<figure class="cp-thumb">';
					$output .= $video_image;
					$output .= '<figcaption class="cp-caption"> <a class="play-video" href="'.get_permalink($videoz->video_id).'">Play</a> </figcaption>';
					$output .= '</figure>';
					$output .= '<div class="cp-text">';
					$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
					$output .= '<ul class="cp-meta-list">';
					$output .= '<li><span>' . $videogo_post_views . '</span></li>';
					$output .= '</ul>';
					$output .= '<p>'.$video_content.'<a href="'.get_permalink($videoz->video_id).'">{+}</a></p>';
					$output .= '</div>';
					$output .= '</div>';
					$videogo_post_counter++;
					continue;
					
				  }

                  if($videogo_post_counter == 1){
					
					$output .= '</div>';
					$output .= '<div class="col-md-7">';
					$output .= '<ul class="cp-music-list">';
					
				  }
					
                  if($videogo_post_counter >= 1){
					
					$output .= '<li>';
					$output .= '<div class="cp-thumb">';
					$output .= $video_image;
					$output .= '</div>';
					$output .= '<div class="cp-post-content">';
					$output .= '<h4><a href="'.get_permalink($videoz->video_id).'">'.$videoz->video_title.'</a></h4>';
					$output .= '<p>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).' <span>54 Views</span></p>';
					$output .= '</div>';
					$output .= '</li>';
					
				  }
					$videogo_post_counter++;
					
				}
					
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				
			}
			
			if(($videogo_style == '')||($videogo_style == ' ')){ echo '<h3>No style of element Video Listings is selected.</h3>';	}
			
			return $output;
			
		}

	}
	new videogo_video_listings;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_video_listings extends WPBakeryShortCode {
		}
	}
}
?>