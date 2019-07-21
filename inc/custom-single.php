<?php
/**
 * Single Post Layout Settings
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
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
function jarvis_customizer_single( WP_Customize_Manager $wp_customize ) {

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_single',
		array(
			'title' => esc_html__( 'Single Post & Page', 'jarvis' ),
		)
	);

	/**
	 * Setting to change the layout of the homepage.
	 */
	$wp_customize->add_setting(
		'jarvis_single_layout',
		array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_int',
		)
	);

	/**
	 * The default layout label.
	 *
	 * The layout switches side based on the text direction so lets change the
	 * label to fit.
	 */
	$layout_label = esc_html__( 'Left (default)', 'jarvis' );
	if ( is_rtl() ) {
		$layout_label = esc_html__( 'Right (default)', 'jarvis' );
	}

	$wp_customize->add_control(
		'jarvis_single_layout',
		array(
			'label' => esc_html__( 'Display Category Summaries', 'jarvis' ),
			'section' => 'jarvis_single',
			'type' => 'radio',
			'choices' => array(
				0 => $layout_label,
				1 => esc_html( 'Center', 'jarvis' ),
			),
		)
	);

	/**
	 * Setting to show/ hide the post author.
	 */
	$wp_customize->add_setting(
		'jarvis_single_show_author',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'jarvis_single_show_author',
		array(
			'label' => esc_html__( 'Display Post Author', 'jarvis' ),
			'section' => 'jarvis_single',
			'type' => 'checkbox',
		)
	);

	/**
	 * Setting to show/ hide the post date.
	 */
	$wp_customize->add_setting(
		'jarvis_single_show_date',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'jarvis_single_show_date',
		array(
			'label' => esc_html__( 'Display Post Date', 'jarvis' ),
			'section' => 'jarvis_single',
			'type' => 'checkbox',
		)
	);

}

add_action( 'customize_register', 'jarvis_customizer_single' );


/**
 * Update Theme Elements without refreshing content.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function jarvis_register_customize_refresh_single( WP_Customize_Manager $wp_customize ) {

	// Ensure selective refresh is enabled.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		return false;

	}

	// Update single class.
	$wp_customize->get_setting( 'jarvis_single_layout' )->transport = 'postMessage';

	// Update single class.
	$wp_customize->get_setting( 'jarvis_single_show_author' )->transport = 'postMessage';

	// Update single class.
	$wp_customize->get_setting( 'jarvis_single_show_date' )->transport = 'postMessage';

}

add_action( 'customize_register', 'jarvis_register_customize_refresh_single' );


/**
 * Generate the css required to display single posts properly.
 */
function jarvis_get_single_css() {

	$styles = array();

	if ( ! get_theme_mod( 'jarvis_single_show_author', true ) ) {
		$styles[] = '.byline { display: none !important; }';
	}

	if ( ! get_theme_mod( 'jarvis_single_show_date', true ) ) {
		$styles[] = '.posted-on { display: none !important; }';
	}

	return implode( $styles, ' ' );

}

