<?php 
/*	
*	CrunchPress Pagination File
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file return the Pagination to the selected post_type
*	---------------------------------------------------------------------
*/
	
	if( !function_exists('pagination') ){
		function videogo_pagination($videogo_pages = '', $videogo_range = 4)
		{		
			/* Don't print empty markup if there's only one page. */
			if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
				return;
			}
			
			$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
						
			$videogo_pagenum_link = html_entity_decode( get_pagenum_link() );
			$videogo_query_args   = array();
			$videogo_url_parts    = explode( '?', $videogo_pagenum_link );
			if ( isset( $videogo_url_parts[1] ) ) {
				wp_parse_str( $videogo_url_parts[1], $videogo_query_args );
			}
			$videogo_pagenum_link = remove_query_arg( array_keys( $videogo_query_args ), $videogo_pagenum_link );
			$videogo_pagenum_link = trailingslashit( $videogo_pagenum_link ) . '%_%';
			$videogo_format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $videogo_pagenum_link, 'index.php' ) ? 'index.php/' : '';
			$videogo_format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
			/* Set up paginated links.*/
			$videogo_links = paginate_links( array(
				'base'     => $videogo_pagenum_link,
				'format'   => $videogo_format,
				'total'    => $GLOBALS['wp_query']->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map( 'urlencode', $videogo_query_args ),
				'prev_text' => '<i class="fa fa-caret-square-o-left"></i>',
				'next_text' => '<i class="fa fa-caret-square-o-right"></i>',
			) );
			html_entity_decode($videogo_links);
			
			if ( $videogo_links ) :
				return '<li>'.$videogo_links.'</li>';
			endif;
		}
	}
	
	
	if( !function_exists('videogo_post_nav') ){
		function videogo_post_nav() {
			$videogo_previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$videogo_next     = get_adjacent_post( false, '', false );
			if ( ! $videogo_next && ! $videogo_previous ) {
				return;
			}
		?>			
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', esc_html__( '<li><span class="meta-nav">Published In</span>%title</li>', 'videogo' ) );
			else :
				previous_post_link( '%link', esc_html__( '<li><span class="meta-nav">Previous Post</span>%title</li>', 'videogo' ) );
				next_post_link( '%link', esc_html__( '<li><span class="meta-nav">Next Post</span>%title</li>', 'videogo' ) );
			endif;
			?>
		</div><!-- .nav-links -->			
		<?php
		}
	}
	
	
	if( !function_exists('videogo_post_next') ){
		function videogo_post_next() {
			$videogo_previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$videogo_next     = get_adjacent_post( false, '', false );
			if ( ! $videogo_next && ! $videogo_previous ) {
				return;
			}
				if ( is_attachment() ) :
					echo '<div class="portfolio-thumb">';
					previous_post_link( '%link', esc_html__( '<li><span class="meta-nav">Published In</span>%title</li>', 'videogo' ) );
					echo '</div>';
				else :
					echo '<div class="portfolio-thumb">';
					previous_post_link( '%link', esc_html__( '<li><span class="meta-nav">Previous Post</span>%title</li>', 'videogo' ) );
					next_post_link( '%link', esc_html__( '<li><span class="meta-nav">Next Post</span>%title</li>', 'videogo' ) );
					echo '</div>';
				endif;
		}
	}
	
		if( !function_exists('pagination_crunch') ){
		function pagination_crunch($pages = '', $range = 4)
		{ 
			 $output = '';	
			 $showitems = ($range * 2)+1;  
		 
			 global $paged;
	
			 if($pages == '')
			 {
				 global $wp_query;
				 
				 $pages = $wp_query->max_num_pages;
				 
				 if(!$pages)
				 {
					 $pages = 1;
				 }
			 }   
		 
			 if(1 != $pages)
			 {		
			 
				$output .='<div class="cp-pagination-row">';
				$output .='<ul class="pagination">';  
				 if($paged > 2 ) $output .="<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
				 if($paged > 1 ) $output .='<li> <a class="previous" aria-label="Previous" href="'.get_pagenum_link($paged - 1).'"> Prev </a> </li>';
				 
		 
				 for ($i=1; $i <= $pages; $i++)
				 {
					 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
					 {
						$output .= ($paged == $i)? '<li class="active"><span>'.$i.' <span class="sr-only">(current)</span></span></li>':"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
					 }
				 }
		 
				 if ($paged < $pages ) $output .='<li><a class="next" aria-label="Next" href="'.get_pagenum_link($paged + 1).'"> Next </a>';
				 if ($paged < $pages-1 ){ $output .="<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
				 $output .="</ul>\n";} else {
				 $output .='</ul></div>'; }
			 }
			 return $output;
		}
	}
?>