<?php
/**
 * WP Post Series
 *
 * @package Jarvis
 */

/**
 * Remove WP Post Series external files.
 *
 * @return void
 */
function jarvis_remove_wp_post_series_dequeue() {

	// Dequeue stylesheets.
	wp_dequeue_style( 'wp-post-series-frontend' );

	// Deregister scripts so that it can't be enqueued.
	wp_deregister_script( 'wp-post-series' );

}

add_action( 'wp_enqueue_scripts', 'jarvis_remove_wp_post_series_dequeue', 100 );


/**
 * Display Plugin Styles.
 *
 * @return void
 */
function jarvis_wp_post_series_styles() {

	jarvis_print_plugin_css( 'wp-post-series' );

}

add_action( 'wp_body_open', 'jarvis_wp_post_series_styles' );
