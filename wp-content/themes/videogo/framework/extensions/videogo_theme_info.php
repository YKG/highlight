<?php
	/*	
	*	CrunchPress Options Theme Info Ratification File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
add_action('wp_ajax_theme_info','videogo_theme_info');
function videogo_theme_info(){
	
	$videogo_info = wp_get_theme();
	$videogo_info_name = $videogo_info->get( 'Name' );
	$videogo_ratify_sent = '';
?>
<div class="cp-wrapper bootstrap_admin cp-margin-left">
  <div class="hbg top_navigation row-fluid">
    <div class="cp-logo span2"> <img src="<?php echo esc_url(VIDEOGO_PATH_URL.'/framework/images/logo.png');?>" class="logo" /> </div>
    <div class="sidebar span10"> <?php echo videogo_top_navigation_html_tooltip();?> </div>
  </div>
  <div class="content-area-main row-fluid">
    <div class="sidebar-wraper span2">
      <div class="sidebar-sublinks">
        <ul id="wp_t_o_right_menu">
          <li class="theme_info" id="active_tab">
            <?php esc_html_e('Theme Info','videogo'); ?>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-area span10">
      <div class="panel-elements" id="panel-elements">
        <div class="panel-element"></div>
        <ul class="typography_class">
          <li id="theme_validation" class="active_tab">
            <?php $fonts_array = videogo_get_font_array();?>
            <ul class="recipe_class row-fluid">
              <li class="panel-input span6"> <span class="panel-title">
                <h3 for="font_google">
                  <?php esc_html_e('License Validation','videogo'); ?>
                </h3>
                </span>
                <div id="validation-form">
                  <form method="post" action="">
                    <input type="text" name="purchasecode" id="purchasecode" placeholder="Input Code and Hit Enter" class="icf-control">
                    <input type="submit" class="validation-button" value="<?php echo esc_html_e('Submit','videogo') ?>">
                    <input type="hidden" name="validcheck" value="LX2hwcRo1lLTUZW1hwcmV">
                  </form>
                </div>
                <span id="validation-form-description">
					<?php esc_html_e('Your license of ','videogo'); echo esc_attr($videogo_info_name); esc_html_e(' is ','videogo'); ?>
                    <strong><?php esc_html_e(' not validated. ','videogo');?></strong>
                    <?php esc_html_e(' Place your Envato purchase code HERE.','videogo');?>
                </span>
                <?php 
$videogo_user_ratified = get_option( 'theme_validated_user' );
@$videogo_version = get_option( 'theme_version_number' );
if($videogo_user_ratified <> ''){ 
		
		$videogo_output = '';
		//add inline css does not work for admin panel
		$display_message = '<style>#validation-form{display:none}#validation-form-description{display:none}</style>';
		$videogo_output .= '<h1>'.esc_html('Welcome ','videogo').$videogo_user_ratified.'</h1>';
		$videogo_output .= '<h2>'.esc_html('Your license of ','videogo');
		$videogo_output .= '<strong>'.$videogo_info->get( 'Name' ).'</strong> verion '.$videogo_info->get( 'Version' );
		$videogo_output .= ' <span><em>'.esc_html(' Validated.','videogo').'</em></span></h2>';
		echo ($videogo_output.$display_message);
	
	}
if(@isset($_POST['validcheck'])){
	
	//add inline css does not work for admin panel
	$display_message = '<style>#validation-form{display:none}#validation-form-description{display:none}</style>';
	$purchase_code = $_POST['purchasecode'];
	$url = VIDEOGO_RATIFY_URL."?purchasecode=$purchase_code";
	$request = wp_remote_get( $url , array( 'timeout' => 55 ) ); 
	
    if ( is_wp_error( $request ) ) {
      echo 'There is error in connection, please try again';
    }
	
	$data = json_decode( wp_remote_retrieve_body( $request ), true ); 
	
	$response = $request['response'];
	
	$validation_result = $request['body'];
	$validated = $response['code'];
	
	$validation_result_exploded = explode(",", $validation_result);
	
	$theme_user = $validation_result_exploded[0];
	$theme_validated_until = $validation_result_exploded[1];
	$theme_validated_until_exploded = explode(" ", $theme_validated_until);
	$theme_validated_until_date = $theme_validated_until_exploded[0].' '.$theme_validated_until_exploded[1].' '.$theme_validated_until_exploded[2].' '.$theme_validated_until_exploded[5];
	
	echo ($display_message);
	
	$output = '';
	if($validated == '200'){
		$output .= '<h1>'.esc_html('Welcome ','videogo').$theme_user.'</h1>';
		$output .= '<h2>'.esc_html('Your license of ','videogo');
		$output .= '<strong>'.wp_get_theme().'</strong>';
		$output .= ' <span><em>'.esc_html(' Validated.','videogo').'</em></span></h2>';
		echo ($output);
		videogo_user($theme_user);
		}
	include_once(VIDEOGO_FW. '/extensions/plugins.php'); 
	
	}
?>
              </li>
              <li class="sample_text span6">
              <div class="theme_support">
                <h3 class="theme_support">
                  <?php esc_html_e('Theme Support','videogo'); ?>
                </h3>
                <?php
	$output3 = '';
	$videogo_valid_until = get_option( 'theme_valid_until' );
	if($videogo_valid_until <> ''){
		$output3 .= '<h2 class="theme_support_supported">'.esc_html('Your support is valid until ','videogo').$videogo_valid_until.'</h2>';
		echo ($output3);
		//add inline css does not work for admin panel
		echo '<style>.theme_support_not_supported{ display: none }</style>';
		}
	$output2 = ''; 
	if(@$validated == '200'){
		$output2 .= '<h2 class="theme_support_supported">'.esc_html('Your support is valid until ','videogo').$theme_validated_until_date.'</h2>';
		echo ($output2);
		
		update_option( 'theme_valid_until', $theme_validated_until_date );
		update_option( 'theme_version_number', $videogo_info->get( 'Version' ) ); 
		videogo_is_validated();
		$videogo_ratify_sent = 200;
		} else {
?>
                <h3 class="theme_support_not_supported">
                  <?php esc_html_e('No Support is available until theme is validated.','videogo'); ?>
                </h3>
                <?php  } ?>
                </div>
              </li>
            </ul>
            
          </li>
          <li id="theme_info" class="active_tab">
            <ul class="recipe_class row-fluid">
              <li class="panel-input span6"> <span class="panel-title">
                <h3 for="rss-feed">
                  <?php esc_html_e( 'Ratings Action', 'videogo' ); ?>
                </h3>
                </span>
                <div id="crunchpress-feed">
                  <p><?php esc_html_e( 'If you like Theme please leave us a five star rating. A huge thank you from CrunchPress in advance!', 'videogo' ); ?></p>
                </div>
              </li>
              <li class="sample_text span6">
              <div class="cool">
                <h3 for="font_google">
                  <?php esc_html_e('Somthing cool needed here','videogo'); ?>
                </h3>
                </div>
              </li>
            </ul>
          </li>
          <li id="rss-feed" class="active_tab">
            <ul class="recipe_class row-fluid">
              <li class="panel-input span6"> <span class="panel-title">
                <h3 for="rss-feed">
                  <?php esc_html_e( 'Our Newly Added Items', 'videogo' ); ?>
                </h3>
                </span>
                <div id="crunchpress-feed">
             <?php
			 	$request = wp_remote_get( 'http://crunchpress.com/portfolio/portfolio.txt' , array( 'timeout' => 15 ) ); 
	
				$data = json_decode( wp_remote_retrieve_body( $request ), true ); 
	
				$html = $request['body'];	 
			 	echo ($html); 
			 ?>
             </div>
              </li>
              <li class="sample_text span6">
              <div class="changelog">
                <h3 for="font_google">
                  <?php esc_html_e('Changelog','videogo'); ?>
                </h3>
                <?php
    
	$url = VIDEOGO_CHANGELOG_URL;
	$request = wp_remote_get( $url , array( 'timeout' => 55 ) ); 
	
    if ( is_wp_error( $request ) ) {
      esc_html_e( 'There is error in connection, please try again', 'videogo' ); 
    }
	
	$data = json_decode( wp_remote_retrieve_body( $request ), true ); 
	
	@$response = $request['response'];
	$validated = $response['code'];
	
	if($validated == '200'){
		$videogo_changelog =  $request['body'];
		
		echo ($videogo_changelog);
		
		if (strpos($videogo_changelog, 'Initial') != false) {
			
			
			} else { 
			
				add_option( 'videogo_dismiss_update_notice', true );
				add_action( 'admin_notices', 'videogo_update_notice' );
				videogo_update_notice(); 
			
			}
			
			if (preg_match_all('/\d+(\.\d+)+(\.\d+)?/', $videogo_changelog, $videogo_matches)) {
				$videogo_changelog_version_arr = $videogo_matches[0];
			}
			
			$videogo_changelog_version = @$videogo_changelog_version_arr[0];
		if(! videogo_is_validated()){ } else { 	
		if(@$videogo_version != $videogo_changelog_version){
			
				add_option( 'videogo_dismiss_update_notice', true );
				add_action( 'admin_notices', 'videogo_update_notice' );
				videogo_update_notice(); 
			
			}
		  }
		}
		
		if($videogo_ratify_sent == '200'){ 
function videogo_reload_inline_js(){
	echo "<script type='text/javascript'>\n";
	echo "reloadAfterThemeActivation();
			function reloadAfterThemeActivation() {
				location.reload();
			}";
	echo "\n</script>";
}
add_action( 'admin_print_scripts', 'videogo_reload_inline_js' );		
		 }	?>
        </div>
              </li>
            </ul>
          </li>
        </ul>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>
<?php }	?>