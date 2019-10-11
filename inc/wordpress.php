<?php
/**
 * Actions and Filters That Customize WordPress functionality
 *
 * Set up the theme and provide helper functions. These functions are attached
 * to action and filter hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Jarvis
 * @subpackage WordPress
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Enqueue scripts, and styles.
 *
 * Also sets javascript properties that need to access PHP.
 *
 * @global array $wp_scripts
 */
function jarvis_enqueue() {

	/**
	 * Output the site styles.
	 * They are displayed inline for extra speed.
	 */
	add_action(
		'wp_body_open',
		function() {
			jarvis_print_css( 'style' );
			/**
			 * No escaping needed.
			 * The jarvis_get_site_styles function generates, and escapes
			 * everything neccessary.
			 */
			echo '<style id="jarvis-custom-styles">' . jarvis_get_site_styles() . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	);

	// Scripts.
	wp_enqueue_script(
		'jarvis-script-global',
		jarvis_get_script_file(),
		array(),
		jarvis_get_theme_version( '/assets/scripts/global.js' ),
		true
	);

	wp_script_add_data( 'jarvis-script-global', 'script_execution', 'async' );

	// Comments Javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );
		wp_script_add_data( 'comment-reply', 'script_execution', 'async' );

	}

}

add_action( 'wp_enqueue_scripts', 'jarvis_enqueue' );


/**
 * Set the media property for the default theme styles to all.s
 *
 * By default loading the styles blocks rendering. By setting the media type to
 * print, and then changing the media type when loading completes, we ensure the
 * site loads quickly.
 *
 * @see https://www.filamentgroup.com/lab/load-css-simpler/
 *
 * @param string $html The style element html.
 * @param string $handle The name of the current style.
 * @return string
 */
function jarvis_on_style_load( $html, $handle ) {

	if ( 'jarvis-style' === $handle ) {

		// Replace the media all with media print, and add an onload handler.
		$print_html = str_replace( "media='all'", "media='print' onload='this.media=\"all\"'", $html );

		// Wrap the original link in a noscript tag for users who don't have js enabled.
		$html = $print_html . '<noscript>' . $html . '</noscript>';

	}

	return $html;

}

add_filter( 'style_loader_tag', 'jarvis_on_style_load', 10, 2 );


/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function jarvis_editor_blocks_styles() {

	// Load the theme styles within Gutenberg.
	/**
	 * Load the theme styles within Gutenberg.
	 * We put these styles here rather than in the editor-styles since those
	 * styles get prefixed with editor-styles-wrapper and so don't work globally.
	 */
	wp_enqueue_style(
		'jarvis-editor-blocks',
		get_theme_file_uri( '/assets/css/editor-blocks.css' ),
		array(),
		jarvis_get_theme_version( '/assets/css/editor-blocks.css' )
	);

	// Add custom properties for the block editor.
	wp_add_inline_style( 'jarvis-editor-blocks', jarvis_get_block_styles() );

	/**
	 * Overwrite Core theme styles with empty styles.
	 *
	 * @see https://github.com/WordPress/gutenberg/issues/7776#issuecomment-406700703
	 */
	wp_deregister_style( 'wp-block-library-theme' );
	wp_register_style( 'wp-block-library-theme', '', array(), '1.0' );

	/**
	 * If a dark colour then enable the dark editor styles.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/#dark-backgrounds
	 */
	if ( ! jarvis_colour_brightness( get_background_color() ) ) {

		add_theme_support( 'dark-editor-style' );

	}

}

add_action( 'enqueue_block_editor_assets', 'jarvis_editor_blocks_styles' );


/**
 * Get the custom properties for the site so that we can override them.
 */
function jarvis_get_custom_properties() {

	$properties = array(
		'background-color' => get_background_color(),
	);

	return $properties;

}


/**
 * Generate styles for the block editor.
 */
function jarvis_get_block_styles() {

	$properties = jarvis_get_custom_properties();

	$styles = array();

	$styles[] = '.editor-styles-wrapper, .editor-styles-wrapper > .editor-writing-flow, .editor-styles-wrapper > .editor-writing-flow > div { background-color: #' . esc_attr( $properties['background-color'] ) . '; }';

	return implode( $styles, ' ' );

}


/**
 * Generate styles for the website front-end.
 */
