<?php
/**
 * Plugin Name: Hide Admin Bar
 * Plugin URI: https://wordpress.org/plugins/hide-admin-bar/
 * Description: Hides the Admin Bar in WordPress 3.1+.
 * Version: 1.0.1
 * Requires at least: 3.1
 * Requires PHP: 5.6
 * Author: David Vongries
 * Author URI: https://davidvongries.com/
 * Text Domain: hide-admin-bar
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Helper constants.
define( 'HIDE_ADMIN_BAR_PLUGIN_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'HIDE_ADMIN_BAR_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'HIDE_ADMIN_BAR_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'HIDE_ADMIN_BAR_PLUGIN_VERSION', '1.0.1' );

require __DIR__ . '/helpers.php';
require __DIR__ . '/vendor/autoload.php';

Mapsteps\HideAdminBar\Setup::init();
