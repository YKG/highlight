<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_coming_soon")){
	class videogo_coming_soon{
		function __construct(){
			add_action("init",array($this,"videogo_coming_soon_init"));
			add_shortcode('videogo_coming_soon',array($this,'videogo_coming_soon_shortcode'));
		}
		function videogo_coming_soon_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_coming_soon',
					"name" => __( "Coming Soon", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter  Heading', 'js_composer' ),
							'param_name' => 'heading',
							'value' => '',
							'description' => __( 'Enter  Heading.', 'js_composer' )
						),	
						array(
							'type' => 'textarea',
							"holder" => "h3",
							'heading' => __( 'Enter content', 'js_composer' ),
							'param_name' => 'content',
							'value' => '',
							'description' => __( 'Enter content.', 'js_composer' )
						),	
						array(
							"type" => "attach_image",
							"heading" => __( "Select Background Image", "js_composer" ),
							"param_name" => "comingsoon_image",
							"value" => "",
							"description" => __( "Select Image from Media Library.", "js_composer" ),
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
		
		function videogo_coming_soon_shortcode( $atts, $content = null ) {
			
			$results = shortcode_atts( array(
				'heading' => '',
				'comingsoon_image' => '',
				'el_class' => ''
				
			), $atts );
			
			extract($results);
			
			$output = '';
			
			$image_full = wp_get_attachment_image_src( $comingsoon_image, "full" );
			$image_url = $image_full[0];
								
			$output .= '<!--Main Content Start-->';
			$output .= '<div class="m-b" style="margin-bottom: -65px;">';
			$output .= '<!--Coming Soon Start-->';
			$output .= '<section class="cp-coming-soon-section '.$el_class.'" style="background: url('.$image_url.') no-repeat scroll left top / cover;">';
			$output .= '<div class="container">';
			$output .= '<!--Error Holder Start-->';
			$output .= '<div class="cp-error-holder">';
			$output .= '<strong class="cp-title">'.$heading.'</strong>';
			$output .= '<p>'.$content.'</p>';
			$output .= '<form action="'.esc_url(home_url('/')).'" method="get" id="searchform_widget" class="cp-newsletter-form">';
			$output .= '<input type="text" placeholder="'.esc_html('Looking for something...','videogo').'" name="s" value="'.the_search_query().'" required pattern="[a-zA-Z ]+">';
			$output .= '<button type="submit" class="btn-submit" value="'.esc_html('Submit','videogo').'"><span class="fa fa-search"></span></button>';
			$output .= '</form>';
			$output .= '<a href="'.esc_url(home_url('/')).'" class="cp-btn-style2">'.esc_html('Home Page','videogo').'</a>';
			$output .= '</div>';
			$output .= '<!--Error Holder Start-->';
			$output .= '</div>';
			$output .= '</section>';
			$output .= '<!--Coming Soon End-->';
			$output .= '</div>';
			$output .= '<!--Main Content End-->';
			
			return $output;
		}
	}
	new videogo_coming_soon;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_coming_soon extends WPBakeryShortCode {
		}
	}	
}
?>