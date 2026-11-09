<?php
/**
 * Admin side: settings page & assets.
 *
 * @package Hide_Admin_Bar
 */

namespace Mapsteps\HideAdminBar;

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Setup Hide Admin Bar.
 */
class Setup {

	/**
	 * Hook in once all plugins are loaded.
	 */
	public static function init() {

		add_action( 'plugins_loaded', array( new self(), 'setup' ) );

	}

	/**
	 * Register the action & filter hooks.
	 */
	public function setup() {

		add_filter( 'plugin_action_links', array( $this, 'add_settings_link' ), 10, 2 );
		add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_filter( 'admin_body_class', array( $this, 'admin_body_class' ), 20 );

		new SaveSettings();

	}

	/**
	 * Check if we're on the settings page.
	 *
	 * @return bool
	 */
	private function is_settings_page() {

		$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

		return $current_screen && 'settings_page_hide-admin-bar' === $current_screen->id;

	}

	/**
	 * Add settings link to plugin list page.
	 *
	 * @param array  $actions     An array of plugin action links.
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 *
	 * @return array The modified plugin action links.
	 */
	public function add_settings_link( $actions, $plugin_file ) {

		if ( HIDE_ADMIN_BAR_PLUGIN_BASENAME === $plugin_file && current_user_can( 'manage_options' ) ) {
			$settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=hide-admin-bar' ) ) . '">' . esc_html__( 'Settings', 'hide-admin-bar' ) . '</a>';

			array_unshift( $actions, $settings_link );
		}

		return $actions;

	}

	/**
	 * Add submenu under "Settings" menu item.
	 */
	public function add_submenu_page() {

		add_options_page(
			__( 'Hide Admin Bar', 'hide-admin-bar' ),
			__( 'Hide Admin Bar', 'hide-admin-bar' ),
			'manage_options',
			'hide-admin-bar',
			array( $this, 'settings_page_output' )
		);

	}

	/**
	 * Settings page output.
	 */
	public function settings_page_output() {

		$admin_bar_settings = hide_admin_bar_get_admin_bar_settings();
		$roles              = hide_admin_bar_get_roles();

		require HIDE_ADMIN_BAR_PLUGIN_DIR . '/templates/settings-page.php';

	}

	/**
	 * Enqueue the settings page styles & scripts.
	 */
	public function admin_scripts() {

		if ( ! $this->is_settings_page() ) {
			return;
		}

		wp_enqueue_style( 'heatbox', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/css/heatbox.css', array(), HIDE_ADMIN_BAR_PLUGIN_VERSION );
		wp_enqueue_style( 'hide-admin-bar-settings', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/css/settings-page.css', array( 'heatbox' ), HIDE_ADMIN_BAR_PLUGIN_VERSION );

		wp_enqueue_script( 'hide-admin-bar-settings', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/js/settings-page.js', array( 'jquery' ), HIDE_ADMIN_BAR_PLUGIN_VERSION, true );

		wp_localize_script(
			'hide-admin-bar-settings',
			'HideAdminBar',
			array(
				'nonce' => wp_create_nonce( 'hide_admin_bar_save_settings' ),
				'i18n'  => array(
					'saved' => __( 'Settings saved', 'hide-admin-bar' ),
					'error' => __( 'Something went wrong. Please try again.', 'hide-admin-bar' ),
				),
			)
		);

	}

	/**
	 * Add the user & role classes to every admin page, and the heatbox classes to the settings page.
	 *
	 * @param string $classes The class names.
	 *
	 * @return string The class names.
	 */
	public function admin_body_class( $classes ) {

		$current_user = wp_get_current_user();

		$classes .= ' hide-admin-bar-user-' . sanitize_html_class( $current_user->user_nicename );

		foreach ( (array) $current_user->roles as $role ) {
			$classes .= ' hide-admin-bar-role-' . sanitize_html_class( $role );
		}

		if ( $this->is_settings_page() ) {
			$classes .= ' heatbox-admin has-header';
		}

		return $classes;

	}

}
