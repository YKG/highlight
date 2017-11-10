<?php  
/*
 * This file is used to generate comments form.
 */	
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		
		die ('Please do not load this page directly. Thanks!');
	
	if (post_password_required()){ ?>
		
		<p class="nopassword"><?php echo esc_html__('This post is password protected. Enter the password to view comments.','videogo'); ?></p> 
		
		<?php return;
	}
	if ( have_comments() ) : ?>
	
<!--Comments Holder Start-->
	<article class="cp-comments-holder">
		<div class="cp-heading-outer">
			<h2><?php esc_html_e("Comments","'videogo'");?></h2>
		</div>
		<h3><?php comments_number(esc_html__('No Comment','videogo'), esc_html__('One Comment','videogo'), esc_html__('% Comments','videogo') );?></h3>
	
		<ul id="comments" class="cp-comments-listed">
		
            <?php wp_list_comments( 'type=comment&callback=videogo_comment' ); ?>
		
		</ul>
	
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		
			<div class="comments-navigation">
				
				<div class="previous"> <?php previous_comments_link(esc_html__('Older Comments','videogo')); ?> </div>
				
				<div class="next"> <?php next_comments_link(esc_html__('Newer Comments','videogo')); ?> </div>
			
			</div>
	
		<?php endif; 
	endif; 
?>
	</article>
<!--Comments Holder End-->
<?php
	/* Markup */ 
	
	$videogo_comment_form = array( 
		
		'fields' => apply_filters( 'comment_form_default_fields', array(
			
			'author' => '<div class="col-md-4 col-sm-4"><div class="inner-holder">' .						
								'<input class="comm-field" id="author" name="author" placeholder="'.esc_html__('Your Name *','videogo').'" type="text" value="' .
								esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .						
								'</div>' .
							'</div>',
							
			'email'  => 	'<div class="col-md-4 col-sm-4"><div class="inner-holder">' .
								'<input id="email" class="comm-field" name="email" placeholder="'.esc_html__('Email Address *','videogo').'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .						
							'</div></div>',
							
			'url'    => '	<div class="col-md-4 col-sm-4"><div class="inner-holder">' .
								'<input id="url" class="comm-field" placeholder="'.esc_html__('Subject *','videogo').'" name="url" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .						
								'</div>' .
							'</div>' ) ),
			
			'comment_field' =>  '<div class="col-md-12 col-sm-12"><div class="inner-holder">'.	
									'<textarea cols="60" rows="10" placeholder="'.esc_html__(' Comments *','videogo').'" class="comm-area" id="comment" name="comment" aria-required="true"></textarea>
								</div></div>' .
						'',
			'class_form'      => 'comment-form',
			'id_submit'         => 'submit',
			'class_submit'      => 'btn-submit',
			'name_submit'       => 'submit',
			'title_reply'       => '',
			'label_submit'      => esc_html__( 'Submit','videogo' ),
			'format'            => 'xhtml',
	);
	if ( have_comments() ) : 
		 comment_form($videogo_comment_form, $post->ID); 
	endif; 