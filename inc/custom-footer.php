<?php
/**
 * Allow users to edit footer credits.
 *
 * @package jarvis
 */

/**
 * Theme Credits Customizer properties
 *
 * @param WP_Customize_Manager $wp_customize WP Customize object. Passed by WordPress.
 */
function jarvis_customizer_credits( WP_Customize_Manager $wp_customize ) {

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_credits',
		array(
			'title' => esc_html__( 'Footer Credits', 'jarvis' ),
		)
	);

	/**
	 * Setting to allow the credits to be hidden.
	 */
	$wp_customize->add_setting(
		'jarvis_display_credits',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'jarvis_sanitize_checkbox',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jarvis_display_credits',
		array(
			'label' => esc_html__( 'Display Footer Credits', 'jarvis' ),
			'section' => 'jarvis_credits',
			'type' => 'checkbox',
		)
	);

	/**
	 * Setting to allow the credits to be hidden.
	 */
	$wp_customize->add_setting(
		'jarvis_credits_content',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jarvis_credits_content',
		array(
			'label' => esc_html__( 'Credits Content', 'jarvis' ),
			'section' => 'jarvis_credits',
			'type' => 'textarea',
		)
	);

}

add_action( 'customize_register', 'jarvis_customizer_credits' );



/**
 * Update Credits without doing a full page refresh.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function jarvis_register_customize_refresh_credits( WP_Customize_Manager $wp_customize ) {

	// Ensure selective refresh is enabled.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		return false;

	}

	// Update credits content.
	$wp_customize->selective_refresh->add_partial(
		'jarvis_credits_content',
		array(
			'selector' => 'section.footer-wrap',
			'render_callback' => function() {
				jarvis_credits_content( false );
			},
		)
	);

}

add_action( 'customize_register', 'jarvis_register_customize_refresh_credits' );


/**
 * Display credits content.
 *
 * @param  boolean $wrapper True to display wrapper, false for just contents.
 * @return boolean
 */
function jarvis_credits_content( $wrapper = true ) {

	$contents = jarvis_credits_get_content();

	if ( $contents && $wrapper ) {

		echo '<div class="site-info">' . $contents . '</div>'; // WPCS: XSS ok.

	}

	if ( $contents && ! $wrapper ) {

		echo $contents; // WPCS: XSS ok.

	}

	// False to display defaults credits.
	// True to display credits as above.
	return ! empty( $contents );

}


/**
 * Display credits content.
 */
function jarvis_credits_get_content() {

	$separator = '<span role="separator" aria-hidden="true" class="sep"></span>';
	$top_link = '<a href="#header">' . esc_html__( 'Top', 'jarvis' ) . '</a>';

	$contents = get_theme_mod( 'jarvis_credits_content', '' );

	$contents = str_ireplace( '(YEAR)', date( 'Y' ), $contents );
	$contents = str_ireplace( '(C)', '&copy;', $contents );
	$contents = str_ireplace( '(|)', $separator, $contents );
	$contents = str_ireplace( '(SEP)', $separator, $contents );
	$contents = str_ireplace( '(TOP)', $top_link, $contents );
	$contents = str_ireplace( '(PRIVACY)', get_the_privacy_policy_link(), $contents );

	return wp_kses_post( $contents );

}


/**
 * Display footer credits.
 *
 * @return boolean
 */
function jarvis_credits_footer() {

	/**
	 * If we're not in the customizer preview and credits have been disabled
	 * then lets quit.
	 *
	 * Return true so that the credits get hidden.
	 */
	if ( ! is_customize_preview() && ! get_theme_mod( 'jarvis_display_credits', true ) ) {
		return true;
	}

	return jarvis_credits_content();

}

add_filter( 'jarvis_credits', 'jarvis_credits_footer' );
