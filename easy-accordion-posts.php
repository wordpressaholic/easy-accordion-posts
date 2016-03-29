<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://kartik.webfixfast.com/
 * @since             1.0.0
 * @package           Easy_Accordion_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Accordion Posts
 * Plugin URI:        http://webfixfast.com/easy-accordion-posts
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            WordPressaHolic
 * Author URI:        http://kartik.webfixfast.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       easy-accordion-posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-easy-accordion-posts-activator.php
 */
function activate_easy_accordion_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-accordion-posts-activator.php';
	Easy_Accordion_Posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-easy-accordion-posts-deactivator.php
 */
function deactivate_easy_accordion_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-accordion-posts-deactivator.php';
	Easy_Accordion_Posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_easy_accordion_posts' );
register_deactivation_hook( __FILE__, 'deactivate_easy_accordion_posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-easy-accordion-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_easy_accordion_posts() {

	$plugin = new Easy_Accordion_Posts();
	$plugin->run();

}
run_easy_accordion_posts();
