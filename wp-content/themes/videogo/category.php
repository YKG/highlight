<?php 
/*
 * This file is used to generate WordPress standard category pages.
 */
get_header ();
	
	/* Get Default Option for Archives, Category, Search. */
	$videogo_default_settings = get_option('default_pages_settings');
	if($videogo_default_settings != ''){
		$videogo_default = new DOMDocument ();
		$videogo_default->loadXML ( $videogo_default_settings );
		$videogo_sidebar = videogo_find_xml_value($videogo_default->documentElement,'sidebar_default');
		$videogo_right_sidebar = videogo_find_xml_value($videogo_default->documentElement,'right_sidebar_default');
		$videogo_left_sidebar = videogo_find_xml_value($videogo_default->documentElement,'left_sidebar_default');
	}	
	$videogo_select_layout_cp = '';
	$videogo_general_settings = get_option('general_settings');
	if($videogo_general_settings <> ''){
		$videogo_logo = new DOMDocument ();
		$videogo_logo->loadXML ( $videogo_general_settings );
		$videogo_select_layout_cp = videogo_find_xml_value($videogo_logo->documentElement,'videogo_select_layout_cp');
	}
	
	$videogo_sidebar_class = '';
	/* Get Sidebar for page */
	$videogo_sidebar_class = videogo_sidebar_func($videogo_sidebar);
	
	/* videogo_breadcrumbs Section */
	$videogo_breadcrumbs = '';
	$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
?>
	
	<!-- INNER BANNER STARTS-->
	<div class="cp_inner-banner">
		<div class="container">
			<div class="cp-inner-banner-holder">
			<?php
				/* Category Title */
				if (is_category()) { ?>
					<h1><?php esc_attr(single_cat_title());?></h1>
				<?php }
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
	<!-- INNER BANNER ENDS -->
	
	<!-- MAIN STARTS-->
	<div id="cp-main-content">
		<section class="cp-blog padding-top-60">
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
						<div class="<?php echo esc_attr($videogo_sidebar_class[1]);?> pd-tb60">
							<div id="<?php the_ID(); ?>" class="cp-post-box">
								<div <?php post_class(); ?>>
								<!-- Loop -->
									<?php while ( have_posts() ) : the_post(); global $post; 
									
					$post_detail_xml = get_post_meta( $post->ID , 'post_detail_xml', true);
					$videogo_video_url = '';
						if($post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $post_detail_xml );
							$videogo_video_url = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
						}
								$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" ); 
								$image_url = $image_full[0]; 
										
								if($image_url <> ''){ 
										$video_image = '<img src="'.$image_url.'" alt="video image '.$post->ID.'">';
								} else {
										$video_image_url = videogo_get_video_thumbnail($videogo_video_url);
									if($video_image_url <> ''){ 
										$video_image = '<img src="'.$video_image_url.'" alt="video listing image '.$post->ID.'">'; 
										} else { $video_image = ''; }
								}
							?> 
									<div class="cp-blog-item">
										<?php /* Featured Image Check */
										if((has_post_thumbnail())||$video_image <> ''){ ?>
											<div class="frame cp-img-effect-1">
												<a href="<?php echo esc_url(get_permalink());?>"><?php echo ($video_image); ?></a>
											</div>
										<?php } ?>
											<div class="cp-text">
												<div class="cp-text-box">
													<h3>
														<a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a>
													</h3>
													<div class="detail-row">
														<ul class="cp-meta-list">
															<li>
																<a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'),get_the_time('d')); ?>"><?php echo esc_attr(get_the_date(get_option('date_format')));?></a>
															</li>
															<li><?php esc_html_e('By: ','videogo');?><?php the_author_posts_link(); ?></li>
															<li>
																<?php	
																	$videogo_categories = get_the_category();
																	$videogo_catArray = array();
																	if($videogo_categories){
																		foreach($videogo_categories as $videogo_category) {
																				$videogo_catArray[] = '<a href="'.esc_url(get_category_link( $videogo_category->term_id )).'" title="' . esc_attr( $videogo_category->name  ) . '">'.esc_attr($videogo_category->cat_name).'</a>';
																		}
																		$videogo_cat = implode(', ',$videogo_catArray);
																		echo html_entity_decode($videogo_cat);
																	} 
																?>
															</li>
															<li> 
															  <?php
																	/* Get Post Comment */
																	comments_popup_link( esc_html__('0 Comment','videogo'),
																	esc_html__('1 Comment','videogo'),
																	esc_html__('% Comments','videogo'), '',
																	esc_html__('Comments are off','videogo') );
																?>	
															</li>
														</ul>
													</div>
													<?php the_content(); ?>
													<a href="<?php echo esc_url(get_permalink());?>" class="cp-btn-style1"><?php esc_html_e('Read More','videogo');?></a>
												</div> 
											</div>
									</div>	
									<?php endwhile; /* endwhile */ ?>
										<div class = "cp-pagination">
											<?php videogo_pagination();?>	
										</div>
								</div>
							</div>
						</div><!-- Main Content Section Ends -->
						
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
						if($videogo_sidebar == 'both-sidebar-right' || $videogo_sidebar == "right-sidebar" || $videogo_sidebar == "both-sidebar"){ ?>
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
		</section>
	</div>
<?php get_footer(); ?>