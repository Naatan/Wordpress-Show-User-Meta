<?php

/*
Plugin Name: Show User Meta
Plugin URI: http://wordpress.org/
Description: Shows user meta data when editing a profile
Version: 0.1
Author: Nathan Rijksen
Author URI: http://naatan.com/
 */

class Show_user_meta
{
	
	/**
	 * Constructor
	 * 
	 * @returns	void					
	 */
	function __construct()
	{
		$this->register_hooks();
	}
	
	/**
	 * Register hooks
	 * 
	 * @returns	void							
	 */
	function register_hooks()
	{
		add_action('edit_user_profile', array($this, 'show_meta'));
		
	}
	
	/**
	 * Show the user meta info
	 * 
	 * @returns	void							
	 */
	function show_meta()
	{
		global $user_id;
		$meta = get_metadata('user',$user_id);
		
		$defaults = array('first_name','last_name','nickname','description','rich_editing','comment_shortcuts','admin_color','use_ssl','show_admin_bar_front');
		
		foreach ($defaults AS $default)
		{
			if (isset($meta[$default]))
			{
				unset($meta[$default]);
			}
		}
		
		if (count($meta)==0)
		{
			return;
		}
		
		?>
		<h3><?php _e('User Meta', 'show-user-meta'); ?></h3>
		<table class="form-table">
		<?php
		
		foreach ($meta AS $k => $v)
		{
		
			?>
				<tr>
					<th><label for="meta_<?php echo $k ?>"><?php echo $k ?></label></th>
					<td><input class="regular-text" name="meta_<?php echo $k ?>" id="meta_<?php echo $k ?>" value="<?php echo htmlentities($v[0]); ?>" readonly="readonly"/>
				</tr>
			<?php
		}
		
		?>
		</table>
		<?php
	}
	
}

new Show_user_meta;