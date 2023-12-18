<?php
/**
 * Setup Hide Admin Bar.
 *
 * @package Hide_Admin_Bar
 */

namespace Mapsteps\HideAdminBar;

use Mapsteps\HideAdminBar\Ajax\SaveSettingsAction;

/**
 * Setup Hide Admin Bar.
 */
class Setup {

	/**
	 * Whether to remove admin bar for current user.
	 *
	 * @var bool
	 */
	public static $remove_admin_bar = false;

	/**
	 * The class instance.
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Get instance of the class.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	/**
	 * Init the class setup.
	 */
	public static function init() {

		self::$instance = new self();

		add_action( 'plugins_loaded', array( self::$instance, 'setup' ) );

	}

	/**
	 * Check if we're on the BAB settings page.
	 *
	 * @return bool
	 */
	private function is_settings_page() {

		$current_screen = get_current_screen();

		return ( 'settings_page_hide-admin-bar' === $current_screen->id ? true : false );
	}

	/**
	 * Setup action & filters.
	 */
	public function setup() {

		add_action( 'init', array( $this, 'setup_text_domain' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 999 );
		add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
		add_filter( 'admin_body_class', array( $this, 'admin_body_class' ), 20 );
		add_action( 'wp', array( $this, 'remove_admin_bar' ) );

		add_filter( 'plugin_action_links', array( $this, 'add_settings_link' ), 10, 4 );

		// Ajax.
		add_action( 'wp_ajax_hide_admin_bar_save_settings', array( new SaveSettingsAction(), 'ajax' ) );

	}

	/**
	 * Setup textdomain.
	 */
	public function setup_text_domain() {

		load_plugin_textdomain( 'hide-admin-bar', false, HIDE_ADMIN_BAR_PLUGIN_DIR . '/languages' );

	}

	/**
	 * Enqueue admin styles & scripts.
	 */
	public function admin_scripts() {

		if ( ! $this->is_settings_page() ) {
			return;
		}

		// Select2.
		wp_enqueue_style( 'select2', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/css/select2.min.css', array(), HIDE_ADMIN_BAR_PLUGIN_VERSION );

		// Settings page styling.
		wp_enqueue_style( 'heatbox', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/css/heatbox.css', array(), HIDE_ADMIN_BAR_PLUGIN_VERSION );

		// Hide Admin Bar admin styling.
		wp_enqueue_style( 'hide-admin-bar-settings', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/css/settings-page.css', array(), HIDE_ADMIN_BAR_PLUGIN_VERSION );

		// Select2.
		wp_enqueue_script( 'select2', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/js/select2.min.js', array( 'jquery' ), HIDE_ADMIN_BAR_PLUGIN_VERSION, true );

		wp_enqueue_script( 'hide-admin-bar-settings', HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/js/settings-page.js', array( 'jquery' ), HIDE_ADMIN_BAR_PLUGIN_VERSION, true );

		wp_localize_script(
			'hide-admin-bar-settings',
			'HideAdminBar',
			array(
				'labels' => array(
					'edit' => __( 'Edit', 'hide-admin-bar' ),
					'save' => __( 'Save', 'hide-admin-bar' ),
				),
			)
		);
	}

	/**
	 * Add settings link to plugin list page.
	 *
	 * @param array $actions An array of plugin action links.
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 * @param array $plugin_data An array of plugin data. See `get_plugin_data()`.
	 * @param string $context The plugin context. By default this can include 'all', 'active', 'inactive',
	 *                            'recently_activated', 'upgrade', 'mustuse', 'dropins', and 'search'.
	 *
	 * @return array The modified plugin action links.
	 */
	public function add_settings_link( $actions, $plugin_file, $plugin_data, $context ) {

		if ( HIDE_ADMIN_BAR_PLUGIN_BASENAME === $plugin_file ) {
			$settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=hide-admin-bar' ) ) . '">' . __( 'Settings', 'hide-admin-bar' ) . '</a>';

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
			'delete_others_posts',
			'hide-admin-bar',
			array(
				$this,
				'settings_page_output',
			)
		);

	}

	/**
	 * Hide Admin Bar settings page output.
	 */
	public function settings_page_output() {

		require __DIR__ . '/templates/settings-page.php';

	}

	/**
	 * Modify admin body class.
	 *
	 * @param string $classes The class names.
	 */
	public function admin_body_class( $classes ) {

		$current_user = wp_get_current_user();
		$classes      .= ' hide-admin-bar-user-' . $current_user->user_nicename;

		$roles = $current_user->roles;
		$roles = $roles ?: array();

		foreach ( $roles as $role ) {
			$classes .= ' hide-admin-bar-role-' . $role;
		}

		if ( ! $this->is_settings_page() ) {
			return $classes;
		}

		$classes .= ' heatbox-admin has-header';

		return $classes;

	}

	/**
	 * Remove admin bar on the frontend for certain roles.
	 */
	public function remove_admin_bar() {

		$admin_bar_settings = hide_admin_bar_get_admin_bar_settings();

		if ( empty( $admin_bar_settings['remove_by_roles'] ) ) {
			return;
		}

		$selected_roles = $admin_bar_settings['remove_by_roles'];

		if ( in_array( 'all', $admin_bar_settings['remove_by_roles'], true ) ) {
			self::$remove_admin_bar = true;

			add_filter( 'show_admin_bar', '__return_false' );

			return;
		}

		$current_user = wp_get_current_user();

		foreach ( $current_user->roles as $role ) {
			if ( in_array( $role, $selected_roles, true ) ) {
				self::$remove_admin_bar = true;

				add_filter( 'show_admin_bar', '__return_false' );
				break;
			}
		}

	}

}
