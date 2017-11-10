<?php 
/*	
*	CrunchPress Super Object File
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
	
	
	/* Remove LayerSlider Scripts */
	if(class_exists('LS_Sliders')){
		remove_action('wp_enqueue_scripts', 'layerslider_enqueue_content_res');
	}
	/* get extended classes name used in Page-Options.php*/
	function videogo_get_extends_name($videogo_base){
		$videogo_myclass = array();
		foreach(get_declared_classes() as $videogo_class){
			 if(is_subclass_of($videogo_class,$videogo_base)){ 
				$videogo_myclass[] = $videogo_class;
			 }
		}
		   return $videogo_myclass; 
	}
	
	/* get number of extended Classes used in following function */
	function videogo_get_extends_number($videogo_base){
		$videogo_rt=0;
		foreach(get_declared_classes() as $videogo_class){
			if(is_subclass_of($videogo_class,$videogo_base)){ 
				$videogo_rt++;
			}
		}
		return $videogo_rt;
	}
	
	/* create Page Option Meta */
	function videogo_class_function_layout(){	
		for($i =0;$i <= videogo_get_extends_number('videogo_function_library');$i++){
			$videogo_new_class = videogo_get_extends_name('videogo_function_library');
		}
		return $videogo_new_class;
	}
	
	/* Find the XML value from XML Object */
	function videogo_find_xml_value($videogo_xml, $videogo_field){
	
		if(!empty($videogo_xml)){
		
			foreach($videogo_xml->childNodes as $videogo_xmlChild){
			
				if($videogo_xmlChild->nodeName == $videogo_field){
					if( is_admin() ){
						return $videogo_xmlChild->nodeValue;
					}else{
						return $videogo_xmlChild->nodeValue;
					}
				}
				
			}
			
		}
		
		return '';
		
	}
	
	/*  Checking Google Font */
	function videogo_verify_font($videogo_font_google){
		$videogo_fonts_array = videogo_get_font_array();
			foreach($videogo_fonts_array as $keys=>$values){
				if($values == 'Google Font'){
					if($keys == $videogo_font_google){
						return 'Google Font';
					}
				}
			}
	}
	
	function videogo_verify_google_f($videogo_font_google){
		$videogo_font_array = videogo_get_font_array();
		$videogo_google_array_find = array_keys($videogo_font_array);
		if($videogo_font_google == 'Default'){return 'no_font';}else{
			if(in_array($videogo_font_google,$videogo_google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	
	function videogo_verify_google_para($videogo_font_heading){
		$videogo_font_array = videogo_get_font_array();
		$videogo_google_array_find = array_keys($videogo_font_array);
		if($videogo_font_heading == 'Default'){return 'no_font';}else{
			if(in_array($videogo_font_heading,$videogo_google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	function videogo_verify_google_menu($videogo_font_menu){
		$videogo_font_array = videogo_get_font_array();
		$videogo_google_array_find = array_keys($videogo_font_array);
		if($videogo_font_menu == 'Default'){return 'no_font';}else{
			if(in_array($videogo_font_menu,$videogo_google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	function find_xml_child_nodes($videogo_xml_data,$videogo_tag_name,$videogo_child_node){
		if(!empty($videogo_xml_data)){
			$videogo_slider = new DOMDocument ();
			$videogo_slider->loadXML ( $videogo_xml_data );
			$videogo_element_tag_name = $videogo_slider->getElementsByTagName($videogo_tag_name);
			foreach($videogo_element_tag_name as $videogo_element_tag){
				foreach($videogo_element_tag->childNodes as $i){
					if($i->tagName == $videogo_child_node){
							return $i->nodeValue;
					}
				}
			}
		}
		return '';
	}
	
	/* Array Values NodeValue */
	function videogo_return_xml_array($videogo_children_des){
		$videogo_array_data = array();
		$videogo_counter = 0;
		foreach($videogo_children_des as $values){
			$videogo_array_data[] = $values->nodeValue;
		}
		return $videogo_array_data;
	}
	
	
	
	/* return the title list of each post_type */
	function videogo_get_slug_id( $videogo_post_type ){
		
		$videogo_posts_title = array();
		$videogo_posts = get_posts(array('post_type' => $videogo_post_type, 'numberposts'=>100));
		
		foreach ($videogo_posts as $videogo_post) {
			$videogo_posts_title[] = $videogo_post->ID;
		}
		
		return $videogo_posts_title;
	
	}	
	
	/* Find the XML node from XML Object */
	function videogo_find_xml_node($videogo_xml, $videogo_node){
	
		if(!empty($videogo_xml)){
		
			foreach($videogo_xml->childNodes as $videogo_xmlChild){
			
				if($videogo_xmlChild->nodeName == $videogo_node){
				
					return $videogo_xmlChild;
					
				}
				
			}
			
		}
		
		return '';
		
	}
	
	/* Create tag string from nodename and value */
	function videogo_create_xml_tag($videogo_node, $videogo_value){
	
		return '<' . $videogo_node . '>' . $videogo_value . '</' . $videogo_node . '>';
		
	}
	
	/* Get array of sidebar name */
	function videogo_get_sidebar_name(){
	
		global $videogo_sidebar;
		$sidebar = array();
		
		if(!empty($videogo_sidebar)){
		
			$videogo_xml = new DOMDocument();
			$videogo_xml->loadXML($videogo_sidebar);
			
			foreach( $videogo_xml->documentElement->childNodes as $videogo_sidebar_name ){
			
				$sidebar[] = $videogo_sidebar_name->nodeValue;
				
			}
			
		}
		
		return $sidebar;
		
	}
	
	videogo_get_google_font(); 
	
	function videogo_get_google_font(){
	
		get_template_part( 'framework/extensions/google', 'font' );
	  
		global $all_font;
		$videogo_google_fonts = videogo_update_google_font_array();
		
		foreach($videogo_google_fonts as $videogo_google_font){
		
			$all_font[$videogo_google_font['family']] = array('subsets' => $videogo_google_font['subsets'],'type'=>'Google Font','variants' => $videogo_google_font['variants']);
		
		}
		
	}
	
	/* return a link to get the google font */
	function videogo_get_google_font_url( $videogo_font_family ){
		$videogo_google_font_list = videogo_get_font_array();
		if( !empty($videogo_font_family) && !empty($videogo_google_font_list[$videogo_font_family]) ){
			$videogo_google_font = $videogo_google_font_list[$videogo_font_family];
			$videogo_temp_font_name  = str_replace(' ', '+' , $videogo_font_family) . ':';
			$videogo_temp_font_name .= apply_filters('google_font_weight', implode(',', $videogo_google_font['variants'])) . '&subset='; 
			$videogo_temp_font_name .= apply_filters('google_font_subset', implode(',', $videogo_google_font['subsets'])); 
			
			return esc_attr(VIDEOGO_HTTP . 'fonts.googleapis.com/css?family=' . $videogo_temp_font_name);
		} 
		return '';
	}
	
	function videogo_get_font_array( $videogo_type = '' ){
		
		global $all_font;
	
		$videogo_typekit_settings = get_option('typokit_settings');
		if($videogo_typekit_settings <> ''){
			$videogo_typekit_xml = new DOMDocument();
			$videogo_typekit_xml->loadXML($videogo_typekit_settings);
			foreach( $videogo_typekit_xml->documentElement->childNodes as $videogo_typekit_font ){
					$all_font[$videogo_typekit_font->nodeValue] = array('status'=>'enabled','type'=>'Used font','is-used'=>false,);
			}
		}
		
		foreach($all_font as $font_name => $font_value){
		
			if(isset($font_value['type']) || $font_value['type'] == 'Google Font'){
				$videogo_fonts[$font_name] = $font_value; 
			}
			
		}
			
		return $videogo_fonts;
		
	}
	
	function videogo_get_font_type( $videogo_font_family='' ){
		
		global $fonts,$all_font;
		
		if($videogo_font_family == 'Default'){ 
			$videogo_font_found = '';
		}else{
			$videogo_font_found = 'Google_Font';
		}		
		
		return $videogo_font_found;	
		
	}
	
	/* get width and height from string WIDTHxHEIGHT */
	function videogo_get_width( $videogo_size ){
		$videogo_size_array = $videogo_size;
		return $videogo_size_array[0];
	}
	
	
	function videogo_get_height( $videogo_size ){
		$videogo_size_array = $videogo_size;
		return $videogo_size_array[1];
	}
	
	/* use ajax to print all of media image */
	add_action('wp_ajax_get_media_image','videogo_get_media_image');
	function videogo_get_media_image(){
	
		$videogo_image_width = 60;
		$videogo_image_height = 60;
		
		$videogo_paged = (isset($_POST['page']))? $_POST['page'] : 1; 	
		if($videogo_paged == ''){ $videogo_paged = 1; }
		
		$videogo_statement = array('post_type' => 'attachment',
			'post_mime_type' =>'image',
			'post_status' => 'inherit', 
			'posts_per_page' => 12,
			'paged' => $videogo_paged);
		$videogo_media_query = new WP_Query($videogo_statement);
	
		?>
		
		<div class="media-title">
			<label><?php esc_html_e('Insert Gallery Items','videogo'); ?></label>
		</div>
		
		<?php
		
		echo '<div class="media-gallery-nav" id="media-gallery-nav">';
		echo '<ul>';
		echo '<a><li class="nav-first" rel="1" ></li></a>';
		
		for( $i=1 ; $i<=$videogo_media_query->max_num_pages; $i++){
		
			if($i == $videogo_paged){
				echo '<li rel="' . $i . '">' . $i . '</li>';
			}else if( ($i <= $videogo_paged+2 && $i >= $videogo_paged-2) || $i%10 == 0){
				echo '<a><li rel="' . $i . '">' . $i . '</li></a>';		
			}
			
		}
		echo '<a><li class="nav-last" rel="' . esc_attr($videogo_media_query->max_num_pages) . '"></li></a>';
		echo '</ul>';
		echo '</div>';
	
		echo '<ul>';
		
		foreach( $videogo_media_query->posts as $videogo_image ){ 
		
			$videogo_thumb_src = wp_get_attachment_image_src( $videogo_image->ID, array(60,60));
			$videogo_thumb_src_preview = wp_get_attachment_image_src( $videogo_image->ID, array(60,60));
			echo '<li><img src="' . esc_url($videogo_thumb_src[0]) .'" title="' . esc_attr($videogo_image->post_title) . '" attid="' . esc_attr($videogo_image->ID) . '" rel="' . esc_url($videogo_thumb_src_preview[0]) . '"/></li>';
		
		}
		
		echo '</ul>';
		
		if(isset($_POST['page'])){ die(''); }
	}
	
	
	/* Adding Ajax Url for Dummy Data */
	add_action('wp_head','videogo_ajax_ajaxurl');
	function videogo_ajax_ajaxurl() {
		$videogo_data = "var ajaxurl = '".esc_url(admin_url('admin-ajax.php'))."';
		var directory_url = '".esc_url(get_template_directory_uri())."';";
		$videogo_handle = 'videogo_custom';
		wp_add_inline_script( $videogo_handle, $videogo_data, $videogo_position = 'after' ); 
	
	}
	
	/* return the array of category */
	function videogo_get_category_list_array( $videogo_category_name, $videogo_parent='' ){
		
		if( empty($videogo_parent) ){ 
			$videogo_category_list = array();
			$videogo_get_category = get_categories( array( 'taxonomy' => $videogo_category_name	));
			if($videogo_get_category <> ''){
				foreach( $videogo_get_category as $videogo_category ){
					$videogo_category_list[] = $videogo_category;
				}
			}
				
			return $videogo_category_list;
			
		}else{
			$videogo_parent_id = get_term_by('name', $videogo_parent, $videogo_category_name);
			$videogo_get_category = get_categories( array( 'taxonomy' => $videogo_category_name, 'child_of' => $videogo_parent_id->term_id	));
			$videogo_category_list = array( '0' => $videogo_parent );
			if($videogo_get_category <> ''){
				foreach( $videogo_get_category as $videogo_category ){
					$videogo_category_list[] = $videogo_category;
				}
			}
				
			return $videogo_category_list;		
		
		}
	}
	
	/* return the title list of each post_type */
	function videogo_get_title_list( $videogo_post_type ){
		
		$videogo_posts_title = array();
		$videogo_posts = get_posts(array('post_type' => $videogo_post_type, 'numberposts'=>100));
		
		foreach ($videogo_posts as $videogo_post) {
			$videogo_posts_title[] = $videogo_post->post_title;
		}
		
		return $videogo_posts_title;
	
	}
	
	/* return the title list of each post_type */
	function videogo_get_title_list_array( $videogo_post_type ){
		
		$videogo_posts_title = array();
		$videogo_posts = get_posts(array('post_type' => $videogo_post_type, 'numberposts'=>100));
		
		foreach ($videogo_posts as $videogo_post) {
			$videogo_posts_title[] = $videogo_post;
		}
		
		return $videogo_posts_title;
	
	}
	function hexDarker($videogo_hex,$videogo_factor = 30){
        
		$videogo_new_hex = '';
        
        $videogo_base['R'] = hexdec($videogo_hex{0}.$videogo_hex{1});
        $videogo_base['G'] = hexdec($videogo_hex{2}.$videogo_hex{3});
        $videogo_base['B'] = hexdec($videogo_hex{4}.$videogo_hex{5});
        
        foreach ($videogo_base as $k => $v)
		{
			$videogo_amount = $videogo_v / 100;
			$videogo_amount = round($videogo_amount * $videogo_factor);
			$videogo_new_decimal = $videogo_v - $videogo_amount;
	
			$videogo_new_hex_component = dechex($videogo_new_decimal);
			if(strlen($videogo_new_hex_component) < 2)
					{ $videogo_new_hex_component = "0".$videogo_new_hex_component; }
			$videogo_new_hex .= $videogo_new_hex_component;
		}
                
        return $videogo_new_hex;        
    }
	
	
	function videogo_show_sidebar($videogo_sidebar_name, $videogo_right_sidebar,$videogo_left_sidebar,$videogo_value_right,$videogo_value_left){?>
			
			<ul class="panel-body recipe_class row-fluid">
				<li class="panel-radioimage span12">
					<div class="panel-title ">
						<h3><?php esc_html_e('Select Sidebar', 'videogo'); ?></h3>
					</div>
					<div class="clear"></div>
					<?php 
						$videogo_options = array(
							'1'=>array('value'=>'right-sidebar','image'=>'/framework/images/right-sidebar.png'),
							'2'=>array('value'=>'left-sidebar','image'=>'/framework/images/left-sidebar.png'),
							'3'=>array('value'=>'both-sidebar','image'=>'/framework/images/both-sidebar.png','default'=>'selected'),
							'4'=>array('value'=>'both-sidebar-left','image'=>'/framework/images/both-sidebar-left.png'),
							'5'=>array('value'=>'both-sidebar-right','image'=>'/framework/images/both-sidebar-right.png'),
							'3'=>array('value'=>'no-sidebar','image'=>'/framework/images/no-sidebar.png')
						);
					foreach( $videogo_options as $videogo_option ){ ?>
						<div class='radio-image-wrapper'>
							<span class="head-sec-sidebar"><?php echo str_replace('-',' ',$videogo_option['value']); ?></span>
							<label for="<?php echo esc_attr($videogo_option['value']); ?>">
								<img src=<?php echo VIDEOGO_PATH_URL.$videogo_option['image']?> class="<?php echo esc_attr($videogo_sidebar_name);?>" alt="<?php echo esc_attr($videogo_sidebar_name);?>">
								<div id="check-list" <?php 
									if($videogo_sidebar_name == $videogo_option['value']){
										echo 'class="check-list"';
									}
								?>>
							</div>                                
							</label>
							<input type="radio" name="sidebars" value="<?php echo esc_attr($videogo_option['value']); ?>" <?php 
									if($videogo_sidebar_name == $videogo_option['value']){
										echo 'checked';
									}
							?> id="<?php echo esc_attr($videogo_option['value']); ?>" class="<?php echo esc_attr($videogo_sidebar_name);?>"
							>                            
						</div>
					<?php } ?>
				</li>
			</ul>
			<div class="row-fluid">
				<ul class="videogo_right_sidebar recipe_class span6">
					<li class="panel-input">	
						<div class="panel-title">
							<h3><?php esc_html_e('Right Sidebar', 'videogo'); ?></h3>
						</div>
						<div class="combobox">
							<select name="<?php echo esc_attr($videogo_right_sidebar);?>" id="videogo_sidebar_dropdown">								
								<?php
								$videogo_sidebar_settings = get_option('sidebar_settings');
								if($videogo_sidebar_settings <> ''){
									$videogo_sidebars_xml = new DOMDocument();
									$videogo_sidebars_xml->loadXML($videogo_sidebar_settings);
									foreach( $videogo_sidebars_xml->documentElement->childNodes as $videogo_sidebar_name ){?>
										<option <?php if($videogo_value_right == $videogo_sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo esc_attr($videogo_sidebar_name->nodeValue); ?>"><?php echo esc_attr($videogo_sidebar_name->nodeValue); ?></option>
								<?php }
								} ?>	
							</select>
						</div>
						<p><?php esc_html_e('Select Slide from dropdown to use in main slider.', 'videogo'); ?></p>
					</li>
				</ul>
				<ul class="videogo_left_sidebar recipe_class span6">
					<li class="panel-input">	
						<div class="panel-title">
							<h3><?php esc_html_e('Left Sidebar', 'videogo'); ?></h3>
						</div>
						<div class="combobox">
							<select name="<?php echo esc_attr($videogo_left_sidebar);?>" id="videogo_sidebar_dropdown_left">								
								<?php
								if($videogo_sidebar_settings <> ''){
									$videogo_sidebars_xml = new DOMDocument();
									$videogo_sidebars_xml->loadXML($videogo_sidebar_settings);
									foreach( $videogo_sidebars_xml->documentElement->childNodes as $videogo_sidebar_name ){?>
										<option <?php if($videogo_value_left == $videogo_sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo esc_attr($videogo_sidebar_name->nodeValue); ?>"><?php echo esc_attr($videogo_sidebar_name->nodeValue); ?></option>
								<?php }
								} ?>	
							</select>
						</div>
						<p><?php esc_html_e('Select Slide from dropdown to use in main slider.', 'videogo'); ?></p>
					</li>
				</ul>
			</div>
			<div class="clear"></div>
<?php } 
	
	/* Top Navigation Heading */
	function videogo_top_navigation_html_tooltip(){	?>
		<ul class="tooltip-right">
			<li class="small-icon-tab icon gen_set<?php if($_GET['page']=="videogo_theme_info"){echo " active";} ?>"><a href="?page=videogo_theme_info" data-toggle="tooltip" title="" data-original-title="Theme Info"> <i class="fa fa-info-circle"></i></a> </li>
			<li class="small-icon-tab icon gen_set<?php if($_GET['page']=="videogo_general_options"){echo " active";} ?>"><a href="?page=videogo_general_options" data-toggle="tooltip" title="" data-original-title="General Settings"> <i class="fa fa-home"></i></a> </li>
			<li class="small-icon-tab icon typo_set<?php if($_GET['page']=="videogo_typography_settings"){echo " active";} ?>"> <a href="?page=videogo_typography_settings" data-toggle="tooltip" title="" data-original-title="Typography" class=""><i class="fa fa-font"></i></a> </li>
			<li class="small-icon-tab icon slid_set<?php if($_GET['page']=="videogo_slider_settings"){echo " active";} ?>"> <a href="?page=videogo_slider_settings" class="" data-toggle="tooltip" title="" data-original-title="Slider"><i class="fa fa-picture-o"></i></a> </li>
			<li class="small-icon-tab icon side_set<?php if($_GET['page']=="videogo_sidebar_settings"){echo " active";} ?>"> <a href="?page=videogo_sidebar_settings" class="" data-toggle="tooltip" title="" data-original-title="Sidebar"><i class="fa fa-columns"></i></a> </li>
			<li class="small-icon-tab icon default_set<?php if($_GET['page']=="videogo_default_pages_settings"){echo " active";} ?>"> <a href="?page=videogo_default_pages_settings" class="" data-toggle="tooltip" title="" data-original-title="Default Pages"><i class="fa fa-file-text"></i></a> </li>
			<li class="small-icon-tab icon social_set<?php if($_GET['page']=="videogo_social_settings"){echo " active";} ?>"> <a href="?page=videogo_social_settings" class="" data-toggle="tooltip" title="" data-original-title="Social"><i class="fa fa-share"></i></a> </li>
			<li class="small-icon-tab icon news_set<?php if($_GET['page']=="videogo_newsletter_settings"){echo " active";} ?>"> <a href="?page=videogo_newsletter_settings" class="" data-toggle="tooltip" title="" data-original-title="Newsletter"><i class="fa fa-envelope"></i></a></li>
			<li class="small-icon-tab icon import_ex<?php if($_GET['page']=="videogo_dummydata_import"){echo " active";} ?>"> <a href="?page=videogo_dummydata_import" class="" data-toggle="tooltip" title="" data-original-title="Import Content"> <i class="fa fa-globe"></i></a></li>
			<?php $mystring = $_SERVER['REQUEST_URI'];
			$findme = 'seo_settings';
			$seo_settings = strpos($mystring, $findme);
			?>
			
		</ul>
	<?php
	}
	
	/* Slider Id for Page Options Array */
	function videogo_get_slider_id($videogo_slider_name){
		
		if(!empty($videogo_slider_name)){
		$videogo_layer_slider_id = get_post_meta( $videogo_slider_name, 'cp-slider-xml', true);
			if($videogo_layer_slider_id <> ''){
				$videogo_slider_xml_dom = new DOMDocument ();
				$videogo_slider_xml_dom->loadXML ( $videogo_layer_slider_id );
				return $videogo_slider_xml_dom->documentElement;
			}
		}
	}
	/* Page Slider */
	function videogo_page_slider(){
	
	global $post;
		
		$videogo_slider_off = '';
		$videogo_slider_type = '';
		$videogo_slider_slide = '';
		$videogo_slider_height = '';
		$videogo_slider_off = get_post_meta ( $post->ID, "page-option-top-slider-on", true );
		
		if($videogo_slider_off == 'Yes'){
			/* Get Page Main Slider Values */
			$videogo_slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$videogo_slider_layer_id = get_post_meta ( $post->ID, "page-option-top-slider-layer", true );
			$videogo_slider_shortcode = get_post_meta ( $post->ID, "page-option-top-slider-shortcode", true );
			
			if($videogo_slider_type != 'Owl-Slider' && $videogo_slider_type != 'Revolution-Slider'){
				$videogo_slider_slide = get_post_meta ( $post->ID, "page-option-top-slider-images", true );
				$videogo_slider_height = get_post_meta ( $post->ID, "page-option-top-slider-height", true );
				$videogo_size_new = '';
				
				if(!empty($videogo_slider_slide)){
					$videogo_slider_input_xml = get_post_meta( $videogo_slider_slide, 'cp-slider-xml', true);
					if($videogo_slider_input_xml <> ''){
					$videogo_slider_xml_dom = new DOMDocument ();
					$videogo_slider_xml_dom->loadXML ( $videogo_slider_input_xml );
						
						if($videogo_slider_type == 'Bx-Slider'){
								echo videogo_print_bx_slider($videogo_slider_xml_dom->documentElement,array(5000,1400),'abc123');
						}
					}
				}
			}
			
			/* Revolution SLider */
			if($videogo_slider_type == 'Revolution-Slider'){
				echo '<div class="tp-banner-container">';
				videogo_print_revolution_slider();
				echo '</div>';
			}elseif($videogo_slider_type == 'Owl-Slider'){
				echo videogo_inner_owl_slider();
			}
			
			/* Layer SLider */
			if($videogo_slider_type == 'Layer-Slider'){
				if(class_exists('LS_Sliders')){
					echo do_shortcode('[layerslider id="' . $videogo_slider_layer_id . '"]');
				}else{
					echo '<h2>'.esc_html_e('Please install the LayerSlider plugin.','videogo').'</h2>';
				}	
			}else if($videogo_slider_type == 'Add-Shortcode'){
				echo do_shortcode($videogo_slider_shortcode);
			}
		}
	}
	
	/* Sidebar function */
	function videogo_sidebar_func($videogo_sidebarr){
		if ($videogo_sidebarr == "left-sidebar" || $videogo_sidebarr == "right-sidebar") {
            $videogo_sidebar_class[] = 'col-md-3 content_sidebar sidebar';
			$videogo_sidebar_class[1] = 'col-md-9';
        }else if ($videogo_sidebarr == "both-sidebar") {
            $videogo_sidebar_class[] = "col-md-3 content_sidebar sidebar";
			$videogo_sidebar_class[1] = 'col-md-6';
        }else if($videogo_sidebarr == "both-sidebar-left") {
		    $videogo_sidebar_class[] = "col-md-3 content_sidebar sidebar";
			$videogo_sidebar_class[1] = 'col-md-6';
		}else if($videogo_sidebarr == "both-sidebar-right") {
		    $videogo_sidebar_class[] = "col-md-3 content_sidebar sidebar";
			$videogo_sidebar_class[1] = 'col-md-6';
		}else{
			$videogo_sidebar_class[1] = 'col-md-12';
		}
		return $videogo_sidebar_class;
	}
	
	
	
	
	$videogo_countries = array(
	  "GB" => "United Kingdom",
	  "US" => "United States",
	  "AF" => "Afghanistan",
	  "AL" => "Albania",
	  "DZ" => "Algeria",
	  "AS" => "American Samoa",
	  "AD" => "Andorra",
	  "AO" => "Angola",
	  "AI" => "Anguilla",
	  "AQ" => "Antarctica",
	  "AG" => "Antigua And Barbuda",
	  "AR" => "Argentina",
	  "AM" => "Armenia",
	  "AW" => "Aruba",
	  "AU" => "Australia",
	  "AT" => "Austria",
	  "AZ" => "Azerbaijan",
	  "BS" => "Bahamas",
	  "BH" => "Bahrain",
	  "BD" => "Bangladesh",
	  "BB" => "Barbados",
	  "BY" => "Belarus",
	  "BE" => "Belgium",
	  "BZ" => "Belize",
	  "BJ" => "Benin",
	  "BM" => "Bermuda",
	  "BT" => "Bhutan",
	  "BO" => "Bolivia",
	  "BA" => "Bosnia And Herzegowina",
	  "BW" => "Botswana",
	  "BV" => "Bouvet Island",
	  "BR" => "Brazil",
	  "IO" => "British Indian Ocean Territory",
	  "BN" => "Brunei Darussalam",
	  "BG" => "Bulgaria",
	  "BF" => "Burkina Faso",
	  "BI" => "Burundi",
	  "KH" => "Cambodia",
	  "CM" => "Cameroon",
	  "CA" => "Canada",
	  "CV" => "Cape Verde",
	  "KY" => "Cayman Islands",
	  "CF" => "Central African Republic",
	  "TD" => "Chad",
	  "CL" => "Chile",
	  "CN" => "China",
	  "CX" => "Christmas Island",
	  "CC" => "Cocos (Keeling) Islands",
	  "CO" => "Colombia",
	  "KM" => "Comoros",
	  "CG" => "Congo",
	  "CD" => "Congo, The Democratic Republic Of The",
	  "CK" => "Cook Islands",
	  "CR" => "Costa Rica",
	  "CI" => "Cote D'Ivoire",
	  "HR" => "Croatia (Local Name: Hrvatska)",
	  "CU" => "Cuba",
	  "CY" => "Cyprus",
	  "CZ" => "Czech Republic",
	  "DK" => "Denmark",
	  "DJ" => "Djibouti",
	  "DM" => "Dominica",
	  "DO" => "Dominican Republic",
	  "TP" => "East Timor",
	  "EC" => "Ecuador",
	  "EG" => "Egypt",
	  "SV" => "El Salvador",
	  "GQ" => "Equatorial Guinea",
	  "ER" => "Eritrea",
	  "EE" => "Estonia",
	  "ET" => "Ethiopia",
	  "FK" => "Falkland Islands (Malvinas)",
	  "FO" => "Faroe Islands",
	  "FJ" => "Fiji",
	  "FI" => "Finland",
	  "FR" => "France",
	  "FX" => "France, Metropolitan",
	  "GF" => "French Guiana",
	  "PF" => "French Polynesia",
	  "TF" => "French Southern Territories",
	  "GA" => "Gabon",
	  "GM" => "Gambia",
	  "GE" => "Georgia",
	  "DE" => "Germany",
	  "GH" => "Ghana",
	  "GI" => "Gibraltar",
	  "GR" => "Greece",
	  "GL" => "Greenland",
	  "GD" => "Grenada",
	  "GP" => "Guadeloupe",
	  "GU" => "Guam",
	  "GT" => "Guatemala",
	  "GN" => "Guinea",
	  "GW" => "Guinea-Bissau",
	  "GY" => "Guyana",
	  "HT" => "Haiti",
	  "HM" => "Heard And Mc Donald Islands",
	  "VA" => "Holy See (Vatican City State)",
	  "HN" => "Honduras",
	  "HK" => "Hong Kong",
	  "HU" => "Hungary",
	  "IS" => "Iceland",
	  "IN" => "India",
	  "ID" => "Indonesia",
	  "IR" => "Iran (Islamic Republic Of)",
	  "IQ" => "Iraq",
	  "IE" => "Ireland",
	  "IL" => "Israel",
	  "IT" => "Italy",
	  "JM" => "Jamaica",
	  "JP" => "Japan",
	  "JO" => "Jordan",
	  "KZ" => "Kazakhstan",
	  "KE" => "Kenya",
	  "KI" => "Kiribati",
	  "KP" => "Korea, Democratic People's Republic Of",
	  "KR" => "Korea, Republic Of",
	  "KW" => "Kuwait",
	  "KG" => "Kyrgyzstan",
	  "LA" => "Lao People's Democratic Republic",
	  "LV" => "Latvia",
	  "LB" => "Lebanon",
	  "LS" => "Lesotho",
	  "LR" => "Liberia",
	  "LY" => "Libyan Arab Jamahiriya",
	  "LI" => "Liechtenstein",
	  "LT" => "Lithuania",
	  "LU" => "Luxembourg",
	  "MO" => "Macau",
	  "MK" => "Macedonia, Former Yugoslav Republic Of",
	  "MG" => "Madagascar",
	  "MW" => "Malawi",
	  "MY" => "Malaysia",
	  "MV" => "Maldives",
	  "ML" => "Mali",
	  "MT" => "Malta",
	  "MH" => "Marshall Islands",
	  "MQ" => "Martinique",
	  "MR" => "Mauritania",
	  "MU" => "Mauritius",
	  "YT" => "Mayotte",
	  "MX" => "Mexico",
	  "FM" => "Micronesia, Federated States Of",
	  "MD" => "Moldova, Republic Of",
	  "MC" => "Monaco",
	  "MN" => "Mongolia",
	  "MS" => "Montserrat",
	  "MA" => "Morocco",
	  "MZ" => "Mozambique",
	  "MM" => "Myanmar",
	  "NA" => "Namibia",
	  "NR" => "Nauru",
	  "NP" => "Nepal",
	  "NL" => "Netherlands",
	  "AN" => "Netherlands Antilles",
	  "NC" => "New Caledonia",
	  "NZ" => "New Zealand",
	  "NI" => "Nicaragua",
	  "NE" => "Niger",
	  "NG" => "Nigeria",
	  "NU" => "Niue",
	  "NF" => "Norfolk Island",
	  "MP" => "Northern Mariana Islands",
	  "NO" => "Norway",
	  "OM" => "Oman",
	  "PK" => "Pakistan",
	  "PW" => "Palau",
	  "PA" => "Panama",
	  "PG" => "Papua New Guinea",
	  "PY" => "Paraguay",
	  "PE" => "Peru",
	  "PH" => "Philippines",
	  "PN" => "Pitcairn",
	  "PL" => "Poland",
	  "PT" => "Portugal",
	  "PR" => "Puerto Rico",
	  "QA" => "Qatar",
	  "RE" => "Reunion",
	  "RO" => "Romania",
	  "RU" => "Russian Federation",
	  "RW" => "Rwanda",
	  "KN" => "Saint Kitts And Nevis",
	  "LC" => "Saint Lucia",
	  "VC" => "Saint Vincent And The Grenadines",
	  "WS" => "Samoa",
	  "SM" => "San Marino",
	  "ST" => "Sao Tome And Principe",
	  "SA" => "Saudi Arabia",
	  "SN" => "Senegal",
	  "SC" => "Seychelles",
	  "SL" => "Sierra Leone",
	  "SG" => "Singapore",
	  "SK" => "Slovakia (Slovak Republic)",
	  "SI" => "Slovenia",
	  "SB" => "Solomon Islands",
	  "SO" => "Somalia",
	  "ZA" => "South Africa",
	  "GS" => "South Georgia, South Sandwich Islands",
	  "ES" => "Spain",
	  "LK" => "Sri Lanka",
	  "SH" => "St. Helena",
	  "PM" => "St. Pierre And Miquelon",
	  "SD" => "Sudan",
	  "SR" => "Suriname",
	  "SJ" => "Svalbard And Jan Mayen Islands",
	  "SZ" => "Swaziland",
	  "SE" => "Sweden",
	  "CH" => "Switzerland",
	  "SY" => "Syrian Arab Republic",
	  "TW" => "Taiwan",
	  "TJ" => "Tajikistan",
	  "TZ" => "Tanzania, United Republic Of",
	  "TH" => "Thailand",
	  "TG" => "Togo",
	  "TK" => "Tokelau",
	  "TO" => "Tonga",
	  "TT" => "Trinidad And Tobago",
	  "TN" => "Tunisia",
	  "TR" => "Turkey",
	  "TM" => "Turkmenistan",
	  "TC" => "Turks And Caicos Islands",
	  "TV" => "Tuvalu",
	  "UG" => "Uganda",
	  "UA" => "Ukraine",
	  "AE" => "United Arab Emirates",
	  "UM" => "United States Minor Outlying Islands",
	  "UY" => "Uruguay",
	  "UZ" => "Uzbekistan",
	  "VU" => "Vanuatu",
	  "VE" => "Venezuela",
	  "VN" => "Viet Nam",
	  "VG" => "Virgin Islands (British)",
	  "VI" => "Virgin Islands (U.S.)",
	  "WF" => "Wallis And Futuna Islands",
	  "EH" => "Western Sahara",
	  "YE" => "Yemen",
	  "YU" => "Yugoslavia",
	  "ZM" => "Zambia",
	  "ZW" => "Zimbabwe"
	);
	function videogo_booking_form_event_manager() {
		global $EM_Notices,$EM_Event;
		/* count tickets and available tickets */
		$videogo_tickets_count = count($EM_Event->get_bookings()->get_tickets()->tickets);
		$videogo_available_tickets_count = count($EM_Event->get_bookings()->get_available_tickets());
		/* decide whether user can book, event is open for bookings etc. */
		$videogo_can_book = is_user_logged_in() || (get_option('dbem_bookings_anonymous') && !is_user_logged_in());
		$videogo_is_open = $EM_Event->get_bookings()->is_open(); //whether there are any available tickets right now
		$videogo_show_tickets = true;
		/* if user is logged out, check for member tickets that might be available, since we should ask them to log in instead of saying 'bookings closed' */
		if( !$videogo_is_open && !is_user_logged_in() && $EM_Event->get_bookings()->is_open(true) ){
			$videogo_is_open = true;
			$videogo_can_book = false;
			$videogo_show_tickets = false;
		}
		?>
		<div id="em-booking" class="em-booking <?php if( get_option('dbem_css_rsvp') ) echo 'css-booking'; ?>">
			<?php 
				/* We are firstly checking if the user has already booked a ticket at this event, if so offer a link to view their bookings.*/
				$EM_Booking = $EM_Event->get_bookings()->has_booking();
			
			if(!empty($EM_Event->bookings)){
				if( is_object($EM_Booking) && !get_option('dbem_bookings_double') ): //Double bookings not allowed ?>
					<p>
						<?php echo get_option('dbem_bookings_form_msg_attending'); ?>
						<a href="<?php echo em_get_my_bookings_url(); ?>"><?php echo get_option('dbem_bookings_form_msg_bookings_link'); ?></a>
					</p>
				<?php elseif( !$EM_Event->event_rsvp ): /* bookings not enabled */?>
					<p><?php echo get_option('dbem_bookings_form_msg_disabled'); ?></p>
				<?php elseif( $EM_Event->get_bookings()->get_available_spaces() <= 0 ): ?>
					<p><?php echo get_option('dbem_bookings_form_msg_full'); ?></p>
				<?php elseif( !$videogo_is_open ): /* event has started */ ?>
					<p><?php echo get_option('dbem_bookings_form_msg_closed'); ?></p>
				<?php else: 
				
						echo esc_attr($EM_Notices);
					
						if( $videogo_tickets_count > 0) : /* Tickets exist, so we show a booking form. */ ?>
						<form class="em-booking-form" name='booking-form' method='post' action='<?php echo apply_filters('em_booking_form_action_url',''); ?>#em-booking'>
							<input type='hidden' name='action' value='booking_add'/>
							<input type='hidden' name='event_id' value='<?php echo esc_attr($EM_Event->event_id); ?>'/>
							<input type='hidden' name='_wpnonce' value='<?php echo wp_create_nonce('booking_add'); ?>'/>
							<?php 
								/* Tickets Form */
								if( $videogo_show_tickets && ($videogo_can_book || get_option('dbem_bookings_tickets_show_loggedout')) && ($videogo_tickets_count > 1 || get_option('dbem_bookings_tickets_single_form')) ){ /* show if more than 1 ticket, or if in forced ticket list view mode */
									do_action('em_booking_form_before_tickets', $EM_Event); //do not delete
									/* Show multiple tickets form to user, or single ticket list if settings enable this
									If logged out, can be allowed to see this in settings witout the register form  */
									em_locate_template('forms/bookingform/tickets-list.php',true, array('EM_Event'=>$EM_Event));
									do_action('em_booking_form_after_tickets', $EM_Event); /* do not delete */
									$videogo_show_tickets = false;
								}
							if( $videogo_can_book ): ?>
								<div class='em-booking-form-details'>
									<?php 
										if( $videogo_show_tickets && $videogo_available_tickets_count == 1 && !get_option('dbem_bookings_tickets_single_form') ){
											do_action('em_booking_form_before_tickets', $EM_Event); //do not delete
											//show single ticket form, only necessary to show to users able to book (or guests if enabled)
											$EM_Ticket = $EM_Event->get_bookings()->get_available_tickets()->get_first();
											em_locate_template('forms/bookingform/ticket-single.php',true, array('EM_Event'=>$EM_Event, 'EM_Ticket'=>$EM_Ticket));
											do_action('em_booking_form_after_tickets', $EM_Event); //do not delete
										} 
									
										do_action('em_booking_form_before_user_details', $EM_Event);
										
										if( has_action('em_booking_form_custom') ){ 
											/* Pro Custom Booking Form. You can create your own custom form by hooking into this action and setting the option above to true */
											do_action('em_booking_form_custom', $EM_Event); //do not delete
										}else{
											/* If you just want to modify booking form fields, you could do so here */
											em_locate_template('forms/bookingform/booking-fields.php',true, array('EM_Event'=>$EM_Event));
										}
										do_action('em_booking_form_after_user_details', $EM_Event);
									
										do_action('em_booking_form_footer', $EM_Event); /* do not delete */?>
										
										<div class="em-booking-buttons">
											<?php if( preg_match('/https?:\/\//',get_option('dbem_bookings_submit_button')) ): 
											/* Settings have an image url (we assume). Use it here as the button.*/ ?>
											<input type="image" src="<?php echo get_option('dbem_bookings_submit_button'); ?>" class="em-booking-submit" id="em-booking-submit" />
											<?php else: /* Display normal submit button */ ?>
											<input type="submit" class="em-booking-submit" id="em-booking-submit" value="<?php echo esc_attr(get_option('dbem_bookings_submit_button')); ?>" />
											<?php endif; ?>
										</div>
									
									<?php do_action('em_booking_form_footer_after_buttons', $EM_Event); ?>
								</div>
							<?php else: ?>
								<p class="em-booking-form-details"><?php echo get_option('dbem_booking_feedback_log_in'); ?></p>
							<?php endif; ?>
						</form>	
						<?php 
						if( !is_user_logged_in() && get_option('dbem_bookings_login_form') ){
							/* User is not logged in, show login form (enabled on settings page) */
							em_locate_template('forms/bookingform/login.php',true, array('EM_Event'=>$EM_Event));
						}
						?>
						<br class="clear" />  
					<?php endif; 
					
					endif;
			}
			?>
		</div>
	<?php }
	
	/* Maintenance Mode Function Start */
	function videogo_maintenance_mode_fun(){
		
		
		
		echo '<h1>'.esc_html('Theme has activated Maintenance mode.','videogo').'</h1>';
		
		
		}
	/* update the option if new value is exists and not equal to old one  */
	function videogo_save_option_widgets($videogo_name, $videogo_old_value, $videogo_new_value){
	
		if(empty($videogo_new_value) && !empty($videogo_old_value)){
		
			if(!delete_option($videogo_name)){
			
				return false;
				
			}
			
		}else if($videogo_old_value != $videogo_new_value){
		
			if(!update_option($videogo_name, $videogo_new_value)){
			
				return false;
				
			}
			
		}
		
		return true;
		
	}
