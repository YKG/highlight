<?php
	/*	
	*	Crunchpress Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file create and contains the portfolio post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	/* FRONT END RECIPE LAYOUT */
	$videogo_wooproduct_class = array("Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,350), "size2"=>array(614,614), "size3"=>array(350,350)));
	
	/* Print WooCommerce Item */
	function videogo_print_wooproduct_item($item_xml){
		/* Yet To Be Implement */
	}	
	/* Get Cart Content */
	function videogo_get_cart() {
		return array_filter( (array) $this->cart_contents );
	}