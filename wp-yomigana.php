<?php
/**
Plugin Name: WP-Yomigana
Plugin URI: https://wordpress.org/plugins/wp-yomigana/
Description: You can enter ruby tag in block editor and classic editor.
Version: nightly
Requires at least: 6.6
Requires PHP: 7.4
Author: Takahashi Fumiki
Author URI: https://takahashifumiki.com
License: GPL 3.0 or later
Text Domain: wp-yomigana
Domain Path: /languages

This plugins owes a lot to TinyMCE Advanced, a WordPress plugin(https://wordpress.org/extend/plugins/tinymce-advanced/).

*/

// Do not load directly.
defined( 'ABSPATH' ) || die();

/**
 * Initialize plugin
 *
 * @ignore
 */
function yomigana_init() {
	// Register i18n.
	load_plugin_textdomain( 'wp-yomigana', false, basename( __DIR__ ) . '/languages' );
	// Check error.
	$auto_loader = yomigana_error();
	if ( is_wp_error( $auto_loader ) ) {
		add_action( 'admin_notices', 'yomigana_notice' );
	} else {
		require $auto_loader;
		Hametuha\Yomigana\Bootstrap::get_instance();
	}
}
add_action( 'plugins_loaded', 'yomigana_init' );

/**
 * Check error.
 *
 * @return WP_Error|string
 */
function yomigana_error() {
	$path = __DIR__ . '/vendor/autoload.php';
	if ( ! file_exists( $path ) ) {
		// translators: %s is file path.
		return new WP_Error( 'no_composer', sprintf( __( 'WP-Yomigana\'s auto load file %s is not found.', 'wp-yomigana' ), $path ) );
	} else {
		return $path;
	}
}

/**
 * Show error message on admin screen.
 *
 * @ignore
 */
function yomigana_notice() {
	$error = yomigana_error();
	printf( '<div class="error"><p>%s</p></div>', esc_html( $error->get_error_message() ) );
}
