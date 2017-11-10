<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_sponser")){
	class videogo_sponser{
		function __construct(){
			add_action("init",array($this,"videogo_sponser_init"));
			add_shortcode('videogo_sponser',array($this,'videogo_sponser_shortcode'));
		}
		
		function videogo_sponser_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_sponser',
					"name" => __( "Sponser/Clients/Partners", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							'type' => 'attach_images',
							"holder" => "h3",
							'heading' => __( 'Images', 'js_composer' ),
							'param_name' => 'image_large',
							'value' => '',
							'description' => __( 'Select images from media library.', 'js_composer' )
						),	
					 
						array(
							"type" => "textfield",
							"heading" => __( "Enter Page link", "js_composer" ),
							"param_name" => "link_page",
							"value" => '',
							"description" => __( "separated link by comma(,) for sponsor image.", "js_composer" )
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
		
		function videogo_sponser_shortcode( $atts, $content = null ) {
			
			$results = shortcode_atts( array(
				'image_large' => '',
				'link_page' => '',
				'el_class' => ''
				
			), $atts );
			
			extract($results);
			
			$output = '';
			
			$title =  explode( ',', $link_page ) ;
			$image_large =  explode( ',', $image_large ) ;
			
					    $output .= '<section class="videogo_brands-section">';
      					$output .= '<div class="container">';
						$output .= '<div class="videogo_brands-box">';
						$output .= '<div class="row">';
						
							foreach($image_large as $key => $image_id){
								$img_id = preg_replace( '/[^\d]/', '', $image_id );
								$image = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '100', 'class' => 'vc_single_image-img' ) );
								
								$final =  $image['p_img_large'][0];
								if(empty($final)){
									$image_url = '<img class="vc_single_image-img" src="' . vc_asset_url( 'vc/no_image.png' ) . '" />'; 
								} else {
									 $image_url = '<img src="'.$final.'" alt="">'; 
								}
								
								$output .= '<div class="col-md-2">'.$image_url.'</div>';
							} 
						$output .= '</div></div></div></section>';
			return $output;
		}
	}
	new videogo_sponser;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_sponser extends WPBakeryShortCode {
		}
	}	
}
?>