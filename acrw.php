<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://#
 * @since             1.0.0
 * @package           Acrw
 * 
 * Plugin Name:       Add to Cart Redirect for Woocommerce
 * Plugin URI:        https://#
 * Description:       Sends customers to custom pages/location such as the checkout page for faster conversions and other purposes such as terms-of-use pages.
 * Version:           1.0.0
 * Author:            Belo 
 * Author URI:        https://#
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       acrw
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$dx_active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
$dx_required_plugins = array(
  "woocommerce/woocommerce.php"
);

foreach ($dx_required_plugins as $rp) {
    if ( ! in_array( $rp, $dx_active_plugins ) ) {
        return;
    }
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ACRW_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-acrw-activator.php
 */
function activate_acrw() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-acrw-activator.php';
	Acrw_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-acrw-deactivator.php
 */
function deactivate_acrw() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-acrw-deactivator.php';
	Acrw_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_acrw' );
register_deactivation_hook( __FILE__, 'deactivate_acrw' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-acrw.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_acrw() {

	$plugin = new Acrw();
	$plugin->run();

}
run_acrw();