function jarvis_get_site_styles() {

	$styles = array();

	$styles[] = jarvis_title_styles();
	$styles[] = jarvis_get_font_css();
	$styles[] = jarvis_get_single_css();
	$styles[] = jarvis_header();

	return implode( $styles, ' ' );

}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * The theme is responsive so the width is likely to be narrower than the value
 * set.
 * Uses Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jarvis_content_width() {

	$width = 900;

	$GLOBALS['content_width'] = apply_filters( 'jarvis_content_width', $width );

}

add_action( 'template_redirect', 'jarvis_content_width', 0 );


/**
 * Set up all the theme properties and extras.
 */
function jarvis_after_setup_theme() {

	/**
	 * Setup theme translations.
	 *
	 * Translations can be found in the wp-content/themes/jarvis/languages/
	 * directory.
	 */
	load_theme_textdomain( 'jarvis', get_parent_theme_file_path( '/languages' ) );

	// Set default content width.
	$GLOBALS['content_width'] = 900;

	/**
	 * Let WordPress manage the document title.
	 *
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Feed me.
	add_theme_support( 'automatic-feed-links' );

	// Add selective refresh to widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Make Gutenberg embeds responsive.
	add_theme_support( 'responsive-embeds' );

	// Disable custom font sizes, ensuring consistent vertical rhythm.
	add_theme_support( 'disable-custom-font-sizes' );

	/**
	 * Custom colours for use in the editor. A nice way to provide consistancy
	 * in user editable content.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
	 */
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name' => esc_html__( 'White', 'jarvis' ),
				'slug' => 'primary',
				'color' => '#ffffff',
			),
			array(
				'name' => esc_html__( 'Light Gray', 'jarvis' ),
				'slug' => 'secondary',
				'color' => '#f5f5f5',
			),
			array(
				'name' => esc_html__( 'Black', 'jarvis' ),
				'slug' => 'highlight',
				'color' => '#000000',
			),
		)
	);

	/**
	 * Add support for full width images and other content such as videos.
	 * Remove this if the theme does not support a full width layout.
	 */
	add_theme_support( 'align-wide' );

	/**
	 * Custom background.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/custom-background/
	 */
	add_theme_support(
		'custom-background',
		apply_filters(
			'jarvis_custom_background',
			array(
				'default-color' => 'eedd33',
			)
		)
	);

	/**
	 * HTML5 FTW.
	 *
	 * This does not include support for the search-form since Jarvis has its
	 * own form layout.
	 *
	 * @see searchform.php
	 *
	 * @link https://codex.wordpress.org/Theme_Markup
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support(
		'html5',
		apply_filters(
			'jarvis_html5_args',
			array(
				'comment-list',
				'comment-form',
				'gallery',
				'caption',
			)
		)
	);

	/**
	 * Post Formats.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support(
		'post-formats',
		apply_filters(
			'jarvis_post_formats_args',
			array(
				'quote',
				'video',
				'image',
				'gallery',
				'audio',
			)
		)
	);

	/**
	 * Custom Logo.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/custom-logo/
	 */
	add_theme_support(
		'custom-logo',
		apply_filters(
			'jarvis_custom_logo_args',
			array(
				'height' => 500,
				'width' => 500,
				'flex-height' => true,
				'flex-width' => true,
			)
		)
	);

	/**
	 * Menus.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
	 */
	register_nav_menu( 'menu-1', esc_html__( 'Menu', 'jarvis' ) );

	/**
	 * Editor styles.
	 */
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-styles.css' );

}

add_action( 'after_setup_theme', 'jarvis_after_setup_theme' );


/**
 * Include the default site header for the site.
 */
function jarvis_include_header() {

	get_template_part( 'parts/header' );

}

add_action( 'jarvis_header', 'jarvis_include_header' );


/**
 * Include the default site footer for the site.
 */
function jarvis_include_footer() {

	get_template_part( 'parts/footer' );

}

add_action( 'jarvis_footer', 'jarvis_include_footer' );


/**
 * Intitiate sidebars
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 */
function jarvis_widgets_init() {

	// Footer Widgets.
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Widgets', 'jarvis' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Widgets that display at the bottom of your website. They are arranged in rows.', 'jarvis' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

}

add_action( 'widgets_init', 'jarvis_widgets_init' );


/**
 * Set a custom excerpt length.
 *
 * The WordPress default excerpt length is 55.
 *
 * @param int $length length of excerpt.
 * @return int
 */
