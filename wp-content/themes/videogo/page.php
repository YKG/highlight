<?php 
/*
 * This file is used to generate different page layouts set from backend.
 */
 
 	//Fetch the theme Option Values
	$videogo_maintenance_mode_swtich = videogo_get_themeoption_value('videogo_maintenance_mode_swtich','general_settings');
	$videogo_maintenace_title = videogo_get_themeoption_value('videogo_maintenace_title','general_settings');
	$videogo_countdown_time = videogo_get_themeoption_value('videogo_countdown_time','general_settings');
	$videogo_email_maintenance = videogo_get_themeoption_value('videogo_email_maintenance','general_settings');
	$videogo_mainte_description = videogo_get_themeoption_value('videogo_mainte_description','general_settings');
	$videogo_social_icons_maintenance = videogo_get_themeoption_value('videogo_social_icons_maintenance','general_settings');
	
	if($videogo_maintenance_mode_swtich <> 'disable'){
		//If Logged in then Remove Maintenance Page
		if ( is_user_logged_in() ) {
			$videogo_maintenance_mode_swtich = 'disable';
		} else {
			$videogo_maintenance_mode_swtich = 'enable';
		}
	}
	
	if($videogo_maintenance_mode_swtich == 'enable'){
		//Trigger the Maintenance Mode Function Here
		videogo_maintenance_mode_fun();
	}else{
 
	@get_header ();
		/* Deprecated PageBuilder Full For VideoGo VC */
		$videogo_sidebar_class = '';
		$videogo_sidebar = get_post_meta ( $post->ID, 'page-option-sidebar-template', true );
		$videogo_sidebar_class = videogo_sidebar_func($videogo_sidebar);
		$videogo_left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
		$videogo_right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );
		$videogo_top_header_style = get_post_meta ( $post->ID, "page-option-page-top-style", true );
		 	
		/* Slider Check */
		$videogo_slider_off = '';
		/* Page Meta Data */
		$videogo_slider_off = get_post_meta ( $post->ID, "page-option-top-slider-on", true );  
			if(($videogo_slider_off == 'Yes') && ($videogo_top_header_style == 'home-v6')){ 
			
				echo videogo_home_v6_slider('',array(5000,1400),'homev6'); 
				
			}
		if(class_exists('videogo_slider_class')){
		
			//Condition for Box Layout
			if($videogo_slider_off == 'Yes' && is_front_page()){ 
			
				if($videogo_top_header_style == 'home-v1'){ ?>
                  <!--Banner Start-->
				  <div class="cp_banner_full_width">
                <?php 
						echo videogo_page_slider(); 
						
						$videogo_post_idz_header = array();
						$videogo_top_header_post_idz = get_post_meta ( $post->ID, "page-option-number-of-post", true ); 
						$videogo_post_idz_header = explode(",",$videogo_top_header_post_idz);
				?>
                  <div class="cp-video-grid-block">
                  <ul  class="cp-video-grid-listing">
     <?php
	 
	 					foreach($videogo_post_idz_header as $videogo_header_post_id){    
						
							$videogo_header_post_author = get_post_field( 'post_author', $videogo_header_post_id );
							$videogo_full_image_url = wp_get_attachment_url( get_post_thumbnail_id($videogo_header_post_id) ); 
							$videogo_image_url = aq_resize( $videogo_full_image_url, 408, 297, true );
				?>				
							<li class="cp-vgl-holder m2 p2">
							<div class="cp-thumb">
                            <a href="<?php echo esc_url(get_permalink($videogo_header_post_id)); ?>">
							<img src="<?php echo esc_url($videogo_image_url); ?>" alt="video go header post image '<?php echo esc_attr($videogo_header_post_id); ?>">
                            </a>
							<div class="cp-caption">
							<a class="play-video" href="<?php echo esc_url(get_permalink($videogo_header_post_id)); ?>"><?php echo esc_html("Play"); ?></a>
							<h4><a href="<?php echo esc_url(get_permalink($videogo_header_post_id)); ?>"><?php echo esc_attr(get_the_title($videogo_header_post_id)); ?></a></h4>
							<strong>by <?php echo esc_attr( get_the_author_meta( 'user_nicename', $videogo_header_post_author )); ?></strong>
							</div>
							</div>
							</li>
		<?php 		}     ?>             
                  
                 		 </ul>
                  	</div>
                  </div>
                  <!--Banner End--> 
			<?php	}
			}		
		}
			if($videogo_slider_off == 'No'){ 
			
				if($videogo_top_header_style == 'home-v2'){
					 
					 videogo_header_video_scripts();
					
					$videogo_header_video_url = get_post_meta ( $post->ID, "page-option-video-url", true );
					$videogo_header_video_banner_url = get_post_meta ( $post->ID, "page-option-video-banner-url", true );
						
					?>
                    
			<div class="cp_video-banner">
				<video id="cp-video-player" class="video-js vjs-default-skin" controls preload="none" poster="<?php echo esc_url($videogo_header_video_banner_url); ?>" data-setup="{}">
					<source src="<?php echo esc_url($videogo_header_video_url); ?>" type="video/mp4">
				</video>
			</div>
					
			<?php	}
				if($videogo_top_header_style == 'home-v3'){
						$videogo_header_post_idzv3 = get_post_meta ( $post->ID, "page-option-number-of-post", true ); 
					
						echo videogo_header_style_output($videogo_top_header_style,$videogo_header_post_idzv3);
				}
				if($videogo_top_header_style == 'home-v4'){
						$videogo_header_post_idzv4 = get_post_meta ( $post->ID, "page-option-number-of-post", true ); 
					
						echo videogo_header_style_output($videogo_top_header_style,$videogo_header_post_idzv4);
				}
				if($videogo_top_header_style == 'home-v5'){
						$videogo_header_post_idzv5 = get_post_meta ( $post->ID, "page-option-number-of-post", true ); 
					
						echo videogo_header_style_output($videogo_top_header_style,$videogo_header_post_idzv5);
				}
			}
		/* videogo_breadcrumbs Value */
		$videogo_breadcrumbs = '';
		$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
