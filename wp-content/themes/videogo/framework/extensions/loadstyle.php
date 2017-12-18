<?php
	/* Colors & Fonts Loader File */
	add_action('wp_ajax_nopriv_videogo_color_bg', 'videogo_color_bg');
	add_action('wp_ajax_videogo_color_bg','videogo_color_bg');
	function videogo_color_bg($videogo_recieve_color = '' , $videogo_bg_texture='',$videogo_navi_color='', $videogo_heading_color = '', $videogo_secondary_color = '',$videogo_select_layout_cp = '', $videogo_backend_on_off = ''){
		global $videogo_html_new;
		$videogo_html_new .= '<style id="stylesheet">';
			/*
			================================================
						Primary Colors
			================================================
			*/
			$videogo_html_new .= '::selection {
				background: '.esc_attr($videogo_recieve_color).'; /* Safari */
				color:#fff;
			}
			::-moz-selection {
				background: '.esc_attr($videogo_recieve_color).'; /* Firefox */
				color:#fff;
			}';
			/*Main Background Color*/
			$videogo_html_new .= '.cp-navigation-row,.wpcf7-form-control.wpcf7-submit.btn-submit,.cp-ft-widget-countdown,.widget-form form [type="submit"],a.cp-btn-style1:before,a.cp-btn-style1:after,a.cp-btn-style2:before,a.cp-btn-style2:after,.cp-blog-item .cp-icon-box,.mp3-player-box .audioplayer-bar-played
,.mp3-player-box .audioplayer-playing .audioplayer-playpause a:before, .audioplayer-playing .audioplayer-playpause a:after,.mp3-player-box .audioplayer-volume-adjust > div,.mp3-player-box .audioplayer-volume-button a,#commentform .btn-submit,.cp-newsletter-form
,.cp-get-in-outer,.cp-range-slider-holder .cp-filter,.cp-tab-box .nav-tabs > li.active > a,.cp-tab-box.nav-tabs > li.active > a:hover,.cp-tab-box .nav-tabs > li.active > a:focus,.cp-tab-box .nav-tabs > li a:hover,.widget_categories .cp-reviews li:before,.woocommerce #main-woo .summary .cart .single_add_to_cart_button,.woocommerce .woocommerce-tabs .tabs > li.active > a,.woocommerce .woocommerce-tabs .tabs > li.active a:hover,.woocommerce .woocommerce-tabs .tabs > li.active > a:focus,
.woocommerce .woocommerce-tabs .tabs > li a:hover,.woocommerce-tabs #commentform input[type="submit"],.woocommerce #main-woo ul.products .product .add_to_cart_button,.woocommerce #main-woo ul.products .product .added_to_cart,.woocommerce .shop_table .actions .button,.woocommerce-checkout .form-row .button, .widget_search #searchform_widget button ,  .widget_tag_cloud .tagcloud a:hover , #main-woo .onsale , .woocommerce .woocommerce-message .wc-forward
				{
					background-color:'.esc_attr($videogo_recieve_color).' !important; 
				}';
			/* Text Colours */
			$videogo_html_new .= '.cp-mega-menu .drop-down li:hover>a,.cp-video-item .cp-text h4 a:hover,.cp-listed li a,.cp-most-listed .cp-text .cp-meta-list span,.cp-listed li + li:before,.cp-latest-item .cp-text .cp-top h4 a
