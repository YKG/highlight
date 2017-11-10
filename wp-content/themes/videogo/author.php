<?php
/*
 * This file is used to generate WordPress standard author page.
 */
@get_header();
	
	$videogo_default_settings = get_option('default_pages_settings');
	if($videogo_default_settings != ''){
		$videogo_default = new DOMDocument ();
		$videogo_default->loadXML ( $videogo_default_settings );
	}
	$videogo_sidebar = '';
	$videogo_output = '';
	/* Fetch sidebar theme option */ 		
	$videogo_default_settings = get_option('default_pages_settings');		
	if($videogo_default_settings != ''){		
		$videogo_default = new DOMDocument ();
		$videogo_default->loadXML ( $videogo_default_settings );
		$videogo_sidebar = videogo_find_xml_value($videogo_default->documentElement,'sidebar_default');
		$videogo_right_sidebar = videogo_find_xml_value($videogo_default->documentElement,'right_sidebar_default');
		$videogo_left_sidebar = videogo_find_xml_value($videogo_default->documentElement,'left_sidebar_default');
	}
	
	/* videogo_breadcrumbs Section */
	$videogo_breadcrumbs = '';
	$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
	
	/* Get Sidebar Class */
	$videogo_sidebar_class = videogo_sidebar_func($videogo_sidebar);
	
	?>
	<!-- INNER BANNER STARTS-->
			<div class="cp_inner-banner">
				<div class="container">
					<div class="cp-inner-banner-holder">
					<?php /* Author Title */
                        if (is_author()){
                            echo '<h1>'.esc_html_e('By : ', 'videogo').esc_attr(ucfirst(get_the_author())).'</h1>';
                        }
                        /* videogo_breadcrumbs Section */
                        if($videogo_breadcrumbs == 'enable'){
                            if(!is_front_page()){
                                echo videogo_breadcrumbs();
                            }
                        }
                    ?>
					</div>
				</div>
			</div>
	<!-- INNER BANNER ENDS-->
		<!--MAIN START-->
		<div id="cp-main-content"> 
			<!--BLOG SECTION START-->
			<section class="cp-blog padding-top-60">
				<!-- CONTAINER STARTS -->
				<div class="container">
					<!-- ROW STARTS -->
					<div class="row">	
						<?php /* Left Sidebar */
							if($videogo_sidebar == "left-sidebar" || $videogo_sidebar == "both-sidebar" || $videogo_sidebar == "both-sidebar-left"){?>
								<div id="block_first" class="sidebar side-bar <?php echo esc_attr($videogo_sidebar_class[0]);?>">
									<aside>
										<div class="cp-sidebar">
											<?php dynamic_sidebar( $videogo_left_sidebar ); ?>
										</div>
									</aside>
								</div>
								<?php
							}
							if($videogo_sidebar == 'both-sidebar-left'){?>
								<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($videogo_sidebar_class[0]);?>">
									<aside>
										<div class="cp-sidebar">
											<?php dynamic_sidebar( $videogo_right_sidebar );?>
										</div>
									</aside>
							    </div>
						<?php } ?>
						
							<div class="<?php echo esc_attr($videogo_sidebar_class[1]);?>">
								<div id="<?php the_ID(); ?>" class="cp-blog-section pd-tb33">
									<div <?php post_class(); ?>>
									<?php
									/* Feature Sticky Post */
										if ( is_front_page() && videogo_has_featured_posts() ) { 
											/* Include the featured content template. */
											get_template_part( 'featured-content' );
										}
									?>
									<!-- Loop -->
										<?php  while ( have_posts() ) : the_post(); global $post; 
										$videogo_thumbnail_types = '';
										$videogo_audio_url_type = '';
										$videogo_video_url_type = '';
										$videogo_select_slider_type = '';
										$videogo_num_comments = get_comments_number($post->ID);
										
											$post_detail_xml = get_post_meta( $post->ID , 'post_detail_xml', true);
												if($post_detail_xml <> ''){
													$cp_post_xml = new DOMDocument ();
													$cp_post_xml->loadXML ( $post_detail_xml );
													$videogo_thumbnail_types = videogo_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
													$videogo_audio_url_type = videogo_find_xml_value($cp_post_xml->documentElement,'audio_url_type');
													$videogo_video_url_type = videogo_find_xml_value($cp_post_xml->documentElement,'video_url_type');
													$videogo_select_slider_type = videogo_find_xml_value($cp_post_xml->documentElement,'select_slider_type');	
												}
					
										$videogo_post_views = videogo_getPostViews(get_the_ID());
										$videogo_post_format = get_post_format($post->ID); 
											if($videogo_post_format == ''){ $videogo_post_format = 'standard post'; }
											$is_quote = get_post_format( $post->ID  );
											
												$post_content = $post->post_content;
								
										$videogo_image_size = array(845,320);    
					
						 if(($videogo_post_format == 'audio')){ 
						 
							wp_enqueue_style('audioplayer-css3',VIDEOGO_PATH_URL.'/frontend/css/audioplayer.css');
							wp_register_script('audio-js', VIDEOGO_PATH_URL.'/frontend/js/audioplayer.js', false, '1.0', true);
							wp_enqueue_script('audio-js');
					
									$videogo_output .= '<!--Blog Audio Item Start-->';
									$videogo_output .= '<article class="cp-blog-item">';
									$videogo_output .= '<div class="cp-audio-item">';
									$videogo_output .= '<div class="mp3-player-box">';
									$videogo_output .= '<audio preload="auto" controls>';
									$videogo_output .= '<source src="'.esc_url($videogo_audio_url_type).'">';
									$videogo_output .= '</audio>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-music"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<p>'.$post_content.'</p>';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> </li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article><!--Blog Audio Item End-->';
					
								} 
						if(($videogo_post_format == 'standard post')&&(@$videogo_video_url_type == '')){ 
						
									$videogo_output .= '<!--Blog Item Start-->';
									if(videogo_print_blog_thumbnail($post->ID,$videogo_image_size) <> ''){ 
									$videogo_output .= '<article class="cp-blog-item">';
									$videogo_output .= '<figure class="cp-thumb">';
									$videogo_output .= videogo_print_blog_thumbnail($post->ID,$videogo_image_size);
									$videogo_output .= '</figure>';
									} else {
									$videogo_output .= '<article class="cp-blog-item cp-blog-item2">';
									}
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									if(@$videogo_select_slider_type <> ''){
									$videogo_output .= '<i class="fa fa-align-left"></i>';
									} else {
									$videogo_output .= '<i class="fa fa-file-text"></i>';
									}
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<p>'.$post_content.'</p>';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Item End-->';
									
								} 
						if($videogo_post_format == 'quote'){ 
						
									$videogo_output .= '<!--Blog Item Start-->';
									$videogo_output .= '<article class="cp-blog-item cp-blog-item2">';
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-quote-left"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= ''.$post_content.'';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Item End-->';
					
								}
						if($videogo_post_format == 'link'){ 
						
									$videogo_output .= '<!--Blog Link Item Start-->';
									$videogo_output .= '<article class="cp-blog-item cp-blog-item2">';
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-link"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<p>'.$post_content.'</p>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Link Item End-->';
									
								} 
						if($videogo_post_format == 'video'){ 
						
									$videogo_output .= '<!--Blog Video Item Start-->';
									$videogo_output .= '<article class="cp-blog-item">';
									$videogo_output .= '<iframe src="'.esc_url($videogo_video_url_type).'"></iframe>';
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-film"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<p>'.$post_content.'</p>';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Video Item End-->';
						
								} 
						if(($videogo_post_format == 'standard post')&&(@$videogo_video_url_type <> '')){ 
									$videogo_output .= '<!--Blog Video Item Start-->';
									$videogo_output .= '<article class="cp-blog-item">';
									$videogo_output .= '<iframe src="'.esc_url($videogo_video_url_type).'"></iframe>';
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-film"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<p>'.$post_content.'</p>';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Video Item End-->';
								}					
						if($videogo_post_format == 'image'){ 
						
									$videogo_output .= '<!--Blog Image Item Start-->';
									$videogo_output .= '<article class="cp-blog-item">';
									if(videogo_print_blog_thumbnail($post->ID,$videogo_image_size) <> ''){ 
									$videogo_output .= '<figure class="cp-thumb">';
									$videogo_output .= videogo_print_blog_thumbnail($post->ID,$videogo_image_size);
									$videogo_output .= '</figure>';
									}
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-picture-o"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									if($post_content<>''){
									$videogo_output .= '<p>'.$post_content.'</p>';
									}
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Image Item End-->';
						
								} 					
					
					
						if($videogo_post_format == 'gallery'){  
						
								$content = $post->post_content;
						if ( has_shortcode( $content, 'gallery' ) ) {  
						
						
                   $videogo_output .= '<article class="cp-blog-item">';
                   $videogo_output .= '<ul class="cp-image-post-listed">';
                   $videogo_output .= get_post_gallery();
                   $videogo_output .= '</ul>';
                   $videogo_output .= '<div class="cp-text"> <span class="cp-icon-box"> <i class="fa fa-picture-o"></i> </span>';
                   $videogo_output .= '<div class="cp-inner-holder">';
                   $videogo_output .= '<h3><a href="'.esc_url(get_permalink($post->ID)).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
                   $videogo_output .= '<ul class="cp-meta-list">';
                   $videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
                   $videogo_output .= '<li>by '.esc_attr(get_the_author()).'</li>';
                   $videogo_output .= '</ul>';
                   $videogo_output .= '<ul class="cp-meta-post-list">';
                   $videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'"> '.esc_attr(get_the_author()).'</a></li>';
                   $videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
                   $videogo_output .= '</ul>';
                   $videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a> </div>';
                   $videogo_output .= '</div>';
                   $videogo_output .= '</article>';
						
						} else {
								$regex = '/src="([^"]*)"/';
								preg_match_all( $regex, $content, $matches );
								$matches = array_reverse($matches);
								$total_images = count($matches[0]);
								$loop_internal_counter = 0;
								$img_li_output = '';	
								for ($x = 0; $x < $total_images; $x++) {
									if($loop_internal_counter == 0){
										$image_url = $matches[0][$x];
										$current_li_image = aq_resize( $image_url, 845, 225, true );
										$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
									}
									if($loop_internal_counter == 1){
										$image_url = $matches[0][$x];
										$current_li_image = aq_resize( $image_url, 456, 230, true );
										$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
									}
									if($loop_internal_counter == 2){
										$image_url = $matches[0][$x];
										$current_li_image = aq_resize( $image_url, 389, 230, true );
										$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
									}
									if($loop_internal_counter == 3){
										$image_url = $matches[0][$x];
										$current_li_image = aq_resize( $image_url, 323, 230, true );
										$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
									}
									if($loop_internal_counter == 4){
										$image_url = $matches[0][$x];
										$current_li_image = aq_resize( $image_url, 520, 230, true );
										$img_li_output .= '<li><div class="cp-thumb"><img src="'.$current_li_image.'" alt=""></div></li>';
									}
								$loop_internal_counter++;
								if($loop_internal_counter == 5){ $loop_internal_counter = 0; }
								} 
					
									$videogo_output .= '<!--Blog Gallery Item Start-->';
									$videogo_output .= '<article class="cp-blog-item">';
									$videogo_output .= '<ul class="cp-image-post-listed">';
									$videogo_output .= $img_li_output;
									$videogo_output .= '</ul>';
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-picture-o"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<a href="'.get_permalink($post->ID).'" class="cp-btn-style1">'.esc_html('Read More','videogo').'</a>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Gallery Item End-->';
					
							}
						}
										endwhile; wp_reset_postdata(); /* endwhile */ echo ($videogo_output); ?>
										<div class = "cp-pagination">
											<?php echo pagination_crunch();?>		
										</div>
									</div>
								</div>
							</div> <!-- Main Content Ends Here -->
				
						<?php /* Right Sidebars */
							if($videogo_sidebar == "both-sidebar-right"){?>
								<div class="<?php echo esc_attr($videogo_sidebar_class[0]);?> side-bar">
									<aside>
										<div class="cp-sidebar">
											<?php dynamic_sidebar( $videogo_left_sidebar ); ?>
										</div>
									</aside>
								</div>
								<?php
							}
							if($videogo_sidebar == 'both-sidebar-right' || $videogo_sidebar == "right-sidebar" || $videogo_sidebar == "both-sidebar"){?>
								<div class="<?php echo esc_attr($videogo_sidebar_class[0]);?> side-bar">
									<aside>
										<div class="cp-sidebar">
											<?php dynamic_sidebar( $videogo_right_sidebar ); ?>
										</div>
									</aside>
								</div>
						<?php } ?>	
					</div>	
					<!-- ROW ENDS -->
				</div>
				<!-- CONTAINER ENDS -->
			</section>
			<!--BLOG SECTION END--> 
		</div> 
		<!--MAIN END-->
<?php @get_footer(); ?>