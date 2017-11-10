<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_facts")){
	class videogo_facts{
		function __construct(){
			add_action("init",array($this,"videogo_facts_init"));
			add_shortcode('videogo_facts',array($this,'videogo_facts_shortcode'));
			
		}
		
		function videogo_facts_init(){
			
			if(function_exists("vc_map")){
				
				vc_map( array(
					'base' => 'videogo_facts',
					"name" => __( "Our Facts", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Section Heading', 'js_composer' ),
							'param_name' => 'count_heading',
							'value' => '',
							'description' => __( 'Enter Title for section.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Number 1', 'js_composer' ),
							'param_name' => 'count_number1',
							'value' => '',
							'description' => __( 'Enter Count For Display.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Optional Symbol For Number 1', 'js_composer' ),
							'param_name' => 'number_attach1',
							'value' => '',
							'description' => __( 'Enter Symbol eg. "k", "th", "+" etc.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Caption 1', 'js_composer' ),
							'param_name' => 'count_caption1',
							'value' => '',
							'description' => __( 'Enter Caption For Count.', 'js_composer' )
						),	
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Number 2', 'js_composer' ),
							'param_name' => 'count_number2',
							'value' => '',
							'description' => __( 'Enter Count For Display.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Optional Symbol For Number 2', 'js_composer' ),
							'param_name' => 'number_attach2',
							'value' => '',
							'description' => __( 'Enter Symbol eg. "k", "th", "+" etc.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Caption 2', 'js_composer' ),
							'param_name' => 'count_caption2',
							'value' => '',
							'description' => __( 'Enter Caption For Count.', 'js_composer' )
						),	
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Number 3', 'js_composer' ),
							'param_name' => 'count_number3',
							'value' => '',
							'description' => __( 'Enter Count For Display.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Optional Symbol For Number 3', 'js_composer' ),
							'param_name' => 'number_attach3',
							'value' => '',
							'description' => __( 'Enter Symbol eg. "k", "th", "+" etc.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Caption 3', 'js_composer' ),
							'param_name' => 'count_caption3',
							'value' => '',
							'description' => __( 'Enter Caption For Count.', 'js_composer' )
						),	
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Number 4', 'js_composer' ),
							'param_name' => 'count_number4',
							'value' => '',
							'description' => __( 'Enter Count For Display.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Optional Symbol For Number 4', 'js_composer' ),
							'param_name' => 'number_attach4',
							'value' => '',
							'description' => __( 'Enter Symbol eg. "k", "th", "+" etc.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							"holder" => "h3",
							'heading' => __( 'Enter Count Caption 4', 'js_composer' ),
							'param_name' => 'count_caption4',
							'value' => '',
							'description' => __( 'Enter Caption For Count.', 'js_composer' )
						),	
					)
				) );
			}
		}
		
	function videogo_facts_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'count_heading' => '',
			'count_number1' => '',
			'number_attach1' => '',
			'count_caption1' => '',				
			'count_number2' => '',
			'number_attach2' => '',
			'count_caption2' => '',				
			'count_number3' => '',
			'number_attach3' => '',
			'count_caption3' => '',				
			'count_number4' => '',
			'number_attach4' => '',
			'count_caption4' => '',				
		), $atts));
		
		$output = '';
					wp_register_script('running-counter-js', BigStore_PATH_URL.'/frontend/js/runing-counter.js', false, '1.0', true);
					wp_enqueue_script('running-counter-js');
					wp_register_script('counterup-js', BigStore_PATH_URL.'/frontend/js/jquery.counterup.min.js', false, '1.0', true);
					wp_enqueue_script('counterup-js');

			    $output .= '<section class="videogo_facts-style-1  padd-tb-80">';
				$output .= '<div class="container">';
				$output .= '<div class="cp-heading-style-2">';
				$output .= '<h2>'.$count_heading.'</h2>';
				$output .= '</div>';
				$output .= '<div class="row">';
				$output .= '<div class="col-md-3 col-sm-6">';
				$output .= '<div class="videogo_facts-box"><strong class="number counter">'.$count_number1.$number_attach1.'</strong>';
				$output .= '<span>'.$count_caption1.'</span> </div>';
				$output .= '</div>';
				$output .= '<div class="col-md-3 col-sm-6">';
				$output .= '<div class="videogo_facts-box"> <b> <strong class="number counter">'.$count_number2.'</strong>';
				$output .= '<em>'.$number_attach2.'</em> </b> <span>'.$count_caption2.'</span> </div>';
				$output .= '</div>';
				$output .= '<div class="col-md-3 col-sm-6">';
				$output .= '<div class="videogo_facts-box"> <strong class="number counter">'.$count_number3.$number_attach3.'</strong>';
				$output .= '<span>'.$count_caption3.'</span> </div>';
				$output .= '</div>';
				$output .= '<div class="col-md-3 col-sm-6">';
				$output .= '<div class="videogo_facts-box"> <b> <strong class="number counter">'.$count_number4.'</strong>';
				$output .= '<em>'.$number_attach4.'</em> </b> <span>'.$count_caption4.'</span> </div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</section>';
		
		return $output;
	
	}
	}
	new videogo_facts;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_facts extends WPBakeryShortCode {
		}
	}	

}
?>