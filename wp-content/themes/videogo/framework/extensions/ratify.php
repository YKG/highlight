<?php
function videogo_admin_notice( $videogo_msg = '', $videogo_args = array() ) {
      if ( is_array( $videogo_msg ) ) {
        $videogo_args = $videogo_msg;
      }
      $videogo_args = wp_parse_args( $videogo_args, array(
        'message'     => is_string( $videogo_msg ) ? $videogo_msg : '',
        'handle'      => false,
        'echo'        => true,
        'class'       => '',
        'dismissible'  => false,
        'ajax_dismiss' => false
      ) );
      extract( $videogo_args );
      $videogo_script = '';
      if ( is_string( $ajax_dismiss ) ) {
        if ( ! $handle ) {
          $handle = 'tco_' . uniqid();
        }
        ob_start(); 
function videogo_admin_inline_js(){
	echo "<script type='text/javascript'>\n";
	echo "jQuery( function( $ ) {
          $('[data-tco-notice=".$handle."]').on( 'click', '.notice-dismiss', function(){
            $.post('".admin_url('admin-ajax.php?action=' . esc_attr( $ajax_dismiss ) )."');
          });
        } );";
	echo "\n</script>";
}
add_action( 'admin_print_scripts', 'videogo_admin_inline_js' );		
		
        $videogo_script = ob_get_clean();
      }
      $class = ( $dismissible ) ? ' ' . $class . ' is-dismissible' : ' ' . $class;
      $videogo_logo_svg = '<img src="'.VIDEOGO_PATH_URL.'/images/cp_logo.jpg" alt="cp-logo" >';
      $videogo_logo = "<a class=\"tco-notice-logo\" href=\"http://crunchpress.com/\" target=\"_blank\">{$videogo_logo_svg}</a>";
      if ( $handle ) {
      $handle = "data-tco-notice=\"$handle\"";
      }
      $notice = "<div class=\"tco-notice notice {$class}\" {$handle}>{$videogo_logo}<p>{$message}</p></div>{$videogo_script}";
      if ( $echo ) {
        echo ($notice);
      }
      return $notice;
    }
function videogo_get_home_link() {
  return admin_url( 'themes.php?page=videogo_theme_info' );
}
function videogo_user($videogo_user) {
  update_option( 'theme_validated_user', $videogo_user );
  return true;
}
function videogo_is_validated(){
	
	$videogo_is_user_ratified = get_option( 'theme_validated_user' );
	
	if($videogo_is_user_ratified <> ''){
		
		return true;
		
		} else {
			return false;
			}
	}
function videogo_ratification(){
	$is_valid = videogo_is_validated();
	
	if($is_valid){ 
		include_once(VIDEOGO_FW. '/extensions/plugins.php'); 
	} else { 
		include_once(VIDEOGO_FW. '/extensions/plugins.php'); 
	}
}
add_action('wp_ajax_videogo_dismiss_validation_notice','videogo_dismiss_validation');
function videogo_dismiss_validation() { 
    update_option( 'videogo_dismiss_validation_notice', false );
    wp_send_json_success(); 
  }