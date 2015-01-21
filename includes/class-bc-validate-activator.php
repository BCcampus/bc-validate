<?php

/** 
 * @since      1.0.0
 *
 * @package    BC_Validate
 * @subpackage BC_Validate/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    BC_Validate
 * @subpackage BC_Validate/includes
 * @author     Your Name <email@example.com>
 */
class BC_Validate_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		add_site_option( 'bc-validate-activated', true );
	}

}
