<?php
/**
 * Settings page template.
 *
 * Included from Setup::settings_page_output(), $admin_bar_settings holds the settings, $roles the site's roles.
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

$hide_admin_bar_all      = in_array( 'all', $admin_bar_settings['remove_by_roles'], true );
$hide_admin_bar_products = array(
	array(
		'url'         => 'https://wordpress.org/plugins/better-admin-bar/',
		'image'       => 'better-admin-bar.jpg',
		'title'       => __( 'Better Admin Bar', 'hide-admin-bar' ),
		'subheadline' => __( 'Replace the boring WordPress admin bar!', 'hide-admin-bar' ),
		'text'        => __( 'Better Admin Bar is the plugin that makes your clients love WordPress. It drastically improves the user experience when working with WordPress and allows you to replace the boring WordPress admin bar with your own navigation panel.', 'hide-admin-bar' ),
	),
	array(
		'url'         => 'https://wordpress.org/plugins/ultimate-dashboard/',
		'image'       => 'ultimate-dashboard.jpg',
		'title'       => __( 'Ultimate Dashboard', 'hide-admin-bar' ),
		'subheadline' => __( 'Fully customize your WordPress dashboard.', 'hide-admin-bar' ),
		'text'        => __( 'Ultimate Dashboard is the #1 plugin to create a custom WordPress dashboard for you and your clients. It also comes with multisite support which makes it the perfect plugin for your WaaS network.', 'hide-admin-bar' ),
	),
	array(
		'url'         => 'https://wordpress.org/themes/page-builder-framework/',
		'image'       => 'page-builder-framework.jpg',
		'title'       => __( 'Page Builder Framework', 'hide-admin-bar' ),
		'subheadline' => __( 'The only theme you\'ll ever need.', 'hide-admin-bar' ),
		'text'        => __( 'With its minimalistic design the Page Builder Framework theme is the perfect foundation for your next project. Build blazing fast websites with a theme that is easy to use, lightweight & highly customizable.', 'hide-admin-bar' ),
	),
);
?>

<div class="wrap heatbox-wrap hide-admin-bar-settings">

	<div class="heatbox-header heatbox-margin-bottom">

		<div class="heatbox-container heatbox-container-center">

			<div class="logo-container">

				<div>
					<h1 class="title">
						<?php echo esc_html( get_admin_page_title() ); ?>
						<span class="version"><?php echo esc_html( HIDE_ADMIN_BAR_PLUGIN_VERSION ); ?></span>
					</h1>
					<p class="subtitle"><?php esc_html_e( 'Hide the WordPress admin bar on your website.', 'hide-admin-bar' ); ?></p>
				</div>

			</div>

		</div>

	</div>

	<div class="heatbox-container heatbox-container-center heatbox-column-container">

		<div class="heatbox-main">

			<!-- WordPress places admin notices after this marker -->
			<hr class="wp-header-end">

			<form method="post" class="hide-admin-bar-settings-form">

				<div class="heatbox">
					<h2><?php esc_html_e( 'Hide the admin bar', 'hide-admin-bar' ); ?></h2>
					<table class="form-table" role="presentation">
						<tr>
							<th scope="row">
								<?php esc_html_e( 'Hide it for', 'hide-admin-bar' ); ?>
								<p class="description"><?php esc_html_e( 'Hides the admin bar on the frontend of your website. Nothing selected: everyone sees it as usual.', 'hide-admin-bar' ); ?></p>
							</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><?php esc_html_e( 'Hide it for', 'hide-admin-bar' ); ?></legend>
									<div class="setting-fields">
										<div class="setting-field">
											<label class="label checkbox-label">
												<?php esc_html_e( 'All users', 'hide-admin-bar' ); ?>
												<input type="checkbox" value="all" class="hide-admin-bar-all" <?php checked( $hide_admin_bar_all ); ?>>
												<div class="indicator"></div>
											</label>
										</div>
										<?php foreach ( $roles as $hide_admin_bar_role => $hide_admin_bar_role_name ) : ?>
											<div class="setting-field hide-admin-bar-role">
												<label class="label checkbox-label">
													<?php echo esc_html( translate_user_role( $hide_admin_bar_role_name ) ); ?>
													<input type="checkbox" value="<?php echo esc_attr( $hide_admin_bar_role ); ?>" <?php checked( $hide_admin_bar_all || in_array( $hide_admin_bar_role, $admin_bar_settings['remove_by_roles'], true ) ); ?> <?php disabled( $hide_admin_bar_all ); ?>>
													<div class="indicator"></div>
												</label>
											</div>
										<?php endforeach; ?>
									</div>
								</fieldset>
							</td>
						</tr>
					</table>
				</div>

				<div class="heatbox-form-footer">
					<div>
						<button type="submit" class="button button-primary button-larger hide-admin-bar-submit">
							<?php esc_html_e( 'Save Changes', 'hide-admin-bar' ); ?>
						</button>
						<span class="heatbox-notice hide-admin-bar-notice" role="status"></span>
					</div>
				</div>

			</form>

		</div>

		<div class="heatbox-sidebar">
			<?php require __DIR__ . '/review.php'; ?>
		</div>

		<div class="heatbox-divider"></div>

	</div>

	<div class="heatbox-container heatbox-container-wide heatbox-container-center heatbox-products">

		<h2><?php esc_html_e( 'Check out our other free WordPress products!', 'hide-admin-bar' ); ?></h2>

		<ul class="products">
			<?php foreach ( $hide_admin_bar_products as $hide_admin_bar_product ) : ?>
				<li class="heatbox">
					<a href="<?php echo esc_url( $hide_admin_bar_product['url'] ); ?>" target="_blank" aria-hidden="true" tabindex="-1">
						<img src="<?php echo esc_url( HIDE_ADMIN_BAR_PLUGIN_URL . '/assets/img/' . $hide_admin_bar_product['image'] ); ?>" alt="">
					</a>
					<div class="heatbox-content">
						<h3><?php echo esc_html( $hide_admin_bar_product['title'] ); ?></h3>
						<p class="subheadline"><?php echo esc_html( $hide_admin_bar_product['subheadline'] ); ?></p>
						<p><?php echo esc_html( $hide_admin_bar_product['text'] ); ?></p>
						<a href="<?php echo esc_url( $hide_admin_bar_product['url'] ); ?>" target="_blank" class="button"><?php esc_html_e( 'Learn more', 'hide-admin-bar' ); ?><span class="screen-reader-text"> <?php esc_html_e( '(opens in a new tab)', 'hide-admin-bar' ); ?></span></a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

		<p class="credit"><?php esc_html_e( 'Made with ❤ in Torsby, Sweden', 'hide-admin-bar' ); ?></p>

	</div>

</div>
