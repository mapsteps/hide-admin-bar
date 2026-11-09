<?php
/**
 * Save the settings via ajax.
 *
 * @package Hide_Admin_Bar
 */

namespace Mapsteps\HideAdminBar;

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Ajax handler of the settings form.
 */
class SaveSettings {

	/**
	 * Register the ajax action.
	 */
	public function __construct() {

		add_action( 'wp_ajax_hide_admin_bar_save_settings', array( $this, 'save' ) );

	}

	/**
	 * Save the settings. An empty selection shows the admin bar to everyone.
	 */
	public function save() {

		if ( ! check_ajax_referer( 'hide_admin_bar_save_settings', 'nonce', false ) ) {
			wp_send_json_error( __( 'Invalid token', 'hide-admin-bar' ), 401 );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( __( 'You are not allowed to do this', 'hide-admin-bar' ), 403 );
		}

		$roles = isset( $_POST['remove_by_roles'] ) ? wp_unslash( $_POST['remove_by_roles'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Sanitized below.

		update_option( 'hab_admin_bar_settings', array( 'remove_by_roles' => hide_admin_bar_sanitize_roles( $roles ) ) );

		wp_send_json_success( __( 'Settings saved', 'hide-admin-bar' ) );

	}

}
