<?php

/** 
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           BC_Validate
 *
 * @wordpress-plugin
 * Plugin Name:       BC Post-Secondary Validator
 * Description:       Provides a mechanism to validate whether a user's email address is part of the BC Post-Secondary System
 * Version:           1.0.0
 * Author:            Brad Payne	
 * Author URI:        http://bradpayne.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bc-validate
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! is_multisite() ) {
	return;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_bc_validate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bc-validate-activator.php';
	BC_Validate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_bc_validate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bc-validate-deactivator.php';
	BC_Validate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bc_validate' );
register_deactivation_hook( __FILE__, 'deactivate_bc_validate' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bc-validate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bc_validate() {

	$plugin = new BC_Validate();
	$plugin->run();

}
run_bc_validate();
