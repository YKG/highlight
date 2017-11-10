<?php
class videogo_ad_image_widget extends WP_Widget
{
  function videogo_ad_image_widget()
  {
    $videogo_widget_ops = array('classname' => 'widget widget-advertisement', 'description' => 'Advertisement image' );
    parent::__construct('videogo_ad_image_widget', 'CrunchPress : Advertisement Image Widget', $videogo_widget_ops);
  }
 
  function form($videogo_instance)
  {
    $videogo_instance = wp_parse_args( (array) $videogo_instance, array( 'title' => '' ) );
	$videogo_title = $videogo_instance['title'];
	$videogo_ad_img_url = isset( $videogo_instance['ad_img_url'] ) ? esc_attr( $videogo_instance['ad_img_url'] ) : '';	
?>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
		 <?php esc_attr_e('Title:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($videogo_title); ?>" />
	  </label>
  </p>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('ad_img_url')); ?>">
		 <?php esc_attr_e('Ad Image URL:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('ad_img_url')); ?>" name="<?php echo esc_attr($this->get_field_name('ad_img_url')); ?>" type="text" value="<?php echo esc_attr($videogo_ad_img_url); ?>" />
	  </label>
  </p>
  
<?php
  }
 
  function update($videogo_new_instance, $videogo_old_instance)
	{
		$videogo_instance = $videogo_old_instance;
		$videogo_instance['title'] = $videogo_new_instance['title'];
		$videogo_instance['ad_img_url'] = $videogo_new_instance['ad_img_url'];
    
		return $videogo_instance;
	}
 
	function widget($videogo_args, $videogo_instance)
	{
		
		extract($videogo_args, EXTR_SKIP);
		$videogo_title = empty($videogo_instance['title']) ? ' ' : apply_filters('widget_title', $videogo_instance['title']);
		$videogo_ad_img_url = isset( $videogo_instance['ad_img_url'] ) ? esc_attr( $videogo_instance['ad_img_url'] ) : '';		
		
		echo html_entity_decode($before_widget);	
		
		
			echo '<div class="cp-heading-outer"><h2>';
			echo esc_attr($videogo_title);
			echo '</h2></div>';
			$videogo_ad_image_url = aq_resize( $videogo_ad_img_url, 250, 300, true );
		?>
                <div class="cp-advertisement"> <img src="<?php echo esc_url($videogo_ad_image_url); ?>" alt="advertisement image"> </div>
	<?php 
	
	echo html_entity_decode($after_widget);
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("videogo_ad_image_widget");') );?>