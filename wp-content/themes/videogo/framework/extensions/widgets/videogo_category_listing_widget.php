<?php
class videogo_category_listing extends WP_Widget{
	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function videogo_category_listing() {
		$widget_ops = array(
			'classname' => 'widget_categories',
			'description' => esc_html( 'A list or dropdown of categories.','videogo' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'videogo_category_listing', esc_html( 'CrunchPress : Category Listing','videogo' ), $widget_ops );
	}
	public function widget( $args, $instance ) { 
		static $first_dropdown = true;
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html( 'Categories','videogo' ) : $instance['title'], $instance, $this->id_base );
		$vcatcount = isset( $instance['vcatcount'] ) ? esc_attr( $instance['vcatcount'] ) : '';
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';
		echo ($args['before_widget']);
		if ( $title ) {
			echo '<div class="cp-heading-outer"><h2>'.$title .'</h2></div>';
		}
		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h
		);
		if ( $d ) {
			$dropdown_id = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
			$first_dropdown = false;
			echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';
			$cat_args['show_option_none'] = esc_html( 'Select Category','videogo' );
			$cat_args['id'] = $dropdown_id;
			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
		$videogo_data = '(function() {
			var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
			function onCatChange() {
				if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
					location.href = "<?php echo home_url(); ?>/?cat=" + dropdown.options[ dropdown.selectedIndex ].value;
				}
			}
			dropdown.onchange = onCatChange;
			})();
		';
		$videogo_handle = 'videogo_custom';
		wp_add_inline_script( $videogo_handle, $videogo_data, $videogo_position = 'after' ); 
		} else {
?>
		<ul class="cp-reviews">
<?php
		$cat_args['title_li'] = '';
		/**
		 * Filter the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $cat_args An array of Categories widget options.  
		 */
		$list_of_categories = get_categories();
		$categories_counter = 1;
		foreach($list_of_categories as $cat){ 
			echo '<li> <a href="'.get_category_link($cat->cat_ID).'">'.$cat->cat_name.'</a>'.$cat->count.'</li>';
			if($categories_counter == $vcatcount){ break; }
			$categories_counter++;
		}
?>
		</ul>
<?php
		}
		echo ($args['after_widget']);
	}
	/**
	 * Handles updating settings for the current Categories widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['vcatcount'] = $new_instance['vcatcount'];
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0; 
		return $instance;
	}
	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = sanitize_text_field( $instance['title'] );
		$vcatcount = isset( $instance['vcatcount'] ) ? esc_attr( $instance['vcatcount'] ) : '';
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:','videogo' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('vcatcount')); ?>"><?php esc_html_e( 'Number of Categories to show:','videogo' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('vcatcount')); ?>" name="<?php echo esc_attr($this->get_field_name('vcatcount')); ?>" type="text" value="<?php echo  $vcatcount ; ?>" /></p>
		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('dropdown')); ?>" name="<?php echo esc_attr($this->get_field_name('dropdown')); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('dropdown')); ?>"><?php esc_html_e( 'Display as dropdown','videogo' ); ?></label><br />
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Show post counts','videogo' ); ?></label><br />
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>" name="<?php echo esc_attr($this->get_field_name('hierarchical')); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>"><?php esc_html_e( 'Show hierarchy','videogo' ); ?></label></p>
		<?php
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("videogo_category_listing");') ); ?>