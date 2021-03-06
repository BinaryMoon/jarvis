<?php
/**
 * Add support for the Akismet plugin.
 *
 * @package Jarvis
 */

/**
 * Display Plugin Styles.
 *
 * @return void
 */
function jarvis_akismet_styles() {

	if ( defined( 'JETPACK__VERSION' ) ) {
		jarvis_print_plugin_css( 'akismet' );
	}

}

add_action( 'wp_body_open', 'jarvis_akismet_styles' );
