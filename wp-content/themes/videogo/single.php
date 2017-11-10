<?php 
@get_header();
if (have_posts()){ while (have_posts()){ the_post();
	
	global $post;
	/* Get Post Meta Elements detail */
	$videogo_post_social = '';
	$videogo_sidebar = '';
	$videogo_right_sidebar = '';
	$videogo_left_sidebar = '';
	$videogo_thumbnail_types = '';
	$videogo_output = '';
	
	
	$videogo_post_format = get_post_meta($post->ID, 'post_format', true);
	$videogo_post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
	if($videogo_post_detail_xml <> ''){
		
		$videogo_post_xml = new DOMDocument ();
		$videogo_post_xml->loadXML ( $videogo_post_detail_xml );
		$videogo_post_social = videogo_find_xml_value($videogo_post_xml->documentElement,'post_social');
		$videogo_sidebar = videogo_find_xml_value($videogo_post_xml->documentElement,'sidebar_post');
		$videogo_right_sidebar = videogo_find_xml_value($videogo_post_xml->documentElement,'right_sidebar_post');
		$videogo_left_sidebar = videogo_find_xml_value($videogo_post_xml->documentElement,'left_sidebar_post');
		$videogo_thumbnail_types = videogo_find_xml_value($videogo_post_xml->documentElement,'post_thumbnail');
		$videogo_video_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
		$videogo_select_slider_type = videogo_find_xml_value($videogo_post_xml->documentElement,'select_slider_type');
	}
	
	$videogo_sidebar_class = '';
	$videogo_get_post= get_post($post);
	videogo_setPostViews(get_the_ID());
	$videogo_post_views = videogo_getPostViews(get_the_ID()); 
	
	/*Get Sidebar for page*/
	$videogo_sidebar_class = videogo_sidebar_func($videogo_sidebar);
	
	/* videogo_breadcrumbs Section */
	$videogo_breadcrumbs = '';
	$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
	
?>
	<!-- INNER BANNER STARTS-->
			<div class="cp_inner-banner">
				<div class="container">
					<div class="cp-inner-banner-holder">
						<h2>
                        <?php echo esc_attr(get_the_title($post->ID)); ?>
                        </h2>
						<!--Breadcrumb Start-->
						<?php 
							if($videogo_breadcrumbs == 'enable'){
								if(!is_front_page()){
									echo videogo_breadcrumbs();
								}
							}
						?>
                       <!--Breadcrumb End-->
					</div>
				</div>
			</div>
	<!-- INNER BANNER ENDS-->
	<!--Main Content Start-->
		<div id="cp-main-content">
			<section class="cp-blog-section pd-tb60 single">
				<div class="container">
					<div class="row">
					<?php /* Left Sidebars */
						if($videogo_sidebar == "left-sidebar" || $videogo_sidebar == "both-sidebar" || $videogo_sidebar == "both-sidebar-left"){?>
                        <div id="left-sidebar" class="<?php echo esc_attr($videogo_sidebar_class[0]);?>">
							<aside class="cp_sidebar-outer">
								<?php dynamic_sidebar( $videogo_left_sidebar ); ?>
                           </aside>
						</div>
							<?php
						}
						if($videogo_sidebar == 'both-sidebar-left'){?>
                        <div id="left-sidebar-both" class="<?php echo esc_attr($videogo_sidebar_class[0]);?>">
							<aside class="cp_sidebar-outer">
								<?php dynamic_sidebar( $videogo_right_sidebar );?>
                           </aside>
						</div>
							<?php 
						} 
						
						?>
						<div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($videogo_sidebar_class[1]);?> blog-single <?php echo esc_attr($videogo_thumbnail_types);?>">
						<?php
						$videogo_audio_url_type = '';
						$videogo_select_slider_type = '';
						$videogo_video_url_type = '';
						$videogo_thumbnail_types = '';
							$post_detail_xml = get_post_meta( $post->ID , 'post_detail_xml', true);
								if($post_detail_xml <> ''){
									$cp_post_xml = new DOMDocument ();
									$cp_post_xml->loadXML ( $post_detail_xml );
									$videogo_thumbnail_types = videogo_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
									$videogo_audio_url_type = videogo_find_xml_value($cp_post_xml->documentElement,'audio_url_type');
									$videogo_video_url_type = videogo_find_xml_value($cp_post_xml->documentElement,'video_url_type');
									$videogo_select_slider_type = videogo_find_xml_value($cp_post_xml->documentElement,'select_slider_type');	
								}
								$videogo_featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								
							$videogo_tag_list = get_the_tag_list();
							$post_content = $post->post_content;
							$post_content = apply_filters('the_content', $post_content);	
		
							$videogo_post_format = get_post_format($post->ID); 
							if($videogo_post_format == ''){ $videogo_post_format = 'standard post'; }
							$is_quote = get_post_format( $post->ID  ); 
							$videogo_num_comments = get_comments_number($post->ID); 
							
							if(($videogo_post_format == 'standard post')&&(@$videogo_video_url_type <> '')){ 
							
								$videogo_output .= '<!--Video Detail Outer Start-->';
								$videogo_output .= '<div class="cp-video-detail-outer">';
								$videogo_output .= '<div class="cp-video-outer2">';
								$videogo_output .= '<iframe src="'.esc_url($videogo_video_url_type).'"></iframe>';
								$videogo_output .= '</div>';
								$videogo_output .= '<div class="cp-text-holder">';
								$videogo_output .= '<div class="cp-top">';
								$videogo_output .= '<h4>'.esc_attr(get_the_title($post->ID)).'</h4>';
								$videogo_output .= '<span class="viewer">'.$videogo_post_views.'</span> </div>';
								$videogo_output .= '<div class="cp-watch-holer">';
								$videogo_output .= '<ul class="cp-meta-list">';
								$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
								$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
								$videogo_output .= '</ul>';
								$videogo_output .= '</div>';
								$videogo_output .= $post_content;
								$videogo_output .= '</div>';
								$videogo_output .= '<div class="cp-show-more-outer"> </div>';
								$videogo_output .= '</div>';
								$videogo_output .= '<!--Video Detail Outer End-->'; 
							
							 }
									
							$videogo_image_size = array(845,320);    
					
						 if(($videogo_post_format == 'audio')){ 
						 
						 $content = $post->post_content;									
							if ( has_shortcode( $content, 'audio' ) ) { 
									
									preg_match_all('/<a href="(.*?)"/s', $post_content, $matches);
									$videogo_content_audio_url = $matches[1]; 
									$videogo_audio_url_type = $videogo_content_audio_url[0];
									$videogo_audio_url_type = '';
									
							} else {
						 
							wp_enqueue_style('audioplayer-css3',VIDEOGO_PATH_URL.'/frontend/css/audioplayer.css');
							wp_register_script('audio-js', VIDEOGO_PATH_URL.'/frontend/js/audioplayer.js', false, '1.0', true);
							wp_enqueue_script('audio-js');
							
							$videogo_data = "jQuery(document).ready(function($){
									if ($('audio').length) {
										$('audio').audioPlayer();
									}
									});";
							$videogo_handle = 'videogo_custom';
							wp_add_inline_script( $videogo_handle, $videogo_data, $videogo_position = 'after' ); 
							
							} 
					
									$videogo_output .= '<!--Blog Audio Item Start-->';
									$videogo_output .= '<article class="cp-blog-item pd-b60">';
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
									$videogo_output .= wpautop($post_content);
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article><!--Blog Audio Item End-->';
					
								} 
						if(($videogo_post_format == 'standard post')&&(@$videogo_video_url_type == '')){ 
						
									$videogo_output .= '<!--Blog Item Start-->';
									if(videogo_print_blog_thumbnail($post->ID,$videogo_image_size) <> ''){ 
									$videogo_output .= '<article class="cp-blog-item pd-b60">';
									$videogo_output .= '<figure class="cp-thumb">';
									$videogo_output .= videogo_print_blog_thumbnail($post->ID,$videogo_image_size);
									$videogo_output .= '</figure>';
									} else {
									if($videogo_featured_image <> ''){
									$videogo_output .= '<!--Blog Item Start-->';
									$videogo_output .= '<article class="cp-blog-item">';
									$videogo_output .= '<figure class="cp-thumb">';
									$videogo_output .= '<img src="'.$videogo_featured_image.'">';
									$videogo_output .= '</figure>';
									} else {
									$videogo_output .= '<article class="cp-blog-item cp-blog-item2">';
									}
									}
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									if($videogo_select_slider_type <> ''){
										if(strpos($videogo_audio_url_type,'soundcloud')){ 
											$videogo_output .= '<i class="fa fa-soundcloud"></i>';
										} else {
											$videogo_output .= '<i class="fa fa-align-left"></i>';
										}
									} else {
									$videogo_output .= '<i class="fa fa-file-text"></i>';
									}
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_post_title_check = get_the_title($post->ID);
									if($videogo_post_title_check == ''){
$videogo_output .= '<li><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</a></li>'; 
										 } else { 
	$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>'; 
									}
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									if ( post_password_required( $post ) ) { $videogo_output .= get_the_password_form(); } else{
									$videogo_output .= wpautop($post_content);
									}
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Item End-->';
									
								} 
								
						if($videogo_post_format == 'quote'){ 
						
									$videogo_output .= '<!--Blog Item Start-->';
									$videogo_output .= '<article class="cp-blog-item cp-blog-item2 pd-b60">';
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
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Item End-->';
					
								}
						if($videogo_post_format == 'link'){ 
						
									$videogo_output .= '<!--Blog Link Item Start-->';
									$videogo_output .= '<article class="cp-blog-item cp-blog-item2 pd-b60">';
									$videogo_output .= '<div class="cp-text">';
									$videogo_output .= '<span class="cp-icon-box">';
									$videogo_output .= '<i class="fa fa-link"></i>';
									$videogo_output .= '</span>';
									$videogo_output .= '<div class="cp-inner-holder">';
									$videogo_output .= '<h3><a href="'.get_permalink($post->ID).'">'.esc_attr(get_the_title($post->ID)).'</a></h3>';
									$videogo_output .= $post_content;
									$videogo_output .= '<ul class="cp-meta-list">';
									$videogo_output .= '<li>'.esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')).'</li>';
									$videogo_output .= '<li>by '.esc_attr(get_the_author()).', <span>'.$videogo_post_views.'</span></li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Link Item End-->';
									
								} 
						if($videogo_post_format == 'video'){ 
						
									$videogo_output .= '<!--Blog Video Item Start-->';
									$videogo_output .= '<article class="cp-blog-item pd-b60">';
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
									$videogo_output .= wpautop($post_content);
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Video Item End-->';
						
								} 					
						if($videogo_post_format == 'image'){ 
									
									$videogo_image_size = array(845,405);
									$videogo_output .= '<!--Blog Image Item Start-->';
									$videogo_output .= '<article class="cp-blog-item pd-b60">';
									if(videogo_print_blog_thumbnail($post->ID,$videogo_image_size) <> ''){ 
									$videogo_output .= '<figure class="cp-thumb">';
									$videogo_output .= videogo_print_blog_thumbnail($post->ID,$videogo_image_size);
									$videogo_output .= '</figure>';
									} else {
									
									$videogo_output .= wpautop($post_content);
									
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
									$videogo_output .= wpautop(get_the_excerpt());
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
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
									$videogo_output .= '<article class="cp-blog-item  pd-b60">';
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
									$videogo_output .= wpautop(get_the_excerpt());
									$videogo_output .= '<ul class="cp-meta-post-list">';
									$videogo_output .= '<li><i class="fa fa-user"></i> <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_attr(get_the_author()).'</a></li>';
									$videogo_output .= '<li><i class="fa fa-comment-o"></i> '.$videogo_num_comments.'</li>';
									$videogo_output .= '</ul>';
									$videogo_output .= '</div>';
									$videogo_output .= '</div>';
									$videogo_output .= '</article>';
									$videogo_output .= '<!--Blog Gallery Item End-->';
					
							}
						}
                            echo ($videogo_output);
				?>
								<!--Author Holder Start-->
								<article class="cp-author-holder pd-tb60">
									<div class="cp-heading-outer">
										<h2><?php esc_html_e("About Post Author","'videogo'");?></h2>
									</div>
									<ul class="cp-author-listed">
										<li>
											<div class="cp-author-info-holder">
												<div class="cp-thumb">
                                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                                	 <img src="<?php echo get_avatar_url(get_avatar( get_the_author_meta( 'user_email' ), 150)); ?>" class="img-rounded" alt="author img"/>
												</a>
												</div>
												<div class="cp-text">
													<h4><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
															<?php echo get_the_author_meta( 'nickname' ); ?>
                                                     </a></h4>
                                                     <?php if(the_author_meta( 'description' ) <> ''){ ?>
														<p><?php the_author_meta( 'description' ); ?></p>
                                                    <?php } ?>
												</div>
											</div>
										</li>
									</ul>
								</article><!--Author Holder End-->
                                	<?php wp_link_pages(); ?>
                                    <?php comments_template(); ?>
                        </div>	<!-- Post Detail Section Ends--> 
						
					<?php /* Right Sidebars */
						if($videogo_sidebar == "both-sidebar-right"){?>
                        <div class="<?php echo esc_attr($videogo_sidebar_class[0]);?>">
							<aside class="cp_sidebar-outer">
								<?php dynamic_sidebar( $videogo_left_sidebar ); ?>
                           </aside>
						</div>
							<?php
						}
						if($videogo_sidebar == 'both-sidebar-right' || $videogo_sidebar == "right-sidebar" || $videogo_sidebar == "both-sidebar"){?>
                        <div class="<?php echo esc_attr($videogo_sidebar_class[0]);?>">
							<aside class="cp_sidebar-outer">
									<?php dynamic_sidebar( $videogo_right_sidebar );?>
                           </aside>
						</div>
						<?php 
						} ?>				
						</div>
					</div>
				</section>
			</div>
	<!--Main Content End-->
	<?php 
	
	}/*end of while statement*/
} /*end of if statement*/ ?>
<?php get_footer(); ?>