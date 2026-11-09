<?php
/**
 * Hide the admin bar on the frontend.
 *
 * @package Hide_Admin_Bar
 */

namespace Mapsteps\HideAdminBar;

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Frontend output.
 */
class Output {

	/**
	 * Hook in.
	 */
	public static function init() {

		add_filter( 'show_admin_bar', array( new self(), 'show_admin_bar' ), 20 );

	}

	/**
	 * Hide the admin bar for the selected roles.
	 *
	 * @param bool $show Whether to show the admin bar.
	 *
	 * @return bool Whether to show the admin bar.
	 */
	public function show_admin_bar( $show ) {

		if ( ! $show || is_admin() ) {
			return $show;
		}

		$selected_roles = hide_admin_bar_get_admin_bar_settings()['remove_by_roles'];

		if ( in_array( 'all', $selected_roles, true ) ) {
			return false;
		}

		$user_roles = (array) wp_get_current_user()->roles;

		return array_intersect( $user_roles, $selected_roles ) ? false : $show;

	}

}
