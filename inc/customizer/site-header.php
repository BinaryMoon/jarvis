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
function jarvis_customizer_header( WP_Customize_Manager $wp_customize ) {

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_header',
		array(
			'title' => esc_html__( 'Header', 'jarvis' ),
			'panel' => 'jarvis_site_layout',
		)
	);

	/**
	 * Setting to change the layout of the homepage.
	 */
	$wp_customize->add_setting(
		'jarvis_header_layout',
		array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_int',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jarvis_header_layout',
		array(
			'label' => esc_html__( 'Header Layout', 'jarvis' ),
			'section' => 'jarvis_header',
			'type' => 'radio',
			'choices' => array(
				0 => esc_html__( 'Default', 'jarvis' ),
				1 => esc_html__( 'Center', 'jarvis' ),
				2 => esc_html__( 'Side Fixed', 'jarvis' ),
			),
		)
	);

}
