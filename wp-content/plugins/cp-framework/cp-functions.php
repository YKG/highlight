<?php
/*
Plugin Name: Video Go Theme Framework
Plugin URL: http://crunchpress.com/
Description: Base File for Custom Post type and for CrunchPress Page Builder.
Version: 1.0
Author: CrunchPress
Author URI: http://www.crunchpress.com/
*/

    
	/* logical location for CP framework */
	if(!defined( 'videogo_PATH_URL' )){ define('videogo_PATH_URL', get_template_directory_uri());}
	/* Physical location for CP framework */
	if(!defined( 'videogo_PATH_SER' )){define('videogo_PATH_SER', get_template_directory() );}            
	/* Define URL path of framework directory */
	if(!defined( 'videogo_FW_URL' )){define( 'videogo_FW_URL', videogo_PATH_URL . '/framework' );}
	/* Define server path of framework directory */
	if(!defined( 'videogo_FW' )){define( 'videogo_FW', videogo_PATH_SER . '/framework' );}
	/* Define admin url */
	if(!defined( 'AJAX_URL' )){define('AJAX_URL', admin_url( 'admin-ajax.php' ));}

	/*Remove LayerSlider Scripts */
	if(class_exists('LS_Sliders')){
		remove_action('wp_enqueue_scripts', 'layerslider_enqueue_content_res');
	}
	
	
	class videogo_function_library{
		public function create_variable($name, $value) {
		 /* Dynamically create the variable. */
		  return $this->{$name} = new $value;
		}
	

	
		/* function that save the meta to database if new data exists and is not equals to old one */
		public function videogo_save_meta_data($post_id, $new_data, $old_data, $name){
			
			if($new_data == $old_data){
				add_post_meta($post_id, $name, $new_data, true);
			}else if(!$new_data){
				delete_post_meta($post_id, $name, $old_data);
			}else if($new_data != $old_data){
				update_post_meta($post_id, $name, $new_data, $old_data);
			}
		}
		
		/* Add Action and Remove action */
		public function __construct()
		{
			add_action( 'wp_head', array( $this, 'videogo_ajax_ajaxurl' ) );
			remove_action( 'wp_head', array( $this, 'adjacent_posts_rel_link_wp_head' ) );
			$this->videogo_get_google_font();
		}

		/* Get Exact Thumb size  */
		public function videogo_thumb_size($post_id,$size){
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $size );	
			if($thumbnail[1].'x'.$thumbnail[2] == $size[0].'x'.$size[1]){
				return get_the_post_thumbnail($post_id, $size);
			}else{
				return 'No Image Found of Given Size! Please Read Image Upload Instruction in Documentation.';
			}
		}
	
		/* Find the XML value from XML Object*/
		public function videogo_find_xml_value($xml, $field){
		
			if(!empty($xml)){
			
				foreach($xml->childNodes as $xmlChild){
				
					if($xmlChild->nodeName == $field){
						if( is_admin() ){
							return $xmlChild->nodeValue;
						}else{
							return $xmlChild->nodeValue;
						}
					}
					
				}
				
			}
			
			return '';
			
		}
	
		/* Checking Google Font	 */
		public function videogo_verify_font($videogo_font_google){
		$videogo_fonts_array = videogo_get_font_array();
			foreach($videogo_fonts_array as $keys=>$values){
				if($values == 'Google Font'){
					if($keys == $videogo_font_google){
						return 'Google Font';
					}
				}
			}
		}
	
		public function verify_google_f($videogo_font_google){
			$font_array = videogo_get_font_array();
			$google_array_find = array_keys($font_array);
			if($videogo_font_google == 'Default'){return 'no_font';}else{
				if(in_array($videogo_font_google,$google_array_find)){
					return 'google_font';
				}else{
					return 'type_kit';
				}
			}
		}
	
	
		public function videogo_verify_google_para($font_heading){
			$font_array = videogo_get_font_array();
			$google_array_find = array_keys($font_array);
			if($font_heading == 'Default'){return 'no_font';}else{
				if(in_array($font_heading,$google_array_find)){
					return 'google_font';
				}else{
					return 'type_kit';
				}
			}
		}
	
		public function videogo_verify_google_menu($font_menu){
			$font_array = videogo_get_font_array();
			$google_array_find = array_keys($font_array);
			if($font_menu == 'Default'){return 'no_font';}else{
				if(in_array($font_menu,$google_array_find)){
					return 'google_font';
				}else{
					return 'type_kit';
				}
			}
		}
	
		public function find_xml_child_nodes($xml_data,$tag_name,$child_node){
			if(!empty($xml_data)){
				$videogo_slider = new DOMDocument ();
				$videogo_slider->loadXML ( $xml_data );
				$element_tag_name = $videogo_slider->getElementsByTagName($tag_name);
				foreach($element_tag_name as $element_tag){
					foreach($element_tag->childNodes as $i){
						if($i->tagName == $child_node){
								return $i->nodeValue;
						}
					}
				}
			}
			return '';
		}
	
		/* Array Values NodeValue */
		public function return_xml_array($children_des){
			$array_data = array();
			$counter = 0;
			foreach($children_des as $values){
				$array_data[] = $values->nodeValue;
			}
			return $array_data;
		}
		
	
	
		/* return the title list of each post_type */
		public function videogo_get_slug_id( $post_type ){
			
			$posts_title = array();
			$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
			
			foreach ($posts as $post) {
				$posts_title[] = $post->ID;
			}
			
			return $posts_title;
		
		}	
	
		/* Find the XML node from XML Object */
		public function videogo_find_xml_node($xml, $node){
		
			if(!empty($xml)){
			
				foreach($xml->childNodes as $xmlChild){
				
					if($xmlChild->nodeName == $node){
					
						return $xmlChild;
						
					}
					
				}
				
			}
			
			return '';
			
		}
	
		/* Create tag string from nodename and value */
		public function videogo_create_xml_tag($node, $value){
		
			return '<' . $node . '>' . $value . '</' . $node . '>';
			
		}
	
		/* Get array of sidebar name */
		public function videogo_get_sidebar_name(){
		
			global $videogo_sidebar;
			$sidebar = array();
			
			if(!empty($videogo_sidebar)){
			
				$xml = new DOMDocument();
				$xml->loadXML($videogo_sidebar);
				
				foreach( $xml->documentElement->childNodes as $sidebar_name ){
				
					$sidebar[] = $sidebar_name->nodeValue;
					
				}
				
			}
			
			return $sidebar;
			
		}
	
		public function videogo_get_google_font(){
	
			require_once dirname( __FILE__ ) .'/google-font.php';
	
			global $all_font;
		
			$google_fonts = update_google_font_array_plugin();
		
			foreach($google_fonts as $google_font){
			
				$all_font[$google_font['family']] = array('status'=>'enabled','type'=>'Google Font','is-used'=>false);
			
			}
		
		}
	
		public function videogo_get_font_array( $type = '' ){
			global $all_font;
			
			$videogo_typekit_settings = get_option('typokit_settings');
			if($videogo_typekit_settings <> ''){
				$typekit_xml = new DOMDocument();
				$typekit_xml->loadXML($videogo_typekit_settings);
				foreach( $typekit_xml->documentElement->childNodes as $typekit_font ){
						$all_font[$typekit_font->nodeValue] = array('status'=>'enabled','type'=>'Used font','is-used'=>false,);
				}
			}
			foreach($all_font as $font_name => $font_value){
			
				if( empty($type) || $type == $font_value['type'] ){
					$fonts[$font_name] = $font_value['type'];
				}
				
			}
				
		return $fonts;
		
		}
	
		/* get width and height from string WIDTHxHEIGHT */
		public function videogo_get_width( $size ){
			$size_array = $size;
			return $size_array[0];
		}
		public function videogo_get_height( $size ){
			$size_array = $size;
			return $size_array[1];
		}
	
	

		/* use ajax to print all of media image */
		public function videogo_get_media_image(){
		
			$image_width = 150;
			$image_height = 150;
			
			$paged = (isset($_POST['page']))? $_POST['page'] : 1; 	
			if($paged == ''){ $paged = 1; }
			
			$statement = array('post_type' => 'attachment',
				'post_mime_type' =>'image',
				'post_status' => 'inherit', 
				'posts_per_page' => 12,
				'paged' => $paged);
			$media_query = new WP_Query($statement);
		
			?>
			
			<div class="media-title">
				<label><?php esc_html_e('Insert Gallery Items','videogo'); ?></label>
			</div>
		
			<?php
			
			echo '<div class="media-gallery-nav" id="media-gallery-nav">';
			echo '<ul>';
			echo '<a><li class="nav-first" rel="1" ></li></a>';
			
			for( $i=1 ; $i<=$media_query->max_num_pages; $i++){
			
				if($i == $paged){
					echo '<li rel="' . $i . '">' . $i . '</li>';
				}else if( ($i <= $paged+2 && $i >= $paged-2) || $i%10 == 0){
					echo '<a><li rel="' . $i . '">' . $i . '</li></a>';		
				}
				
			}
			echo '<a><li class="nav-last" rel="' . $media_query->max_num_pages . '"></li></a>';
			echo '</ul>';
			echo '</div><br class=clear>';
		
			echo '<ul>';
			
			foreach( $media_query->posts as $image ){ 
			
				$thumb_src = wp_get_attachment_image_src( $image->ID, array(150,150));
				$videogo_thumb_src_preview = wp_get_attachment_image_src( $image->ID, array(150,150));
				echo '<li><img src="' . $thumb_src[0] .'" title="' . $image->post_title . '" attid="' . $image->ID . '" rel="' . $videogo_thumb_src_preview[0] . '"/></li>';
			
			}
			
			echo '</ul><br class=clear>';
			
			if(isset($_POST['page'])){ die(''); }
		}
	
	
		/* Adding Ajax Url for Dummy Data*/	
	
		public function videogo_ajax_ajaxurl() {?>
			<script type="text/javascript">
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			</script>
		<?php
		}

		/* return the slider option array to use with javascript file */
		public function get_videogo_slider_option_array($slider_option){
		
			$slider_setting = array();
		
			foreach($slider_option as $value){
				
				$set_value = get_option($value['name']);
				
				if(isset($value['oldname']) && $set_value){
				
					$slider_setting[$value['oldname']] = $set_value;
				
				}
			}
			
			return $slider_setting;
		}

		/* return the array of category */
		public function videogo_get_category_list( $category_name, $parent='' ){
		
			if( empty($parent) ){ 
			
				$get_category = get_categories( array( 'taxonomy' => $category_name	));
				$category_list = array( '0' =>'All');
				
				foreach( $get_category as $category ){
					$category_list[] = $category->cat_name;
				}
					
				return $category_list;
				
			}else{
			
				$parent_id = get_term_by('name', $parent, $category_name);
				$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
				$category_list = array( '0' => $parent );
				
				foreach( $get_category as $category ){
					$category_list[] = $category->cat_name;
				}
					
				return $category_list;		
		
			}
		}
	
		/* return the array of category */
		public function videogo_get_category_list_array( $category_name, $parent='' ){
		
			if( empty($parent) ){ 
				$category_list = array();
				$get_category = get_categories( array( 'taxonomy' => $category_name	));
				foreach( $get_category as $category ){
					$category_list[] = $category;
				}
					
				return $category_list;
			
			}else{
				//$category_list = array( '0' =>'All');
				$parent_id = get_term_by('name', $parent, $category_name);
				$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
				$category_list = array( '0' => $parent );
				
				foreach( $get_category as $category ){
					$category_list[] = $category;
				}
					
				return $category_list;		
			
			}
		}
	
		/* return the title list of each post_type */
		public function videogo_get_title_list( $post_type ){
			
			$posts_title = array();
			$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
			
			foreach ($posts as $post) {
				$posts_title[] = $post->post_title;
			}
			
			return $posts_title;
		
		}
	
		public function videogo_get_title_list_slug( $post_type ){
			
			$posts_title = array();
			$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
			
			foreach ($posts as $post) {
				$posts_title[] = $post->post_name;
			}
			
			return $posts_title;
		
		}
	
		/* return the title list of each post_type */
		public function videogo_get_title_list_array( $post_type ){
			
			$posts_title = array();
			$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
			
			foreach ($posts as $post) {
				$posts_title[] = $post;
			}
			
			return $posts_title;
		
		}

	
		/* return the title list of each post_type */
		public function videogo_get_slug_list( $post_type ){
			
			$posts_title = array();
			$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
			
			foreach ($posts as $post) {
				$posts_title[] = $post->post_name;
			}
			
			return $posts_title;
		
		}		

		/* return the title list of each post_type */
		public function videogo_layer_slider_title(){
			if(function_exists('layerslider_activation_scripts')){
				global $wpdb;
				$table_name = $wpdb->prefix . "layerslider";
					$sliders = $wpdb->get_results( "SELECT * FROM $table_name
						WHERE flag_hidden = '0' AND flag_deleted = '0'
						ORDER BY date_c ASC LIMIT 100" );
				if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table_name."'"))==1) {
					foreach($sliders as $keys=>$values){
						$post_title[] = $values->name;
										
					}
					return $post_title;
				}
			}
		}
	
		/* return the title list of each post_type */
		public function videogo_layer_slider_id(){
			
			global $wpdb,$post_id_slider;
			$post_id_slider = '';
			$table_name = $wpdb->prefix . "layerslider";
				$sliders = $wpdb->get_results( "SELECT * FROM $table_name
					WHERE flag_hidden = '0' AND flag_deleted = '0'
					ORDER BY date_c ASC LIMIT 100" );
			
				foreach($sliders as $keys=>$values){
					$post_id_slider[] = $values->id;
									
				}
				return $post_id_slider;
			
		
		}
	
	

		public function owl_slider(){
			$post_owl_slider = array('Post Slider'=>'300');
			return $post_owl_slider;	
		}

		public function latest_post(){
			$latest_post_slider = array('Yes','No');
			return $latest_post_slider;	
		}

		public function latest_post_filter(){
			$latest_post_slider_filter = array('Category','Featured','Latest');
			return $latest_post_slider_filter;	
		}
	
		public function latest_post_filter_category(){
		
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false 
			);
		
			$categories = get_categories( $args ); 
			
			foreach($categories as $category_list){
				$categoryArray[] = $category_list;
			}
		
			return $categoryArray;	
		}
	
		public function hexLighter($hex,$factor = 80) { 
			$new_hex = ''; 
			 
			$base['R'] = hexdec($hex{0}.$hex{1}); 
			$base['G'] = hexdec($hex{2}.$hex{3}); 
			$base['B'] = hexdec($hex{4}.$hex{5}); 
			 
			foreach ($base as $k => $v) 
				{ 
				$amount = 255 - $v; 
				$amount = $amount / 100; 
				$amount = round($amount * $factor); 
				$new_decimal = $v + $amount; 
			 
				$new_hex_component = dechex($new_decimal); 
				if(strlen($new_hex_component) < 2) 
					{ $new_hex_component = "0".$new_hex_component; } 
				$new_hex .= $new_hex_component; 
				} 
				 
			return $new_hex;     
		} 
	
		public function hexDarker($hex,$factor = 30){
			$new_hex = '';
			
			$base['R'] = hexdec($hex{0}.$hex{1});
			$base['G'] = hexdec($hex{2}.$hex{3});
			$base['B'] = hexdec($hex{4}.$hex{5});
			
			foreach ($base as $k => $v)
					{
					$amount = $v / 100;
					$amount = round($amount * $factor);
					$new_decimal = $v - $amount;
			
					$new_hex_component = dechex($new_decimal);
					if(strlen($new_hex_component) < 2)
							{ $new_hex_component = "0".$new_hex_component; }
					$new_hex .= $new_hex_component;
					}
					
			return $new_hex;        
		}
		
		public function videogo_show_sidebar($sidebar_name, $right_sidebar,$left_sidebar,$value_right,$value_left){ ?>
				<ul class="panel-body recipe_class row-fluid">
					
					<li class="panel-radioimage span12">
						<div class="panel-title ">
							<h3><?php _e('Select Sidebar', 'videogo'); ?></h3>
						</div>
						<div class="clear"></div>
						<?php 
							$options = array(
								'1'=>array('value'=>'right-sidebar','image'=>'/framework/images/right-sidebar.png'),
								'2'=>array('value'=>'left-sidebar','image'=>'/framework/images/left-sidebar.png'),
								'3'=>array('value'=>'both-sidebar','image'=>'/framework/images/both-sidebar.png','default'=>'selected'),
								'4'=>array('value'=>'both-sidebar-left','image'=>'/framework/images/both-sidebar-left.png'),
								'5'=>array('value'=>'both-sidebar-right','image'=>'/framework/images/both-sidebar-right.png'),
								'6'=>array('value'=>'no-sidebar','image'=>'/framework/images/no-sidebar.png')
							);
						foreach( $options as $option ){ ?>
							<div class='radio-image-wrapper'>
								<span class="head-sec-sidebar"><?php echo str_replace('-',' ',$option['value']); ?></span>
								<label for="<?php echo $option['value']; ?>">
									<img src=<?php echo videogo_PATH_URL.$option['image']?> class="<?php echo $sidebar_name;?>" alt="<?php echo $sidebar_name;?>">
									<div id="check-list" <?php 
										if($sidebar_name == $option['value']){
											echo 'class="check-list"';
										}
									?>>
								</div>                                
								</label>
								<input type="radio" name="sidebars" value="<?php echo $option['value']; ?>" <?php 
										if($sidebar_name == $option['value']){
											echo 'checked';
										}
								?> id="<?php echo $option['value']; ?>" class="<?php echo $sidebar_name;?>"
								>                            
							</div>
						<?php } ?>
					</li>
				</ul>
				<div class="row-fluid">
					<ul class="videogo_right_sidebar recipe_class span6">
						
						<li class="panel-input">	
							<div class="panel-title">
								<h3><?php _e('Right Sidebar', 'videogo'); ?></h3>
							</div>
							<div class="combobox">
								<select name="<?php echo $right_sidebar?>" id="videogo_sidebar_dropdown">								
									<?php
									$videogo_sidebar_settings = get_option('sidebar_settings');
									if($videogo_sidebar_settings <> ''){
										$sidebars_xml = new DOMDocument();
										$sidebars_xml->loadXML($videogo_sidebar_settings);
										foreach( $sidebars_xml->documentElement->childNodes as $sidebar_name ){?>
											<option <?php if($value_right == $sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo $sidebar_name->nodeValue; ?>"><?php echo $sidebar_name->nodeValue; ?></option>
									<?php }
									} ?>	
								</select>
							</div>
							<p><?php _e('Select Slide from dropdown to use in main slider.', 'videogo'); ?></p>
						</li>
						
					</ul>
					<ul class="videogo_left_sidebar recipe_class span6">
						
						<li class="panel-input">	
							<div class="panel-title">
								<h3><?php _e('Left Sidebar', 'videogo'); ?></h3>
							</div>
							<div class="combobox">
								<select name="<?php echo $left_sidebar?>" id="videogo_sidebar_dropdown_left">								
									<?php
									if($videogo_sidebar_settings <> ''){
										$sidebars_xml = new DOMDocument();
										$sidebars_xml->loadXML($videogo_sidebar_settings);
										foreach( $sidebars_xml->documentElement->childNodes as $sidebar_name ){?>
											<option <?php if($value_left == $sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo $sidebar_name->nodeValue; ?>"><?php echo $sidebar_name->nodeValue; ?></option>
									<?php }
									} ?>	
								</select>
							</div>
							<p><?php _e('Select Slide from dropdown to use in main slider.', 'videogo'); ?></p>
						</li>
						
					</ul>
				</div>
				<div class="clear"></div>
	<?php } 
	
		public function videogo_get_slider_id($slider_name){
			
			if(!empty($slider_name)){
			$layer_slider_id = get_post_meta( $slider_name, 'cp-slider-xml', true);
				if($layer_slider_id <> ''){
					$slider_xml_dom = new DOMDocument ();
					$slider_xml_dom->loadXML ( $layer_slider_id );
					return $slider_xml_dom->documentElement;
				}
			}
		}
	
		public static $countries = array(
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
	}

	/************ Declaration Of Custom Post-Types Files *************/

	include_once('post-type-options/events/videogo_events.php'); /* Manage Events */
	include_once('post-type-options/gallery/videogo_gallery.php'); /* Manage Gallery */
	include_once('post-type-options/sliders/videogo_slider.php'); /* Manage Slider */
	include_once('widgets/twitter_widget.php');  /* Manage Twitter */  
	include_once('widgets/videogo_instagram_widget.php');  /* Custom Instagram Widget */  


	add_action( 'muplugins_loaded', 'base_fun_override' );

	function base_fun_override() {

		$videogo_function_library = new videogo_function_library;
	}
?>