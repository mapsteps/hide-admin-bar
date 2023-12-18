<?php
/**
 * Settings page template.
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="wrap heatbox-wrap hide-admin-bar-settings">

	<div class="heatbox-header heatbox-margin-bottom">

		<div class="heatbox-container heatbox-container-center">

			<div class="logo-container">

				<div>
					<span class="title">
						<?php echo esc_html( get_admin_page_title() ); ?>
						<span class="version"><?php echo esc_html( HIDE_ADMIN_BAR_PLUGIN_VERSION ); ?></span>
					</span>
					<p class="subtitle">
						<?php _e( 'The #1 plugin to hide the WordPress Admin Bar.', 'hide-admin-bar' ); ?>
					</p>
				</div>

				<div>
				</div>

			</div>

		</div>

	</div>

	<div class="heatbox-container heatbox-container-center heatbox-column-container">

		<?php settings_fields( 'hide-admin-bar-settings-group' ); ?>

		<div class="heatbox-main">

			<!-- Faking H1 tag to place admin notices -->
			<h1 style="display: none;"></h1>

			<form method="post" action="options.php" class="hide-admin-bar-settings-form">

				<div class="saved-status-bar"><?php _e( 'Your settings have been saved.', 'hide-admin-bar' ); ?></div>

				<input type="hidden" name="hide_admin_bar_settings_nonce"
					   value="<?= esc_attr( wp_create_nonce( HIDE_ADMIN_BAR_PLUGIN_DIR . '_settings_nonce' ) ) ?>">

				<?php require_once __DIR__ . '/metaboxes/settings-metabox.php' ?>

				<p class="submit">
					<button type="button" name="submit" id="submit"
							class="button button-primary button-larger save-general-settings" value="Save Changes">
						<?php _e( 'Save Changes', 'hide-admin-bar' ); ?>
					</button>
				</p>

			</form>

		</div>

		<div class="heatbox-sidebar">

			<?php
			require __DIR__ . '/metaboxes/review-metabox.php';
			?>

		</div>

		<div class="heatbox-divider"></div>


		<div class="heatbox-container heatbox-container-wide heatbox-container-center featured-products">

			<h2><?php _e( 'Check out our other free WordPress products!', 'hide-admin-bar' ); ?></h2>

			<ul class="products">
				<li class="heatbox">
					<a href="https://wordpress.org/plugins/ultimate-dashboard/" target="_blank">
						<img
							src="<?php echo esc_url( HIDE_ADMIN_BAR_PLUGIN_URL ); ?>/assets/images/ultimate-dashboard.jpg">
					</a>
					<div class="heatbox-content">
						<h3><?php _e( 'Ultimate Dashboard', 'hide-admin-bar' ); ?></h3>
						<p class="subheadline"><?php _e( 'Fully customize your WordPress Dashboard.', 'hide-admin-bar' ); ?></p>
						<p><?php _e( 'Ultimate Dashboard is the #1 plugin to create a Custom WordPress Dashboard for you and your clients. It also comes with Multisite Support which makes it the perfect plugin for your WaaS network.', 'hide-admin-bar' ); ?></p>
						<a href="https://wordpress.org/plugins/ultimate-dashboard/" target="_blank"
						   class="button"><?php _e( 'View Features', 'hide-admin-bar' ); ?></a>
					</div>
				</li>
				<li class="heatbox">
					<a href="https://wordpress.org/themes/page-builder-framework/" target="_blank">
						<img
							src="<?php echo esc_url( HIDE_ADMIN_BAR_PLUGIN_URL ); ?>/assets/images/page-builder-framework.jpg">
					</a>
					<div class="heatbox-content">
						<h3><?php _e( 'Page Builder Framework', 'hide-admin-bar' ); ?></h3>
						<p class="subheadline"><?php _e( 'The only Theme you\'ll ever need.', 'hide-admin-bar' ); ?></p>
						<p class="description"><?php _e( 'With its minimalistic design the Page Builder Framework theme is the perfect foundation for your next project. Build blazing fast websites with a theme that is easy to use, lightweight & highly customizable.', 'hide-admin-bar' ); ?></p>
						<a href="https://wordpress.org/themes/page-builder-framework/" target="_blank"
						   class="button"><?php _e( 'View Features', 'hide-admin-bar' ); ?></a>
					</div>
				</li>
				<li class="heatbox">
					<a href="https://wordpress.org/plugins/responsive-youtube-vimeo-popup/" target="_blank">
						<img src="<?php echo esc_url( HIDE_ADMIN_BAR_PLUGIN_URL ); ?>/assets/images/wp-video-popup.jpg">
					</a>
					<div class="heatbox-content">
						<h3><?php _e( 'WP Video Popup', 'hide-admin-bar' ); ?></h3>
						<p class="subheadline"><?php _e( 'The #1 Video Popup Plugin for WordPress.', 'hide-admin-bar' ); ?></p>
						<p><?php _e( 'Add beautiful responsive YouTube & Vimeo video lightbox popups to any post, page or custom post type of website without sacrificing performance.', 'hide-admin-bar' ); ?></p>
						<a href="https://wordpress.org/plugins/responsive-youtube-vimeo-popup/" target="_blank"
						   class="button"><?php _e( 'View Features', 'hide-admin-bar' ); ?></a>
					</div>
				</li>
			</ul>

			<p class="credit"><?php _e( 'Made with ❤ in Torsby, Sweden', 'hide-admin-bar' ); ?></p>

		</div>

	</div>

</div>
