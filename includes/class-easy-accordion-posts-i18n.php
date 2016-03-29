<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://kartik.webfixfast.com/
 * @since      1.0.0
 *
 * @package    Easy_Accordion_Posts
 * @subpackage Easy_Accordion_Posts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Easy_Accordion_Posts
 * @subpackage Easy_Accordion_Posts/includes
 * @author     WordPressaHolic <wordpressaholic@gmail.com>
 */
class Easy_Accordion_Posts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'easy-accordion-posts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
