<?php
/**
 * Leave a review box.
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );
?>

<div class="heatbox">
	<h2><?php esc_html_e( 'Leave a review', 'hide-admin-bar' ); ?></h2>
	<div class="heatbox-content">
		<p class="description">
			<?php esc_html_e( 'Do you enjoy Hide Admin Bar? Help us spread the word and leave a review in the official WordPress repository.', 'hide-admin-bar' ); ?>
		</p>
		<a href="https://wordpress.org/support/plugin/hide-admin-bar/reviews/#new-post" target="_blank" class="button">
			<?php esc_html_e( 'Sure, you deserve it!', 'hide-admin-bar' ); ?>
			<span class="screen-reader-text"> <?php esc_html_e( '(opens in a new tab)', 'hide-admin-bar' ); ?></span>
		</a>
	</div>
</div>
