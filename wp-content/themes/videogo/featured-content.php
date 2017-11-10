<?php
/**
 * The template for displaying featured content
 *
 * @package CrunchPress
 * @subpackage Video Go
 */
	/* getting values from CP Panel */
	$videogo_default_settings = get_option('default_pages_settings');
	if($videogo_default_settings != ''){
		$videogo_default = new DOMDocument ();
		$videogo_default->loadXML ( $videogo_default_settings );
		$videogo_num_excerpt = videogo_find_xml_value($videogo_default->documentElement,'default_excerpt');
	}
					/* Sticky Post Meta/Content */
					$videogo_thumbnail_types = '';
					$videogo_select_slider_type='';
					$videogo_featured_posts = videogo_get_featured_posts();
					foreach ( (array) $videogo_featured_posts as $order => $post ) :
						setup_postdata( $post ); 
						$videogo_thumbnail_types = '';
						$videogo_post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
						if($videogo_post_detail_xml <> ''){
							$videogo_post_xml = new DOMDocument ();
							$videogo_post_xml->loadXML ( $videogo_post_detail_xml );
							$videogo_post_social = videogo_find_xml_value($videogo_post_xml->documentElement,'post_social');
							$videogo_sidebar = videogo_find_xml_value($videogo_post_xml->documentElement,'sidebar_post');
							$videogo_right_sidebar = videogo_find_xml_value($videogo_post_xml->documentElement,'right_sidebar_post');
							$videogo_left_sidebar = videogo_find_xml_value($videogo_post_xml->documentElement,'left_sidebar_post');
							$videogo_thumbnail_types = videogo_find_xml_value($videogo_post_xml->documentElement,'post_thumbnail');
							$videogo_video_url_type = videogo_find_xml_value($videogo_post_xml->documentElement,'video_url_type');
							$videogo_select_slider_type = videogo_find_xml_value($videogo_post_xml->documentElement,'select_slider_type');	
						}
				$videogo_post_views = videogo_getPostViews(get_the_ID());
				$videogo_thumbnail_id = get_post_thumbnail_id( $post->ID );
				$videogo_num_comments = get_comments_number($post->ID);
				$videogo_image_size = wp_get_attachment_image_src($videogo_thumbnail_id, array(850, 360));
					/* Get Sticky Post Meta */
					$videogo_get_post_cp = get_post($post);
					?>
<div <?php post_class(); ?>>
<!--Blog Item Start-->
<?php if(videogo_print_blog_thumbnail($post->ID,$videogo_image_size) <> ''){ ?>
<article class="cp-blog-item">
<figure class="cp-thumb"><?php echo videogo_print_blog_thumbnail($post->ID,$videogo_image_size); ?> </figure>
<?php } else { ?>
<article class="cp-blog-item cp-blog-item2">
  <div class="cp-text"> <span class="cp-icon-box">
    <?php  if($videogo_select_slider_type <> ''){ ?>
    <i class="fa fa-align-left"></i>
    <?php } else { ?>
    <i class="fa fa-file-text"></i>
    <?php  } ?>
    </span>
    <div class="cp-inner-holder">
      <h3><a href="<?php echo get_permalink($post->ID); ?> "><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
      <ul class="cp-meta-list">
        <li><?php echo esc_attr(get_the_date('l')).', '.esc_attr(get_the_date('M')).' '.esc_attr(get_the_date('j')).', '.esc_attr(get_the_date('Y')); ?></li>
        <li><?php esc_html_e( 'by', 'videogo' ); ?> <?php echo esc_attr(get_the_author()); ?>, <span><?php echo $videogo_post_views; ?></span></li>
      </ul>
      <p><?php echo the_content(); ?></p>
      <ul class="cp-meta-post-list">
        <li><i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php echo esc_attr(get_the_author()); ?></a></li>
        <li><i class="fa fa-comment-o"></i> <?php echo $videogo_num_comments; ?></li>
      </ul>
      <a href="<?php echo get_permalink($post->ID); ?>" class="cp-btn-style1">
      <?php esc_html_e( 'Read More', 'videogo' ); ?>
      </a> </div>
  </div>
</article>
<!--Blog Item End-->
<?php } ?>
<?php endforeach; wp_reset_postdata(); ?>