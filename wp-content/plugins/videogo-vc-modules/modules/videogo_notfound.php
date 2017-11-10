<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_notfound")){
	class videogo_notfound{
		function __construct(){
			add_action("init",array($this,"videogo_notfound_init"));
			add_shortcode('videogo_notfound',array($this,'videogo_notfound_shortcode'));
		}
		
		function videogo_notfound_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_notfound',
					"name" => __( "404 Layout", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"heading" => __( "404 Heading", "js_composer" ),
							"param_name" => "nf_title",
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
							"type" => "attach_image",
							"heading" => __( "Select Image", "js_composer" ),
							"param_name" => "nf_images",
							"value" => "",
							"description" => __( "Select Image from Media Library.", "js_composer" ),
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"heading" => __( "Search Message", "js_composer" ),
							"param_name" => "nf_sm",
							"value" => __( "", "js_composer" ),
							"description" => __( "Enter The Text for Search input area.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"heading" => __( "Link Button Text", "js_composer" ),
							"param_name" => "nf_link_btn_text",
							"value" => __( "", "js_composer" ),
							"description" => __( "Enter The Text for Link Button.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"heading" => __( "Link URL", "js_composer" ),
							"param_name" => "nf_link_url",
							"value" => __( "", "js_composer" ),
							"description" => __( "Enter The URL for Link Button.", "js_composer" )
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
		
		function videogo_notfound_shortcode( $atts, $content = null ) {
		//print_r($atts);
			extract( shortcode_atts( array(
				'nf_title' => '',
				'nf_images' => '',
				'nf_sm' => '',
				'nf_link_btn_text' => '',
				'nf_link_url' => '',
				'el_class' => ''
				
			), $atts ) );
			
					$output = '';

					$image_full = wp_get_attachment_image_src( $nf_images, "full" );
					$image_url = $image_full[0];
					
					$output .= '<section class="cp-page404-section '.$el_class.'">';
					$output .= '<img src="'.$image_url.'" alt="error image">';
					$output .= '<div class="container">';
					$output .= '<div class="cp-error-holder">';
					$output .= '<strong class="cp-title">'.$nf_title.'</strong>';
					$output .= '<p>'.wpb_js_remove_wpautop( $content, true ).'</p>';
					$output .= '<form action="'.esc_url(home_url('/')).'" method="get" id="searchform" class="cp-newsletter-form">';
					$output .= '<input type="text" placeholder="'.$nf_sm.'" value="'.the_search_query().'" name="s" required pattern="[a-zA-Z ]+">';
					$output .= '<button type="submit" class="btn-submit" value="Submit"><span class="fa fa-search"></span></button>';
					$output .= '</form>';
					$output .= '<a href="'.$nf_link_url.'" class="cp-btn-style2">'.$nf_link_btn_text.'</a>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</section>';
					
			return $output;
		}
	}
	new videogo_notfound;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_notfound extends WPBakeryShortCode {
		}
	}	
}
?>