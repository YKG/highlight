<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_contact_form")){
	class videogo_contact_form{
		function __construct(){
			add_action("init",array($this,"videogo_contact_form_init"));
			add_shortcode('videogo_contact_form',array($this,'videogo_contact_form_shortcode'));
		}
		
		function videogo_contact_form_init(){
			
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_contact_form',
					"name" => __( "Contact Form", "js_composer" ),
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
							"heading" => __( "Enter  Email", "js_composer" ),
							"param_name" => "email",
							"value" => '',
							"description" => __( "Enter  Email", "js_composer" )
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Contact Page Display Style", "js_composer" ),
							"param_name" => "contact_page_style",
							"value" => array("Select Style","style1","style2","style3"),
							"description" => __( "Select style ?", "js_composer" )
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
		
		function videogo_contact_form_shortcode( $atts, $content = null ) {
			
			$results = shortcode_atts( array(
				'heading_detail' => '',
				'contact_page_style' => '',
				'email' => '',
				'el_class' => ''
			), $atts );
			
			$output = '';
			extract($results);

				
			if($contact_page_style == 'style1'){

			  	$output .= '<section class="videogo_contact-style-1 padd-tb-80">';
      			$output .= '<div class="">';
        		$output .= '<div class="col-md-9">';					
          		$output .= '<form class="material" action="form.php" method="post">';
            	$output .= '<input type="text" name="name" placeholder="Name*" required pattern="[a-zA-Z ]+">';
            	$output .= '<input type="email" name="email" placeholder="E-mail*" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$">';
            	$output .= '<input type="text" name="website" placeholder="Website*" required>';
            	$output .= '<textarea name="message" placeholder="Comment*" required></textarea>';
            	$output .= '<input type="submit" value="Send">';
          		$output .= '</form>';
        		$output .= '</div>';
        		$output .= '<div class="col-md-3"></div>';
      			$output .= '</div>';
    			$output .= '</section>';
					
			}

			if($contact_page_style == 'style2'){
				
				$output .= '<section class="videogo_contact-style-2">';
				$output .= '<div class="holder">';
				$output .= '<h4>'.$heading_detail.'</h4>';
				$output .= '<p>'.$content.'</p>';
				$output .= '<form action="form.php" method="post" class="row">';
				$output .= '<div class="col-md-6 col-sm-6 col-xs-12">';
				$output .= '<label>What’s your name?</label>';
				$output .= '<input  type="text" required>';
				$output .= '</div>';
				$output .= '<div class="col-md-6 col-sm-6 col-xs-12">';
				$output .= '<label>Got an email address?</label>';
				$output .= '<input  type="text" required>';
				$output .= '</div>';
				$output .= '<div class="col-md-12 col-sm-12 col-xs-12">';
				$output .= '<label>What’s the subject of your message?</label>';
				$output .= '<input  type="text" required>';
				$output .= '</div>';
				$output .= '<div class="col-md-12 col-sm-12 col-xs-12">';
				$output .= '<label>Tell us about how we can help?</label>';
				$output .= '<textarea  cols="10" rows="10" required></textarea>';
				$output .= '</div>';
				$output .= '<div class="col-md-12 col-sm-12 col-xs-12">';
				$output .= '<input  type="submit" value="Send">';
				$output .= '</div>';
				$output .= '</form>';
				$output .= '</div>';
				$output .= '</section>';
	
			}
			
			if($contact_page_style == 'style3'){
				
				$output .= '<section class="padd-tb-80 videogo_contact-style-6">';
				$output .= '<div class="row">';
				$output .= '<h4>'.$heading_detail.'</h4>';
				$output .= '<p>'.$content.'</p>';
				$output .= '<form action="form.php" method="post" class="row">';
				$output .= '<div class="col-md-6 col-sm-6 col-xs-12">';
				$output .= '<label>What’s your name?</label>';
				$output .= '<input  type="text" required>';
				$output .= '</div>';
				$output .= '<div class="col-md-6 col-sm-6 col-xs-12">';
				$output .= '<label>Got an email address?</label>';
				$output .= '<input  type="text" required>';
				$output .= '</div>';
				$output .= '<div class="col-md-12 col-sm-12 col-xs-12">';
				$output .= '<label>What’s the subject of your message?</label>';
				$output .= '<input  type="text" required>';
				$output .= '</div>';
				$output .= '<div class="col-md-12 col-sm-12 col-xs-12">';
				$output .= '<label>Tell us about how we can help?</label>';
				$output .= '<textarea  cols="10" rows="10" required></textarea>';
				$output .= '</div>';
				$output .= '<div class="col-md-12 col-sm-12 col-xs-12">';
				$output .= '<input  type="submit" value="Send">';
				$output .= '</div>';
				$output .= '</form>';
				$output .= '</div>';
				$output .= '</section>';
	
			}
			
			if(($contact_page_style == '')||($contact_page_style == ' ')){ echo '<h3>No style of this element is selected.</h3>';	}
					
			return $output;
			
		}

	}
	new videogo_contact_form;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_contact_form extends WPBakeryShortCode {
		}
	}	


}
?>