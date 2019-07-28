<?php
/**
 * Archive Layout Settings
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
function jarvis_customizer_archive( WP_Customize_Manager $wp_customize ) {

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_archive',
		array(
			'title' => esc_html__( 'Homepage & Archive', 'jarvis' ),
			'panel' => 'jarvis_site_layout',
		)
	);

	/**
	 * Setting to change the layout of the homepage.
	 */
	$wp_customize->add_setting(
		'jarvis_archive_layout',
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
		'jarvis_archive_layout',
		array(
			'label' => esc_html__( 'Alignment', 'jarvis' ),
			'section' => 'jarvis_archive',
			'type' => 'radio',
			'choices' => array(
				0 => $layout_label,
				1 => esc_html__( 'Center', 'jarvis' ),
			),
		)
	);

	/**
	 * Setting to change the layout of the homepage.
	 */
	$wp_customize->add_setting(
		'jarvis_archive_header_height',
		array(
			'default' => 1,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_int',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jarvis_archive_header_height',
		array(
			'label' => esc_html__( 'Header Height', 'jarvis' ),
			'section' => 'jarvis_archive',
			'type' => 'radio',
			'choices' => array(
				0 => esc_html__( 'Small', 'jarvis' ),
				1 => esc_html__( 'Medium (Default)', 'jarvis' ),
				2 => esc_html__( 'Full Height', 'jarvis' ),
			),
		)
	);

}


