<?php /*
	
* CrunchPress Headers File
*---------------------------------------------------------------------*
* @version		1.0
* @author		CrunchPress
* @link			http://crunchpress.com
* @copyright	Copyright (c) CrunchPress 
 *---------------------------------------------------------------------*
 	This file Contain all the custom Built in function *
	Developer Note: do not update this file.*
 ---------------------------------------------------------------------*/
	function videogo_footer_style_1(){ ?>
  <!--Footer Start-->
  <footer class="cp_footer"> 
		  	<?php if ( is_active_sidebar( 'custom-sidebar6' ) ){ 
                    dynamic_sidebar('custom-sidebar6'); 
			} else {
				
				echo "<div class='container'><div class='row'>";
					dynamic_sidebar('sidebar-footer');
				echo "</div></div>";
				} 
			?>  
    <!--Copyright Section Start-->
    <section class="cp-copyright-section">
      <div class="container">
      <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12"> 
          	<strong class="cp-ft-logo">

	<?php
		$videogo_footer_logo = videogo_get_themeoption_value('videogo_footer_header_logo','general_settings');
		$videogo_footer_logo_width = videogo_get_themeoption_value('videogo_footer_logo_width','general_settings');
		$videogo_footer_logo_height = videogo_get_themeoption_value('videogo_footer_logo_height','general_settings');

		if(!empty($videogo_footer_logo)){ 
				$videogo_footer_image_src = wp_get_attachment_image_src( $videogo_footer_logo, 'full' );
				$videogo_footer_image_src = (empty($videogo_footer_image_src))? '': esc_url($videogo_footer_image_src[0]);			
		
		
	?>
<a href="<?php echo esc_url(home_url('/')); ?>">
	<img class="logo_img" width="<?php if(esc_attr($videogo_footer_logo_width) == '' or esc_attr($videogo_footer_logo_width) == ' '){ echo '200'; }else{echo esc_attr($videogo_footer_logo_width);}?>" height="<?php if(esc_attr($videogo_footer_logo_height) == '' or esc_attr($videogo_footer_logo_height) == ' '){ echo ''; }else{echo esc_attr($videogo_footer_logo_height);}?>" src="<?php if(esc_url($videogo_footer_image_src) <> ''){echo esc_url($videogo_footer_image_src);}else{echo esc_url(VIDEOGO_PATH_URL.'/images/'.esc_attr($videogo_logo_url).'');}?>" alt="<?php echo esc_attr(bloginfo( 'name' ));?>">
				</a>

<?php } else { videogo_default_logo(); } ?>
		</strong> 
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="ft-nav-right">
	<?php 
		/* pre-cautionary so no post data effects the menu in footer */
			wp_reset_postdata();
		/* getting menus set for footer */ 
			$videogo_footer_menu_1 = videogo_get_themeoption_value('videogo_footer_menu_1','general_settings');  
			$videogo_footer_menu_2 = videogo_get_themeoption_value('videogo_footer_menu_2','general_settings'); 
			
		if(($videogo_footer_menu_1 <> '')&&(is_nav_menu($videogo_footer_menu_1))){	
			echo ' <nav class="cp-ft-nav">'; videogo_footer_menu($videogo_footer_menu_1); echo '</nav>'; 
		}
		if(($videogo_footer_menu_2 <> '')&&(is_nav_menu($videogo_footer_menu_1))){	
			echo ' <nav class="cp-ft-nav cp-ft-nav2">'; videogo_footer_menu($videogo_footer_menu_2); echo '</nav>';	
		}
	 /* getting copyright text from back-end settings */
			$videogo_copyright = videogo_get_themeoption_value('videogo_copyright_code','general_settings');
				if(!empty($videogo_copyright) && ($videogo_copyright <> 'videogo_copyright_code')) { ?>
            <nav class="cp-ft-nav"><ul><li><?php echo esc_attr($videogo_copyright); ?></li></ul></nav>
	<?php } ?>
    </div>
          </div>
	</div>
      </div>
    </section>
    <!--Copyright Section End--> 
    
  </footer>
  <!--Footer End--> 
					
<?php } /* function ends here */
	function videogo_footer_html($footer=""){
		videogo_footer_style_1();
	}
