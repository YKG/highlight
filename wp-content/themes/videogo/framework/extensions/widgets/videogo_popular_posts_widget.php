<?php
class videogo_popular_post extends WP_Widget
{
  function videogo_popular_post()
  {
    $videogo_widget_ops = array('classname' => ' widget-recent-post ', 'description' => 'Shows the Popular Posts' );
    parent::__construct('videogo_popular_post', 'CrunchPress : Show Popular Posts', $videogo_widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$get_cate_posts = isset( $instance['get_cate_posts'] ) ? esc_attr( $instance['get_cate_posts'] ) : '';
	$nop = isset( $instance['nop'] ) ? esc_attr( $instance['nop'] ) : '';
?>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	 <?php esc_html_e('Title:','videogo');?>  
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>   
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('nop')); ?>">
	 <?php esc_html_e('Number of Posts To Display:','videogo');?> 
	  <input class="widefat" size="2" id="<?php echo esc_attr($this->get_field_id('nop')); ?>" name="<?php echo esc_attr($this->get_field_name('nop')); ?>" type="text" value="<?php echo esc_attr($nop); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
  
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['get_cate_posts'] = $new_instance['get_cate_posts'];	
	$instance['nop'] = $new_instance['nop'];
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_cate_posts = isset( $instance['get_cate_posts'] ) ? esc_attr( $instance['get_cate_posts'] ) : '';		
		$nop = isset( $instance['nop'] ) ? esc_attr( $instance['nop'] ) : '';	
	
		if($nop == ""){$nop = '-1';}
		echo html_entity_decode($before_widget);	
		if (!empty($title))
			echo '<div class="cp-heading-outer"><h2>';
			echo esc_attr($title);
			echo '</h2></div>';
			?>
				<ul>
				<?php
					/* Query List */
					$args = array( 
						'post_type' 		=> 'post',
						'post_status'       => 'publish',
						'posts_per_page' 	=> $nop,
						'orderby'		 	=> 'popular_post_views_count', 
						'order' 			=> 'DESC'
					);
				
					query_posts($args);
					while ( have_posts() ) { the_post(); global $post; ?>
                    <li>
                      <div class="cp-holder">
                        <div class="cp-thumb2"> <a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post->ID, array(75,65));?></a> </div>
                        <div class="cp-text">
                          <h5><a href="<?php echo esc_url(get_permalink());?>">
							<?php 
								$title = get_the_title();
								if (strlen($title) < 22){ 
									echo esc_attr(get_the_title());
								}
								else {
									echo esc_attr(substr((get_the_title()),0,22)) . '...';
								}
							?>
                          </a></h5>
                          <ul class="cp-meta-list">
                            <li><?php echo esc_attr(get_the_date(get_option('date_format')));?></li>
                            <li><?php esc_html_e('by ','videogo');?><?php echo esc_attr(get_the_author());?></li>
                          </ul>
                        </div>
                      </div>
                    </li>
					<?php } 
					wp_reset_query(); /* endwhile */ ?>	
				</ul>
<?php 	wp_reset_postdata();
		echo html_entity_decode($after_widget);
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("videogo_popular_post");') ); ?>