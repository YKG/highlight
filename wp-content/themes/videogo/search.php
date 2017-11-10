<?php
/*
 * This file is used to generate WordPress standard seach page.
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
	$videogo_sidebar_class = '';
	/* Get Sidebar for page */
	$videogo_sidebar_class = videogo_sidebar_func($videogo_sidebar);
	/* videogo_breadcrumbs Check */
	$videogo_breadcrumbs = '';
	$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
?>
		<!--INNER BANNER-->
			<div class="cp_inner-banner">
				<div class="container">
					<div class="cp-inner-banner-holder">
					<?php 
                        if (is_search()) { ?>
                            <h1><?php esc_html_e('Search results for', 'videogo'); ?> : <?php echo get_search_query() ?></h1>
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
		<!--INNER BANNER END--> 
	
	<!--MAIN START-->
	<div id="cp-main-content"> 
		<section class="cp-blog">
			<div class="container">
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
						if($videogo_sidebar == 'both-sidebar-left'){ ?>
							<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($videogo_sidebar_class[0]);?>">
								<aside>
									<div class="cp-sidebar">
										<?php dynamic_sidebar( $videogo_right_sidebar );?>
									</div>
								</aside>
							</div>
					<?php } ?>
					
					<!-- Content Starts -->
						<div id="search" class="blog_listing blog-home <?php echo esc_attr($videogo_sidebar_class[1]);?> pd-tb60">						
							<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); global $post; ?>
							<!--Search Item Starts-->
							<article class="cp-blog-item">
								<?php /* Featured Image Check */
									if(has_post_thumbnail($post->ID)){ ?>
										<div class="frame cp-img-effect-1">
											<a href="<?php echo esc_url(get_permalink());?>"><?php echo videogo_print_blog_thumbnail($post->ID, array(850,355));?></a>
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
										<p>
											<?php /* Get The Content */
												 the_content();
											?>
										</p>
										<a href="<?php echo esc_url(get_permalink());?>" class="cp-btn-style1"><?php esc_html_e('Read More','videogo');?></a>
									</div>
								</div>
							</article>
							<!--Search item Ends-->
							<?php endwhile; 
							
				/** If Searched Result NOT Found **/
							
							} else { ?>
                            <section class="result-not-found pd-tb60">
                                <!-- CONTAINER STARTS -->
                                <div class="container">
                            
									<strong class="title"><?php esc_html_e('OOPS!','videogo');?></strong> 
										<strong class="text"><?php esc_html_e('Result Not Found!','videogo');?><br>
											<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again.','videogo'); ?>
										</strong>
									<form method="get" id="searchform" class="navbar-form" action="<?php  echo esc_url(home_url('/')); ?>">
									<input type="text" class="form-control" placeholder="<?php esc_html_e('Type your text here again','videogo');?>" value="<?php the_search_query(); ?>" name="s"  autocomplete="off" />
									<button><i class="fa fa-search"></i></button>
									</form>
								</div>
							</section>
                                
							<?php } /* else case ends here */ ?>
						</div>
					
					<?php /* Right Sidebar */
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
					<div class = "cp-pagination">
						<?php videogo_pagination();?>	
					</div>
				</div>	
			</div>
		</section>
	</div>
	<!--MAIN ENDS -->
<?php @get_footer(); ?>