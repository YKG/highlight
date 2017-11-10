<?php
	/*
	*	CrunchPress Page Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each page item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	/*  Print Content Item */
	function videogo_print_default_content_item(){
		
		while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<a href="<?php echo esc_url(get_permalink());?>">
			<?php
				
			?>
			</a>
			<div class="entry-content-cp">
				<?php
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'videogo' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
					edit_post_link( esc_html__( 'Edit', 'videogo' ), '<span class="edit-link">', '</span>' );
				?>
			</div><!-- .entry-content -->
		</div><!-- #post-## -->
		
		<?php
		echo '<div class="comment-box">';
			/* If comments are open or we have at least one comment, load up the comment template. */
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		echo '</div>';
		endwhile;
	}