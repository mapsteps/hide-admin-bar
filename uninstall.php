<?php
/**
 * Runs when the plugin is deleted.
 *
 * @package Hide_Admin_Bar
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || die( "Can't access directly" );

if ( is_multisite() && function_exists( 'get_sites' ) ) {
	foreach ( get_sites( array(
		'fields' => 'ids',
		'number' => 0,
	) ) as $hide_admin_bar_site_id ) {
		delete_blog_option( $hide_admin_bar_site_id, 'hab_admin_bar_settings' );
	}
} else {
	delete_option( 'hab_admin_bar_settings' );
}
