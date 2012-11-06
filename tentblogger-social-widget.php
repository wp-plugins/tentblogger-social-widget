<?php
/*
Plugin Name: TentBlogger Social Widget
Plugin URI: http://tentblogger.com/social-widget/
Description: A lightweight, fast loading and clean looking social widget to capitalize on the "Big 3" on your blog: <a href="http://twitter.com">Twitter</a>, <a href="http://facebook.com">Facebook</a>, and RSS. Share your tweets from <a href="http://twitter.com">Twitter</a>, your <a href="http://facebook.com">Facebook</a> Profile or Page, and a RSS Feed of your choice. Think of it as a <a href="http://twitter.com">Twitter</a> Widget, <a href="http://facebook.com">Facebook</a> Widget, and a RSS Widget all in one with a slick and simple unified appearance. 
Version: 3.3
Author: TentBlogger
Author URI: http://tentblogger.com
License:

    Copyright 2011 - 2012 TentBlogger (info@tentblogger.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class TentBlogger_Social_Widget extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
	function TentBlogger_Social_Widget() {
	
		$widget_opts = array (
			'classname' => 'tentblogger-social-widget',
			'description' => __('A Twitter Widget, Facebook Widget, and a RSS Widget all in one with a slick and simple unified appearance. ', 'tentblogger-social-widget')
		);		
		
		$this->WP_Widget('tentblogger-social-widget', __('TentBlogger Social Widget', 'tentblogger-social-widget'), $widget_opts);
		add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 3600;'));
		load_plugin_textdomain('tentblogger-social-widget', false, dirname(plugin_basename( __FILE__ ) ) . '/lang/' );
		$this->_register_scripts_and_styles();
		
	} // end constructor

	/*--------------------------------------------------*/
	/* API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	function widget($args, $instance) {
	
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		
		$twitter_username = empty($instance['twitter_username']) ? '' : apply_filters('twitter_username', $instance['twitter_username']);
		$tweet_count = empty($instance['tweet_count']) ? '' : apply_filters('tweet_count', $instance['tweet_count']);
		$show_twitter_avatar = empty($instance['show_twitter_avatar']) ? '' : apply_filters('show_twitter_avatar', $instance['show_twitter_avatar']);
		$feedburner_username = empty($instance['feedburner_username']) ? '' : apply_filters('feedburner_username', $instance['feedburner_username']);
		$feed_count = empty($instance['feed_count']) ? '' : apply_filters('feedburner_username', $instance['feed_count']);		
		$facebook_badge = empty($instance['facebook_badge']) ? '' : apply_filters('facebook_id', $instance['facebook_badge']);
    $use_theme = empty($instance['use_theme']) ? '' : apply_filters('facebook_id', $instance['use_theme']);
		$use_visual_effects = empty($instance['use_visual_effects']) ? '' : apply_filters('use_visual_effects', $instance['use_visual_effects']);
		$display_tentblogger_image = empty($instance['display_tentblogger_image']) ? '' : apply_filters('use_visual_effects', $instance['display_tentblogger_image']);
    
		// Grab the HTML content
		include('tentblogger-social-widget-content.php');
		
		echo $after_widget;
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['twitter_username'] = $this->_strip($new_instance, 'twitter_username');
		$instance['tweet_count'] = $this->_strip($new_instance, 'tweet_count');
		$instance['show_twitter_avatar'] = $this->_strip($new_instance, 'show_twitter_avatar');
		$instance['feedburner_username'] = $this->_strip($new_instance, 'feedburner_username');
		$instance['feed_count'] = $this->_strip($new_instance, 'feed_count');
		$instance['facebook_badge'] = $new_instance['facebook_badge'];
    $instance['use_theme'] = $new_instance['use_theme'];
		$instance['use_visual_effects'] = $new_instance['use_visual_effects'];
		$instance['display_tentblogger_image'] = $new_instance['display_tentblogger_image'];
		
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form($instance) {
  
		$instance = wp_parse_args(
			(array)$instance,
			array(	
				'twitter_username' => '',
				'tweet_count' => '',
				'feedburner_username' => '',
				'feed_count' => '',
        'use_theme' => '',
				'facebook_badge' => '',
				'use_visual_effects' => ''
			)
		);
		
		$twitter_username = $this->_strip($instance, 'twitter_username');
		$tweet_count = $this->_strip($instance, 'tweet_count');
		$show_twitter_avatar = $this->_strip($instance, 'show_twitter_avatar');
		$feedburner_username = $this->_strip($instance, 'feedburner_username');
		$feed_count = $this->_strip($instance, 'feed_count');
		$facebook_badge = $instance['facebook_badge'];
    $use_theme = $instance['use_theme'];
		$use_visual_effects = $instance['use_visual_effects'];
		$display_tentblogger_image = $instance['display_tentblogger_image'];

		// Grab the HTML content for the form
		include('tentblogger-social-widget-form.php'); 
		
	} // end form
	
	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	
	/**
	 * Generates the user's twitter feed.
	 *
	 * @twitter_username		The user's Twitter handle
	 * @show_twitter_avatar	Whether or not to display the user's Twitter avatar
	 * @tweet_count					The number of tweets to display.
	 */
	public function get_twitter_feed($twitter_username, $show_twitter_avatar, $tweet_count) {
  
		$feed = fetch_feed('http://twitter.com/statuses/user_timeline/' . $twitter_username . '.rss');
		$user = json_decode($this->curl('http://twitter.com/users/show/' . $twitter_username . '.json'));
    
		// Make sure there isn't a problem with the feed
		if( is_wp_error( $feed) ) {		
			if( ( $options = get_option('tentblogger-social-widget-cache') ) ) {
				echo $options['twitter'];			
			} else {
				echo "There was a problem retrieving your Twitter feed.";
			} // end if/else
		} else {
    
		    $tweets = $feed->get_items(0, $tweet_count);
		    if($tweets == null || count($tweets) == 0) {
		    
		      $options = get_option('tentblogger-social-widget-cache');
		      echo $options['twitter'];
		    
		    } else {
		    
		      $tweet_cache = '';
		      foreach($tweets as $tweet) {
		        $tweet_str = '<li>';
		          if($show_twitter_avatar == "yes") {
		            $tweet_str .= '<img src="' . $user->profile_image_url . '" alt="' . $twitter_username . '" />';
		          } // end if
		          $tweet_str .= html_entity_decode(preg_replace("/".strtolower($twitter_username).": /", "", $tweet->get_title()));
		          $tweet_str .= ' <a href="' . $tweet->get_permalink() . '" target="_blank">' . __('Link', 'tentblogger-social-widget') . '</a>';
		        $tweet_str .= '</li>';
		        $tweet_cache .= $tweet_str;
		        echo $tweet_str;
		      } // end foreach
		      
		      // serialize the tweets in case twitter goes down
		      $options = get_option('tentblogger-social-widget-cache');
		      $options['twitter'] = $tweet_cache;      
		      update_option('tentblogger-social-widget-cache', $options);  
      
	      } // end if
      
    } // end if/else
    
	} // end get_twitter_feed
	
	/**
	 * Generates the user's FeedBurner feed.
	 *
	 * @feedburner_username		The user's FeedBurner username
	 * @feed_count						The number of posts to display
	 */
	public function get_feedburner_feed($feedburner_username, $feed_count) {
  
		$feed = fetch_feed('http://feeds.feedburner.com/' . $feedburner_username);
		$max_items = $feed->get_item_quantity($feed_count);
		$posts = $feed->get_items(0, $max_items);

		if($posts == null || count($posts) < 0) {
    
      $options = get_option('tentblogger-social-widget-cache');
      echo $options['feedburner'];
      
		} else {
      
      $feed_cache = '';
			foreach($posts as $post) {
				$feed_str = '<li><a href="' . $post->get_permalink() . '" target="_blank" title="' . $post->get_title() . '">' . $post->get_title() . '</a></li>';
        $feed_cache .= $feed_str;
				echo $feed_str;
			} // end foreach
      
      // serialize the feed in case feedburner can't be read
      $options = get_option('tentblogger-social-widget-cache');
      $options['feedburner'] = $feed_cache;      
      update_option('tentblogger-social-widget-cache', $options);  
      
    } // end if/else
    
    
	} // end get_feedburner_feed
	
	/*--------------------------------------------------*/
	/* Private Functions
	/*--------------------------------------------------*/
	
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function _register_scripts_and_styles() {
  
	    $use_theme = false;
	    $options = get_option('widget_tentblogger-social-widget');
	    if( null != $options ) {
		    foreach($options as $option) {
		      if($option['use_theme'] && $option['use_theme'] == 'on') {
		        $use_theme = true;
		      } // end if
		    } // end foreach
	    } 
    
		if(is_admin()) {
			$this->_load_file('tentblogger-social-admin-styles', '/tentblogger-social-widget/css/tentblogger-social-widget-admin.css');
		} else {
			
      wp_enqueue_script("jquery");
			$this->_load_file('tentblogger-social-widget-styles', '/tentblogger-social-widget/css/tentblogger-social-widget.css');
      
      if($use_theme) {
        $this->_load_file('tentblogger-social-widget-theme-style', '/tentblogger-social-widget/css/theme.css');  
      } // end if
      
      $this->_load_file('tentblogger-social-widget-styles', '/tentblogger-social-widget/css/custom.css');
			$this->_load_file('tentblogger-social-widget-script', '/tentblogger-social-widget/javascript/tentblogger-social-widget.js', true);
      
		} // end if
	} // end register_scripts_and_styles

	/**
	 * Helper function for registering and loading scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function _load_file($name, $file_path, $is_script = false) {
		$url = WP_PLUGIN_URL . $file_path;
		$file = WP_PLUGIN_DIR . $file_path;
		if(file_exists($file)) {
			if($is_script) {
				wp_register_script($name, $url);
				wp_enqueue_script($name);
			} else {
				wp_register_style($name, $url);
				wp_enqueue_style($name);
			} // end if
		} // end if
	} // end _load_file
	
	/**
	 * Convenience method for stripping tags and slashes from the content
	 * of a form input.
	 *
	 * @obj			The instance of the argument array
	 * @title		The title of the element from which we're stripping tags and slashes.
	 */
	private function _strip($obj, $title) {
		return strip_tags(stripslashes($obj[$title]));
	} // end strip
	
	/**
	 * Convenience function for echoing escaping attributes and echoing back
	 * the value.
	 * 
	 * @val	The value from which to escape attributes and echo.
	 */
	private function _ae($val) {
		echo esc_attr($val);
	} // end _ae
	
	/**
	 * Convenience function for getting the field information for the value.
	 * 
	 * @val		The value for which to get field information.
	 * @type	The type of field information to get (either name or ID).
	 */
	private function _gf($val, $type) {
		if(strtolower($type) == 'name') {
			echo $this->get_field_name($val);
		} else if(strtolower($type) == 'id') {
			echo $this->get_field_id($val);
		} // end if/else
	} // end _gf
	
	/**
	 * Convenience function for printing whether or not the specified
	 * value is selected in a select element.
	 *
	 * @instance	The current instance of the widget.
	 * @val				The value to determine the state of its selection.
	 * @i					The current iteration of the loop in which this function is called.
	 */
	private function _is_selected($instance, $val, $i) {
		if($i == $instance[$val]) {
			echo 'selected="selected"';
		} // end if
	} // end _is_selected
	
	/**
	 * Echo's the active or inactive class name for the incoming tab
	 * based on the status of the other tabs.
	 *
	 * @tab				The incoming tab to evaluate
	 * @twitter		The Twitter username
	 * @facebook 	The Facebook username
	 * @rss				The FeedBurner username
	 */
	private function _is_active($tab, $twitter, $facebook, $rss) {
	
		switch(strtolower($tab)) {
		
			case 'twitter':
				if(strlen($twitter) > 0) {
					echo 'active ';
				} else {
					echo 'inactive ';
				} // end if
				break;
				
			case 'facebook':
				if(strlen($twitter) == 0 && strlen($facebook) > 0) {
					echo 'active ';
				} else {
					echo 'inactive ';
				} // end if 
				break;
				
			case 'rss':
				if(strlen($twitter) == 0 && strlen($facebook) == 0 && strlen($rss) > 0) {
					echo 'active ';
				} else {
					echo 'inactive ';
				} // end if 
				break;
				
			default:
				echo 'inactive';
				break;
				
		} // end switch/case
		
	} // end _is_active;
	
	/**
	 * Echo's the fade classname based on whether or not the incoming values
	 * is set.
	 *
	 * @value	The value used to determine if the fade classname should be applied.
	 */
	private function _use_visual_effects($value) {
		if(strlen($value) > 0) {
			echo 'fade';
		} // end if
	} // end _use_visual_effects
	
	/**
	 * Returns data retrieved from the specified URL.
	 *
	 * @url	Thse URL to which we're making the request.
	 */
	private function curl($url) {

		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, '');
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		
		$data = curl_exec($ch);
		if(curl_errno($ch) !== 0 || curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200):
			$data === false;
		endif;
		curl_close($ch);
		
		return $data;
		
	} // end curl
	
} // end class
add_action('widgets_init', create_function('', 'register_widget("TentBlogger_Social_Widget");'));
?>