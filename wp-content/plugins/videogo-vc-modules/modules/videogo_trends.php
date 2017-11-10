<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_trends")){
	class videogo_trends{
		function __construct(){
			add_action("init",array($this,"videogo_trends_init"));
			add_shortcode('videogo_trends',array($this,'videogo_trends_shortcode'));
		}
		
		function videogo_trends_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_trends',
					"name" => __( "Latest Trends", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"heading" => __( "Trend Heading", "js_composer" ),
							"param_name" => "trend_title",
							"value" => __( "", "js_composer" ),
							"description" => __( "Enter The Text for Heading.", "js_composer" )
						),
						array(
							"type" => "textarea_html",
							"holder" => "p",
							"class" => "",
							"heading" => __( "Enter Text", "js_composer" ),
							"param_name" => "content",
							"value" => __( "", "js_composer" ),
							"description" => __( "Enter Detail Here.", "js_composer" )
						),
						array(
							"type" => "attach_images",
							"heading" => __( "Select Images", "js_composer" ),
							"param_name" => "trend_images",
							"value" => "",
							"description" => __( "Select Image from Media Library.", "js_composer" ),
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"heading" => __( "Trend Link", "js_composer" ),
							"param_name" => "trend_link",
							"value" => __( "", "js_composer" ),
							"description" => __( "Enter The URL.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"heading" => __( "Trend Link Text", "js_composer" ),
							"param_name" => "trend_link_text",
							"value" => __( "", "js_composer" ),
							"description" => __( "Enter The Text for Link Button.", "js_composer" )
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
		
		function videogo_trends_shortcode( $atts, $content = null ) {
		//print_r($atts);
			extract( shortcode_atts( array(
				'trend_title' => '',
				'trend_images' => '',
				'trend_link' => '',
				'trend_link_text' => '',
				'el_class' => ''
				
			), $atts ) );
			
					$output = '';
					
					$images_to_show = explode(',', $trend_images);
					$output .= '<section class="videogo_trends-section">';
					$output .= '<div class="container-fluid">';
					$output .= '<div class="row">';
					$output .= '<div class="col-md-3">';
					$output .= '<div class="holder">';
					$output .= '<h3>'.$trend_title.'</h3>';
					$output .= ''.wpb_js_remove_wpautop( $content, true ).'';
					$output .= '<a class="btn-style-4" href="'.$trend_link.'">'.$trend_link_text.'</a> </div>';
					$output .= '</div>';
					$output .= '<div class="col-md-9">';
					$output .= '<div class="row">';
					foreach($images_to_show as $image){
						$image_full = wp_get_attachment_image_src( $image, "full" );
						$image_url = $image_full[0];
						$current_image = aq_resize( $image_url, 432, 335, true ); 
						$output .= '<div class="col-md-4 col-sm-6"><div class="thumb">';
						$output .= '<img src="'.$current_image.'" alt="trend images">';
						$output .= '</div></div>';
						} 
					$output .= '</div></div></div></div></section>';
		
			return $output;
		}
	}
	new videogo_trends;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_trends extends WPBakeryShortCode {
		}
	}	
}
?>