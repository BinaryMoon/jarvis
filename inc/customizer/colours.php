<?php
/**
 * Allow users to edit the colours used on their website.
 *
 * @package Jarvis
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Theme Colours Customizer properties
 *
 * @param WP_Customize_Manager $wp_customize WP Customize object. Passed by WordPress.
 */
function jarvis_customizer_colours( WP_Customize_Manager $wp_customize ) {

	/**
	 * Light mode background colour
	 */
	$wp_customize->add_setting(
		'jarvis_light_mode_colour',
		array(
			'default' => '#eedd33',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jarvis_light_mode_colour',
			array(
				'label' => esc_html__( 'Light Mode background color', 'wp-toolbelt' ),
				'description' => esc_html__( 'The default background colour.', 'wp-toolbelt' ),
				'section' => 'colors',
			)
		)
	);

	/**
	 * Dark mode background colour.
	 */
	$wp_customize->add_setting(
		'jarvis_dark_mode_colour',
		array(
			'default' => '#004466',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jarvis_dark_mode_colour',
			array(
				'label' => esc_html__( 'Dark Mode background color', 'wp-toolbelt' ),
				'description' => esc_html__( 'This will be selected automatically for users who are using dark mode in their operating system.', 'wp-toolbelt' ),
				'section' => 'colors',
			)
		)
	);

}

add_action( 'customize_register', 'jarvis_customizer_colours' );
