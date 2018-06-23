<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       aisapr.ru
 * @since      1.0.0
 *
 * @package    Convert_To_Rub
 * @subpackage Convert_To_Rub/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Convert_To_Rub
 * @subpackage Convert_To_Rub/includes
 * @author     AISA <nikita@aisapr.ru>
 */
class Convert_To_Rub_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'convert-to-rub',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
