<?php
if(class_exists('videogo_function_library')){

	add_action( 'plugins_loaded', 'event_fun_override' );

	function event_fun_override() {
		// your code here
		$events_class = new videogo_events_class;
	}


	class videogo_events_class extends videogo_function_library{
				
		/* Define Parameters of Size*/
		public function page_builder_size_class(){
		
			
		}
		
		/* Define Parameters of Page Builder Here */
		public function page_builder_element_class(){
		
			/* Stub Only */
		}	
		
		public function __construct(){
			
			add_action( 'add_meta_boxes', array( $this, 'videogo_add_events_option' ) );
			add_action( 'save_post', array( $this, 'save_event_option_meta' ) );
			
		}

		
		public function videogo_create_events() {
			
			
			$labels = array(
				'name' => _x('Events', 'Event General Name', 'videogo'),
				'singular_name' => _x('Event Item', 'Event Singular Name', 'videogo'),
				'add_new' => _x('Add New', 'Add New Event Name', 'videogo'),
				'add_new_item' => __('Add New Event', 'videogo'),
				'edit_item' => __('Edit Event', 'videogo'),
				'new_item' => __('New Event', 'videogo'),
				'view_item' => __('View Event', 'videogo'),
				'search_items' => __('Search Event', 'videogo'),
				'not_found' =>  __('Nothing found', 'videogo'),
				'not_found_in_trash' => __('Nothing found in Trash', 'videogo'),
				'parent_item_colon' => ''
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => videogo_PATH_URL . '/framework/images/calendar-icon.png',
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 5,								'has_archive' => true,
				'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
				'rewrite' => array('slug' => 'events', 'with_front' => false)
			  ); 
			  
			register_post_type( 'events' , $args);
			
	
			register_taxonomy(
				"event-category", array("events"), array(
					"hierarchical" => true,
					"label" => "Event Categories", 
					"singular_label" => "Event Categories", 
					"rewrite" => true));
			register_taxonomy_for_object_type('events-categories', 'events');
			
			register_taxonomy(
				"event-tag", array("events"), array(
					"hierarchical" => false, 
					"label" => "Event Tag", 
					"singular_label" => "Event Tag", 
					"rewrite" => true));
			register_taxonomy_for_object_type('events-tag', 'events');
			
		}
		
		
		
		public function videogo_add_events_option(){	
		
			add_meta_box('event-option', __('Event Options','videogo'), array($this,'videogo_add_event_option_element'),
				'event', 'normal', 'high');
		}
		

		public function videogo_add_event_option_element(){

			$event_detail_xml = '';
			$event_social = '';
			$sidebar_event = '';
			$right_sidebar_event = '';
			$left_sidebar_event = '';
			$event_start_date = '';
			$event_end_date = '';
			$event_start_time = '';
			$event_end_time = '';
			$additional_info = '';
			$entry_level = '';
			$booking_url = '';
			$event_thumbnail = '';
			$video_url_type = '';
			$select_slider_type = '';
			$event_location_select = '';
			$schedule_head = '';
			$schedule_descrip = '';
			$team_parti_head = '';
			$team_parti_descrip = '';
			$name_post_schedule = '';
			$title_post_schedule = '';
			$des_post_schedule = '';
			$sch_select_organizer = '';
			
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
			global $post,$EM_Event;
			
			$event_detail_xml = get_post_meta($EM_Event->ID, 'event_detail_xml', true);
			if($event_detail_xml <> ''){
				$videogo_event_xml = new DOMDocument ();
				$videogo_event_xml->loadXML ( $event_detail_xml );
				$event_social = videogo_find_xml_value($videogo_event_xml->documentElement,'event_social');
				$sidebar_event = videogo_find_xml_value($videogo_event_xml->documentElement,'sidebar_event');
				$left_sidebar_event = videogo_find_xml_value($videogo_event_xml->documentElement,'left_sidebar_event');
				$right_sidebar_event = videogo_find_xml_value($videogo_event_xml->documentElement,'right_sidebar_event');
				$event_thumbnail = videogo_find_xml_value($videogo_event_xml->documentElement,'event_thumbnail');
				$video_url_type = videogo_find_xml_value($videogo_event_xml->documentElement,'video_url_type');
				$select_slider_type = videogo_find_xml_value($videogo_event_xml->documentElement,'select_slider_type');
				
			}
		?>
		
		<div class="event_options cp-wrapper" id="event_backend_options" >
			<ul class="event_social_class recipe_class row-fluid">
				<li class="panel-input span12"> <span class="panel-title">
				  <h3 for="event_social" >
					<?php esc_html_e('Social Sharing', 'videogo'); ?>
				  </h3>
				  </span>
				  <label for="event_social">
					<div class="checkbox-switch <?php
						echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; ?>">
					</div>
				  </label>
				  <input type="checkbox" name="event_social" class="checkbox-switch" value="disable" checked>
				  <input type="checkbox" name="event_social" id="event_social" class="checkbox-switch" value="enable" <?php 			
						echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checked': ''; ?>>
				  <p> <?php esc_html_e('You can turn On/Off social sharing from event detail.','videogo'); ?> </p>
				</li>
			</ul>
			<div class="clear"></div>
			<?php echo videogo_function_library::videogo_show_sidebar($sidebar_event,'right_sidebar_event','left_sidebar_event',$right_sidebar_event,$left_sidebar_event);?>
			<div class="clear"></div>
			<input type="hidden" name="event_submit" value="events"/>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	<?php }
		
		public function save_event_option_meta($post_id){
			
			$event_social = '';
			$sidebars = '';
			$right_sidebar_event = '';
			$left_sidebar_event = '';
			$event_detail_xml = '';
			$event_thumbnail = '';
			$video_url_type = '';
			$select_slider_type = '';

			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
		
			if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		
				if(isset($event_submit) AND $event_submit == 'events'){
					$new_data = '<event_detail>';
					$new_data = $new_data . videogo_function_library::videogo_create_xml_tag('event_social',$event_social);
					$new_data = $new_data . videogo_function_library::videogo_create_xml_tag('sidebar_event',$sidebars);
					$new_data = $new_data . videogo_function_library::videogo_create_xml_tag('right_sidebar_event',$right_sidebar_event);
					$new_data = $new_data . videogo_function_library::videogo_create_xml_tag('left_sidebar_event',$left_sidebar_event);
					$new_data = $new_data . '</event_detail>';
					/* Saving Sidebar and Social Sharing Settings as XML */
					$old_data = get_post_meta($post_id, 'event_detail_xml',true);
					videogo_function_library::videogo_save_meta_data($post_id, $new_data, $old_data, 'event_detail_xml');

				}
		}

	}
}
