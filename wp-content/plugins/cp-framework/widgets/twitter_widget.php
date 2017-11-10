<?php

/*
	Description: Latest Twitter With updated API Widget.
	Version: 1.0.0
	Author: Crunchpress
	Author URI: http://themeforest.net
*/

if (! class_exists('tmhOAuth')) {
	require 'twitter/tmhOAuth.php';	
}

class twitter_widget extends WP_Widget
{
	function twitter_widget()
	{
		$videogo_widget_ops = array('classname' => 'twitter_widget footer-box-1', 'description' => 'Show Twitter Widget Tweets on your website' );
		parent::__construct('twitter_widget', 'CrunchPress : Twitter Widget', $videogo_widget_ops);
	
	}/*end of twitter_widget function*/
 
	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$videogo_title = $instance['title'];
		$videogo_consumer_key = isset( $instance['videogo_consumer_key'] ) ? esc_attr( $instance['videogo_consumer_key'] ) : '';
		$videogo_consumer_secret = isset( $instance['videogo_consumer_secret'] ) ? esc_attr( $instance['videogo_consumer_secret'] ) : '';
		$videogo_user_token = isset( $instance['user_token'] ) ? esc_attr( $instance['user_token'] ) : '';
		$videogo_user_secret = isset( $instance['user_secret'] ) ? esc_attr( $instance['user_secret'] ) : '';
		$videogo_username_widget = isset( $instance['username_widget'] ) ? esc_attr( $instance['username_widget'] ) : '';
		$videogo_num_of_tweets = isset( $instance['num_of_tweets'] ) ? esc_attr( $instance['num_of_tweets'] ) : '';
	
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">
		  <?php esc_html_e('Widget Title:','videogo');?>
		  <input class="title"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($videogo_title); ?>" />
		</label>
	</p>
	
	<p>
	   <?php esc_html_e('Please visit this link first','videogo');?>
		<a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a> <?php _e('it will take to page where you can make twitter app that will help you to get some details that you need to activate your twitter widget.','videogo');?>
		  
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('videogo_consumer_key'); ?>">
		<?php esc_html_e('Consumer Key','videogo');?>
		</label>
		<br/>
	   <input class="title"  id="<?php echo $this->get_field_id('videogo_consumer_key'); ?>" name="<?php echo $this->get_field_name('videogo_consumer_key'); ?>" type="text" value="<?php echo esc_attr($videogo_consumer_key); ?>" />
	</p>
  
	<p>
		<label for="<?php echo $this->get_field_id('videogo_consumer_secret'); ?>">
		 <?php esc_html_e('Consumer Secret Key','videogo');?>
		</label> 
		<br/ >
		<input class="title"  id="<?php echo $this->get_field_id('videogo_consumer_secret'); ?>" name="<?php echo $this->get_field_name('videogo_consumer_secret'); ?>" type="text" value="<?php echo esc_attr($videogo_consumer_secret); ?>" />
	</p>
  
	<p>
		<label for="<?php echo $this->get_field_id('user_token'); ?>">
		<?php esc_html_e('User Token','videogo');?>
		</label>
		<br/ >
		<input class="title"  id="<?php echo $this->get_field_id('user_token'); ?>" name="<?php echo $this->get_field_name('user_token'); ?>" type="text" value="<?php echo esc_attr($videogo_user_token); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('user_secret'); ?>">
		   <?php esc_html_e('User Secret Token','videogo');?>
		</label>
		<br/ >
		<input class="title"  id="<?php echo $this->get_field_id('user_secret'); ?>" name="<?php echo $this->get_field_name('user_secret'); ?>" type="text" value="<?php echo esc_attr($videogo_user_secret); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('username_widget'); ?>">
		<?php esc_html_e('User Name (without twitter url for example: http://www.twitter.com/Envato write only Envato): ','videogo');?>
		</label>
		<br/ >
		<input class="title"  id="<?php echo $this->get_field_id('username_widget'); ?>" name="<?php echo $this->get_field_name('username_widget'); ?>" type="text" value="<?php echo esc_attr($videogo_username_widget); ?>" />
	</p>
	
