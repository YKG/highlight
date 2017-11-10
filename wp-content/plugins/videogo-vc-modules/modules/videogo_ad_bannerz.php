<?php 
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_ad_bannerz")){
	class videogo_ad_bannerz{
		
		function __construct(){
			add_action("init",array($this,"videogo_ad_bannerz_init"));
			add_shortcode('videogo_ad_bannerz',array($this,'videogo_ad_bannerz_shortcode'));
		}
		
		function videogo_ad_bannerz_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_ad_bannerz',
					"name" => __( "Advertisement", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							'type' => 'attach_image',
							"holder" => "h3",
							'heading' => __( 'Ad Image', 'js_composer' ),
							'param_name' => 'ad_image',
							'value' => '',
							'description' => __( 'Select Advertisement image from media library. Image will be cropped according to style.', 'js_composer' )
						),
						array(
							"type" => "dropdown",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Ad Style", "js_composer" ),
							"param_name" => "ad_style",
							"value" =>  array( __( 'Select Style', 'js_composer' ) => 'empty',
											__( 'Style 1', 'js_composer' ) => 'style1',
											__( 'Style 2', 'js_composer' ) => 'style2'
											),
							"description" => __( "Different Styles of Advertisement.", "js_composer" )
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
		
		function videogo_ad_bannerz_shortcode( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'ad_image' => '',
				'ad_code' => '',
				'ad_style' => '',
				'el_class' => ''	
			), $atts ) );


			$output = '';
			
			if($ad_style == 'style1'){ 
			
				$image_full = wp_get_attachment_image_src( $ad_image, "full" );
				$image_url = $image_full[0];
				$current_ad_image = aq_resize( $image_url, 728, 90, true );
				
				$output .= '<div class="cp-advertisement">';
				$output .= '<div class="row">';
				$output .= '<div class="col-md-12">';
				if($ad_image <> ''){
					$output .= '<img src="'.$current_ad_image.'" alt="Advertisement image style 1">';
				} 
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';

			}
			
			if($ad_style == 'style2'){
				
				$image_full = wp_get_attachment_image_src( $ad_image, "full" );
				$image_url = $image_full[0];
				$current_ad_image = aq_resize( $image_url, 160, 600, true );
				
				$output .= '<div class="cp-ad-holder">';
				if($ad_image <> ''){
					$output .= '<img src="'.$current_ad_image.'" alt="">';
				} 
				$output .= '</div>';
				
				}
			
			if(($ad_style == '')||($ad_style == ' ')){ echo '<h3>No style of element Advertisement is selected.</h3>';	}
			
			return $output;
		}

	}
	new videogo_ad_bannerz;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_ad_bannerz extends WPBakeryShortCode {
		}
	}
}
?>