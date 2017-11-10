<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_today_best")){
	class videogo_today_best{
		static $add_plugin_script;
		function __construct(){
			add_action("init",array($this,"videogo_today_best_init"));
			add_shortcode('videogo_today_best',array($this,'videogo_today_best_shortcode'));
		}
		
		function videogo_today_best_init(){
			if(function_exists("vc_map")){
				vc_map( array(
					"base" => "videogo_today_best",
					"name" => __( "Today's Best Videos", "js_composer" ),
					"class" => "",
					"icon" => "icon-heart",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Heading Text", "js_composer" ),
							"param_name" => "heading_text",
							"description" => __( "Enter text for this section title.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "1st Video Url ", "js_composer" ),
							"param_name" => "video_url_1",
							"description" => __( "Enter url for 1st video.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "2nd Video Url ", "js_composer" ),
							"param_name" => "video_url_2",
							"description" => __( "Enter url for 2nd video.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "3rd Video Url ", "js_composer" ),
							"param_name" => "video_url_3",
							"description" => __( "Enter url for 3rd video.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "4th Video Url ", "js_composer" ),
							"param_name" => "video_url_4",
							"description" => __( "Enter url for 4th video.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "5th Video Url ", "js_composer" ),
							"param_name" => "video_url_5",
							"description" => __( "Enter url for 5th video.", "js_composer" )
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
		
		function videogo_today_best_shortcode( $atts, $content = null ) {
			
			extract( shortcode_atts( array(
				'heading_text' => '',
				'video_url_1' => '',
				'video_url_2' => '',
				'video_url_3' => '',
				'video_url_4' => '',
				'video_url_5' => '',
				'el_class' => ''
			), $atts ) );

			$output = '';	

				$output .= '<div class="cp-today-video">';
				$output .= '<div class="container">';
				$output .= '<div class="row">';
				if($heading_text <> ''){
					$output .= '<div class="cp-heading-outer">';
					$output .= '<h2>'.$heading_text.'</h2>';
					$output .= '</div>';
				}
				$output .= '</div>';
				$output .= '<div class="row">';
				$output .= '<div class="col-md-1"></div>';
				$output .= '<div class="col-md-10">';
				$output .= '<ul class="today-videos">';
				if($video_url_1 <> ''){
					$output .= '<li><iframe src="'.$video_url_1.'"></iframe></li>';
				}
				if($video_url_2 <> ''){
					$output .= '<li><iframe src="'.$video_url_2.'"></iframe></li>';
				}
				if($video_url_3 <> ''){
					$output .= '<li><iframe src="'.$video_url_3.'"></iframe></li>';
				}
				if($video_url_4 <> ''){
					$output .= '<li><iframe src="'.$video_url_4.'"></iframe></li>';
				}
				if($video_url_5 <> ''){
					$output .= '<li><iframe src="'.$video_url_5.'"></iframe></li>';
				}
				$output .= '</ul>';
				$output .= '<div id="bx-pager">';
				if($video_url_1 <> ''){
					$output .= '<a data-slide-index="0" href=""><img src="'.videogo_get_video_thumbnail($video_url_1).'" width="165" height="97" alt="today best video 1">';
					$output .= '<strong>'.videogo_get_video_title($video_url_1).'</strong> </a>';
				}
				if($video_url_2 <> ''){
					$output .= '<a data-slide-index="1" href=""><img src="'.videogo_get_video_thumbnail($video_url_2).'" width="165" height="97" alt="today best video 2">';
					$output .= '<strong>'.videogo_get_video_title($video_url_2).'</strong> </a>';
				}
				if($video_url_3 <> ''){
					$output .= '<a data-slide-index="2" href=""><img src="'.videogo_get_video_thumbnail($video_url_3).'" width="165" height="97" alt="today best video 3">';
					$output .= '<strong>'.videogo_get_video_title($video_url_3).'</strong> </a>';
				}
				if($video_url_4 <> ''){
					$output .= '<a data-slide-index="3" href=""><img src="'.videogo_get_video_thumbnail($video_url_4).'" width="165" height="97" alt="today best video 4">';
					$output .= '<strong>'.videogo_get_video_title($video_url_4).'</strong> </a>';
				}
				if($video_url_5 <> ''){
					$output .= '<a data-slide-index="4" href=""><img src="'.videogo_get_video_thumbnail($video_url_5).'" width="165" height="97" alt="today best video 5">';
					$output .= '<strong>'.videogo_get_video_title($video_url_5).'</strong> </a>';
				}
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="col-md-1"></div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
			
			return $output;

		}

	}
	new videogo_today_best;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_today_best extends WPBakeryShortCode {
		}
	}
}