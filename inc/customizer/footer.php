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
 * @return void
 */
function jarvis_customizer_credits( WP_Customize_Manager $wp_customize ) {

	$default_footer = '(privacy)(|)(ptd)(|)(top)';

	$description = array(
		'<p>' . __( 'The footer credits area supports <strong>HTML</strong>. It also supports the following tags:', 'jarvis' ) . '</p>',
		'<ul>',
		'<li>' . __( '<strong>(c)</strong>: the copyright symbol &copy;', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(year)</strong>: the current year. Updates automatically', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(|)</strong>: add a gap between items', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(privacy)</strong>: a privacy policy link', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(feed)</strong>: a link to the site RSS Feed', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(top)</strong>: a "back to top" link', 'jarvis' ) . '</li>',
		'<li>' . __( '<strong>(ptd)</strong>: the Pro Theme Design credit', 'jarvis' ) . '</li>',
		'</ul>',
		// translators: %s = the default footer content.
		'<p>' . sprintf( __( 'The default theme footer can be reproduced with:<br /><strong>%s</strong>', 'jarvis' ), $default_footer ) . '</p>',
		'<p class="section-description-buttons">',
		'<button type="button" class="button-link section-description-close">' . __( 'Close', 'jarvis' ) . '</button>',
		'</p>',
	);

	$description = apply_filters( 'jarvis_customizer_credits_description', $description );

	/**
	 * Jarvis theme options section.
	 */
	$wp_customize->add_section(
		'jarvis_credits',
		array(
			'title' => esc_html__( 'Footer Credits', 'jarvis' ),
			'description' => implode( '', $description ),
			'description_hidden' => true,
			'panel' => 'jarvis_site_layout',
		)
	);

	/**
	 * Setting to allow the credits to be hidden.
	 */
	$wp_customize->add_setting(
		'jarvis_credits_content',
		array(
			'default' => $default_footer,
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
 * @return void
 */
function jarvis_register_customize_refresh_credits( WP_Customize_Manager $wp_customize ) {

	// Ensure selective refresh is enabled.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		return;

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

