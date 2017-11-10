<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php esc_html(bloginfo( 'charset' )); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_html(bloginfo( 'pingback_url' )); ?>">
    <?php 
		wp_head();
	?>
</head>
<body <?php body_class();?>>
	<div id="wrapper">
		<?php 
			/* Calling Header Function From videogo_header.php */
			videogo_header_style_1();	
		?>	