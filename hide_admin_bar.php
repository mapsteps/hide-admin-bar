<?php
/**
 * Plugin Name: Hide Admin Bar
 * Plugin URI: https://mapsteps.com
 * Description: Hide the WordPress admin bar on the frontend for all users or specific user roles.
 * Version: 2.0
 * Requires at least: 3.5
 * Requires PHP: 5.6
 * Author: David Vongries
 * Author URI: https://mapsteps.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: hide-admin-bar
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Helper constants.
define( 'HIDE_ADMIN_BAR_PLUGIN_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'HIDE_ADMIN_BAR_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'HIDE_ADMIN_BAR_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'HIDE_ADMIN_BAR_PLUGIN_VERSION', '2.0' );

require __DIR__ . '/inc/helpers.php';
require __DIR__ . '/inc/class-save-settings.php';
require __DIR__ . '/inc/class-output.php';
require __DIR__ . '/inc/class-setup.php';

Mapsteps\HideAdminBar\Output::init();
Mapsteps\HideAdminBar\Setup::init();
