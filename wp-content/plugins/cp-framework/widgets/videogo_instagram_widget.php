<?php
class cp_instagram_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'cp_instagram_feed',
			esc_html__( 'CrunchPress : Instagram','taxigo' ),
			array( 'classname' => 'instagram-widget', 'description' => esc_html__( 'Displays your latest Instagram photos','taxigo' ) )
		);
	}
              
	function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$size = empty( $instance['size'] ) ? 'large' : $instance['size'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];

		echo html_entity_decode($before_widget);
		//if ( ! empty( $title ) ) { echo html_entity_decode($before_title) . $title . $after_title; };

		do_action( 'wpiw_before_widget', $instance );

		if ( $username != '' ) {

			$media_array = $this->scrape_instagram( $username, $limit );

			if ( is_wp_error( $media_array ) ) {

				echo ($media_array->get_error_message());

			} else {

				// filter for images only?
				if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) )
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );

				// filters for custom classes
				$ulclass = ( apply_filters( 'wpiw_list_class', 'cp-instagram-listed instagram-size-' . $size ) );
				$liclass = ( apply_filters( 'wpiw_item_class', '' ) );
				$aclass = ( apply_filters( 'wpiw_a_class', '' ) );
				$imgclass = ( apply_filters( 'wpiw_img_class', '' ) );

				?><ul class="<?php echo esc_attr( $ulclass ); ?>"><?php
				foreach ( $media_array as $item ) { 
					// copy the else line into a new file (parts/wp-instagram-widget.php) within your theme and customise accordingly
					if ( locate_template( 'parts/wp-instagram-widget.php' ) != '' ) {
						include locate_template( 'parts/wp-instagram-widget.php' );
					} else { 
					$item['description'] = str_replace('"', "", $item['description']);
						echo '<li class="'. $liclass .'"><figure class="cp-ins-item"><a href="'. ( $item['link'] ) .'" target="'. ( $target ) .'"  class="'. $aclass .'"><img width="224" height="187" src="'. ($item[$size]) .'"  alt="'. ( $item['description'] ) .'" title="'. ( $item['description'] ).'"  class="'. $imgclass .'"/></a></figure></li>';
					}
				}
				?></ul></section>
    <!--Instagram Section End--> <?php
			}
		}

		$linkclass = ( apply_filters( 'wpiw_link_class', 'clear' ) );

		if ( $link != '' ) {
			?><p class="<?php echo ($linkclass); ?>"><a href="//instagram.com/<?php echo ( trim( $username ) ); ?>" rel="me" target="<?php echo ( $target ); ?>"><?php echo esc_attr($link); ?></a></p><?php
		}

		do_action( 'wpiw_after_widget', $instance );

		echo html_entity_decode($after_widget);
	}
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => esc_html__( 'Instagram','taxigo' ), 'username' => '', 'size' => 'large', 'link' => esc_html__( 'Follow Me!','taxigo' ), 'number' => 9, 'target' => '_self' ) );
		$title = ( $instance['title'] );
		$username = ( $instance['username'] );
		$number = absint( $instance['number'] );
		$size = ( $instance['size'] );
		$target = ( $instance['target'] );
		$link = ( $instance['link'] );
		?>
		<p><label for="<?php echo ($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title','taxigo' ); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo ($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo ($this->get_field_id( 'username' )); ?>"><?php esc_html_e( 'Username','taxigo' ); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>" name="<?php echo ($this->get_field_name( 'username' )); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
		<p><label for="<?php echo ($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of photos','taxigo' ); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo ($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></label></p>
		<p><label for="<?php echo ($this->get_field_id( 'size' )); ?>"><?php esc_html_e( 'Photo size','taxigo' ); ?>:</label>
			<select id="<?php echo ($this->get_field_id( 'size' )); ?>" name="<?php echo ($this->get_field_name( 'size' )); ?>" class="widefat">
				<option value="thumbnail" <?php selected( 'thumbnail', $size ) ?>><?php esc_html_e( 'Thumbnail','taxigo' ); ?></option>
				<option value="small" <?php selected( 'small', $size ) ?>><?php esc_html_e( 'Small','taxigo' ); ?></option>
				<option value="large" <?php selected( 'large', $size ) ?>><?php esc_html_e( 'Large','taxigo' ); ?></option>
				<option value="original" <?php selected( 'original', $size ) ?>><?php esc_html_e( 'Original','taxigo' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo ($this->get_field_id( 'target' )); ?>"><?php esc_html_e( 'Open links in','taxigo' ); ?>:</label>
			<select id="<?php echo ($this->get_field_id( 'target' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'target' )); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ) ?>><?php esc_html_e( 'Current window (_self)','taxigo' ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ) ?>><?php esc_html_e( 'New window (_blank)','taxigo' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo ($this->get_field_id( 'link' )); ?>"><?php esc_html_e( 'Link text','taxigo' ); ?>: <input class="widefat" id="<?php echo ($this->get_field_id( 'link' )); ?>" name="<?php echo ($this->get_field_name( 'link' )); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		$instance['size'] = ( ( $new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large' || $new_instance['size'] == 'small' || $new_instance['size'] == 'original' ) ? $new_instance['size'] : 'large' );
		$instance['target'] = ( ( $new_instance['target'] == '_self' || $new_instance['target'] == '_blank' ) ? $new_instance['target'] : '_self' );
		$instance['link'] = strip_tags( $new_instance['link'] );
		return $instance;
	}

	// based on https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram( $username, $slice = 8 ) { ?>
    
    <!--Instagram Section Start-->
    <section class="cp-instagram-section">
      <div class="cp-ins-text">
        <h4><?php esc_html_e('Instagram','videogo');?></h4>
        <i class="fa fa-instagram"></i> </div>
<?php	$username = strtolower( $username );
		$username = str_replace( '@', '', $username );

		if ( false === ( $instagram = get_transient( 'instagram-media-5-'.sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

			if ( is_wp_error( $remote ) )
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.','taxigo' ) );

			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.','taxigo' ) );

			$shards = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], TRUE );

			if ( ! $insta_array )
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.','taxigo' ) );

			if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
			} else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.','taxigo' ) );
			}

			if ( ! is_array( $images ) )
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.','taxigo' ) );

			$instagram = array();

			foreach ( $images as $image ) {

				$image['thumbnail_src'] = preg_replace( "/^https:/i", "", $image['thumbnail_src'] );
				$image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
				$image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
				$image['large'] = $image['thumbnail_src'];
				$image['display_src'] = preg_replace( "/^https:/i", "", $image['display_src'] );

				if ( $image['is_video'] == true ) {
					$type = 'video';
				} else {
					$type = 'image';
				}

				$caption = esc_html__( 'Instagram Image','taxigo' );
				if ( ! empty( $image['caption'] ) ) {
					$caption = $image['caption'];
				}

				$instagram[] = array(
					'description'   => $caption,
					'link'		  	=> '//instagram.com/p/' . $image['code'],
					'time'		  	=> $image['date'],
					'comments'	  	=> $image['comments']['count'],
					'likes'		 	=> $image['likes']['count'],
					'thumbnail'	 	=> $image['thumbnail'],
					'small'			=> $image['small'],
					'large'			=> $image['large'],
					'original'		=> $image['display_src'],
					'type'		  	=> $type
				);
			}

			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'instagram-media-5-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {

			$instagram = unserialize( base64_decode( $instagram ) );
			return array_slice( $instagram, 0, $slice );

		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.','taxigo' ) );

		} ?>
    
	
<?php 	}

	function images_only( $media_item ) {

		if ( $media_item['type'] == 'image' )
			return true;

		return false;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_instagram_widget");') );?>