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
			'panel' => 'jarvis_site_layout',
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
			'transport' => 'postMessage',
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
			'label' => esc_html__( 'Alignment', 'jarvis' ),
			'section' => 'jarvis_single',
			'type' => 'radio',
			'choices' => array(
				0 => $layout_label,
				1 => esc_html__( 'Center', 'jarvis' ),
			),
		)
	);

	/**
	 * Setting to change the single header height.
	 */
	$wp_customize->add_setting(
		'jarvis_single_header_height',
		array(
			'default' => 1,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_int',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jarvis_single_header_height',
		array(
			'label' => esc_html__( 'Header Height', 'jarvis' ),
			'section' => 'jarvis_single',
			'type' => 'radio',
			'choices' => array(
				0 => esc_html__( 'Small', 'jarvis' ),
				1 => esc_html__( 'Medium (Default)', 'jarvis' ),
				2 => esc_html__( 'Full Height', 'jarvis' ),
			),
		)
	);

	/**
	 * Setting to use the featured image as a header image.
	 *
	 * Unfortunately I have yet to work out a way to make this a function that
	 * can be live previewed.
	 */
	$wp_customize->add_setting(
		'jarvis_single_header',
		array(
			'default' => false,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'jarvis_single_header',
		array(
			'label' => esc_html__( 'Use Featured Image as header image.', 'jarvis' ),
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
			'transport' => 'postMessage',
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

	/**
	 * Setting to show/ hide the post author.
	 */
	$wp_customize->add_setting(
		'jarvis_single_show_author',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
			'transport' => 'postMessage',
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
	 * Setting to show/ hide the post author details.
	 */
	$wp_customize->add_setting(
		'jarvis_single_show_author_details',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jarvis_single_show_author_details',
		array(
			'label' => esc_html__( 'Display Post Author Details', 'jarvis' ),
			'section' => 'jarvis_single',
			'type' => 'checkbox',
		)
	);


	/**
	 * Setting to show/ hide post tags and categories.
	 */
	$wp_customize->add_setting(
		'jarvis_single_show_categories',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jarvis_single_show_categories',
		array(
			'label' => esc_html__( 'Display Categories and Tags', 'jarvis' ),
			'section' => 'jarvis_single',
			'type' => 'checkbox',
		)
	);

}


/**
 * Generate the css required to display single posts properly.
 *
 * @return string CSS styles for single post layout.
 */
function jarvis_get_single_css() {

	if ( is_customize_preview() ) {
		return '';
	}

	$styles = array();

	if ( ! get_theme_mod( 'jarvis_single_show_author', true ) ) {
		$styles[] = 'html .byline { display: none; }';
	}

	if ( ! get_theme_mod( 'jarvis_single_show_date', true ) ) {
		$styles[] = 'html .posted-on { display: none; }';
	}

	if ( ! get_theme_mod( 'jarvis_single_show_categories', true ) ) {
		$styles[] = 'html .entry-terms { display: none; }';
	}

	return implode( $styles, ' ' );

}


