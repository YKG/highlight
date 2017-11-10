<?php 
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_tabs")){
	class videogo_tabs{
		
		function __construct(){
			add_action("init",array($this,"videogo_tabs_init"));
			add_shortcode('videogo_tabs',array($this,'videogo_tabs_shortcode'));
		}
		
		function videogo_tabs_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					'base' => 'videogo_tabs',
					"name" => __( "Tabs", "js_composer" ),
					"class" => "",
					"icon" => "",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Title", "js_composer" ),
							"param_name" => "tab_heading1",
							"description" => __( "Enter Tab 1 Title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Text", "js_composer" ),
							"param_name" => "tab_text_1",
							"description" => __( "Enter text for tab 1", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Title", "js_composer" ),
							"param_name" => "tab_heading2",
							"description" => __( "Enter Tab 2 Title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Text", "js_composer" ),
							"param_name" => "tab_text_2",
							"description" => __( "Enter text for tab 2", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Title", "js_composer" ),
							"param_name" => "tab_heading3",
							"description" => __( "Enter Tab 3 Title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Text", "js_composer" ),
							"param_name" => "tab_text_3",
							"description" => __( "Enter text for tab 3", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Title", "js_composer" ),
							"param_name" => "tab_heading4",
							"description" => __( "Enter Tab 4 Title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Text", "js_composer" ),
							"param_name" => "tab_text_4",
							"description" => __( "Enter text for tab 4", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Title", "js_composer" ),
							"param_name" => "tab_heading5",
							"description" => __( "Enter Tab 5 Title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Text", "js_composer" ),
							"param_name" => "tab_text_5",
							"description" => __( "Enter text for tab 5", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Title", "js_composer" ),
							"param_name" => "tab_heading6",
							"description" => __( "Enter Tab 6 Title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Text", "js_composer" ),
							"param_name" => "tab_text_6",
							"description" => __( "Enter text for tab 6", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Title", "js_composer" ),
							"param_name" => "tab_heading7",
							"description" => __( "Enter Tab 7 Title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Tab Text", "js_composer" ),
							"param_name" => "tab_text_7",
							"description" => __( "Enter text for tab 7", "js_composer" )
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
		
		function videogo_tabs_shortcode( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'tab_heading1' => '',
				'tab_text_1' => '',
				'tab_heading2' => '',
				'tab_text_2' => '',
				'tab_heading3' => '',
				'tab_text_3' => '',
				'tab_heading4' => '',
				'tab_text_4' => '',
				'tab_heading5' => '',
				'tab_text_5' => '',
				'tab_heading6' => '',
				'tab_text_6' => '',
				'tab_heading7' => '',
				'tab_text_7' => '',
				'el_class' => ''
			), $atts ) );
			
			$output = ''; 
			
						$output .= '<section class="videogo_choose-section">';
						$output .= '<div class="container">';
        				$output .= '<div class="row">';
          				$output .= '<div class="col-md-6">';
						$output .= '<div class="videogo_choose-tab-box">';
						$output .= '<div role="tabpanel">'; 
                
						$output .= '<ul role="tablist" class="nav nav-tabs">';
						if($tab_heading1 <> ''){ $output .= '<li class="active" role="presentation"><a data-toggle="tab" href="#tab-1">'.$tab_heading1.'</a></li>'; }
						if($tab_heading2 <> ''){ $output .= '<li role="presentation"><a data-toggle="tab" href="#tab-2">'.$tab_heading2.'</a></li>'; }
						if($tab_heading3 <> ''){ $output .= '<li role="presentation"><a data-toggle="tab" href="#tab-3">'.$tab_heading3.'</a></li>'; }
						if($tab_heading4 <> ''){ $output .= '<li role="presentation"><a data-toggle="tab" href="#tab-4">'.$tab_heading4.'</a></li>'; }
						if($tab_heading5 <> ''){ $output .= '<li role="presentation"><a data-toggle="tab" href="#tab-5">'.$tab_heading5.'</a></li>'; }
						if($tab_heading6 <> ''){ $output .= '<li role="presentation"><a data-toggle="tab" href="#tab-6">'.$tab_heading6.'</a></li>'; }
						if($tab_heading7 <> ''){ $output .= '<li role="presentation"><a data-toggle="tab" href="#tab-7">'.$tab_heading7.'</a></li>'; }
                
                		$output .= '</ul>';
                
						$output .= '<div class="tab-content">';
                
						if($tab_text_1 <> ''){ 
						
						$output .= '<div id="tab-1" class="tab-pane active" role="tabpanel">';
						$output .= '<div class="videogo_choose-tab-content"> <span class="icon-presentation2"></span>';
						$output .= '<p>'.$tab_text_1.'</p>';
						$output .= '</div>';
						$output .= '</div>'; 
						
						}
						if($tab_text_2 <> ''){ 
						
						$output .= '<div id="tab-2" class="tab-pane" role="tabpanel">';
						$output .= '<div class="videogo_choose-tab-content"> <span class="icon-presentation2"></span>';
						$output .= '<p>'.$tab_text_2.'</p>';
						$output .= '</div>';
						$output .= '</div>'; 
						
						}
						if($tab_text_3 <> ''){ 
						
						$output .= '<div id="tab-3" class="tab-pane" role="tabpanel">';
						$output .= '<div class="videogo_choose-tab-content"> <span class="icon-presentation2"></span>';
						$output .= '<p>'.$tab_text_3.'</p>';
						$output .= '</div>';
						$output .= '</div>'; 
						
						}
						if($tab_text_4 <> ''){ 
						
						$output .= '<div id="tab-4" class="tab-pane" role="tabpanel">';
						$output .= '<div class="videogo_choose-tab-content"> <span class="icon-presentation2"></span>';
						$output .= '<p>'.$tab_text_4.'</p>';
						$output .= '</div>';
						$output .= '</div>'; 
						
						}
						if($tab_text_5 <> ''){ 
						
						$output .= '<div id="tab-5" class="tab-pane" role="tabpanel">';
						$output .= '<div class="videogo_choose-tab-content"> <span class="icon-presentation2"></span>';
						$output .= '<p>'.$tab_text_5.'</p>';
						$output .= '</div>';
						$output .= '</div>'; 
						
						}
						if($tab_text_6 <> ''){ 
						
						$output .= '<div id="tab-6" class="tab-pane" role="tabpanel">';
						$output .= '<div class="videogo_choose-tab-content"> <span class="icon-presentation2"></span>';
						$output .= '<p>'.$tab_text_6.'</p>';
						$output .= '</div>';
						$output .= '</div>'; 
						
						}
						if($tab_text_7 <> ''){ 
						
						$output .= '<div id="tab-7" class="tab-pane" role="tabpanel">';
						$output .= '<div class="videogo_choose-tab-content"> <span class="icon-presentation2"></span>';
						$output .= '<p>'.$tab_text_7.'</p>';
						$output .= '</div>';
						$output .= '</div>'; 
						
						}
                
                  		$output .= '</div>';
						$output .= '</div>';
						$output .= '</div>';
						$output .= '</div>';
          				$output .= '</div>';
						$output .= '</div>';
						$output .= '</section>';
							
			return $output;
		}

	}
	new videogo_tabs;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_tabs extends WPBakeryShortCode {
		}
	}
}
?>