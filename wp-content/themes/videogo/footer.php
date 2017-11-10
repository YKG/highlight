<?php
/** 
* The template for displaying the footer 
* Contains footer content and the closing of the #main and #page div elements. 
* @package CrunchPress 
* @subpackage Video Go
*/
	
	if (isset($post)) {
		
		$videogo_footer_style = get_post_meta($post->ID, "page-option-bottom-footer-style", true);
	
	} else {
		$videogo_footer_style = '';
	}
	
	videogo_footer_html($videogo_footer_style);
?>    
</div> <!-- wrapper closing -->
<?php wp_footer(); ?>
</body>
</html>