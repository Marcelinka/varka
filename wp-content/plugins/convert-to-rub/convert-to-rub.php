<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              aisapr.ru
 * @since             1.0.0
 * @package           Convert_To_Rub
 *
 * @wordpress-plugin
 * Plugin Name:       Конвертер цены товаров
 * Plugin URI:        aisapr.ru
 * Description:       Плагин для регулярной конвертации в рубли цены товаров, указанной в иностранных валютах.
 * Version:           1.0.0
 * Author:            AISA
 * Author URI:        aisapr.ru
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       convert-to-rub
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-convert-to-rub-activator.php
 */
function activate_convert_to_rub() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-convert-to-rub-activator.php';
	Convert_To_Rub_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-convert-to-rub-deactivator.php
 */
function deactivate_convert_to_rub() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-convert-to-rub-deactivator.php';
	Convert_To_Rub_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_convert_to_rub' );
register_deactivation_hook( __FILE__, 'deactivate_convert_to_rub' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-convert-to-rub.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_convert_to_rub() {

	$plugin = new Convert_To_Rub();
	$plugin->run();

}

run_convert_to_rub();