function jarvis_excerpt_length( $length ) {

	return 30;

}

add_filter( 'excerpt_length', 'jarvis_excerpt_length', 999 );


/**
 * Change the truncation text on excerpts to an ellipsis.
 *
 * @return string
 */
function jarvis_excerpt_more() {

	return ' &hellip; ';

}

add_filter( 'excerpt_more', 'jarvis_excerpt_more' );


/**
 * Add post terms (categories and tags) to the_content.
 *
 * Using this through the_content filter places it before the related posts,
 * social sharing, and other Toolbelt content, which gives it more context.
 *
 * @param string $content The original post content.
 * @return string The modified post content.
 */
function jarvis_post_terms( $content = '' ) {

	// Ignore if on archive pages.
	if ( ! is_single() ) {
		return $content;
	}

	// Make sure it only happens on blog posts.
	if ( 'post' !== get_post_type( (int) get_the_ID() ) ) {
		return $content;
	}

	// Don't display if password required.
	if ( post_password_required() ) {
		return $content;
	}

	$terms = '';

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'jarvis' ) );
	if ( $categories_list ) {

		// Add microformat category class to links.
		$categories_list = str_replace( '<a href=', '<a class="p-category" href=', $categories_list );
		$categories_list = str_replace( ',', '', $categories_list );

		/* translators: %1$s will be replaced with a list of categories */
		$terms .= sprintf( '<p class="taxonomy entry-meta tax-categories">' . esc_html__( 'Posted in: %1$s', 'jarvis' ) . '</p>', $categories_list ); // WPCS: XSS OK.

	}

	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'jarvis' ) );

	if ( $tags_list && ! is_wp_error( $tags_list ) ) {

		/* translators: %1$s will be replaced with a list of tags */
		$terms .= sprintf( '<p class="taxonomy entry-meta tax-tags">' . esc_html__( 'Tagged as: %1$s', 'jarvis' ) . '</p>', $tags_list ); // WPCS: XSS OK.

	}

	// Output everything.
	if ( ! empty( $terms ) ) {
		$content .= '<div class="entry-terms taxonomies">' . $terms . '</div>';
	}

	return $content;

}

add_filter( 'the_content', 'jarvis_post_terms' );


/**
 * Add a span around the title prefix so that the prefix can be hidden with CSS
 * if desired.
 *
 * This is being worked on for core here: https://core.trac.wordpress.org/ticket/38545
 * Hopefully it will one day make it in so I can remove this!
 *
 * @param string $title Archive title.
 * @return string Archive title with inserted span around prefix.
 */
function jarvis_wrap_the_archive_title( $title ) {

	// Skip if the site isn't LTR, this is visual, not functional.
	// Should try to work out an elegant solution that works for both directions.
	if ( is_rtl() ) {
		return $title;
	}

	// Split the title into parts so we can wrap them with spans.
	$title_parts = explode( ': ', $title, 2 );

	// Glue it back together again.
	if ( ! empty( $title_parts[1] ) ) {

		$title = wp_kses(
			$title_parts[1],
			array(
				'span' => array(
					'class' => array(),
				),
			)
		);

		$title = '<small>' . esc_html( $title_parts[0] ) . ': </small>' . $title;

	}

	return $title;

}

add_filter( 'get_the_archive_title', 'jarvis_wrap_the_archive_title' );


/**
 * Add a span to the category and tag listings.
 *
 * Gives them consistent html for simpler CSS styles.
 *
 * @param string $cat_list HTML containing list of categories/ tags.
 * @return string
 */
function jarvis_category_list_span( $cat_list ) {

	$cat_list = str_replace( 'tag">', 'tag"><span>', $cat_list );
	$cat_list = str_replace( '</a>', '</span></a>', $cat_list );

	return $cat_list;

}

add_filter( 'the_category', 'jarvis_category_list_span' );
add_filter( 'the_tags', 'jarvis_category_list_span' );


/**
 * Standardize menu classes.
 *
 * Reduces inconsistencies in menu classes.
 * These occur when using pages/ categories as the menu fallback.
 * This allows the css styles to be simpler since we only have to accomadate one
 * menu class.
 *
 * @param string $menu_html Page menu in a html list.
 * @return string
 */
function jarvis_change_menu( $menu_html = '' ) {

	$menu_html = str_replace( 'page_item_has_children', 'menu-item-has-children', $menu_html );

	return $menu_html;

}

