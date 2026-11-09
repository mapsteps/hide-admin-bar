<?php
/**
 * Runs when the plugin is deleted.
 *
 * @package Hide_Admin_Bar
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || die( "Can't access directly" );

delete_option( 'hab_admin_bar_settings' );
