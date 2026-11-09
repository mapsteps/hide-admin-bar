<?php
/**
 * Better Admin Bar promo box.
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Admins who can install plugins go straight to the install screen.
$hide_admin_bar_bab_url    = current_user_can( 'install_plugins' ) ? admin_url( 'plugin-install.php?s=better+admin+bar&tab=search&type=term' ) : 'https://wordpress.org/plugins/better-admin-bar/';
$hide_admin_bar_bab_target = current_user_can( 'install_plugins' ) ? '_self' : '_blank';
?>

<div class="heatbox">
	<a href="<?php echo esc_url( $hide_admin_bar_bab_url ); ?>" target="<?php echo esc_attr( $hide_admin_bar_bab_target ); ?>" aria-hidden="true" tabindex="-1">
		<img src="<?php echo esc_url( HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/img/sidebar-banner.png' ); ?>" alt="">
	</a>
	<div class="heatbox-content">
		<h3><?php esc_html_e( 'Don\'t just hide the admin bar. Replace it!', 'hide-admin-bar' ); ?></h3>
		<p class="description">
			<?php esc_html_e( 'Better Admin Bar replaces the WordPress admin bar with a clean quick access panel your clients will love. Free on WordPress.org.', 'hide-admin-bar' ); ?>
		</p>
		<a href="<?php echo esc_url( $hide_admin_bar_bab_url ); ?>" target="<?php echo esc_attr( $hide_admin_bar_bab_target ); ?>" class="button button-primary">
			<?php esc_html_e( 'Get Better Admin Bar', 'hide-admin-bar' ); ?>
			<?php if ( '_blank' === $hide_admin_bar_bab_target ) : ?>
				<span class="screen-reader-text"> <?php esc_html_e( '(opens in a new tab)', 'hide-admin-bar' ); ?></span>
			<?php endif; ?>
		</a>
	</div>
</div>
