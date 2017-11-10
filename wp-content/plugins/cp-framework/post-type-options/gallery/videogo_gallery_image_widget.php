<?php
class gallery_image_show extends WP_Widget
{
  function gallery_image_show()
  {
    $videogo_widget_ops = array('classname' => 'photo-gallery', 'description' => 'Show Gallery Images' );
    parent::__construct('gallery_image_show', 'CrunchPress : Gallery Widget', $videogo_widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$videogo_wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';		
	$videogo_title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';		
	$videogo_select_gallery = isset( $instance['select_gallery'] ) ? esc_attr( $instance['select_gallery'] ) : '';		
	$videogo_nofimages = isset( $instance['nofimages'] ) ? esc_attr( $instance['nofimages'] ) : '';	
	$videogo_externallink = isset( $instance['externallink'] ) ? esc_attr( $instance['externallink'] ) : '';	 ?>

  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('wid_class')); ?>">
		 <?php esc_html_e('Class:','videogo');?>  
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('wid_class')); ?>" name="<?php echo esc_attr($this->get_field_name('wid_class')); ?>" type="text" value="<?php echo esc_attr($videogo_wid_class); ?>" />
	  </label>
  </p>
  <div class="clear"></div>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
		  <?php esc_html_e('Title:','videogo');?> 
		  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($videogo_title); ?>" />
	  </label>
  </p>
  <div class="clear"></div>
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('select_gallery')); ?>">
		  <?php esc_html_e('Select Gallery:','videogo');?>
		  <select id="<?php echo esc_attr($this->get_field_id('select_gallery')); ?>" name="<?php echo esc_attr($this->get_field_name('select_gallery')); ?>" class="widefat">
			<?php
			global $wpdb,$post;
			$videogo_gallery_name = videogo_get_title_list_array('gallery');
			foreach ( $videogo_gallery_name as $videogo_gallery_title){ ?>
						<option <?php if($select_gallery == $videogo_gallery_title->ID){echo 'selected';}?> value="<?php echo esc_attr($videogo_gallery_title->ID);?>" >
							<?php echo substr(esc_attr($videogo_gallery_title->post_title), 0, 20);	if ( strlen($videogo_gallery_title->post_title) > 20 ) echo "...";?>
						</option>						
				<?php }
				?>
		  </select>
	  </label>
  </p>     
  
  <p>
	  <label for="<?php echo esc_attr($this->get_field_id('nofimages')); ?>">
		 <?php esc_html_e('Number of Images to Show:','videogo');?> 
		  <input class="widefat" size="5" id="<?php echo esc_attr($this->get_field_id('nofimages')); ?>" name="<?php echo esc_attr($this->get_field_name('nofimages')); ?>" type="text" value="<?php echo esc_attr($videogo_nofimages); ?>" />
	  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
		$instance['wid_class'] = $new_instance['wid_class'];
		$instance['title'] = $new_instance['title'];
		$instance['select_gallery'] = $new_instance['select_gallery'];
		$instance['nofimages'] = $new_instance['nofimages'];
		$instance['externallink'] = $new_instance['externallink'];
		
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$videogo_wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';
		$videogo_title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$videogo_select_gallery = isset( $instance['select_gallery'] ) ? esc_attr( $instance['select_gallery'] ) : '';
		$videogo_nofimages = isset( $instance['nofimages'] ) ? esc_attr( $instance['nofimages'] ) : '';	
		$videogo_externallink = isset( $instance['externallink'] ) ? esc_attr( $instance['externallink'] ) : '';	
		
		echo html_entity_decode($before_widget);	
		
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo esc_attr($videogo_title);
			echo html_entity_decode($after_title);

			$videogo_slider_xml_string = get_post_meta($select_gallery,'post-option-gallery-xml', true);
			$videogo_slider_xml_dom = new DOMDocument();
			if( !empty( $videogo_slider_xml_string ) ){
			$videogo_slider_xml_dom->loadXML($videogo_slider_xml_string);	
			?>
			
                <div class="flicker">
                  <ul>
						<?php
						$videogo_children = $videogo_slider_xml_dom->documentElement->childNodes;
						$videogo_counter_gallery = 0;
						$videogo_counter_limit = 0;
						if($videogo_nofimages > $videogo_slider_xml_dom->documentElement->childNodes->length){$videogo_nofimages = $videogo_slider_xml_dom->documentElement->childNodes->length;}
						for($i=0;$i<$videogo_nofimages;$i++) { 
						$videogo_counter_limit++;
							$videogo_link_type = videogo_find_xml_value($videogo_children->item($i), 'linktype');
							$videogo_title = videogo_find_xml_value($videogo_children->item($i), 'title');
							$videogo_thumbnail_id = videogo_find_xml_value($videogo_children->item($i), 'image');				
							$videogo_alt_text = get_post_meta($videogo_thumbnail_id , '_wp_attachment_image_alt', true);						
							$videogo_image_full = wp_get_attachment_image_src($videogo_thumbnail_id, 'full');
							$videogo_image_thumb = wp_get_attachment_image_src($videogo_thumbnail_id, array(80,80));
							echo '<li><div class="gal-image-cp"><a data-gal="prettyPhoto[]" href="' . $videogo_image_full[0] . '"  title=""><img src="' . $videogo_image_thumb[0] . '" alt="' . $videogo_alt_text . '" /></a></div></li>';
						}?>				
					</ul>
                </div>
			<?php
		}	
		
	
	
	echo html_entity_decode($after_widget);
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("gallery_image_show");') );?>