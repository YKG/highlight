<?php
class videogo_magazine_widget extends WP_Widget
{
  function videogo_magazine_widget()
  {
    $videogo_widget_ops = array('classname' => 'widget widget-magazine', 'description' => 'Video of Month image with link' );
    parent::__construct('videogo_magazine_widget', 'CrunchPress : Video of Month Widget', $videogo_widget_ops);
  }
 
  function form($videogo_instance)
  {
    $videogo_instance = wp_parse_args( (array) $videogo_instance, array( 'title' => '' ) );
	$videogo_title = $videogo_instance['title'];
	$videogo_sub_title = isset( $videogo_instance['sub_title'] ) ? esc_attr( $videogo_instance['sub_title'] ) : '';	
	$videogo_sub_title_link = isset( $videogo_instance['sub_title_link'] ) ? esc_attr( $videogo_instance['sub_title_link'] ) : '';	
	$videogo_image_url = isset( $videogo_instance['image_url'] ) ? esc_attr( $videogo_instance['image_url'] ) : '';	
?>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
		 <?php esc_attr_e('Title:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($videogo_title); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('sub_title')); ?>">
		 <?php esc_attr_e('Sub Title:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('sub_title')); ?>" name="<?php echo esc_attr($this->get_field_name('sub_title')); ?>" type="text" value="<?php echo esc_attr($videogo_sub_title); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('sub_title_link')); ?>">
		 <?php esc_attr_e('Sub Title Link:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('sub_title_link')); ?>" name="<?php echo esc_attr($this->get_field_name('sub_title_link')); ?>" type="text" value="<?php echo esc_attr($videogo_sub_title_link); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('image_url')); ?>">
		 <?php esc_attr_e('Image URL:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('image_url')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url')); ?>" type="text" value="<?php echo esc_attr($videogo_image_url); ?>" />
	  </label>
  </p>
  
<?php
  }
 
  function update($videogo_new_instance, $videogo_old_instance)
	{
		$videogo_instance = $videogo_old_instance;
		$videogo_instance['title'] = $videogo_new_instance['title'];
		$videogo_instance['sub_title'] = $videogo_new_instance['sub_title'];
		$videogo_instance['sub_title_link'] = $videogo_new_instance['sub_title_link'];
		$videogo_instance['image_url'] = $videogo_new_instance['image_url'];
    
		return $videogo_instance;
	}
 
	function widget($videogo_args, $videogo_instance)
	{
		
		extract($videogo_args, EXTR_SKIP);
		$videogo_title = empty($videogo_instance['title']) ? ' ' : apply_filters('widget_title', $videogo_instance['title']);
		$videogo_sub_title = isset( $videogo_instance['sub_title'] ) ? esc_attr( $videogo_instance['sub_title'] ) : '';
		$videogo_sub_title_link = isset( $videogo_instance['sub_title_link'] ) ? esc_attr( $videogo_instance['sub_title_link'] ) : '';		
		$videogo_image_url = isset( $videogo_instance['image_url'] ) ? esc_attr( $videogo_instance['image_url'] ) : '';		
		
		echo html_entity_decode($before_widget);	
		
		
			echo '<div class="cp-heading-outer"><h2>';
			echo esc_attr($videogo_title);
			echo '</h2>';
			$videogo_magazine_of_month_image = aq_resize( $videogo_image_url, 262, 495, true );
		?>
        
           <ul class="cp-listed">
                  <li><a href="<?php echo esc_url($videogo_sub_title_link); ?>"><?php echo esc_attr($videogo_sub_title); ?></a></li>
            </ul>
          </div>
    <div class="cp-thumb"><a href="<?php echo esc_url($videogo_sub_title_link); ?>">
    <img src="<?php echo esc_url($videogo_magazine_of_month_image); ?>" alt="magazine of month image"></a>
    </div> <?php echo do_shortcode( '[fu-upload-form]' ); ?>
        
        
	<?php 
	
	echo html_entity_decode($after_widget);
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("videogo_magazine_widget");') );?>