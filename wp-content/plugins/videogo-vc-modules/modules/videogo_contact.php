<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_contact_detail")){
	class videogo_contact_detail{
		function __construct(){
			add_action("init",array($this,"videogo_contact_detail_init"));
			add_shortcode('videogo_contact_detail',array($this,'videogo_contact_detail_shortcode'));
		}
		
		function videogo_contact_detail_init(){
			$videogo_formArray='';
			if( post_type_exists('wpcf7_contact_form') ){
				
				$videogo_formArray[0] = esc_html__("Select Contact Form",'videogo');
				$videogo_args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
				if( $videogo_cf7Forms = get_posts( $videogo_args ) ){
					foreach($videogo_cf7Forms as $videogo_cf7Form){
						$videogo_formArray[$videogo_cf7Form->ID] = $videogo_cf7Form->post_title;
					}
				}else{
					$videogo_formArray = array();
				}
			}	
			
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_contact_detail',
					"name" => __( "Contact Details", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Contact Detail Heading', 'js_composer' ),
							'param_name' => 'heading_detail',
							'value' => '',
							'description' => __( 'Enter Contact Detail Heading.', 'js_composer' )
						),
						array(
							"type" => "textarea",
							"heading" => __( "Demo Text", "js_composer" ),
							"param_name" => "content",
							"value" => '',
							"description" => __( "Enter Some Detail", "js_composer" )
						),
						array(
							"type" => "textfield",
							"heading" => __( "Enter  Email Address", "js_composer" ),
							"param_name" => "email",
							"value" => '',
							"description" => __( "Enter  Email Address", "js_composer" )
						),
						array(
							"type" => "textfield",
							"heading" => __( "Enter  Address", "js_composer" ),
							"param_name" => "address",
							"value" => '',
							"description" => __( "Enter  Address", "js_composer" )
						),
						array(
							"type" => "textfield",
							"heading" => __( "Enter  Phone Number", "js_composer" ),
							"param_name" => "phone",
							"value" => '',
							"description" => __( "Enter  Phone Number", "js_composer" )
						),
						array(
							"type" => "attach_image",
							"heading" => __( "Select Background Image", "js_composer" ),
							"param_name" => "address_bar_image",
							"value" => "",
							"description" => __( "Select Image from Media Library.", "js_composer" ),
						),
						array(

							"type" => "dropdown",
							"heading" => esc_html__( "Select Contact Form", 'videogo' ),
							"param_name" => "form_name",
							"value" => $videogo_formArray,
							"description" => esc_html__( "Please Select Contact Form", 'videogo' )

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
		
		function videogo_contact_detail_shortcode( $atts, $content = null ) {
			
			$results = shortcode_atts( array(
				'heading_detail' => '',
				'email' => '',
				'address' => '',
				'phone' => '',
				'address_bar_image' => '',
				'el_class' => '',
				'videogo_form_id'=>'',
				'form_name'=>'',
				
			), $atts );
			
			extract($results);

			$image_full = wp_get_attachment_image_src( $address_bar_image, "full" );
			$image_url = $image_full[0];
			
			if( $form_name <> esc_html__('Select Contact Form','videogo') ){
				$videogo_args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
				if( $videogo_cf7Forms = get_posts( $videogo_args ) ){
					foreach($videogo_cf7Forms as $videogo_cf7Form){
						$videogo_formArray[$videogo_cf7Form->ID] = $videogo_cf7Form->post_title;
						if( $videogo_cf7Form->post_title == $form_name ){
							$videogo_form_id=$videogo_cf7Form->ID;
						}	
					}
				}
			}	
			
			$output = '';
			$output .= '<!--Contact Us Start-->';
			$output .= '<section class="cp-contact-us-section pd-b60 '.$el_class.'">';
			$output .= '<div class="container">';
			$output .= '<div class="cp-get-in-touch-outer">';
			$output .= '<div class="cp-top-holder">';
			$output .= '<h3>'.$heading_detail.'</h3>';
			$output .= '<p>'.$content.'</p>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<!--Get In Outer Start-->';
			$output .= '<div class="cp-get-in-outer" style="background: rgba(0, 0, 0, 0) url('.$image_url.') no-repeat scroll left top / cover ">';
			$output .= '<div class="row">';
			if($email <> ''){
			$output .= '<div class="col-md-4 col-sm-4">';
			$output .= '<div class="inner-holder">';
			$output .= '<i class="fa fa-paper-plane"></i>';
			$output .= '<a href="mailto:'.$email.'">'.$email.'</a>';
			$output .= '</div>';
			$output .= '</div>';
			}
			if($address <> ''){
			$output .= '<div class="col-md-4 col-sm-4">';
			$output .= '<div class="inner-holder">';
			$output .= '<i class="fa fa-map-marker"></i>';
			$output .= '<p>'.$address.'</p>';
			$output .= '</div>';
			$output .= '</div>';
			}
			if($phone <> ''){
			$output .= '<div class="col-md-4 col-sm-4">';
			$output .= '<div class="inner-holder">';
			$output .= '<i class="fa fa-phone"></i>';
			$output .= '<p>'.$phone.'</p>';
			$output .= '</div>';
			$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<!--Get In Outer End-->';
			
			
			if($form_name <> 'Select Contact Form' && !empty($videogo_form_id) ){ 
			$output .= do_shortcode ('[contact-form-7 id="'.esc_attr($videogo_form_id).'"]');
			}
			
			$output .= '</div>';
			$output .= '</section>';
			$output .= '<!--Contact Us End-->';
			
			return $output;
		}
	}
	new videogo_contact_detail;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_contact_detail extends WPBakeryShortCode {
		}
	}	
}

?>