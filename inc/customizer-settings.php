<?php
/**
 * Theme Customizer
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 *
 * @package Jarvis
 * @subpackage ThemeCustomizerSettings
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Exit if we're not in the Customizer.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {

	return null;

}

require 'customizer-sanitization.php';
require 'class.jarvis_dropdown_fonts.php';


/**
 * Theme Customizer properties
 *
 * @param WP_Customize_Manager $wp_customize WP Customize object. Passed by WordPress.
 */
function jarvis_customizer_settings( WP_Customize_Manager $wp_customize ) {

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_options',
		array(
			'title' => esc_html__( 'Theme Options', 'jarvis' ),
		)
	);

	/**
	 * Setting to allow the categories under the header to be hidden.
	 */
	$wp_customize->add_setting(
		'jarvis_display_category_summaries',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'jarvis_display_category_summaries',
		array(
			'label' => esc_html__( 'Display Category Summaries', 'jarvis' ),
			'section' => 'jarvis_options',
			'type' => 'checkbox',
		)
	);

	/**
	 * Setting to allow the categories under the header to be hidden
	 */
	$wp_customize->add_setting(
		'jarvis_display_date_social',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'jarvis_display_date_social',
		array(
			'label' => esc_html__( 'Display Date and Social Links in Header', 'jarvis' ),
			'section' => 'jarvis_options',
			'type' => 'checkbox',
		)
	);

	/**
	 * Setting to control whether the slider autoplays or not.
	 */
	$wp_customize->add_setting(
		'jarvis_autoplay_slider',
		array(
			'default' => false,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'jarvis_autoplay_slider',
		array(
			'label' => esc_html__( 'Autoplay the Featured Content Slider', 'jarvis' ),
			'section' => 'jarvis_options',
			'type' => 'checkbox',
		)
	);

}

add_action( 'customize_register', 'jarvis_customizer_settings' );


/**
 * Update Theme Elements without refreshing content.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function jarvis_register_customize_refresh( WP_Customize_Manager $wp_customize ) {

	// Ensure selective refresh is enabled.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		return false;

	}

	// Update site title.
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector' => '.site-title',
			'render_callback' => function() {
				bloginfo( 'name' );
			},
		)
	);

	// Update site description.
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector' => '.site-description',
			'render_callback' => function() {
				bloginfo( 'description' );
			},
		)
	);

	// Show and hide header text.
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}

add_action( 'customize_register', 'jarvis_register_customize_refresh' );


/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function jarvis_customize_preview_js() {

	$script_path = get_theme_file_uri( '/assets/scripts/customizer-preview.min.js' );

	if ( WP_DEBUG ) {
		$script_path = get_theme_file_uri( '/assets/scripts/customizer-preview.js' );
	}

	wp_enqueue_script(
		'jarvis-customize-preview',
		$script_path,
		array( 'customize-preview', 'jquery' ),
		'1.0',
		true
	);

}

add_action( 'customize_preview_init', 'jarvis_customize_preview_js' );


/**
 * Binds JS handlers to load the Customizer controls js.
 */
function jarvis_customize_controls_js() {

	$script_path = get_theme_file_uri( '/assets/scripts/customizer-controls.min.js' );

	if ( WP_DEBUG ) {
		$script_path = get_theme_file_uri( '/assets/scripts/customizer-controls.js' );
	}

	wp_enqueue_script(
		'jarvis-customize-controls',
		$script_path,
		array( 'jquery' ),
		'1.0',
		true
	);

	wp_enqueue_style(
		'jarvis-customizer-styles',
		get_theme_file_uri( '/assets/css/customizer.css' ),
		null,
		jarvis_get_theme_version( '/assets/css/customizer.css' )
	);

}

add_action( 'customize_controls_enqueue_scripts', 'jarvis_customize_controls_js' );

