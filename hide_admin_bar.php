<?php
/** 
 * Plugin Name: Hide Admin Bar
 * Plugin URI: https://wordpress.org/plugins/hide-admin-bar/
 * Description: Hides the Admin Bar in WordPress 3.1+.
 * Version: 0.5
 * Requires at least: 3.1
 * Requires PHP: 5.6
 * Author: David Vongries
 * Author URI: https://davidvongries.com/
 * Text Domain: hide-admin-bar
 *
 * @package Hide_Admin_Bar
 */

/**
 * Hide admin bar preferences in the users profile.
 */
function hide_admin_bar_prefs() {

	?>
	<style type="text/css">
		.show-admin-bar {display: none;}
	</style>
	<?php

}
add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_prefs' );

/**
 * Disable admin bar.
 */
add_filter( 'show_admin_bar', '__return_false' );
