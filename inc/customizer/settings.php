<?php
/**
 * Default settings.
 *
 * @package Jarvis
 * @subpackage ThemeCustomizerSettings
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Theme Customizer properties
 *
 * @param WP_Customize_Manager $wp_customize WP Customize object. Passed by WordPress.
 */
function jarvis_customizer_settings( WP_Customize_Manager $wp_customize ) {

	/**
	 * Jarvis site layout.
	 */
	$wp_customize->add_panel(
		'jarvis_site_layout',
		array(
			'title' => esc_html__( 'Site Layout', 'jarvis' ),
			'priority' => 55,
		)
	);

	/**
	 * Add a link to the theme documentation on Github.
	 */
	$wp_customize->add_section(
		'jarvis_docs',
		array(
			'title' => esc_html__( 'Jarvis Theme Documentation', 'jarvis' ),
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
		new Jarvis_Doc_Link(
			$wp_customize,
			'jarvis_documentation',
			array(
				'section' => 'jarvis_docs',
				'settings' => array(),
			)
		)
	);

	/**
	 * Add panels in the order they should appear.
	 */
	jarvis_customizer_header( $wp_customize );

	jarvis_customizer_archive( $wp_customize );

	jarvis_customizer_single( $wp_customize );

	jarvis_customizer_credits( $wp_customize );
	jarvis_register_customize_refresh_credits( $wp_customize );

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
	$setting = $wp_customize->get_setting( 'blogname' );
	$setting->transport = 'postMessage';

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
	$setting = $wp_customize->get_setting( 'blogdescription' );
	$setting->transport = 'postMessage';

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
	$setting = $wp_customize->get_setting( 'header_textcolor' );
	$setting->transport = 'postMessage';

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
		jarvis_get_theme_version( '/assets/scripts/customizer-preview.js' ),
		true
	);

	wp_add_inline_script( 'jarvis-customize-preview', jarvis_get_font_json() );

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
		jarvis_get_theme_version( '/assets/scripts/customizer-controls.js' ),
		true
	);

	wp_enqueue_style(
		'jarvis-customizer-styles',
		get_theme_file_uri( '/assets/css/customizer.css' ),
		array(),
		jarvis_get_theme_version( '/assets/css/customizer.css' )
	);

}

add_action( 'customize_controls_enqueue_scripts', 'jarvis_customize_controls_js' );