add_filter( 'wp_page_menu', 'jarvis_change_menu' );


/**
 * Change the colour of the Google url bar to match the background colour of the
 * site.
 *
 * This helps to improve branding and personalisation.
 */
function jarvis_theme_colour() {

	// Use the user defined background colour.
	$colour = get_background_color();

	if ( ! empty( $colour ) ) {
?>
		<meta name="theme-color" content="#<?php echo esc_attr( $colour ); ?>">
<?php
	}

}

add_filter( 'wp_head', 'jarvis_theme_colour' );


/**
 * Standardize wp_link_pages html so that it matches that used in
 * the_posts_pagination.
 *
 * This allows simpler styling, and consistent CSS.
 *
 * @param  string $html Link html.
 * @return string       Modified html.
 */
function jarvis_link_pages_link( $html ) {

	$html = str_replace( '<a ', '<a class="page-numbers" ', $html );

	// No link so must be the current page.
	if ( false === strpos( $html, '<a ' ) ) {

		$html = '<span class="page-numbers current">' . $html . '</span>';

	}

	return $html;

}

add_filter( 'wp_link_pages_link', 'jarvis_link_pages_link' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function jarvis_pingback_header() {

	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
	}

}

add_action( 'wp_head', 'jarvis_pingback_header' );


/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function jarvis_widget_tag_cloud_args( $args ) {

	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	$args['format'] = 'list';

	return $args;

}

add_filter( 'widget_tag_cloud_args', 'jarvis_widget_tag_cloud_args' );


/**
 * Add auto formatting to the author bio.
 *
 * @link https://make.wordpress.org/core/2018/01/17/auto-formatting-of-author-bios-reverted-in-4-9-2/
 */
add_filter( 'get_the_author_description', 'wptexturize' );
add_filter( 'get_the_author_description', 'convert_chars' );
add_filter( 'get_the_author_description', 'wpautop' );
add_filter( 'get_the_author_description', 'shortcode_unautop' );


/**
 * Get the version value for the specified file.
 * Helps to decache media.
 *
 * @param string $filepath The file to check.
 * @return string
 */
function jarvis_get_theme_version( $filepath = '' ) {

	if ( WP_DEBUG && $filepath ) {
		return (string) filemtime( get_theme_file_path( $filepath ) );
	}

	$version = wp_get_theme( get_template() )->get( 'Version' );
	if ( ! $version ) {
		$version = '1.0';
	}

	return $version;

}


/**
 * Get the path for the global javascript file.
 * Get the minified version for production and the full version for dev.
 *
 * @return string
 */
function jarvis_get_script_file() {

	if ( WP_DEBUG ) {
		return get_theme_file_uri( '/assets/scripts/global.js' );
	}

	return get_theme_file_uri( '/assets/scripts/global.min.js' );

}


/**
 * Add async/defer attributes to enqueued scripts that have the specified script_execution flag.
 *
 * @link https://core.trac.wordpress.org/ticket/12009
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function jarvis_filter_script_loader_tag( $tag = '', $handle ) {

	$script_execution = wp_scripts()->get_data( $handle, 'script_execution' );

	if ( ! $script_execution ) {
		return $tag;
	}

	if ( 'async' !== $script_execution && 'defer' !== $script_execution ) {
		return $tag;
	}

	// Abort adding async/defer for scripts that have this script as a dependency. _doing_it_wrong()?
	foreach ( wp_scripts()->registered as $script ) {
		if ( in_array( $handle, $script->deps, true ) ) {
			return $tag;
		}
	}

	// Add the attribute if it hasn't already been added.
	if ( ! preg_match( ":\s$script_execution(=|>|\s):", $tag ) ) {
		$tag = (string) preg_replace( ':(?=></script>):', " $script_execution", $tag, 1 );
	}

	return $tag;

}

add_filter( 'script_loader_tag', 'jarvis_filter_script_loader_tag', 10, 2 );


/**
 * Register the required plugins for this theme.
 */
function jarvis_register_required_plugins() {

	$plugins = array(

		/**
		 * Recommend the Toolbelt plugin.
		 *
		 * @link https://wordpress.org/plugins/wp-toolbelt/
		 */
		array(
			'name'      => 'Toolbelt',
			'slug'      => 'wp-toolbelt',
			'required'  => false,
		),

	);

	tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'jarvis_register_required_plugins' );
