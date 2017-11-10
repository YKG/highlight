<?php
	/*	
	*	CrunchPress Comment File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file return the comment list to the selected post_type
	*	---------------------------------------------------------------------
	*/
	 
	function get_comment_list( $videogo_comment, $videogo_args, $videogo_depth ) {
	
		$GLOBALS['comment'] = $videogo_comment;
		
		switch ( $videogo_comment->comment_type ) :
			case 'pingback'  :
			case 'trackback' :
			?>
				<li class="post pingback">	
					<p>
						<?php esc_html_e( 'Pingback:', 'videogo'); ?>
						<?php comment_author_link(); ?>
						<?php edit_comment_link( esc_html_e('(Edit)', 'videogo'), ' ' ); ?>
					</p>
				</li>
			<?php
				break;
				
			default :
			?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<div class="thumb">
						<?php echo get_avatar( $videogo_comment, 60 ); ?>
					</div>
					<div class="text">
						<h4><?php echo get_comment_author_link(); ?></h4>
						<?php comment_text(); ?>
						<div class="post-time">
							<ul>
								<li><p><?php echo get_comment_time();?> - <?php echo get_comment_date();?></p></li>
								<li><?php comment_reply_link( array_merge( $videogo_args, array( 'depth' => $videogo_depth, 'max_depth' => $videogo_args['max_depth'] ) ) ); ?></li>
							</ul>
						</div>
					</div>
				
			<?php
				break;
		endswitch;
		
	}
?>
