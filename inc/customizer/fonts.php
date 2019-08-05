<?php
/**
 * Allow users to edit the fonts on their website.
 *
 * @package Jarvis
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */


/**
 * Theme Credits Customizer properties
 *
 * @param WP_Customize_Manager $wp_customize WP Customize object. Passed by WordPress.
 */
function jarvis_customizer_fonts( WP_Customize_Manager $wp_customize ) {

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_fonts',
		array(
			'title' => esc_html__( 'Fonts', 'jarvis' ),
			'priority' => 50,
		)
	);

	/**
	 * Setting to change the title font.
	 */
	$wp_customize->add_setting(
		'jarvis_title_font',
		array(
			'default' => 'cambria',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_fonts',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new Jarvis_Font_Selector(
			$wp_customize,
			'jarvis_title_font',
			array(
				'choices' => jarvis_get_fonts(),
				'label' => esc_html__( 'Title Font', 'jarvis' ),
				'section' => 'jarvis_fonts',
				'default-font' => 'Cambria',
			)
		)
	);

	/**
	 * Setting to change the heading font.
	 */
	$wp_customize->add_setting(
		'jarvis_header_font',
		array(
			'default' => 'cambria',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_fonts',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new Jarvis_Font_Selector(
			$wp_customize,
			'jarvis_header_font',
			array(
				'choices' => jarvis_get_fonts(),
				'label' => esc_html__( 'Heading Font', 'jarvis' ),
				'section' => 'jarvis_fonts',
				'default-font' => 'Cambria',
			)
		)
	);

	/**
	 * Setting to change the body font.
	 */
	$wp_customize->add_setting(
		'jarvis_body_font',
		array(
			'default' => 'cambria',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_fonts',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new Jarvis_Font_Selector(
			$wp_customize,
			'jarvis_body_font',
			array(
				'choices' => jarvis_get_fonts(),
				'label' => esc_html__( 'Body Font', 'jarvis' ),
				'section' => 'jarvis_fonts',
				'default-font' => 'Cambria',
			)
		)
	);

}

add_action( 'customize_register', 'jarvis_customizer_fonts' );
