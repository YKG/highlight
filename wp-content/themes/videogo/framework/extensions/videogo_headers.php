<?php 
/*	
*	CrunchPress Headers File
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file Contain all the custom Built in function 
*	Developer Note: do not update this file.
*	---------------------------------------------------------------------
*/
	function videogo_header_style_1(){ ?>
    <?php 
		$mega_menu_activated_location = '';
		if ( class_exists( 'mega_main_init' ) ) {
			$mega_menu_activated_location = '';
			global $mega_main_menu; 
			$mega_menu_locations = $mega_main_menu->get_option( 'mega_menu_locations' ); 
			if(count($mega_menu_locations)>1){ $mega_menu_activated_location = $mega_menu_locations[1]; } 
	?>
  <!--Header Start-->
  <header class="cp_header"> 
    <!--Navigation Start-->
    <div class="cp-navigation-row"> 
      <!--Side Bar Menu Start-->
      <div id="cp_side-menu"> <span id="cp-close-btn"><a href="#"><i class="fa fa-times"></i></a></span>
        <div class="cp_side-navigation">
              <?php //Sign In And Sign Up Turn On/Off 
					$videogo_topsign_icon = videogo_get_themeoption_value('videogo_top_content_switch','general_settings');
						if (esc_attr($videogo_topsign_icon) == 'enable'){ 
							videogo_social_icons_list_header("cp-social-links");
               			} 
			   ?>
          <div class="cp-right-outer">
          
                  <?php echo videogo_side_menu('side-menu'); ?>
            <form action="<?php  echo esc_url(home_url('/')); ?>" method="get" class="cp-search-form-outer">
              <div class="cp-search-form-outer">
                <input type="text" placeholder="<?php esc_html_e('Search...','videogo');?>" name="s" value="<?php the_search_query();?>" required>
                <button class="btn-submit" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--Side Bar Menu End-->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 col-sm-9 col-xs-12"> 
            <!--Sidebar Menu Button -->
            <div id="cp_side-menu-btn" class="cp_side-menu"> <a href="#" class=""><i class="fa fa-bars"></i></a> </div>
            <!--Sidebar Menu Button End--> 
            
            <!--Logo Start--> 
            <strong class="cp-logo"><?php videogo_default_logo(); ?></strong> 
            <!--Logo End--> 
            <!--Nav Holder Start-->
            <div class="cp-nav-holder">
              <div class="cp-megamenu">
                <div class="cp-mega-menu">
                  <label for="mobile-button"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/menu-bar.png" alt=""> </label>
                  <!-- mobile click button to show menu -->
                  <input id="mobile-button" type="checkbox">
                  <?php echo videogo_mega_menu('header-menu','header-menu'); ?>
                </div>
              </div>
            </div>
            <!--Nav Holder End--> 
          </div>
          <div class="col-md-2 col-sm-3 col-xs-12"> 
            <!--Right Holder Start-->
            <div class="cp-right-holder"> 
              <?php //Sign In And Sign Up Turn On/Off 
					$videogo_topsign_icon = videogo_get_themeoption_value('videogo_top_content_switch','general_settings');
						if (esc_attr($videogo_topsign_icon) == 'enable'){ 
							videogo_social_icons_list_header("cp-social-links");
               			} 
			   ?>
            </div>
            <!--Right Holder End--> 
          </div>
        </div>
      </div>
    </div>
    <!--Navigation End--> 
  </header>
  <!--Header End--> 
<?php } else { ?>
  <!--Header Start-->
  <header class="cp_header"> 
    <!--Navigation Start-->
    <div class="cp-navigation-row"> 
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9 col-sm-8 col-xs-12"> 
            <!--Sidebar Menu Button -->
            <div id="cp_side-menu-btn" class="cp_side-menu cp_side-menu2"> <a></a> </div>
            <!--Sidebar Menu Button End--> 
            
            <!--Logo Start--> 
            <strong class="cp-logo"> <a href="<?php echo esc_url(home_url('/')); ?>"><?php videogo_default_logo(); ?></a> </strong> 
            <!--Logo End--> 
            <!--Nav Holder Start-->
            <div class="cp-nav-holder">
              <div class="cp-megamenu">
                <div class="cp-mega-menu">
                  <label for="mobile-button"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/menu-bar.png" alt=""> </label>
                  <!-- mobile click button to show menu -->
                  <input id="mobile-button" type="checkbox">
                  <?php 
				  if(has_nav_menu('header-menu')){
					  echo videogo_normal_menu('header-menu','header-menu'); 
					  } else {
						  echo videogo_normal_menu('default-menu','default-menu');
						  }
				  ?>
                </div>
              </div>
            </div>
            <!--Nav Holder End--> 
          </div>
          <div class="col-md-3 col-sm-4 col-xs-12"> 
            <!--Right Holder Start-->
            <div class="cp-right-holder">
              <ul class="cp-social-links">
                <li class="cp-search-holder"><i class="fa fa-search"></i>
					<form method="get" id="searchform_header" class="cp-search-form-outer" action="<?php  echo esc_url(home_url('/')); ?>">
					
					<input type="text" class="form-control" placeholder="<?php esc_html_e('Search...','videogo');?>" value="<?php the_search_query(); ?>" name="s"  autocomplete="off" />
					<button class="btn-submit" type="submit"><i class="fa fa-search"></i></button>
				</form>
                </li>
              </ul>
              <?php //Sign In And Sign Up Turn On/Off 
					$videogo_topsign_icon = videogo_get_themeoption_value('videogo_top_content_switch','general_settings');
						if (esc_attr($videogo_topsign_icon) == 'enable'){ 
							videogo_social_icons_list_header("cp-social-links");
               			} 
			   ?>
            </div>
            <!--Right Holder End--> 
          </div>
        </div>
      </div>
    </div>
    <!--Navigation End--> 
  </header>
  <!--Header End--> 
	<?php 
		}
	}  
  
	
	/* Header Function html */
	function videogo_print_header_html($videogo_header=""){
		
		videogo_header_style_1();
	}
	
	
	/* Normal Menu */
	function videogo_normal_menu($videogo_location='',$videogo_class=''){
		
		global $counter;
		/* Menu parameters */
		$videogo_menu_defaults = array(
		'menu'            => '', 
		'container'       => '', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => 'default',
		'menu_class'      => 'main-menu',
		'menu_id'         => 'nav',
		'echo'            => true,
		'fallback_cb'     => '',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => '',);				
		
		$videogo_defaults = array(
		'theme_location'  => $videogo_location,
		'menu'            => '', 
		'container'       => '', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => 'navbar',
		'menu_class'      => 'main-menu',
		'menu_id'         => 'nav',
		'echo'            => true,
		'fallback_cb'     => '',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => '',);				
		if($videogo_location == 'default-menu'){ 
			echo '<div id="default-menu" class="cp-mega-menu">';
				wp_nav_menu( $videogo_menu_defaults);
			echo '</div>';
		} 
		if($videogo_location == 'header-menu'){ 
			echo '<div id="header-menu" class="cp-mega-menu">';
				wp_nav_menu( $videogo_defaults);
			echo '</div>';
		} 
	} 
	
	
	/*Social Networking Icons*/
	function videogo_social_icons_list_header($class=''){
		
		$videogo_social_settings = get_option('social_settings');
		if($videogo_social_settings <> ''){
			$videogo_social = new DOMDocument ();
			$videogo_social->loadXML ( $videogo_social_settings );
			/* Social Networking Values */
			$videogo_facebook_network = videogo_get_themeoption_value('videogo_facebook_network','social_settings');
			$videogo_twitter_network = videogo_get_themeoption_value('videogo_twitter_network','social_settings');
			$videogo_google_plus_network = videogo_get_themeoption_value('videogo_google_plus_network','social_settings');
			$videogo_linked_in_network = videogo_get_themeoption_value('videogo_linked_in_network','social_settings');
			$videogo_youtube_network = videogo_get_themeoption_value('videogo_youtube_network','social_settings');
			$videogo_flickr_network = videogo_get_themeoption_value('videogo_flickr_network','social_settings');
			$videogo_vimeo_network = videogo_get_themeoption_value('videogo_vimeo_network','social_settings');
			$videogo_pinterest_network = videogo_get_themeoption_value('videogo_pinterest_network','social_settings');
			$videogo_Instagram_network = videogo_get_themeoption_value('videogo_Instagram_network','social_settings'); 
			$videogo_github_network = videogo_get_themeoption_value('videogo_github_network','social_settings'); 
			$videogo_skype_network = videogo_get_themeoption_value('videogo_skype_network','social_settings');
			$videogo_dribble_network = videogo_get_themeoption_value('videogo_dribble_network','social_settings');
		}
		
		/* Social Networking Icons HTML Markup */
		echo '<ul class="'.esc_attr($class).'">';
				/* Twitter */
			if(esc_attr($videogo_twitter_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_twitter_network).'" title="Twitter"><i class="fa fa-twitter"></i></a></li>';	
			}
				/* Facebook */
			if(esc_attr($videogo_facebook_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_facebook_network).'" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
			}
				/* GooglePlus */
			if(esc_attr($videogo_google_plus_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_google_plus_network).'" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>';
			}
				/* LinkedIn */
			if(esc_attr($videogo_linked_in_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_linked_in_network).'" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>'; 
			}
				/* Youtube */
			if(esc_attr($videogo_youtube_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_youtube_network).'" title="Youtube"><i class="fa fa-youtube"></i></a></li>';
			} 
				/* Flickr */
			if(esc_attr($videogo_flickr_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_flickr_network).'" title="Flickr"><i class="fa fa-flickr"></i></a></li>';
			}
				/* Vimeo */
			if(esc_attr($videogo_vimeo_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_vimeo_network).'" title="Vimeo"><i class="fa fa-vimeo-square"></i></a></li>';
			}
				/* Pinterest */
			if(esc_attr($videogo_pinterest_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_pinterest_network).'" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>';
			}
				/* Instagram */
			if(esc_attr($videogo_Instagram_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_Instagram_network).'" title="Instagram"><i class="fa fa-instagram"></i></a></li>';
			}
				/* Github */
			if(esc_attr($videogo_github_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_github_network).'" title="github"><i class="fa fa-github"></i></a></li>';
			}
				/* Skype */
			if(esc_attr($videogo_skype_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_skype_network).'" title="Skype"><i class="fa fa-skype"></i></a></li>';
			}
				/* Dribble */
			if(esc_attr($videogo_dribble_network) <> ''){
				echo '<li><a target = "_blank" data-rel="tooltip" href="'.esc_url($videogo_dribble_network).'" title="Dribble"><i class="fa fa-dribbble"></i></a></li>';
			}
			
		echo '</ul>';
	
	} 
	
	function videogo_default_logo($videogo_logo_url =''){ 
		
		echo '<strong class="logo">';
			
			if(esc_attr($videogo_logo_url) == '' || esc_attr($videogo_logo_url) == ' '){
				$videogo_logo_url = 'cp-logo1.png';
			}
			
			$videogo_header_logo_swtich = videogo_get_themeoption_value('videogo_header_logo_swtich','general_settings'); 
			
			if(esc_attr($videogo_header_logo_swtich) == 'enable'){ 
				
				$videogo_header_logo = videogo_get_themeoption_value('videogo_header_logo','general_settings');
				$videogo_logo_width = videogo_get_themeoption_value('videogo_logo_width','general_settings');
				$videogo_logo_height = videogo_get_themeoption_value('videogo_logo_height','general_settings');
				
				$videogo_image_src = '';
				if(!empty($videogo_header_logo)){ 
					$videogo_image_src = wp_get_attachment_image_src( $videogo_header_logo, 'full' );
					$videogo_image_src = (empty($videogo_image_src))? '': esc_url($videogo_image_src[0]);			
				} ?>
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img class="logo_img" width="<?php if(esc_attr($videogo_logo_width) == '' or esc_attr($videogo_logo_width) == ' '){ echo '200'; }else{echo esc_attr($videogo_logo_width);}?>" height="<?php if(esc_attr($videogo_logo_height) == '' or esc_attr($videogo_logo_height) == ' '){ echo ''; }else{echo esc_attr($videogo_logo_height);}?>" src="<?php if(esc_url($videogo_image_src) <> ''){echo esc_url($videogo_image_src);}else{echo esc_url(VIDEOGO_PATH_URL.'/images/'.esc_attr($videogo_logo_url).'');}?>" alt="<?php echo esc_attr(bloginfo( 'name' ));?>">
				</a>
			
			<?php }else{
				/*** Text Based Logo **/
				$videogo_logo_text_cp = videogo_get_themeoption_value('videogo_logo_text_cp','general_settings');
				$videogo_logo_subtext = videogo_get_themeoption_value('videogo_logo_subtext','general_settings');
			
				if($videogo_logo_text_cp == 'videogo_logo_text_cp' && $videogo_logo_subtext == 'videogo_logo_subtext' ){?>
					
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img class="logo_img" width="" height="" src="<?php echo esc_url(VIDEOGO_PATH_URL.'/images/'.esc_attr($videogo_logo_url).'');?>" alt="<?php echo esc_attr(bloginfo( 'name' ));?>">
					</a>
				<?php } else{ ?>
					
					<div class = "cp-heading-1">
					
						<a href="<?php echo esc_url(home_url('/')); ?>">
								
							<h1><?php echo esc_attr($videogo_logo_text_cp);?></h1>
								
							<em><?php echo esc_attr($videogo_logo_subtext);?></em> 
						
						</a>	
					
					</div>
					
				
			<?php }
			
			}?>
		</strong>
	<?php }
	
	/* Mega Menu Support */
	function videogo_mega_menu($location=''){
		if(has_nav_menu($location)){
				$defaults = array(
				  'theme_location'  => $location,
				  'menu'            => '', 
				  'container'       => '', 
				  'container_class' => '', 
				  'container_id'    => 'navbar',
				  'menu_class'      => 'main-menu', 
				  'menu_id'         => 'mega-menu',
				  'echo'            => true,
				  'fallback_cb'     => '',
				  'before'          => '',
				  'after'           => '',
				  'link_before'     => '',
				  'link_after'      => '',
				  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				  'depth'           => 0,
				  'walker'          => '');		
					wp_nav_menu( $defaults);
		}else if(has_nav_menu('mega_main_sidebar_menu')){
			echo '<div class="side-nav-container"><a id="no-show-menu-cp" class="menu_show_cp"><i class="fa fa-bars"></i></a>';
				$defaults = array(
				  'theme_location'  => 'mega_main_sidebar_menu',
				  'menu'            => '', 
				  'container'       => '', 
				  'container_class' => 'menu-{menu slug}-container', 
				  'container_id'    => 'navbar',
				  'menu_class'      => '', 
				  'menu_id'         => 'nav',
				  'echo'            => true,
				  'fallback_cb'     => '',
				  'before'          => '',
				  'after'           => '',
				  'link_before'     => '',
				  'link_after'      => '',
				  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				  'depth'           => 0,
				  'walker'          => '');		
				echo '<div id="custom_mega2" class="videogo_mega_plugin">';
					wp_nav_menu( $defaults);
				echo '</div>';
			echo '</div>';		
		}
	}
	
	function videogo_search_html($icon_show=''){
		if(esc_attr($icon_show) == false){ ?>											
			<a href="#" id="no-active-btn" class="search videogo_search_animate"><span class="hsearch"><i class="fa fa-search"></i></span></a>
		<?php }?>	
			<div id="videogo_search" class="videogo_search">
				<form class="videogo_search-form" action="<?php  echo esc_url(home_url('/')); ?>/">
					<input name="s" class="videogo_search-input" value="<?php esc_attr(the_search_query()); ?>" type="search" placeholder="<?php esc_html_e('Search...','videogo');?>" />
					<button class="videogo_search-submit" type="submit"><i class="fa fa-search"></i></button>
				</form>
				<span class="videogo_search-close"></span>
			</div>
	<?php }
	/* Default side menu Support */
	function videogo_side_menu($location=''){
				$defaults = array(
				  'menu'            => 'side-menu', 
				  'container'       => '', 
				  'container_class' => '', 
				  'container_id'    => 'navbar',
				  'menu_class'      => 'navbar-nav', 
				  'menu_id'         => 'side-menu',
				  'echo'            => true,
				  'fallback_cb'     => '',
				  'before'          => '',
				  'after'           => '',
				  'link_before'     => '',
				  'link_after'      => '',
				  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				  'depth'           => 0,
				  'walker'          => new videogo_Menu_Walker_Ext);		
					wp_nav_menu( $defaults);
	}
	
	/* Top Bar Contents/Contacts */
	function videogo_contact_number(){ 
			
			$videogo_top_content_switch = videogo_get_themeoption_value('videogo_top_content_switch','general_settings');
			$videogo_contact_number = videogo_get_themeoption_value('videogo_contact_number','general_settings');
			$videogo_contact_email = videogo_get_themeoption_value('videogo_contact_email','general_settings');
			echo '<ul>';
		  
				if($videogo_contact_number <> ''){
					echo  '<li>'.esc_attr('Phone: ','videogo').'<a>'.esc_attr($videogo_contact_number).'</a></li>';
				} 
				if($videogo_contact_email <> ''){
				   echo '<li>'.esc_attr('Email: ','videogo').'<a href="mailto:'.esc_attr($videogo_contact_email).'">'.esc_attr($videogo_contact_email).'</a></li>';
				} 
		   
			echo '</ul>';
	}