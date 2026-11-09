<?php
/**
 * Utility functions for Hide Admin Bar.
 *
 * @package Hide_Admin_Bar
 */

/**
 * Get admin bar settings.
 *
 * @return array The admin bar settings.
 */
function hide_admin_bar_get_admin_bar_settings() {

	$saved_settings  = get_option( 'hab_admin_bar_settings', array() );
	$remove_by_roles = array();

	$remove_by_roles[] = 'all';

	if ( isset( $saved_settings['remove_by_roles'] ) ) {
		$remove_by_roles = $saved_settings['remove_by_roles'] ? $saved_settings['remove_by_roles'] : array();
	}

	return array(
		'remove_by_roles' => $remove_by_roles,
	);

}

/**
 * Get pro features.
 *
 * @return array The pro features.
 */
function hide_admin_bar_get_pro_features() {

	return array(
		'custom'        => array(
			'text'        => __( 'Custom Controls', 'hide-admin-bar' ),
			'description' => __( 'Add Custom Controls to your Quick Access Panel.', 'hide-admin-bar' ),
		),
		'page_builders' => array(
			'text'        => __( 'Page Builder Support', 'hide-admin-bar' ),
			'description' => __( 'Better Admin Bar PRO will automatically detect and launch the respective page builder if your page was created in Elementor, Brizy, Divi, Oxygen or Beaver Builder.', 'hide-admin-bar' ),
		),
		'cpt'           => array(
			'text'        => __( 'Custom Post Type Support', 'hide-admin-bar' ),
			'description' => __( 'Better Admin Bar PRO automatically detects registered post types and provides you with the necessary controls.', 'hide-admin-bar' ),
		),
		'multisite'     => array(
			'text'        => __( 'Multisite Support', 'hide-admin-bar' ),
			'description' => __( 'Better Admin Bar PRO is 100% multisite compatible. Configure the Quick Access Panel from the main site of your network and your changes will apply to all subsites.', 'hide-admin-bar' ),
		),
		'access'        => array(
			'text'        => __( 'User Role Access', 'hide-admin-bar' ),
			'description' => __( 'Restrict Quick Access Panel controls to specific User Roles with Better Admin Bar PRO.', 'hide-admin-bar' ),
		),
	);

}
