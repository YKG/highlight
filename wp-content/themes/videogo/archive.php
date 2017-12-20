<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
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
	$videogo_breadcrumbs = '';
	$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings'); 
?>
	
	<!--Archive pagination banenr starts -->
	<div class="cp_inner-banner">
		<div class="container">
			<div class="cp-inner-banner-holder">
			<?php if (is_category()) { ?>
				<h1><?php echo esc_attr(single_cat_title()); ?></h1>
			<?php } elseif (is_day()) { ?>
				<h1><?php esc_html_e('Monthly Archives: ', 'videogo'); ?> 
				<?php echo esc_attr(get_the_date(get_option("date_format"))); ?></h1>
			<?php } elseif (is_month()) { ?>
				<h1><?php esc_html_e('Monthly Archives:', 'videogo'); ?> <?php echo esc_html(get_the_date(get_option("date_format"))); ?></h1>
			<?php } elseif (is_year()) { ?>
				<h1><?php esc_html_e('Archive for', 'videogo'); ?> <?php echo esc_html(get_the_date(get_option("date_format"))); ?></h1>
			<?php }elseif (is_search()) { ?>
				<h1><?php esc_html_e('Search results for', 'videogo'); ?> : <?php echo esc_html(get_search_query()) ?></h1>
			<?php } elseif (is_tag()) { ?>
				<h1><?php esc_html_e('Tag Archives: ', 'videogo'); ?><?php echo esc_attr(single_tag_title('', true)); ?></h1>
			<?php }elseif (is_author()) { ?>
				<h1><?php esc_html_e('By : ', 'videogo'); ?><?php echo esc_attr(ucfirst(get_the_author())); ?></h1>
			<?php }?>
			
			<?php /* videogo_breadcrumbs For Archives */
			if($videogo_breadcrumbs == 'enable'){
				if(!is_front_page()){
					echo videogo_breadcrumbs();
				}
			}
			?>
            </div>
		</div>	
	</div>
	<!--Archive pagination banenr ends --> 
	
	<!--MAIN START-->
	<div id="cp-main-content">
		<!--ARCHIVE SECTION START-->
		<section class="cp-blog pd-tb60">
			<div class="container">
				<!-- ROW STARTS -->
				<div class="row">	
					<?php /* Left Sidebars */
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
						<?php } /* Left Sidebars End */ ?>
					
						<div class="<?php echo esc_attr($videogo_sidebar_class[1]);?>">
							<div id="<?php the_ID(); ?>" class="cp-post-box pd-tb60">
								<?php
									/* Feature Sticky Post */
										if ( is_front_page() && videogo_has_featured_posts() ) { 
											/* Include the featured content template. */
											get_template_part( 'featured-content' );
										}
									/* Feature Sticky Post Ends */
								?>
								<div <?php post_class(); ?>>
									<!-- Loop -->
									<?php while ( have_posts() ) : the_post(); global $post; ?> 
										<!-- Html Markup -->
										<div class="cp-blog-item">
											<?php if(has_post_thumbnail()){ ?> 
												<div class="frame cp-img-effect-1">
													<a href="<?php echo esc_url(get_permalink());?>"><?php echo videogo_print_blog_thumbnail($post->ID,array(850,355));?></a>
												</div>
											<?php } ?>
												<div class="cp-text">
													<div class="cp-text-box">
														<h3>
															<a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a>
														</h3>
														<div class="detail-row">
															<ul class="cp-meta-list">
                                                                <li><?php echo esc_attr(get_the_date('Y.n.j G:i')); ?></li>
                                                                <li><span><?php echo videogo_getPostViews($post->ID); ?></span></li>
															</ul>
														</div>
														<p>
															<?php /* Get The Content */
																$videogo_content = get_the_content();
																if(strlen($videogo_content) > 255){
																	echo mb_substr($videogo_content, 0, 255).'...';
																}else{
																	echo esc_attr($videogo_content);
																}
															?>
														</p>
														<a href="<?php echo esc_url(get_permalink());?>" class="cp-btn-style1"><?php esc_html_e('Read More','videogo');?></a>
													</div>
												</div>
										</div>	
									<?php endwhile; /* loop ends */ ?>
									<div class = "cp-pagination">
										<?php videogo_pagination();?>		
									</div>
								</div>
							</div>
						</div> <!-- Mid Section Over -->
					
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
		</section>
	</div>	
	<!--MAIN ENDS-->
<?php get_footer(); ?>