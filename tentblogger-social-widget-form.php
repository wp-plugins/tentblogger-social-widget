<!-- Twitter -->
<div class="tentblogger-admin-wrapper">
	<fieldset>
		<legend>
			<?php _e('Twitter', 'tentblogger-social-widget'); ?>
		</legend>
		<label for="twitter_username">
			<?php _e('Username (without "@")', 'tentblogger-social-widget'); ?>
		</label>
		<input type="text" value="<?php $this->_ae($twitter_username); ?>" id="<?php $this->_gf('twitter_username', 'id2'); ?>" name="<?php $this->_gf('twitter_username', 'name'); ?>" class="widefat" />
		<label for="tweet_count">
			<?php _e('Number To Display', 'tentblogger-social-widget'); ?>
		</label>
		<select id="<?php $this->_gf('tweet_count', 'id'); ?>" name="<?php $this->_gf('tweet_count', 'name'); ?>" class="widefat">
			<?php for($i = 1; $i <= 5; $i++) { ?>
				<option <?php $this->_is_selected($instance, 'tweet_count', $i); ?>>
					<?php echo $i; ?>
				</option>
			<?php } // end for ?>
		</select>
		<label for="show_twitter_avatar">
			<?php _e('Show Avatar?', 'tentblogger-social-widget'); ?>
		</label>
		<select id="<?php $this->_gf('show_twitter_avatar', 'id'); ?>" name="<?php $this->_gf('show_twitter_avatar', 'name'); ?>" class="widefat">
			<option <?php $this->_is_selected($instance, 'show_twitter_avatar', 'no'); ?> value="no">
				<?php _e('No', 'tentblogger-social-widget'); ?>
			</option>
			<option <?php $this->_is_selected($instance, 'show_twitter_avatar', 'yes'); ?> value="yes">
				<?php _e('Yes', 'tentblogger-social-widget'); ?>
			</option>
		</select>
	</fieldset>
</div>
<!-- /Twitter -->

<!-- RSS -->
<div class="tentblogger-admin-wrapper">
	<fieldset>
		<legend>
			<?php _e('RSS', 'tentblogger-social-widget'); ?>
		</legend>
		<label for="feedburner_username">
			<?php _e('FeedBurner Username (<a href="http://feedburner.google.com/fb/a/myfeeds" target="_blank">Find Yours</a>)', 'tentblogger-social-widget'); ?>
		</label>
		<input type="text" value="<?php $this->_ae($feedburner_username); ?>" id="<?php $this->_gf('feedburner_username', 'id'); ?>" name="<?php $this->_gf('feedburner_username', 'name'); ?>" class="widefat" />
		<label for="feed_count">
			<?php _e('Number To Display', 'tentblogger-social-widget'); ?>
		</label>
		<select id="<?php $this->_gf('feed_count', 'id'); ?>" name="<?php $this->_gf('feed_count', 'name'); ?>" class="widefat">
			<?php for($i = 1; $i <= 5; $i++) { ?>
				<option <?php $this->_is_selected($instance, 'feed_count', $i); ?>>
					<?php echo $i; ?>
				</option>
			<?php } // end for ?>
		</select>
	</fieldset>
</div>
<!-- /RSS -->

<!-- Facebook -->
<div class="tentblogger-admin-wrapper">
	<fieldset>
		<legend>
			<?php _e('Facebook', 'tentblogger-social-widget'); ?>
		</legend>
		<label for="facebook_id">
			<?php _e('Badge Code (<a href="http://www.facebook.com/badges/profile.php" target="_blank">Profile</a>, <a href="https://developers.facebook.com/docs/reference/plugins/like-box" target="_blank">Fan Page</a>)', 'tentblogger-social-widget'); ?>
		</label>
		<input type="text" value="<?php $this->_ae($facebook_badge); ?>" id="<?php $this->_gf('facebook_badge', 'id'); ?>" name="<?php $this->_gf('facebook_badge', 'name'); ?>" class="widefat" />
	</fieldset>
</div>
<!-- /Facebook -->

<!-- Display Options -->
<div class="tentblogger-admin-wrapper">
	<fieldset>
		<legend>
			<?php _e('Display Options', 'tentblogger-social-widget'); ?>
		</legend>
		<div>
			<input type="checkbox" id="<?php $this->_gf('use_visual_effects', 'id'); ?>" name="<?php $this->_gf('use_visual_effects', 'name'); ?>" <?php if($instance['use_visual_effects'] == 'on') { echo 'checked="checked"'; } ?> />
			<label for="use_visual_effects">
				<?php _e('Use Fade Effect on Tabs?', 'tentblogger-social-widget'); ?>
			</label>
		</div>
		<div>
			<input type="checkbox" id="<?php $this->_gf('display_tentblogger_image', 'id'); ?>" name="<?php $this->_gf('display_tentblogger_image', 'name'); ?>" <?php if($instance['display_tentblogger_image'] == 'on') { echo 'checked="checked"'; } ?> />
			<label for="use_visual_effects">
				<?php _e('Display TentBlogger Banner?', 'tentblogger-social-widget'); ?>
			</label>
		</div>
	</fieldset>
</div>
<!-- /Display Options -->