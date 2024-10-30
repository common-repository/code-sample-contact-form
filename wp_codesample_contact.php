<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://codesamples.info
 * @since             1.0.0
 * @package           Wp_codesample_contact
 *
 * @wordpress-plugin
 * Plugin Name:       Code Sample Contact Form
 * Plugin URI:        http://codesamples.info
 * Description:       With CS Contact Form, you can create an manage multiple contact form. This plugin support customize form contact very easily. Moreover, the form support send mail, check validate, reCAPTCHA. The form is styled basic to display on Front-end. 
 * Version:           1.0.0
 * Author:            Hung Truong
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_codesample_contact
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_CODESAMPLE_CONTACT_VERSION', '1.0.0' );

/*
* WP_Error code define for cs contact
*/
define( 'CODE_ERROR', 'cs_contact_error' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp_codesample_contact-activator.php
 */
function activate_wp_codesample_contact() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp_codesample_contact-activator.php';
	Wp_codesample_contact_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp_codesample_contact-deactivator.php
 */
function deactivate_wp_codesample_contact() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp_codesample_contact-deactivator.php';
	Wp_codesample_contact_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_codesample_contact' );
register_deactivation_hook( __FILE__, 'deactivate_wp_codesample_contact' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp_codesample_contact.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_codesample_contact() {

	$plugin = new Wp_codesample_contact();
	$plugin->run();

}
run_wp_codesample_contact();


