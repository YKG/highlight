<?php 
/*
	* This file will generate 404 error page.
*/	
get_header(); 
/* Get Theme Options for Page Layout */
	$videogo_select_layout_cp = '';
	$videogo_general_settings = get_option('general_settings');
	if($videogo_general_settings <> ''){
		$videogo_logo = new DOMDocument ();
		$videogo_logo->loadXML ( $videogo_general_settings );
		$videogo_select_layout_cp = videogo_find_xml_value($videogo_logo->documentElement,'videogo_select_layout_cp');
		$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
	}
?>
       	<!--Banner Start-->
		<div class="cp_inner-banner">
			<div class="container">
				<div class="cp-inner-banner-holder">
					<h2><strong><?php esc_html_e('404','videogo');?></strong></h2>
					<!--Breadcrumb Start-->
				<?php
				$videogo_breadcrumbs = '';
				$videogo_breadcrumbs = videogo_get_themeoption_value('videogo_breadcrumbs','general_settings');
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
       <!--Banner End-->
	<!--Main Content Start-->
	<div id="cp-main-content">
		<!--Page 404 Start-->
		<section class="cp-page404-section">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/p404-img-01.jpg" alt="error image"> 
		<div class="container">
				<!--Error Holder Start-->
				<div class="cp-error-holder">
					<strong class="cp-title"><?php esc_html_e('Error 404 page','videogo');?></strong>
					<p><?php esc_html_e('Lorem et sit consectetuer ipsum dolor sit amet justo et sit amet justo consectetuer adipiscing elit Suspendisse et justo Praesent.','videogo');?></p>
					<form action="<?php  echo esc_url(home_url('/')); ?>" method="get" id="searchform" class="cp-newsletter-form">
						<input type="text" placeholder="<?php esc_html_e('Looking for something...','videogo');?>" value="<?php the_search_query(); ?>" name="s" required pattern="[a-zA-Z ]+">
						<button type="submit" class="btn-submit" value="<?php esc_html_e('Submit','videogo');?>"><span class="fa fa-search"></span></button>
					</form>
					<a href="<?php  echo esc_url(home_url('/')); ?>" class="cp-btn-style2"><?php esc_html_e('Home Page','videogo');?></a>
				</div>
                <!--Error Holder Start-->
			</div>
		</section>
	</div>
   <!--Main Content End-->
<?php get_footer(); ?>