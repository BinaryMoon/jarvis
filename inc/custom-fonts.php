<?php


/**
 * Return a list of websafe fonts.
 *
 * The font list was retried from Pro Theme Design:
 * @see https://github.com/BinaryMoon/pro-theme-design/blob/master/views/_tools/_websafe-fonts/index.php
 */
function jarvis_get_fonts() {

	$fonts = array(
		'arial' => [ 'Arial', 'Arial, Helvetica Neue, Helvetica, sans-serif' ],
		'arial-black' => [ 'Arial Black', 'Arial Black, Arial Bold, Gadget, sans-serif' ],
		'arial-narrow' => [ 'Arial Narrow', 'Arial Narrow, Arial, sans-serif' ],
		'arial-rounded' => [ 'Arial Rounded', 'Arial Rounded MT Bold, Helvetica Rounded, Arial, sans-serif' ],
		'baskerville' => [ 'Baskerville', 'Baskerville, Baskerville Old Face, Hoefler Text, Garamond, Times New Roman, serif' ],
		'book-antiqua' => [ 'Book Antiqua', 'Book Antiqua, Palatino, Palatino Linotype, Palatino LT STD, Georgia, serif' ],
		'bookman' => [ 'Bookman', 'Bookman, Bookman Old Style, Book Antiqua, Palatino, serif' ],
		'calibri' => [ 'Calibri', 'Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif' ],
		'cambria' => [ 'Cambria', 'Cambria, Georgia, serif' ],
		'century-gothic' => [ 'Century Gothic', 'Century Gothic, CenturyGothic, AppleGothic, sans-serif' ],
		'copperplate' => [ 'Copperplate', 'Copperplate Light, Copperplate Gothic Light, serif' ],
		'comic-sans' => [ 'Comic Sans', 'Comic Sans, Comic Sans MS, sans-serif' ],
		'consolas' => [ 'Consolas', 'Consolas, monaco, monospace' ],
		'courier-new' => [ 'Courier New', 'Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace' ],
		'franklin-gothic' => [ 'Franklin Gothic', 'Franklin Gothic Medium, Franklin Gothic, ITC Franklin Gothic, Arial, sans-serif' ],
		'futura' => [ 'Futura', 'Futura, Trebuchet MS, Arial, sans-serif' ],
		'garamond' => [ 'Garamond', 'Garamond, Baskerville, Baskerville Old Face, Hoefler Text, Times New Roman, serif' ],
		'geneva' => [ 'Geneva', 'Geneva, Tahoma, Verdana, sans-serif' ],
		'georgia' => [ 'Georgia', 'Georgia, Times, Times New Roman, serif' ],
		'gill-sans' => [ 'Gill Sans', 'Gill Sans, Gill Sans MT, Century Gothic, Calibri, sans-serif' ],
		'helvetica' => [ 'Helvetica', 'Helvetica Neue, Helvetica, Arial, sans-serif' ],
		'hoefler' => [ 'Hoefler', 'Hoefler Text, Baskerville Old Face, Garamond, Times New Roman, serif' ],
		'impact' => [ 'Impact', 'Impact, Haettenschweiler, Franklin Gothic Bold, Charcoal, Helvetica Inserat, Bitstream Vera Sans Bold, Arial Black, sans-serif' ],
		'lucida-bright' => [ 'Lucida Bright', 'Lucida Bright, Georgia, serif' ],
		'lucida-grande' => [ 'Lucida Grande', 'Lucida Grande, Lucida Sans Unicode, Lucida Sans, Geneva, Verdana, sans-serif' ],
		'lucida-console' => [ 'Lucida Console', 'Lucida Console, Lucida Sans Typewriter, monaco, Bitstream Vera Sans Mono, monospace' ],
		'palatino' => [ 'Palatino', 'Palatino, Palatino Linotype, Palatino LT STD, Book Antiqua, Georgia, serif' ],
		'system' => [ 'System', '-apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol' ],
		'system-mono' => [ 'System Monospace', 'SFMono-Regular,Consolas,Liberation Mono,Menlo,Courier,monospace' ],
		'tahoma' => [ 'Tahoma', 'Tahoma, Verdana, Segoe, sans-serif' ],
		'times-new-roman' => [ 'Times New Roman', 'TimesNewRoman, Times New Roman, Times, Baskerville, Georgia, serif' ],
		'trebuchet' => [ 'Trebuchet', 'Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif' ],
		'verdana' => [ 'Verdana', 'Verdana, Geneva, sans-serif' ],
	);

	return apply_filters( 'jarvis_fonts', $fonts );

}


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
		)
	);

	/**
	 * Setting to change the heading font.
	 */
	$wp_customize->add_setting(
		'jarvis_header_font',
		array(
			'default' => true,
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
			)
		)
	);

	/**
	 * Setting to change the body font.
	 */
	$wp_customize->add_setting(
		'jarvis_body_font',
		array(
			'default' => true,
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
			)
		)
	);

}

add_action( 'customize_register', 'jarvis_customizer_fonts' );


/**
 * Generate the css required to display the custom fonts.
 */
function jarvis_get_font_css() {

	$fonts = jarvis_get_fonts();

	$styles = array();

	$styles[] = 'body { --font-body:' . $fonts[ get_theme_mod( 'jarvis_body_font', 'cambria' ) ][1] . '; }';
	$styles[] = 'body { --font-header:' . $fonts[ get_theme_mod( 'jarvis_header_font', 'cambria' ) ][1] . '; }';

	return implode( $styles, ' ' );

}