,.widget ul li:hover > a,.cp-ft-nav li:hover a,.widget-recent-post .cp-holder .cp-text h5 a,.cp_side-navigation .dropdown-menu > li:hover a,.cp_side-navigation li a:hover,.cp_side-navigation li a:focus
,.cp-inner-banner-holder .breadcrumb > li,.cp-inner-banner-holder .breadcrumb > li a,.cp-inner-banner-holder .breadcrumb > li + li::before,.cp-pagination-row .pagination li a,.cp-pagination-row .pagination li span,.cp-pagination-row .pagination li a,.woocommerce-pagination .page-numbers li a,.woocommerce-pagination .page-numbers li span
,ul.cp-meta-post-list li,ul.cp-meta-post-list li a,.cp-blog-item h3 a:hover,.cp-audio-item .audioplayer-playpause a,.mp3-player-box .audioplayer,.mp3-player-box .audioplayer:not(.audioplayer-playing) .audioplayer-playpause a,.cp-author-info-holder .cp-text h4 a,.cp-author-info-holder .cp-meta-list li
,.cp-watch-listed > li a:hover,.cp-watch-listed > li #cp-dropdown-menu:hover,.cp-comments-holder h4,.cp-show-more-outer a:hover,.cp-form-box2 .cp-social-links li:hover a,.cp-pro-price,.cp-text h4 a:hover,.widget-recent-post .cp-text .cart-btn
,.cp-product-list .cp-text .price-holder,.cp-product-list .cp-text .price-holder span,.cp_side-navigation .cp-right-outer form label,.cp-upload-outer .cp-listed li .fa,.cp_side-navigation .cp-upload-outer .cp-listed li a:hover,#cp-close-btn a .fa,.cp-heading-outer .dropdown .show-btn,.cp-heading-outer .dropdown .btn .fa,#wrapper .cp-inner-main-banner .woocommerce-breadcrumb > a,#wrapper .cp-inner-main-banner .woocommerce-breadcrumb,.woocommerce #main-woo .price .amount,.woocommerce #main-woo .price del span.amount,.comment-reply-link , .cp-latest-item .cp-text h3 a:hover 
, .cp-music-list .cp-post-content a:hover
				{
					color:'.esc_attr($videogo_recieve_color).'; 
				}';
			/* Border Colours */
			$videogo_html_new .= 'a.cp-btn-style1,.cp-blog-item,.mp3-player-box .audioplayer:not(.audioplayer-mute) .audioplayer-volume-button a:after,.cp-error-holder a.cp-btn-style2,.cp-form-box2 .cp-social-links li:hover a
				{
					border-color:'.esc_attr($videogo_recieve_color).'; 
				}';
			/* Border Colour Bottom */
			$videogo_html_new .= '.cp-mega-menu .drop-down
				{
					border-right-color:'.esc_attr($videogo_recieve_color).'; 
				}';
				
			/*
			=============================================
				Secondary Colors Start
			=============================================== 
			*/
				/* Text Color */
				$videogo_html_new .= '
				{
					color: '.esc_attr($videogo_secondary_color).';
				}';
				
				/* Background */
				$videogo_html_new .= '
				{
					background: '.esc_attr($videogo_secondary_color).';
				}';
				/* Border Color */
				$videogo_html_new .= '
				
				{
					border-color: '.esc_attr($videogo_secondary_color).';
				}';
				$videogo_html_new .= '
				{
					border-top-color:'.esc_attr($videogo_recieve_color).';
				}';
				
				/* Border Bottom */
	
				$videogo_html_new .= '
				{
					border-bottom-color:'.esc_attr($videogo_recieve_color).';
				}';
				$videogo_html_new .= '.footer-copy {
					background:rgba(0,0,0,0.5);
				}';
				
				if($videogo_select_layout_cp == 'boxed_layout'){
				$videogo_html_new .= '
				#custom_mega .mmm_fullwidth_container{
					width:auto !important;
				}
				
				#wrapper{
					width:1280px;
					margin:0 auto;
					background:#fff;
					float:none;
					box-shadow:0px 0px 10px 0px rgba(0,0,0,0.2);
					-moz-box-shadow:0px 0px 10px 0px rgba(0,0,0,0.2);
					-webkit-box-shadow:0px 0px 10px 0px rgba(0,0,0,0.2);
				}';
				}else{
					/* Yet To Implement */
				}
				/************************************************ THEME COLOR ENDS ************************************************/
				/*************** Footer Background Image ***********/
				$videogo_footer_bg = videogo_get_themeoption_value('videogo_footer_bg','general_settings');
				
				$videogo_image_src = '';
					if(!empty($videogo_footer_bg)){ 
						$videogo_image_src = wp_get_attachment_image_src( $videogo_footer_bg, 'full' );
						$videogo_image_src = (empty($videogo_image_src))? '': $videogo_image_src[0];			
				}
				
				
				if($videogo_footer_bg <> ''){
					if($videogo_image_src <> ''){
							$videogo_html_new .= '.cp-footer-content {background-image: url('.esc_url($videogo_image_src).')}';
					}
				}else{
					$videogo_path =  VIDEOGO_PATH_URL;
					$videogo_html_new .=  '.cp-footer-content {background-image: url('.esc_url($videogo_path).'/images/footer-bg.jpg) }';
				}
				
				
				/* Inner Header Background Image */
				$videogo_header_image = videogo_get_themeoption_value('videogo_header_inner_bg','general_settings');
				
				$videogo_image_src = '';
					if(!empty($videogo_header_image)){ 
						$videogo_image_src = wp_get_attachment_image_src( $videogo_header_image, 'full' );
						$videogo_image_src = (empty($videogo_image_src))? '': $videogo_image_src[0];			
				}
				
				if($videogo_header_image <> ''){
					if($videogo_image_src <> ''){
							$videogo_html_new .= '#inner-banner {background-image: url('.esc_url($videogo_image_src).') }';
					}
				}else{
					$videogo_path =  VIDEOGO_PATH_URL;
					$videogo_html_new .=  '#inner-banner {background-image: url('.esc_url($videogo_path).'/images/inner-banner.png) }';
				}
				
		$videogo_html_new .= '</style>';
		
		/* Color Picker Is Installed */
		if($videogo_backend_on_off <> 1){
			die(json_encode($videogo_html_new));
		}else{
			return $videogo_html_new;
		}
		
	}
	/********************************** Font Styling ******************************/
	function videogo_add_font_code(){
		global $pagenow;
		echo '<style type="text/css">';
			
			/* Attach Background */
			$videogo_select_background_patren = videogo_get_themeoption_value('videogo_select_background_patren','general_settings');
			$videogo_body_image = videogo_get_themeoption_value('videogo_body_image','general_settings');
			$videogo_image_repeat_layout = videogo_get_themeoption_value('videogo_image_repeat_layout','general_settings');
			$videogo_position_image_layout = videogo_get_themeoption_value('videogo_position_image_layout','general_settings');
			$videogo_image_attachment_layout = videogo_get_themeoption_value('videogo_image_attachment_layout','general_settings');
			
			if($videogo_select_background_patren == 'Background-Image'){
				$videogo_image_src_head = '';							
				if(!empty($videogo_body_image)){ 
					$videogo_image_src_head = wp_get_attachment_image_src( $videogo_body_image, 'full' );
					$videogo_image_src_head = (empty($videogo_image_src_head))? '': $videogo_image_src_head[0];
					$videogo_thumb_src_preview = wp_get_attachment_image_src( $videogo_body_image, 'full');
				}
				echo 'body{
				background-image:url('.esc_url($videogo_thumb_src_preview[0]).');
				background-repeat:'.esc_attr($videogo_image_repeat_layout).';
				background-position:'.esc_attr($videogo_position_image_layout).';
				background-attachment:'.esc_attr($videogo_image_attachment_layout).';
				background-size:cover; }';
			}else if($videogo_select_background_patren == 'Background-Color'){ 
				$videogo_bg_scheme = videogo_get_themeoption_value('videogo_bg_scheme','general_settings');
				echo 'body {background:'.esc_attr($videogo_bg_scheme).';}';
			}else if($videogo_select_background_patren == 'Background-Patren'){
				$videogo_body_patren = videogo_get_themeoption_value('videogo_body_patren','general_settings');
				$videogo_color_patren = videogo_get_themeoption_value('videogo_color_patren','general_settings');
				/* render Body Pattern */
				if(!empty($videogo_body_patren)){
					$videogo_image_src_head = wp_get_attachment_image_src( $videogo_body_patren, 'full' );
					$videogo_image_src_head = (empty($videogo_image_src_head))? '': $videogo_image_src_head[0];
					$videogo_thumb_src_preview = wp_get_attachment_image_src( $videogo_body_patren, array(60,60));
					/* Custom patterm */
					if($videogo_thumb_src_preview[0] <> ''){ echo 'body{background:url('.esc_url($videogo_thumb_src_preview[0]).') repeat !important;}'; }
				}else{ 
					$videogo_bg_scheme = videogo_get_themeoption_value('videogo_bg_scheme','general_settings');
					$videogo_color_patren = videogo_get_themeoption_value('videogo_color_patren','general_settings');
					/* Default patterns */
					//echo 
					//'body{background:'.$videogo_bg_scheme.' url('.VIDEOGO_PATH_URL.$videogo_color_patren.') repeat;} 
					//.inner-pages h2 .txt-left{background:'.$videogo_bg_scheme.' url('.esc_url(VIDEOGO_PATH_URL.$videogo_color_patren).') repeat;}'; 
				}
			}
			
			/* Heading Variables */
			$videogo_heading_h1 = videogo_get_themeoption_value('videogo_heading_h1','typography_settings');
			$videogo_heading_h2 = videogo_get_themeoption_value('videogo_heading_h2','typography_settings');
			$videogo_heading_h3 = videogo_get_themeoption_value('videogo_heading_h3','typography_settings');
			$videogo_heading_h4 = videogo_get_themeoption_value('videogo_heading_h4','typography_settings');
			$videogo_heading_h5 = videogo_get_themeoption_value('videogo_heading_h5','typography_settings');
			$videogo_heading_h6 = videogo_get_themeoption_value('videogo_heading_h6','typography_settings');
			
			/* Render Heading sizes */
			if($videogo_heading_h1 <> ''){ echo 'h1{ font-size:'.esc_attr($videogo_heading_h1).'px !important; }'; }
			if($videogo_heading_h2 <> ''){ echo 'h2{ font-size:'.esc_attr($videogo_heading_h2).'px !important; }'; }
			if($videogo_heading_h3 <> ''){ echo 'h3{ font-size:'.esc_attr($videogo_heading_h3).'px !important; }'; }
			if($videogo_heading_h4 <> ''){ echo 'h4{ font-size:'.esc_attr($videogo_heading_h4).'px !important; }'; }
			if($videogo_heading_h5 <> ''){ echo 'h5{ font-size:'.esc_attr($videogo_heading_h5).'px !important; }'; }
			if($videogo_heading_h6 <> ''){ echo 'h6{ font-size:'.esc_attr($videogo_heading_h6).'px !important; }'; }
			
			/* Body Font Size */
            $font_family = '"lucida grande", "lucida sans unicode", lucida, helvetica, "Hiragino Sans GB", "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif; ';

            echo '.classes-page .skill-inner .label, body,.comments-list li .text p, .header-4-address strong.info,.header-4-address a.email,strong.copy,.widget-box-inner p,.blog-post-box .text p,.box-1 p, .box-1 .textwidget,.get-touch-form input,.get-touch-form strong.title,.footer-copyright strong.copy,#inner-banner p,.welcome-text-box p,.about-me-text p,.about-me-text blockquote q,.team-box .text p,.accordition-box .accordion-inner p,.facts-content-box p,.our-detail-box p,.our-detail-box ul li,.widget_em_widget ul li,.sidebar-recent-post ul li p,blockquote p,blockquote q,.author-box .text p,.contact-page address ul li strong.title,.contact-page address ul li strong.ph,.contact-page address ul li strong.mob,.contact-page address ul li a.email,a.comment-reply-link,.timeline-project-box > .text p,.comments .text p,.event-row .text p,.project-detail p,.news-box .text p,.error-page p,.cp-columns p,.cp-list-style ul li,.customization-options ul li,.cp-accordion .accordion-inner strong,.list-box ul li,.list-box2 ul li,.list-box3 ul li,.tab-content p, .tab-content-area p,.blockquote-1 q,.blockquote-2 q,.map h3,.even-box .caption p,.header-4-address strong.info,.header-4-address a.email,strong.copy,.widget-box-inner p, .cp-theme-style-1 p  ';
            echo '{ font-family: '. $font_family . '}';

			/* Boxed Scheme Background */
			$videogo_videogo_boxed_scheme = videogo_get_themeoption_value('videogo_boxed_scheme','general_settings');
			$videogo_select_layout_cp = videogo_get_themeoption_value('videogo_select_layout_cp','general_settings');
			if($videogo_select_layout_cp == 'box_layout'){ echo '.boxed{background:'.esc_attr($videogo_videogo_boxed_scheme).';}'; }
			
			/* Heading Font Family */
            echo ' h1, h2, h3, h4, h5, h6, #nav';
            echo '{ font-family: '. $font_family . '}';

        /* Menu Font Family */
        echo '</style>';
		/******************** Typography Settings **************************/
		$videogo_primary_color = videogo_get_themeoption_value('videogo_primary_color','general_settings');	
		$videogo_secondary_color = videogo_get_themeoption_value('videogo_secondary_color','general_settings');
		$videogo_heading_color = videogo_get_themeoption_value('videogo_heading_color','general_settings');
		$videogo_select_layout_cp = videogo_get_themeoption_value('videogo_select_layout_cp','general_settings');
		$videogo_recieve_color = '';
		$videogo_recieve_an_color = '';
		$videogo_html_new = '';
		$videogo_backend_on_off = 1;
		/* Color Scheme */
		echo videogo_color_bg($videogo_primary_color,$videogo_bg_texture='',$videogo_navi_color='',$videogo_heading_color,$videogo_secondary_color,$videogo_select_layout_cp,$videogo_backend_on_off);
	}
	/* Add Style in Footer */
	global $pagenow;
	if( $GLOBALS['pagenow'] != 'wp-login.php' ){
		if(!is_admin()){
			//for Frontend only
			add_action('wp_head', 'videogo_add_font_code');
		}
	}