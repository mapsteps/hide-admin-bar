<?php
/**
 * Ajax class to manage ajax request of saving settings.
 *
 * @package Better_Admin_Bar
 */

namespace Mapsteps\HideAdminBar\Ajax;

/**
 * Ajax class to manage ajax request of saving settings.
 */
class SaveSettingsAction {

	/**
	 * All available fields.
	 *
	 * @var array
	 */
	private $fields = array(
		'remove_by_roles',
	);

	/**
	 * Allowed empty fields.
	 *
	 * @var array
	 */
	private $empty_allowed = array();

	/**
	 * Admin bar setting fields.
	 *
	 * @var array
	 */
	private $admin_bar_setting_fields = array(
		'remove_by_roles',
	);

	/**
	 * Sanitized data.
	 *
	 * @var array
	 */
	private $data = array();

	/**
	 * Ajax handler.
	 */
	public function ajax() {
		$this->sanitize();
		$this->validate();
		$this->save();
	}

	/**
	 * Sanitize the data.
	 */
	public function sanitize() {
		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				if ( 'remove_by_roles' === $field ) {
					$roles = array();

					foreach ( $_POST[ $field ] as $role ) {
						$roles[] = sanitize_text_field( $role );
					}

					$this->data[ $field ] = $roles;
				} else {
					$this->data[ $field ] = sanitize_text_field( $_POST[ $field ] );
					$this->data[ $field ] = 'new_tab' === $field ? absint( $this->data[ $field ] ) : $this->data[ $field ];
				}
			}
		}
	}

	/**
	 * Validate the data.
	 */
	public function validate() {
		// Check if nonce is incorrect.
		if ( ! check_ajax_referer( HIDE_ADMIN_BAR_PLUGIN_DIR . '_settings_nonce', 'nonce', false ) ) {
			wp_send_json_error( __( 'Invalid token', 'hide-admin-bar' ) );
		}

		// CHeck if current user has the capability to run this action.
		if ( ! current_user_can( 'delete_others_posts' ) ) {
			wp_send_json_error( __( 'You do not have permission to do this', 'hide-admin-bar' ) );
		}

		// Check if there is empty field.
		foreach ( $this->fields as $field ) {
			if ( ! in_array( $field, $this->empty_allowed, true ) ) {
				if ( ! isset( $this->data[ $field ] ) || empty( $this->data[ $field ] ) ) {
					$field_name = str_ireplace( '_', ' ', $field );
					$field_name = ucfirst( $field_name );

					wp_send_json_error( $field_name . ' ' . __( 'is empty', 'hide-admin-bar' ) );
				}
			}
		}
	}

	/**
	 * Save the data.
	 */
	public function save() {
		$admin_bar_settings = array();

		foreach ( $this->admin_bar_setting_fields as $field ) {
			if ( isset( $this->data[ $field ] ) ) {
				$admin_bar_settings[ $field ] = $this->data[ $field ];
			}
		}

		update_option( 'hab_admin_bar_settings', $admin_bar_settings );

		wp_send_json_success( __( 'The settings are saved' ), 'hide-admin-bar' );
	}
}
