<![CDATA[ TentBlogger Social Widget 2.0 ]]>
<!-- Tabs -->
<div class="tentblogger-tabs">

		<?php if(strlen($twitter_username) > 0) { ?>
			<img src="<?php echo WP_PLUGIN_URL . '/tentblogger-social-widget/images/twitter.png' ?>" alt="<?php _e('Twitter', 'tentblogger-social-icons'); ?>" class="<?php $this->_is_active('twitter', $twitter_username, $facebook_badge, $feedburner_username); ?> tentblogger-social-twitter" />
		<?php } // end if ?>
		
		<?php if(strlen($facebook_badge) > 0) { ?>
			<img src="<?php echo WP_PLUGIN_URL . '/tentblogger-social-widget/images/facebook.png' ?>" alt="<?php _e('Facebook', 'tentblogger-social-icons'); ?>" class="<?php $this->_is_active('facebook', $twitter_username, $facebook_badge, $feedburner_username); ?> tentblogger-social-facebook"/>	
		<?php } // end if ?>
		
		<?php if(strlen($feedburner_username) > 0) { ?>
			<img src="<?php echo WP_PLUGIN_URL . '/tentblogger-social-widget/images/rss.png' ?>" alt="<?php _e('RSS', 'tentblogger-social-icons'); ?>" class="<?php $this->_is_active('rss', $twitter_username, $facebook_badge, $feedburner_username); ?> tentblogger-social-rss" />
		<?php } // end if ?>
		
</div>
<!-- /Tabs -->

<div class="tentblogger-content-wrapper">
	<!-- Twitter -->
	<?php if(strlen($twitter_username) != 0) { ?>
		<ul class="tentblogger-social-twitter active <?php $this->_use_visual_effects($use_visual_effects); ?>">
			<?php $this->get_twitter_feed($twitter_username, $show_twitter_avatar, $tweet_count); ?>
			<li class="tentblogger-follow-link">
				<a href="http://twitter.com/<?php echo $twitter_username; ?>">
					<?php _e('Follow Me', 'tentblogger-social-widget'); ?>
				</a>
			</li>
		</ul>
	<?php } // end if ?>
	<!-- /Twitter -->

	<!-- Facebook -->
	<?php if(strlen($facebook_badge) != 0) { ?>
		<ul class="tentblogger-social-facebook <?php $this->_is_active('facebook', $twitter_username, $facebook_badge, $feedburner_username); $this->_use_visual_effects($use_visual_effects); ?>">
			<?php echo '<li>' . $facebook_badge . '</li>'; ?>
		</ul>
	<?php } // end if ?>
	<!-- /Facebook -->
	
	<!-- RSS -->
	<?php if(strlen($feedburner_username) != 0) { ?>
		<ul class="tentblogger-social-rss <?php $this->_is_active('rss', $twitter_username, $facebook_badge, $feedburner_username); $this->_use_visual_effects($use_visual_effects); ?>">
		<?php $this->get_feedburner_feed($feedburner_username, $feed_count); ?>
		</ul>
	<?php } // end if ?>
	<!-- /RSS -->
</div>
<?php if($display_tentblogger_image) { ?>
	<div class="tentblogger-social-banner">
		<a href="http://tentblogger.com">
			<img src="<?php echo WP_PLUGIN_URL . '/tentblogger-social-widget/images/are-you-a-tentblogger.png' ?>" alt="TentBlogger" />
		</a>
	</div>
<?php } // end if ?>