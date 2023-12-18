<?php
/**
 * Admin bar settings template.
 *
 * @package Better_Admin_Bar
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

$admin_bar_settings = hide_admin_bar_get_admin_bar_settings();

$roles_obj = new \WP_Roles();
$roles     = $roles_obj->role_names;
?>

<div class="heatbox admin-bar-settings-box">
	<h2>
		<?php _e( 'Remove Admin Bar', 'hide-admin-bar' ); ?>
	</h2>
	<div class="setting-fields">

		<div class="field">
			<label for="remove_by_roles" class="label select2-label">
				<p>
					<?php _e( 'Remove Admin Bar from your website for:', 'hide-admin-bar' ); ?>
				</p>

				<select name="remove_by_roles[]" id="remove_by_roles"
						class="general-setting-field multiselect remove-admin-bar use-select2 is-fullwidth" multiple>
					<option
						value="all" <?php echo esc_attr( in_array( 'all', $admin_bar_settings['remove_by_roles'], true ) ? 'selected' : '' ); ?>><?php _e( 'All', 'hide-admin-bar' ); ?></option>

					<?php foreach ( $roles as $role_key => $role_name ) : ?>
						<?php
						$selected_attr = '';

						if ( in_array( $role_key, $admin_bar_settings['remove_by_roles'], true ) ) {
							$selected_attr = 'selected';
						}
						?>
						<option
							value="<?php echo esc_attr( $role_key ); ?>" <?php echo esc_attr( $selected_attr ); ?>><?php echo esc_attr( $role_name ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</div>
	</div>
</div>
