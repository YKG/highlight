<?php 
/*	
*	CrunchPress Pagination File
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file return the videogo_breadcrumbs to the selected post_type
*	---------------------------------------------------------------------
*/
function videogo_breadcrumbs() {	
 
  $videogo_showOnHome = 1; 
  $videogo_delimiter = '';
  $videogo_home = esc_html__('Home','videogo'); 
  $videogo_showCurrent = 1; 
  $videogo_before = '<li class="current">'; 
  $videogo_after = '</li>';
 
	
  global $post;
  
  $videogo_homeLink = home_url('/');
 
  if (is_home() || is_front_page()) {	  
    if ($videogo_showOnHome == 1) echo '<ul class="breadcrumb"><li class=""><a href="' . esc_url($videogo_homeLink) . '">'.esc_attr($videogo_home).'</a></li></ul>';
 
  } else {
	
    echo '<ul class="breadcrumb"><li class=""><a href="' . esc_url($videogo_homeLink) . '">'.esc_attr($videogo_home).'</a> ' . esc_attr($videogo_delimiter) . '</li> ';
 
    if ( is_category() ) {
      $videogo_thisCat = get_category(get_query_var('cat'), false);
      if ($videogo_thisCat->parent != 0) echo get_category_parents($videogo_thisCat->parent, TRUE, ' ' . esc_attr($videogo_delimiter) . ' ');
      
	  echo html_entity_decode($videogo_before) . 'Archive by category "' . single_cat_title('', false) . '"' . $videogo_after;
 
    } elseif ( is_search() ) {
     
	 echo html_entity_decode($videogo_before) . 'Search results for "' . get_search_query() . '"' . $videogo_after;
 
    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . esc_attr($videogo_delimiter) . '</li> ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . esc_attr($videogo_delimiter) . '</li> ';
      echo html_entity_decode($videogo_before) . get_the_time('d') . $videogo_after;
 
    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . esc_attr($videogo_delimiter) . ' </li>';
      echo html_entity_decode($videogo_before) . get_the_time('F') . $videogo_after;
 
    } elseif ( is_year() ) {
      echo html_entity_decode($videogo_before) . get_the_time('Y') . $videogo_after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
		$videogo_post_type = get_post_type_object(get_post_type());
		$videogo_cat = array();
		
		if($videogo_post_type->name == 'event'){
			$videogo_categories = get_the_terms( $post->ID, 'event-categories' );
			if($videogo_categories <> ''){
				foreach ( $videogo_categories as $videogo_category ) {
					$videogo_cat[] = $videogo_category;
				}
			}
			if(isset($videogo_cat[0])){$videogo_cat = $videogo_cat[0];}
			if ($videogo_showCurrent == 1) echo html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;	
		
		}else if($videogo_post_type->name == 'career'){
			$videogo_categories = get_the_terms( $post->ID, 'career-category' );
			if($videogo_categories <> ''){
				foreach ( $videogo_categories as $videogo_category ) {
					$videogo_cat[] = $videogo_category;
				}
			}
			if(isset($videogo_cat[0])){$videogo_cat = $videogo_cat[0];}
			echo '<li><a href="'.get_term_link(intval($videogo_cat->term_id),'career-category').'">'.esc_attr($videogo_cat->name).'</a></li>';
			
			if ($videogo_showCurrent == 1) echo html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;	
		
		}else if($videogo_post_type->name == 'attraction'){
			$videogo_categories = get_the_terms( $post->ID, 'attraction-category' );
			
			if($videogo_categories <> ''){
				foreach ( $videogo_categories as $videogo_category ) {
					$videogo_cat[] = $videogo_category;
				}
			}
			
			if(isset($videogo_cat[0])){$videogo_cat = $videogo_cat[0];}
			echo '<li><a href="'.get_term_link(intval($cat->term_id),'attraction-category').'">'.esc_attr($cat->name).'</a></li>';
			if ($videogo_showCurrent == 1) echo html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;	
		
		}else if($videogo_post_type->name == 'portfolio'){
			
			$videogo_categories = get_the_terms( $post->ID, 'portfolio-category' );
			if($videogo_categories <> ''){
				foreach ( $videogo_categories as $videogo_category ) {
					$videogo_cat[] = $videogo_category;
				}
			}
			if(isset($videogo_cat[0])){$videogo_cat = $videogo_cat[0];
				echo '<li><a href="'.get_term_link(intval($videogo_cat->term_id),'portfolio-category').'">'.esc_attr($videogo_cat->name).'</a></li>';
			}
			if ($videogo_showCurrent == 1) echo html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;	
		
		}else{
			global $wp_query,$post;
			
			$videogo_post_type = get_post_type_object(get_post_type());
			$videogo_slug = $videogo_post_type->rewrite;
			echo '<li><a href="' . $videogo_homeLink . '/' . $videogo_slug['slug'] . '/">' . esc_attr($videogo_post_type->labels->name) . '</a>';
			if ($videogo_showCurrent == 1) echo ' ' . esc_attr($videogo_delimiter) . ' </li>' . html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;
		}
      
	  } else {
        
		$videogo_cat = get_the_category(); 
		$videogo_cat = $videogo_cat[0];
        $videogo_cats = get_category_parents($videogo_cat, TRUE, ' ' . esc_attr($videogo_delimiter) . ' ');
        if ($videogo_showCurrent == 0) $videogo_cats = preg_replace("#^(.+)\s$videogo_delimiter\s$#", "$1", $videogo_cats);
        echo '<li>'.$videogo_cats.'</li>';
        if ($videogo_showCurrent == 1) echo html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      echo html_entity_decode($videogo_before) . 'Archive by category "' . single_cat_title('', false) . '"' . $videogo_after;
    
	} elseif ( is_attachment() ) {
      $videogo_parent = get_post($post->post_parent);
      echo '<li><a href="' . esc_url(get_permalink($videogo_parent)) . '">' . esc_attr($videogo_parent->post_title) . '</a>';
      if ($videogo_showCurrent == 1) echo ' ' . esc_attr($videogo_delimiter) . ' </li>' . html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($videogo_showCurrent == 1) echo html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $videogo_parent_id  = $post->post_parent;
      $videogo_breadcrumbs = array();
     
	 while ($videogo_parent_id) {
        $videogo_page = get_page($videogo_parent_id);
        $videogo_breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($videogo_page->ID)) . '">' . esc_attr(substr(get_the_title(),0,25)) . '</a></li>';
        $videogo_parent_id  = $videogo_page->post_parent;
      }
      $videogo_breadcrumbs = array_reverse($videogo_breadcrumbs);
      for ($i = 0; $i < count($videogo_breadcrumbs); $i++) {
        echo html_entity_decode($videogo_breadcrumbs[$i]);
        if ($i != count($videogo_breadcrumbs)-1) echo ' ' . esc_attr($videogo_delimiter) . ' ';
      }
      if ($videogo_showCurrent == 1) echo ' ' . esc_attr($videogo_delimiter) . ' ' . html_entity_decode($videogo_before) . esc_attr(substr(get_the_title(),0,25)) . $videogo_after;
 
    } elseif ( is_tag() ) {
      echo html_entity_decode($videogo_before) . 'Posts tagged "' . single_tag_title('', false) . '"' . $videogo_after;
 
    } elseif ( is_author() ) {
       global $author;
      $videogo_userdata = get_userdata($author);
      echo html_entity_decode($videogo_before) . 'Articles posted by ' . $videogo_userdata->display_name . $videogo_after;
 
    } elseif ( is_404() ) {
      echo html_entity_decode($videogo_before) . 'Error 404' . $videogo_after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</ul>';
  }
}
?>