<?php
	/*
	*	CrunchPress Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	/* size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar */
	$videogo_is_responsive = 'enable';
	
	if( $videogo_is_responsive ){
		$videogo_blog_div_listing_num_class = array(
			"Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,600), "size2"=>array(770, 265), "size3"=>array(570,300)),
			"Small-Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>array(175,155), "size2"=>array(175,155), "size3"=>array(175,155)));
	}	
	
	/* Basic Print Blog Element Function */
	function videogo_print_blog_item($item_xml){ 
	
		/* Removed Due To VC */
	
	}	
	
	
	/* Modern Blog Element Function */ 
	function print_blog_modern_item($item_xml){
		/* Removed Due To VC */
	}	
	
	/* Used Frequently */
	function videogo_print_blog_thumbnail( $postid, $videogo_item_size ){ 
		
		global $counter;
		$videogo_new_counter = rand();
		
		/* Get Post Options */
		$videogo_img_html = '';
		$videogo_thumbnail_types = '';
		$videogo_video_url_type = '';
		$videogo_select_slider_type = '';
		$videogo_post_detail_xml = get_post_meta($postid, 'post_detail_xml', true);
		if($videogo_post_detail_xml <> ''){
			$videogo_post_xml = new DOMDocument ();
			$videogo_post_xml->loadXML ( $videogo_post_detail_xml ); 
			$videogo_thumbnail_types = videogo_find_xml_value($videogo_post_xml->documentElement,'post_thumbnail');
			$videogo_audio_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'audio_url_type');
			$videogo_video_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
			$videogo_select_slider_type = videogo_find_xml_value($videogo_post_xml->documentElement,'select_slider_type');	
			
			/* Featured Image */
			if( $videogo_thumbnail_types == "Image"){
				if(get_the_post_thumbnail($postid, $videogo_item_size) <> ''){
					$videogo_img_html = '<div class="post_featured_image thumbnail_image">';
					$videogo_img_html = $videogo_img_html . get_the_post_thumbnail($postid, $videogo_item_size);
					$videogo_img_html = $videogo_img_html . '</div>';
				}
				
			}else if( $videogo_thumbnail_types == "Video" ){
				/* Video Thumbnail */
				if($videogo_video_url_type <> ''){									
					$videogo_img_html = '<div class = "remove_hover">';				
					$videogo_img_html = $videogo_img_html .'<div class="post_featured_image thumbnail_image videopost">';
					$videogo_img_html = $videogo_img_html . '<div class="blog-thumbnail-video">';
					if(videogo_get_width($videogo_item_size) == '350'){					
						$img_html = $img_html . videogo_get_video($videogo_video_url_type, videogo_get_width($videogo_item_size), '335');
					}else{												
					$videogo_img_html = $videogo_img_html . videogo_get_video($videogo_video_url_type, videogo_get_width($videogo_item_size), videogo_get_height($videogo_item_size));	
					}
					$videogo_img_html = $videogo_img_html . '</div></div></div>';
				}
			}else if ( $videogo_thumbnail_types == "Slider" ){ 
				/* Print Slider */			
				$videogo_slider_xml = get_post_meta( intval($videogo_select_slider_type), 'cp-slider-xml', true); 				
				if($videogo_slider_xml <> ''){
					$videogo_slider_xml_dom = new DOMDocument();
					$videogo_slider_xml_dom->loadXML($videogo_slider_xml);
					$videogo_slider_name='bxslider'.$videogo_new_counter.$postid;									
					
					$videogo_audio_counter = $counter.$postid;
					/* Inline Styling For Slider Width */
					
					if(videogo_get_width($videogo_item_size) == '350'){									
						
						$videogo_slider_name = 'cp-home-banner';												
						$videogo_data = "#'". $videogo_slider_name."'{width:'".videogo_get_width($videogo_item_size)."'px;height:'".videogo_get_height($videogo_item_size)."'px;float:left;}";
						$videogo_handle = 'videogo-default-style-css';
						wp_add_inline_style ( $videogo_handle, $videogo_data );
					
					}else{												
						$videogo_data = "#'". $videogo_slider_name."'{width:100%;height:350px;float:left;}";
						$videogo_handle = 'videogo-default-style-css';
						wp_add_inline_style ( $videogo_handle, $videogo_data );
					}										
					$videogo_img_html = '<div class = "remove_hover">';					
					$videogo_img_html =  $videogo_img_html .'<div class="post_featured_image thumbnail_image sliderpost">';
					$videogo_img_html = $videogo_img_html . videogo_print_bx_slider($videogo_slider_xml_dom->documentElement, $videogo_item_size,$videogo_slider_name);
					$videogo_img_html = $videogo_img_html . '</div></div>';
				}
			}else if($videogo_thumbnail_types == "Audio"){ 
				if($videogo_audio_url_type <> '' ){
					$videogo_audio_counter = $counter.$postid;
						/* JPlayer Code */
						$videogo_img_html =  '<div class = "remove_hover"><div class="audio_player song-list audiopost">';
						$videogo_audio_html = '';
						if(strpos($videogo_audio_url_type,'soundcloud')){
							$videogo_img_html = $videogo_img_html . videogo_get_audio_track($videogo_audio_url_type,$videogo_audio_counter);
						}else{
							$videogo_img_html = $videogo_img_html . videogo_get_audio_track($videogo_audio_url_type,$videogo_audio_counter) . get_the_post_thumbnail($postid, $videogo_item_size);
						}
						$videogo_img_html = $videogo_img_html . '</div></div>';
				} 
			}else{				
				if(get_the_post_thumbnail($postid, $videogo_item_size) <> ''){								
					$videogo_img_html = '<div class="post_featured_image thumbnail_image">';
					$videogo_img_html = $videogo_img_html . get_the_post_thumbnail($postid, $videogo_item_size);
					$videogo_img_html = $videogo_img_html . '</div>'; 
				}
			}
		}
		return $videogo_img_html;
	}
	
	
	/* Similar Function Above */
	function videogo_print_blog_modern_thumbnail( $post_id, $videogo_item_size ){
		
		global $counter;
		/* Get Post Meta Options */
		$videogo_img_html = '';
		$videogo_thumbnail_types = '';
		$videogo_video_url_type = '';
		$videogo_select_slider_type = '';
		$videogo_post_detail_xml = get_post_meta($post_id, 'post_detail_xml', true);
		if($videogo_post_detail_xml <> ''){
			$videogo_post_xml = new DOMDocument ();
			$videogo_post_xml->loadXML ( $post_detail_xml );
			$videogo_thumbnail_types = videogo_find_xml_value($videogo_post_xml->documentElement,'post_thumbnail');
			$videogo_video_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
			$videogo_select_slider_type = videogo_find_xml_value($videogo_post_xml->documentElement,'select_slider_type');			
			/* Featured Image  */
			if( $videogo_thumbnail_types == "Image" || empty($videogo_thumbnail_types) ){
				if(get_the_post_thumbnail($post_id, $item_size) <> ''){
					$videogo_img_html = '<div class="post_featured_image thumbnail_image">';
					$videogo_img_html = $videogo_img_html . get_the_post_thumbnail($post_id, $videogo_item_size);
					$videogo_img_html = $videogo_img_html . '</div>';
				}
				
			}else if( $videogo_thumbnail_types == "Video" ){
				/* Print Video */
				if($videogo_video_url_type <> ''){
					$videogo_img_html = '<div class="post_featured_image thumbnail_image">';
					$videogo_img_html = $videogo_img_html . '<div class="blog-thumbnail-video">';
					
					if(videogo_get_width($videogo_item_size) == '175'){
						$videogo_img_html = $videogo_img_html . get_video($videogo_video_url_type, videogo_get_width($videogo_item_size), videogo_get_height($videogo_item_size));
					}else{
						$videogo_img_html = $videogo_img_html . get_video($videogo_video_url_type, '100%', videogo_get_height($videogo_item_size));
					}
					$videogo_img_html = $videogo_img_html . '</div></div>';
				}
			}else if ( $videogo_thumbnail_types == "Slider" ){
				/* Print Slider */
				$videogo_slider_xml = get_post_meta( intval($videogo_select_slider_type), 'cp-slider-xml', true); 				
				if($videogo_slider_xml <> ''){
					$videogo_slider_xml_dom = new DOMDocument();
					$videogo_slider_xml_dom->loadXML($videogo_slider_xml);
					$videogo_slider_name='bxslider'.$counter.$post_id;				
					/* Anything Slider Scripts */
					wp_enqueue_script( 'cp-bx-slider', VIDEOGO_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
					wp_enqueue_style('cp-bx-slider',VIDEOGO_PATH_URL.'/frontend/css/bxslider.css');
					
					if(videogo_get_width($videogo_item_size) == '175'){
						$videogo_data = "#'". $videogo_slider_name."'{width:'".videogo_get_width($videogo_item_size)."'px;height:'".videogo_get_height($videogo_item_size)."'px;float:left;}";
						$videogo_handle = 'videogo-default-style-css';
						wp_add_inline_style ( $videogo_handle, $videogo_data );
					}else{
						$videogo_data = "#'". $videogo_slider_name."'{width:100%;height:350px;float:left;}";
						$videogo_handle = 'videogo-default-style-css';
						wp_add_inline_style ( $videogo_handle, $videogo_data );
					}
					$videogo_img_html = '<div class="post_featured_image thumbnail_image">';
					$videogo_img_html = $videogo_img_html . videogo_print_bx_post_slider($videogo_slider_xml_dom->documentElement, $videogo_item_size,$videogo_slider_name);
					$videogo_img_html = $videogo_img_html . '</div>';
				}
			}else if($videogo_thumbnail_types == "Audio"){ 
				if(get_the_post_thumbnail($post_id, $videogo_item_size) <> ''){
					$videogo_img_html = '<div class="post_featured_image thumbnail_image">';
					$videogo_img_html = $videogo_img_html . videogo_get_audio_track($videogo_audio);;
					$videogo_img_html = $videogo_img_html . '</div>';
				}
			}
		}
		return $videogo_img_html;
	}
	
	 
	/* News Element Function */
	function videogo_print_news_item($item_xml){
		/* Removed Due To VC */
	
	}	
	
	
	/* Latest Show For DJ */
	function videogo_print_latest_show_item($item_xml){
		
		/* Removed Due To VC */
		
	}
	
	
              
	
	/* Latest News For Site */
	function videogo_print_featured_item($item_xml){
	
		/* Removed Due To VC */
		
	}
	
	
	/* Latest News Element */
	function videogo_print_latest_news_item($item_xml){
		
		/* Removed Due To VC */
		
	}