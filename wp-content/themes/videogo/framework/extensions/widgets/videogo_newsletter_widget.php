<?php
class videogo_newsletter_widget extends WP_Widget
{
  function videogo_newsletter_widget()
  {
    $videogo_widget_ops = array('classname' => 'widget widget-form', 'description' => 'Newsletter and google feed widget to subscribe on website' );
    parent::__construct('videogo_newsletter_widget', 'CrunchPress : Newsletter/Google Feed Widget', $videogo_widget_ops);
  }
 
  function form($videogo_instance)
  {
    $videogo_instance = wp_parse_args( (array) $videogo_instance, array( 'title' => '' ) );
	$videogo_title = $videogo_instance['title'];
	$videogo_show_name = isset( $videogo_instance['show_name'] ) ? esc_attr( $videogo_instance['show_name'] ) : '';	
	$videogo_news_letter_des = isset( $videogo_instance['news_letter_des'] ) ? esc_attr( $videogo_instance['news_letter_des'] ) : '';	
?>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
		 <?php esc_attr_e('Title:','videogo');?>  
		  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($videogo_title); ?>" />
	  </label>
  </p>
  
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('news_letter_des')); ?>">
		 <?php esc_attr_e('Description:','videogo');?>
		  <textarea rows="2"  cols="35" class="widefat" id="<?php echo esc_textarea($this->get_field_id('news_letter_des')); ?>" name="<?php echo esc_textarea($this->get_field_name('news_letter_des')); ?>"><?php echo esc_textarea($videogo_news_letter_des); ?></textarea>
	  </label>
  </p>
<?php
  }
 
  function update($videogo_new_instance, $videogo_old_instance)
	{
		$videogo_instance = $videogo_old_instance;
		$videogo_instance['title'] = $videogo_new_instance['title'];
		$videogo_instance['show_name'] = $videogo_new_instance['show_name'];
		$videogo_instance['news_letter_des'] = $videogo_new_instance['news_letter_des'];
    
		return $videogo_instance;
	}
 
	function widget($videogo_args, $videogo_instance)
	{
		
		extract($videogo_args, EXTR_SKIP);
		$videogo_title = empty($videogo_instance['title']) ? ' ' : apply_filters('widget_title', $videogo_instance['title']);
		$videogo_show_name = isset( $videogo_instance['show_name'] ) ? esc_attr( $videogo_instance['show_name'] ) : '';
		$videogo_news_letter_des = isset( $videogo_instance['news_letter_des'] ) ? esc_attr( $videogo_instance['news_letter_des'] ) : '';		
		
		echo html_entity_decode($before_widget);	
		
		
			echo '<div class="cp-heading-outer"><h2>';
			echo esc_attr($videogo_title);
			echo '</h2></div>';
			$videogo_newsletter_config = '';
			$videogo_feed_burner_text = '';
			$videogo_newsletter_settings = get_option('newsletter_settings');
			if($videogo_newsletter_settings <> ''){
				$videogo_newsletter = new DOMDocument ();
				$videogo_newsletter->loadXML ( $videogo_newsletter_settings );
				$videogo_newsletter_config = videogo_find_xml_value($videogo_newsletter->documentElement,'videogo_newsletter_config');
				$videogo_feed_burner_text = videogo_find_xml_value($videogo_newsletter->documentElement,'videogo_feed_burner_text');
			}
		?>
                <form class="newsletter get-touch-form" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($videogo_feed_burner_text) ?>', 'popupwindow', 'scrollbars=yes,width=600,height=550');return true">
					<input type="text" pattern="[a-zA-Z ]+" required class="form-control feedemail-input" name="email" onblur="this.value=this.value==''?'Enter email for subscription...':this.value;" onfocus="this.value=this.value=='Enter email for subscription...'?'':this.value" value="Enter email for subscription..." />
						<input type="hidden" value="<?php echo esc_attr($videogo_feed_burner_text) ?>" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<button type="submit"><i class="fa fa-arrow-right"></i></button>
				</form>
	<?php 
	
	echo html_entity_decode($after_widget);
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("videogo_newsletter_widget");') );?>