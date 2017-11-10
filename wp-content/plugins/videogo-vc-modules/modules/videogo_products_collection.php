<?php
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.crunchpress.com
*/
if(!class_exists("videogo_products_collection")){
	class videogo_products_collection{
		static $add_plugin_script;
		function __construct(){
			add_action("init",array($this,"videogo_products_collection_init"));
			add_shortcode('videogo_products_collection',array($this,'videogo_products_collection_shortcode'));
		}
		function videogo_products_collection_init(){

			if(function_exists("vc_map")){
				
				vc_map( array(
					"base" => "videogo_products_collection",
					"name" => __( "Products Collection", "js_composer" ),
					"class" => "",
					"icon" => "icon-heart",
					"category" => __( 'CrunchPress', 'js_composer' ),
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Category Id", "js_composer" ),
							"param_name" => "category_idz",
							"description" => __( "Enter IDs of categories seperated by coma('). For single category just enter id.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"holder" => "h3",
							"class" => "",
							"heading" => __( "Product Count", "js_composer" ),
							"param_name" => "product_count",
							"description" => __( "Enter the count of products for the category to show.", "js_composer" )
						),
						array(
							"type" => "textfield",
							"heading" => __( "Extra class name", "js_composer" ),
							"param_name" => "el_class",
							"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" ))
						
					)
				) );
			}
		}
		
		function videogo_products_collection_shortcode( $atts, $content = null ) {

		$result = shortcode_atts( array(
			'category_idz' => '',
			'product_count' => '',
 			'el_class' => ''
		), $atts );
		
		extract( $result ); 
			
			$output = '';
			if(($product_count == '')||($product_count == ' ')){ $product_count = 8; }
          

			if($category_idz <> ''){ $product_category_ids = explode(",", $category_idz); }
			
			
				$output .= '<section class="cp-product-section pd-t60"><div class=""><ul class="row">';
				$categories_names = array();
				
			foreach ( $product_category_ids as $p_cat_id ) { 
			
					$term = get_term_by( 'id', $p_cat_id, 'product_cat' );
					$categories_names[$p_cat_id] = $term->name;
				
			}
			

		foreach ( $categories_names as $current_category ) {
		$term = get_term_by( 'name', $current_category, 'product_cat' ); 
		$termid = $term->term_id;
		$while_counter = 1;
		$args = array( 'post_type' => 'product', 'posts_per_page' => $product_count, 'product_cat' => $current_category, 'orderby' => 'rand' );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product, $post; 
        
        $product_short_desc = $loop->post->post_excerpt;
		$productshort_desc = substr($product_short_desc, 0, 60);
		$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), "size" );
		$image_url = $image_full[0];
		$bigstore_image_thumb = aq_resize( $image_url, 263, 500, true ); 
		
		
		
		
				$output .= '<li class="col-md-3 col-sm-6 col-xs-12">';
				$output .= '<div class="cp-product-item">';
				$output .= '<figure class="cp-thumb">';
				$output .= '<img src="'.$bigstore_image_thumb.'" alt="product image '.$termid.'">';
				$output .= '<figcaption class="cp-caption">';
			if ( $product->is_on_sale() ) {
				$output .= '<span class="sale-item">Sale</span>';
			}				
				$output .= '<a href="'.get_permalink( $loop->post->ID ).'" class="cart-btn">Detail page</a>';
				$output .= '</figcaption>';
				$output .= '</figure>';
				$output .= '<div class="cp-text">';
				$output .= '<h4><a href="'.get_permalink( $loop->post->ID ).'">'.esc_attr($loop->post->post_title).'</a></h4>';
				$output .= '<span class="cp-pro-price"></span>'.$product->get_price_html();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</li>';
		
		
			$while_counter++;	  
			endwhile;
		}

				$output .= '</ul></div></section>';
			
			wp_reset_query();	
		
		return $output;
	}
		
	}
	new videogo_products_collection;
	if(class_exists('WPBakeryShortCode'))
	{
		class WPBakeryShortCode_videogo_products_collection extends WPBakeryShortCode {
		}
	}
}