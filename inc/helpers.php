<?php
/**
 * Helper functions.
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Get the admin bar settings.
 *
 * Before the settings are saved for the first time, the admin bar is hidden for everyone.
 *
 * @return array The settings. "remove_by_roles" holds role keys or "all".
 */
function hide_admin_bar_get_admin_bar_settings() {

	$saved_settings = get_option( 'hab_admin_bar_settings', array() );

	if ( ! is_array( $saved_settings ) || ! isset( $saved_settings['remove_by_roles'] ) ) {
		return array( 'remove_by_roles' => array( 'all' ) );
	}

	return array(
		'remove_by_roles' => is_array( $saved_settings['remove_by_roles'] ) ? $saved_settings['remove_by_roles'] : array(),
	);

}

/**
 * Keep only "all" or existing role keys.
 *
 * @param mixed $roles The submitted roles.
 *
 * @return array The sanitized roles.
 */
function hide_admin_bar_sanitize_roles( $roles ) {

	if ( ! is_array( $roles ) ) {
		return array();
	}

	$roles = array_map( 'sanitize_text_field', array_filter( $roles, 'is_string' ) );

	if ( in_array( 'all', $roles, true ) ) {
		return array( 'all' );
	}

	return array_values( array_intersect( $roles, array_keys( hide_admin_bar_get_roles() ) ) );

}

/**
 * Get the user roles of the site.
 *
 * @return array Role names, keyed by role.
 */
function hide_admin_bar_get_roles() {

	$roles = new WP_Roles();

	return $roles->role_names;

}
