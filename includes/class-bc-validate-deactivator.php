<?php

/**
 * Fired during plugin deactivation
 *
 * @since      1.0.0
 *
 * @package    BC_Validate
 * @subpackage BC_Validate/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    BC_Validate
 * @subpackage BC_Validate/includes
 * @author     Your Name <email@example.com>
 */
class BC_Validate_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		delete_site_option( 'bc-validate-activated' );	}

}
