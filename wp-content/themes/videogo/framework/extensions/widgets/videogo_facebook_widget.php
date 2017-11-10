<?php
class facebook_widget extends WP_Widget
{
  function facebook_widget()
  {
    $videogo_widget_ops = array('classname' => 'facebook_class', 'description' => 'Facebook Like Box Customize Look and Feel According to theme.' );
    parent::__construct('facebook_widget', 'CrunchPress : Facebook', $videogo_widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $videogo_title = $instance['title'];
	$videogo_pageurl = isset( $instance['pageurl'] ) ? esc_attr( $instance['pageurl'] ) : '';
	$videogo_showfaces = isset( $instance['showfaces'] ) ? esc_attr( $instance['showfaces'] ) : '';
	$videogo_showstream = isset( $instance['showstream'] ) ? esc_attr( $instance['showstream'] ) : '';
	$videogo_likebox_width = isset( $instance['likebox_width'] ) ? esc_attr( $instance['likebox_width'] ) : '';						
	$videogo_likebox_height = isset( $instance['likebox_height'] ) ? esc_attr( $instance['likebox_height'] ) : '';						
?>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	  <?php esc_html_e('Title:','videogo');?> 
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($videogo_title); ?>" />
  </label>
  </p> 
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('pageurl')); ?>">
	  <?php esc_html_e('Page URL:','videogo');?> 
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('pageurl')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('pageurl')); ?>" type="text" value="<?php echo esc_attr($videogo_pageurl); ?>" />
	<br />
      <small><?php esc_html_e('Please enter your page url example: http://www.facebook.com/profilename OR','videogo');?> <br />
     <?php esc_html_e('https://www.facebook.com/pages/wxyz/123456789101112','videogo');?> 
	</small><br />
  </label>
  </p> 
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('showfaces')); ?>">
	 <?php esc_html_e('Show Faces:','videogo');?> 
	  <select id="<?php echo esc_attr($this->get_field_id('showfaces')); ?>" name="<?php echo esc_attr($this->get_field_name('showfaces')); ?>" class="widefat">
			<option <?php if($videogo_showfaces == 'true'){echo 'selected';}?> value="true"><?php esc_html_e('Yes','videogo');?></option>
			<option <?php if($videogo_showfaces == 'false'){echo 'selected';}?> value="false"><?php esc_html_e('No','videogo');?></option>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('showstream')); ?>">
	  <?php esc_html_e('Show Stream:','videogo');?> 
	   <select id="<?php echo esc_attr($this->get_field_id('showstream')); ?>" name="<?php echo esc_attr($this->get_field_name('showstream')); ?>" class="widefat">
			<option <?php if($videogo_showstream == 'true'){echo 'selected';}?> value="true"><?php esc_html_e('Yes','videogo');?></option>
			<option <?php if($videogo_showstream == 'false'){echo 'selected';}?> value="false"><?php esc_html_e('No','videogo');?></option>
      </select>
  </label>
  </p> 
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('likebox_width')); ?>">
	  <?php esc_html_e('Like Box Width:','videogo');?>
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('likebox_width')); ?>" size='2' name="<?php echo esc_attr($this->get_field_name('likebox_width')); ?>" type="text" value="<?php echo esc_attr($videogo_likebox_width); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('likebox_height')); ?>">
	  <?php esc_html_e('Like Box Height:','videogo');?>
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('likebox_height')); ?>" size='2' name="<?php echo esc_attr($this->get_field_name('likebox_height')); ?>" type="text" value="<?php echo esc_attr($videogo_likebox_height); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['pageurl'] = $new_instance['pageurl'];
	$instance['showfaces'] = $new_instance['showfaces'];	
	$instance['showstream'] = $new_instance['showstream'];
	$instance['showheader'] = $new_instance['showheader'];	
	$instance['likebox_width'] = $new_instance['likebox_width'];	
	$instance['likebox_height'] = $new_instance['likebox_height'];			
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$videogo_title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$videogo_pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);
		$videogo_showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);
		$videogo_showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);
		$videogo_showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);
		$videogo_likebox_width = empty($instance['likebox_width']) ? ' ' : apply_filters('widget_title', $instance['likebox_width']);													
		$videogo_likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);													
		
		echo html_entity_decode($before_widget);	
		// WIDGET display CODE Start
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo esc_attr($videogo_title);
			echo html_entity_decode($after_title);
			global $post;?>
			<?php	
			if($videogo_likebox_width == ' ' || $videogo_likebox_width == ''){$videogo_likebox_width = '300';}
			if($videogo_likebox_height == ' ' || $videogo_likebox_height == ''){$videogo_likebox_height = '315';}
			?>         
			<div class="fb-like-box" data-href="<?php echo esc_url($videogo_pageurl);?>" data-width="<?php echo esc_attr($videogo_likebox_width);?>" data-height="<?php echo esc_attr($videogo_likebox_height);?>"  data-show-faces="<?php echo esc_attr($videogo_showfaces);?>" data-header="false" data-stream="<?php echo esc_attr($videogo_showstream);?>" data-show-border="false"></div>
			<div id="fb-root"></div>
<?php
		$videogo_data = "(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = '//connect.facebook.net/en_GB/all.js#xfbml=1&appId=482990088401012';
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));";
		$videogo_handle = 'videogo_custom';
		wp_add_inline_script( $videogo_handle, $videogo_data, $videogo_position = 'after' ); 
 echo html_entity_decode($after_widget);
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("facebook_widget");') );?>