?>
        <!--Banner Start-->
		<?php 
		if((@$videogo_top_header_style == 'home-v2')||(@$videogo_top_header_style == 'home-v3')||(@$videogo_top_header_style == 'home-v4')||(@$videogo_top_header_style == 'home-v5')||(@$videogo_top_header_style == 'home-v6')){ } else {
			if($videogo_breadcrumbs == 'enable'){ 
				if($videogo_slider_off <> 'Yes' || !is_front_page()){ ?>
			<div class="cp_inner-banner">
				<div class="container">
					<div class="cp-inner-banner-holder">
						<h2>
                         <strong>
						<?php 
							if(get_the_title() <> '') { 
								if(strlen(get_the_title()) < 30 ) { 
									echo esc_attr(get_the_title());
								}else {
									echo substr(esc_attr(get_the_title()),0 ,30) . '...';
								}
							}
						?>
                         </strong>
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
		<?php
			 	}
			}
		}
		?>
        <!--Banner End-->
			
			<!--MAIN CONTANT ARTICLE START-->
			<div id="cp-main-content">
				<div class="page_content">
					<div class="container">
						<div class="row">
							<?php /* Left Sidebars */
								if($videogo_sidebar == "left-sidebar" || $videogo_sidebar == "both-sidebar" || $videogo_sidebar == "both-sidebar-left"){ ?>
                                	<aside id="right_sidebar_both" class="cp_sidebar-outer <?php echo esc_attr($videogo_sidebar_class[0]);?>">
									  <?php dynamic_sidebar( $videogo_left_sidebar ); ?>
	                                </aside>  
									<?php
								}
								if($videogo_sidebar == 'both-sidebar-left'){ ?>
                                	<aside id="right_sidebar_both" class="cp_sidebar-outer <?php echo esc_attr($videogo_sidebar_class[0]);?>">
									  <?php dynamic_sidebar( $videogo_right_sidebar );?>
	                                </aside>  
								<?php 
								} 
							?>
							<!-- Content Section -->
							<div id="page" class="<?php echo esc_attr($videogo_sidebar_class[1]);?> pd-t60">
								<?php /* Content Getter */ videogo_print_default_content_item(); ?>
							</div>
							<!-- Content Section Ends -->
							<?php /* Right Sidebars */
							if($videogo_sidebar == "both-sidebar-right"){ ?>
                                <aside id="right_sidebar_both" class="cp_sidebar-outer <?php echo esc_attr($videogo_sidebar_class[0]);?>">
								  <?php dynamic_sidebar( $videogo_left_sidebar ); ?>
                                </aside>  
							<?php
							}
							if($videogo_sidebar == 'both-sidebar-right' || $videogo_sidebar == "right-sidebar" || $videogo_sidebar == "both-sidebar"){ ?>
                                <aside id="right_sidebar" class="cp_sidebar-outer <?php echo esc_attr($videogo_sidebar_class[0]);?>">
								  <?php dynamic_sidebar( $videogo_right_sidebar );?>
                                </aside>  
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!--MAIN CONTANT ARTICLE END-->
	<?php  
	
	@get_footer(); 
} /* else case ends here */
?>