<?php
/**
 * Allow users to edit footer credits.
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
function jarvis_customizer_credits( WP_Customize_Manager $wp_customize ) {

	$default_footer = '(privacy)(|)Pro Theme Design(|)(top)';

	$description = array(
		'<p>' . __( 'The footer credits area supports <strong>HTML</strong>. It also supports the following tags:', 'jarvis' ) . '</p>',
		'<ul>',
		'<li>' . __( '<strong>(c)</strong>: the copyright symbol &copy;', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(year)</strong>: the current year. Updates automatically', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(|)</strong>: add a gap between items', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(privacy)</strong>: a privacy policy link', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(top)</strong>: a "back to top" link', 'jarvis' ) . '</li>',
		'</ul>',
		'<p>' . sprintf( __( 'The default theme footer can be reproduced with:<br /><strong>%s</strong>', 'jarvis' ), $default_footer ) . '</p>',
		'<p class="section-description-buttons">',
		'<button type="button" class="button-link section-description-close">' . __( 'Close', 'jarvis' ) . '</button>',
		'</p>',
	);

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_credits',
		array(
			'title' => esc_html__( 'Footer Credits', 'jarvis' ),
			'description' => implode( $description, '' ),
			'description_hidden' => true,
			'panel' => 'jarvis_site_layout',
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
			'selector' => '.site-info',
			'render_callback' => function() {
				jarvis_credits_content( false );
			},
		)
	);

}


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

	$contents = apply_filters( 'jarvis_footer_content', $contents );

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