	<p>
	  <label for="<?php echo $this->get_field_id('num_of_tweets'); ?>">
		  <?php esc_html_e('Number of Tweets','videogo');?>
	  </label>
	  <br/ >
	  <input class="title" size="5" id="<?php echo $this->get_field_id('num_of_tweets'); ?>" name="<?php echo $this->get_field_name('num_of_tweets'); ?>" type="text" value="<?php echo esc_attr($videogo_num_of_tweets); ?>" />
	</p>
<?php
  
	}/*end of form function*/
 
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['videogo_consumer_key'] = $new_instance['videogo_consumer_key'];
			$instance['videogo_consumer_secret'] = $new_instance['videogo_consumer_secret'];
			$instance['user_token'] = $new_instance['user_token'];
			$instance['user_secret'] = $new_instance['user_secret'];
			$instance['username_widget'] = $new_instance['username_widget'];
			$instance['num_of_tweets'] = $new_instance['num_of_tweets'];
		return $instance;
	
	}/*end of update function*/
 
	function widget($args, $instance)
	{
		global $counter;
		extract($args, EXTR_SKIP);
		
		$videogo_tweetid = '';
		$videogo_this_tweet = '';
		$videogo_title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$videogo_consumer_key = isset( $instance['videogo_consumer_key'] ) ? esc_attr( $instance['videogo_consumer_key'] ) : '';		
		$videogo_consumer_secret = isset( $instance['videogo_consumer_secret'] ) ? esc_attr( $instance['videogo_consumer_secret'] ) : '';		
		$videogo_user_token = isset( $instance['user_token'] ) ? esc_attr( $instance['user_token'] ) : '';		
		$user_secret = isset( $instance['user_secret'] ) ? esc_attr( $instance['user_secret'] ) : '';		
		$videogo_username_widget = isset( $instance['username_widget'] ) ? esc_attr( $instance['username_widget'] ) : '';		
		$videogo_num_of_tweets = isset( $instance['num_of_tweets'] ) ? esc_attr( $instance['num_of_tweets'] ) : '';		
		
		echo html_entity_decode($before_widget);
		
		echo '<div class="cp-sidebar-box">';
		
		/* Twitter Widget Display Code Start*/
		
		if (!empty($videogo_title)){
			echo html_entity_decode($before_title);
			echo esc_attr($videogo_title);
			echo html_entity_decode($after_title);
		}	
		?>
		
		<script>
		
		jQuery(document).ready(function ($) {
			"use strict";
				
				if ($('#cp-tweet-slider-<?php echo esc_attr($counter);?>').length) {
					$('#cp-tweet-slider-<?php echo esc_attr($counter);?>').bxSlider({
						auto: true,
						infiniteLoop: true,
						hideControlOnEnd: true
					});
				}		
		});
		
		</script>
		
		<?php
		
		$videogo_tweets = get_tweets($videogo_username_widget, $videogo_num_of_tweets, $videogo_consumer_key, $videogo_consumer_secret, $videogo_user_token, $videogo_user_secret );
		
		$videogo_profile_image = 'profile_image';
		$videogo_follow_link = 'follow_link';
		$videogo_counter_twi = 2;
		
		?>
		<div class="cp-sidebar-box">	
			<ul id="cp-tweet-slider-<?php echo esc_attr($counter);?>">
				<?php
				
				if($videogo_tweets <> ''){
					
					$videogo_start=0;
					$videogo_end=1;
					$videogo_counter=0;
					while ($videogo_this_tweet = array_shift($videogo_tweets)) { 
					$videogo_slice_tweets=array_slice($videogo_tweets,$videogo_start,$videogo_end);
					$videogo_counter++;
					
				?>
					<li>
						<div class="cp-latest-tweets">
							<ul>
								<?php foreach ($videogo_slice_tweets as $videogo_tweet) { ?>
								<li>
									<i class="fa fa-twitter"></i>
									<div class="cp-text-box">
										<a href="http://twitter.com/<?php echo esc_attr($videogo_tweet->user->screen_name); ?>/status/<?php echo $videogo_tweet->id_str;?>" class="tw"><?php esc_html_e("@","crunchpress"); echo esc_attr($videogo_tweet->user->name); ?></a>
										<p><?php echo esc_attr($videogo_tweet->text);?></p>
										<em><?php echo human_time_diff((strtotime($videogo_tweet->created_at)));esc_html_e(" ago","crunchpress")?></em>
									</div>
								</li>
								
								<?php 
								
								} 
								$videogo_start+=1;
								?>
							</ul>
						</div>			
					</li>			
				<?php }/*end of while loop*/
				} /*end of if condition*/ ?>
			</ul>
		</div>
	<?php 
	
	echo html_entity_decode($after_widget);
	
	}/*end of widget function*/
	
		
}/*end of twitter_widget class*/
add_action( 'widgets_init', create_function('', 'return register_widget("twitter_widget");') );

 /* This calculates a relative time, e.g. "1 minute ago"*/
    function relativeTime($time)
    {   
        $second = 1;
        $minute = 60 * $second;
        $hour = 60 * $minute;
        $day = 24 * $hour;
        $month = 30 * $day;
        
        $delta = time() - $time;

        if ($delta < 1 * $minute)
        {
            return $delta == 1 ? "one second ago" : $delta . " seconds ago";
        }
        if ($delta < 2 * $minute)
        {
          return "a minute ago";
        }
        if ($delta < 45 * $minute)
        {
            return floor($delta / $minute) . " minutes ago";
        }
        if ($delta < 90 * $minute)
        {
          return "an hour ago";
        }
        if ($delta < 24 * $hour)
        {
          return floor($delta / $hour) . " hours ago";
        }
        if ($delta < 48 * $hour)
        {
          return "yesterday";
        }
        if ($delta < 30 * $day)
        {
            return floor($delta / $day) . " days ago";
        }
        if ($delta < 12 * $month)
        {
          $months = floor($delta / $day / 30);
          return $months <= 1 ? "one month ago" : $months . " months ago";
        }
        else
        {
            $years = floor($delta / $day / 365);
            return $years <= 1 ? "one year ago" : $years . " years ago";
        }
    }    

	/* With thanks to The Danger Bees for the donkey work: http://dmblog.com/2011/08/how-to-use-tweet-entities/*/
	function linkify_tweet($raw_text, $tweet = NULL)
	{
		/* first set output to the value we received when calling this function*/
		$output = $raw_text;

		/* create xhtml safe text (mostly to be safe of ampersands)*/
		$output = htmlentities(html_entity_decode($raw_text, ENT_NOQUOTES, 'UTF-8'), ENT_NOQUOTES, 'UTF-8');

		/* parse urls*/
		if ($tweet == NULL)
		{
			/* for regular strings, just create <a> tags for each url*/
			$pattern        = '/([A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+)/i';
			$replacement    = '<a href="${1}" rel="external">${1}</a>';
			$output         = preg_replace($pattern, $replacement, $output);
		} else {
			/* for tweets, let's extract the urls from the entities object*/
			foreach ($tweet->entities->urls as $url)
			{
				$old_url        = $url->url;
				$expanded_url   = (empty($url->expanded_url))   ? $url->url : $url->expanded_url;
				$display_url    = (empty($url->display_url))    ? $url->url : $url->display_url;
				$replacement    = '<a href="'.$expanded_url.'" rel="external">'.$old_url.'</a>';
				$output         = str_replace($old_url, $replacement, $output);
			}

			/*let's extract the hashtags from the entities object*/
			foreach ($tweet->entities->hashtags as $hashtags)
			{
				$hashtag        = '#'.$hashtags->text;
				$replacement    = '<a href="http://twitter.com/search?q=%23'.$hashtags->text.'" rel="external">'.$hashtag.'</a>';
				$output         = str_ireplace($hashtag, $replacement, $output);
			}

			/* let's extract the usernames from the entities object*/
			foreach ($tweet->entities->user_mentions as $user_mentions)
			{
				$username       = '@'.$user_mentions->screen_name;
				$replacement    = '<a href="http://twitter.com/'.$user_mentions->screen_name.'" rel="external" title="'.$user_mentions->name.' on Twitter">'.$username.'</a>';
				$output         = str_ireplace($username, $replacement, $output);
			}

			/* if we have media attached, let's extract those from the entities as well*/
			if (isset($tweet->entities->media))
			{
				foreach ($tweet->entities->media as $media)
				{
					$old_url        = $media->url;
					$replacement    = '<a href="'.$media->expanded_url.'" rel="external" class="twitter-media" data-media="'.$media->media_url.'">'.$media->display_url.'</a>';
					$output         = str_replace($old_url, $replacement, $output);
				}
			}
		}

		return $output;
	}


    function get_tweets( $username, $count=3, $videogo_consumer_key, $videogo_consumer_secret, $user_token, $user_secret ) {
		$tweets = '';

        if ( ! $tweets = get_transient( 'oikos_tweets' ) ) {
            
            $tmhOAuth = new tmhOAuth(array(
                'videogo_consumer_key'    => $videogo_consumer_key,
                'videogo_consumer_secret' => $videogo_consumer_secret,
                'user_token'      => $user_token,
                'user_secret'     => $user_secret,
            ));

			/* Note that we get 20 Tweets by default here, as we don't include replies.  The way
			 * that this works is Twitter gets 'count' Tweets, and then filters out replies. So if you
			 * get 5 Tweets and the last 5 Tweets were all replies, then you'll get nothing.
			 */
			 $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
                'screen_name' => $username,
                'count' => 20,
                'exclude_replies' => true ));
            if ($code == 200) {
                $tweets = json_decode($tmhOAuth->response['response']);
				/* Now we slice the required number of tweets.*/
				$tweets = array_slice( $tweets, 0, $count );
			} else {
                $tweets = array();
            }

            set_transient('oikos_tweets', $tweets, 5 * 60);

        }

        return $tweets;
    }

?>