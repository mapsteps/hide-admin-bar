<?php
/**
 * Pro widgets template.
 *
 * @package Hide_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

$pro_features = hide_admin_bar_get_pro_features();
?>

<div class="heatbox hide-admin-bar-pro-metabox">

	<h2>
		<?php _e( 'Hide Admin Bar PRO', 'hide-admin-bar' ); ?> <span class="badge">PRO</span>
	</h2>

	<div class="heatbox-content">

		<ul class="hide-admin-bar-pro-benefits">
			<?php foreach ( $pro_features as $feature_key => $feature ) : ?>
				<li>
					<span class="dashicons dashicons-yes"></span>
					<div>
						<h3><?= esc_html( $feature['text'] ) ?></h3>
						<p class="description"><?= esc_html( $feature['description'] ) ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>

</div>
