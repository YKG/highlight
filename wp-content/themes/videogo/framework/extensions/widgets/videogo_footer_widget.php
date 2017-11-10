<?php
class videogo_footer_widget extends WP_Widget
{
  function videogo_footer_widget()
  {
    $videogo_footer_widget_ops = array('classname' => 'videogo_footer_widget', 'description' => 'Videogo Special Footer Widget' );
    parent::__construct('videogo_footer_widget', 'CrunchPress : Special Footer Widget', $videogo_footer_widget_ops);
  }
 
  function form($videogo_footer_instance)
  {
    $videogo_title = isset( $videogo_footer_instance['title'] ) ? esc_attr( $videogo_footer_instance['title'] ) : '';
    $videogo_left_image = isset( $videogo_footer_instance['left_image'] ) ? esc_attr( $videogo_footer_instance['left_image'] ) : ''; 
    $videogo_center_background = isset( $videogo_footer_instance['center_background'] ) ? esc_attr( $videogo_footer_instance['center_background'] ) : '';
    $videogo_right_image = isset( $videogo_footer_instance['right_image'] ) ? esc_attr( $videogo_footer_instance['right_image'] ) : '';
    $videogo_sub_heading = isset( $videogo_footer_instance['sub_heading'] ) ? esc_attr( $videogo_footer_instance['sub_heading'] ) : '';
    $videogo_boxed_heading = isset( $videogo_footer_instance['boxed_heading'] ) ? esc_attr( $videogo_footer_instance['boxed_heading'] ) : '';
    $videogo_counter_date = isset( $videogo_footer_instance['counter_date'] ) ? esc_attr( $videogo_footer_instance['counter_date'] ) : '';
    $videogo_external_link = isset( $videogo_footer_instance['external_link'] ) ? esc_attr( $videogo_footer_instance['external_link'] ) : '';
    $videogo_external_link_text = isset( $videogo_footer_instance['external_link_text'] ) ? esc_attr( $videogo_footer_instance['external_link_text'] ) : '';
    $videogo_menu_top = isset( $videogo_footer_instance['menu_top'] ) ? esc_attr( $videogo_footer_instance['menu_top'] ) : '';
    $videogo_menu_bottom = isset( $videogo_footer_instance['menu_bottom'] ) ? esc_attr( $videogo_footer_instance['menu_bottom'] ) : '';
?>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
		 <?php esc_html_e('Title:','videogo');?>
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($videogo_title); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('left_image')); ?>">
		 <?php esc_html_e('Left image url:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('left_image')); ?>" name="<?php echo esc_attr($this->get_field_name('left_image')); ?>" type="text" value="<?php echo esc_attr($videogo_left_image); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('center_background')); ?>">
		 <?php esc_html_e('Center Background image url:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('center_background')); ?>" name="<?php echo esc_attr($this->get_field_name('center_background')); ?>" type="text" value="<?php echo esc_attr($videogo_center_background); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('right_image')); ?>">
		 <?php esc_html_e('Right image url:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('right_image')); ?>" name="<?php echo esc_attr($this->get_field_name('right_image')); ?>" type="text" value="<?php echo esc_attr($videogo_right_image); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('sub_heading')); ?>">
		 <?php esc_html_e('Sub Heading:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('sub_heading')); ?>" name="<?php echo esc_attr($this->get_field_name('sub_heading')); ?>" type="text" value="<?php echo esc_attr($videogo_sub_heading); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('boxed_heading')); ?>">
		 <?php esc_html_e('Boxed Heading:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('boxed_heading')); ?>" name="<?php echo esc_attr($this->get_field_name('boxed_heading')); ?>" type="text" value="<?php echo esc_attr($videogo_boxed_heading); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('counter_date')); ?>">
		 <?php esc_html_e('Counter Date:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('counter_date')); ?>" name="<?php echo esc_attr($this->get_field_name('counter_date')); ?>" type="text" value="<?php echo esc_attr($videogo_counter_date); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('external_link')); ?>">
		 <?php esc_html_e('External Link url:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('external_link')); ?>" name="<?php echo esc_attr($this->get_field_name('external_link')); ?>" type="text" value="<?php echo esc_url($videogo_external_link); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('external_link_text')); ?>">
		 <?php esc_html_e('External Link Text:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('external_link_text')); ?>" name="<?php echo esc_attr($this->get_field_name('external_link_text')); ?>" type="text" value="<?php echo esc_attr($videogo_external_link_text); ?>" />
	  </label>
  </p>
  <p>
	<label for="<?php echo esc_attr($this->get_field_id('menu_top')); ?>">
	  <?php esc_html_e('Top Menu:','videogo');?>
	  <select id="<?php echo esc_attr($this->get_field_id('menu_top')); ?>" name="<?php echo esc_attr($this->get_field_name('menu_top')); ?>" class="widefat">
		<?php
			$menus_top = get_terms('nav_menu'); 
			foreach($menus_top as $menu){
		?>
<option <?php if($menu->slug == esc_attr($videogo_menu_top)){echo 'selected';}?> value="<?php echo esc_attr($menu->slug); ?>"><?php echo esc_attr($menu->name); ?></option>
		<?php }?>
      </select>
	</label>
  </p>  
  <p>
	<label for="<?php echo esc_attr($this->get_field_id('menu_bottom')); ?>">
	  <?php esc_html_e('Bottom Menu:','videogo');?>
	  <select id="<?php echo esc_attr($this->get_field_id('menu_bottom')); ?>" name="<?php echo esc_attr($this->get_field_name('menu_bottom')); ?>" class="widefat">
		<?php
			$menus_bottom = get_terms('nav_menu'); 
			foreach($menus_bottom as $menu){
		?>
<option <?php if($menu->slug == esc_attr($videogo_menu_top)){echo 'selected';}?> value="<?php echo esc_attr($menu->slug); ?>"><?php echo esc_attr($menu->name); ?></option>
		<?php }?>
      </select>
	</label>
  </p>  
  
<?php
  }
 
  function update($videogo_new_instance, $videogo_old_instance)
  {
    $videogo_instance = $videogo_old_instance;
    $videogo_instance['title'] = $videogo_new_instance['title'];
    $videogo_instance['left_image'] = $videogo_new_instance['left_image'];
    $videogo_instance['center_background'] = $videogo_new_instance['center_background'];
    $videogo_instance['right_image'] = $videogo_new_instance['right_image'];
    $videogo_instance['sub_heading'] = $videogo_new_instance['sub_heading'];
    $videogo_instance['boxed_heading'] = $videogo_new_instance['boxed_heading'];
    $videogo_instance['counter_date'] = $videogo_new_instance['counter_date'];
    $videogo_instance['external_link'] = $videogo_new_instance['external_link'];
    $videogo_instance['external_link_text'] = $videogo_new_instance['external_link_text'];
    $videogo_instance['menu_top'] = $videogo_new_instance['menu_top'];
    $videogo_instance['menu_bottom'] = $videogo_new_instance['menu_bottom'];
    return $videogo_instance;
  }
 
	function widget($videogo_args, $videogo_instance)
	{ 
		extract($videogo_args, EXTR_SKIP);
		$videogo_title = empty($videogo_instance['title']) ? ' ' : apply_filters('widget_title', $videogo_instance['title']);
		$videogo_left_image = isset( $videogo_instance['left_image'] ) ? esc_attr( $videogo_instance['left_image'] ) : '';	
		$videogo_center_background = isset( $videogo_instance['center_background'] ) ? esc_attr( $videogo_instance['center_background'] ) : '';	
		$videogo_right_image = isset( $videogo_instance['right_image'] ) ? esc_attr( $videogo_instance['right_image'] ) : '';	
		$videogo_sub_heading = isset( $videogo_instance['sub_heading'] ) ? esc_attr( $videogo_instance['sub_heading'] ) : '';	
		$videogo_boxed_heading = isset( $videogo_instance['boxed_heading'] ) ? esc_attr( $videogo_instance['boxed_heading'] ) : '';	
		$videogo_counter_date = isset( $videogo_instance['counter_date'] ) ? esc_attr( $videogo_instance['counter_date'] ) : '';	
		$videogo_external_link = isset( $videogo_instance['external_link'] ) ? esc_attr( $videogo_instance['external_link'] ) : '';	
		$videogo_external_link_text = isset( $videogo_instance['external_link_text'] ) ? esc_attr( $videogo_instance['external_link_text'] ) : '';	
		$videogo_menu_top = isset( $videogo_instance['menu_top'] ) ? esc_attr( $videogo_instance['menu_top'] ) : '';	
		$videogo_menu_bottom = isset( $videogo_instance['menu_bottom'] ) ? esc_attr( $videogo_instance['menu_bottom'] ) : '';	
		$videogo_menu_top_object = wp_get_nav_menu_object( $videogo_menu_top );
		$videogo_menu_bottom_object = wp_get_nav_menu_object( $videogo_menu_bottom );
		
		if($videogo_left_image <> ''){ $videogo_left_image = aq_resize( $videogo_left_image, 380, 500, true ); }
		if($videogo_center_background <> ''){ $videogo_center_background = aq_resize( $videogo_center_background, 375, 500, true ); }
		if($videogo_right_image <> ''){ $videogo_right_image = aq_resize( $videogo_right_image, 430, 500, true ); }
	?>
    <!--Middle Section Start-->
   <section class="cp-ft-middle-section">
      <div class="cp-col-4">
        <div class="cp-ft-widget-thumb"> 
        <?php if($videogo_left_image <> ''){ ?>
        <img src="<?php echo esc_url($videogo_left_image); ?>" alt="footer-left-image"> 
        <?php } else { echo '.'; } ?>
        </div>
      </div>
      <div class="cp-col-2">
        <div class="cp-ft-widget-countdown" style="background: url('<?php echo esc_url($videogo_center_background); ?>') top left no-repeat; background-size: cover;">
        <?php if (!empty($videogo_title)){
				$videogo_title_pieces = explode(" ", $videogo_title);
			echo '<h2><span>'.esc_attr($videogo_title_pieces[0]).'</span> '.esc_attr($videogo_title_pieces[1]).'</h2>';
		} ?>
          <h3><?php echo esc_attr($videogo_sub_heading); ?></h3>
          <strong class="cp-off-price"><?php echo esc_attr($videogo_boxed_heading); ?></strong>
          <div class="cp_countdown-holder">
            <div class="cp-off-countdown"></div>
          </div>
          <a class="more" href="<?php echo esc_url($videogo_external_link); ?>"><?php echo esc_attr($videogo_external_link_text); ?></a></div>
      </div>
      <div class="cp-col-4">
        <div class="cp-ft-widget-info" style="background: url('<?php echo esc_url($videogo_right_image); ?>') top right no-repeat; background-color: #171517;">
          <div class="widget widget-catrgories">
            <h3><?php echo esc_attr($videogo_menu_top_object->name); ?></h3>
            <?php videogo_footer_menu($videogo_menu_top); ?>
          </div>
          <div class="widget widget-catrgories">
            <h3><?php echo esc_attr($videogo_menu_bottom_object->name); ?></h3>
            <?php videogo_footer_menu($videogo_menu_bottom); ?>
          </div>
        </div>
      </div>
    </section>
    <!--Middle Section End--> 
<?php 
		}
	}
add_action( 'widgets_init', create_function('', 'return register_widget("videogo_footer_widget");') );?>