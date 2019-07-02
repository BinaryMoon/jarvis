<?php
/**
 * Jetpack Compatibility File
 *
 * @package Jarvis
 * @subpackage Jetpack
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @link https://jetpack.com/
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Add theme support for Jetpack plugin features.
 *
 * @link https://jetpack.com/support/infinite-scroll/
 * @link https://jetpack.com/support/featured-content/
 * @link https://jetpack.com/support/custom-content-types/
 * @link https://jetpack.com/support/responsive-videos/
 * @link https://jetpack.com/support/social-menu/
 * @link https://jetpack.com/support/content-options/
 */
function jarvis_jetpack_init() {

	// Add support for Infinite scroll.
	add_theme_support(
		'infinite-scroll',
		apply_filters(
			'jarvis_infinite_scroll',
			array(
				'container' => 'infinite-scroll',
				'footer_widgets' => 'sidebar-2',
				'footer' => 'footer-widgets',
				'posts_per_page' => 16,
				'render' => 'jarvis_infinite_scroll_render',
			)
		)
	);

	// Add support for Featured Content.
	add_theme_support(
		'featured-content',
		apply_filters(
			'jarvis_featured_content',
			array(
				'featured_content_filter' => 'jarvis_get_featured_posts',
				'max_posts' => 4,
				'post_types' => array( 'post', 'page', 'jetpack-portfolio' ),
			)
		)
	);

	// Add support for Testimonials.
	add_theme_support( 'jetpack-testimonial' );

	// Add support for Portfolio and Projects.
	add_theme_support( 'jetpack-portfolio' );

	// Add support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add support for Social Menu.
	add_theme_support( 'jetpack-social-menu' );

	// Add support for Jetpack content options.
	add_theme_support(
		'jetpack-content-options',
		apply_filters(
			'jarvis_content_options',
			array(
				// The default setting of the theme: 'content', 'excerpt' or array( 'content, 'excerpt', ).
				'blog-display' => 'excerpt',
				'author-bio' => true,
				'masonry' => '#main-content',
				'post-details' => array(
					'stylesheet' => 'jarvis-style',
					'date' => '.posted-on',
					'categories' => '.tax-categories',
					'tags' => '.tax-tags',
					'author' => '.byline',
				),
				'featured-images' => array(
					'archive' => true,
					'archive-default' => true,
					'post' => true,
					'post-default' => true,
					'page' => true,
					'page-default' => true,
					'fallback' => true,
				),
			)
		)
	);

	/**
	 * Add support for colour contrast checker.
	 * add_theme_support( 'tonesque' );
	 */

}

add_action( 'after_setup_theme', 'jarvis_jetpack_init' );


/**
 * Render infinite scroll content using template parts.
 */
function jarvis_infinite_scroll_render() {

	while ( have_posts() ) {

		the_post();

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {

			get_template_part( 'parts/content', 'testimonial' );

		} else {

			get_template_part( 'parts/content', 'format-' . get_post_format() );

		}
	}

}


/**
 * Get featured posts using Jetpack Featured content
 *
 * @return array List of featured posts.
 */
function jarvis_get_featured_posts() {

	return apply_filters( 'jarvis_get_featured_posts', array() );

}


/**
 * Check if Jetpack Featured Content has any featured posts available.
 *
 * @return boolean True if has featured posts, otherwise false.
 */
function jarvis_has_featured_posts() {

	// If not front page and not static blog page (which is referred to with
	// is_home).
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( is_paged() ) {
		return false;
	}

	$featured_posts = apply_filters( 'jarvis_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) ) {
		return false;
	}

	if ( count( $featured_posts ) <= 0 ) {
		return false;
	}

	return true;

}


/**
 * Change default Jetpack Infinite Scroll settings.
 *
 * @param array $settings Default Infinite Scroll settings.
 * @return array Modified Infinite Scroll settings.
 */
function jarvis_infinite_scroll_js_settings( $settings ) {

	// Change the text that is displayed in the 'More posts' button.
	// Posts is quite specific and doesn't work so well with custom post types.
	$settings['text'] = jarvis_svg( 'refresh', false ) . esc_html__( 'Load More', 'jarvis' );

	return $settings;

}

add_filter( 'infinite_scroll_js_settings', 'jarvis_infinite_scroll_js_settings' );


/**
 * Get Jetpack Testimonials Title.
 */
function jarvis_testimonials_title() {

	$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

	if ( ! empty( $jetpack_options['page-title'] ) ) {
		echo esc_html( $jetpack_options['page-title'] );
	} else {
		esc_html_e( 'Testimonials', 'jarvis' );
	}

}


/**
 * Retrieve and format Jetpack Testimonials description as set in theme Customiser.
 *
 * @param string $before html to display before testimonials description.
 * @param string $after html to display after testimonials description.
 * @return boolean|string Testimonials description, or false if no description exists.
 */
function jarvis_testimonials_description( $before = '', $after = '' ) {

	$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
	$content = '';

	if ( ! empty( $jetpack_options['page-content'] ) ) {
		$content = $jetpack_options['page-content'];
		$content = addslashes( $content );
		$content = wp_kses_post( $content );
		$content = stripslashes( $content );
		$content = wptexturize( $content );
		$content = convert_smilies( $content );
		$content = convert_chars( $content );
	}

	if ( $content ) {
		echo $before . $content . $after; // WPCS: XSS OK.
	}

	return false;

}


/**
 * Get Jetpack Testimonials Image.
 *
 * @return string Testimonials image or empty string if no image set.
 */
function jarvis_testimonials_image() {

	$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
	$image = '';

	if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {

		$image = wp_get_attachment_image( (int) $jetpack_options['featured-image'], 'jarvis-header' );

	}

	return $image;

}


/**
 * Flush rewrite rules for custom post types on theme setup and switch.
 *
 * This is so that Projects, Testimonials, and other Custom Post Types work as
 * expected. Is hooked into `after_switch_theme`.
 */
function jarvis_flush_rewrite_rules() {

	flush_rewrite_rules();

}

add_action( 'after_switch_theme', 'jarvis_flush_rewrite_rules' );


/**
 * Add breadcrumbs to a page.
 *
 * Breadcrumbs will not display on blog posts, but may display on other custom
 * post types such as pages and other custom post types.
 */
function jarvis_breadcrumbs() {

	// Don't need breadcrumbs on the homepage so lets leave.
	if ( is_home() || is_front_page() ) {

		return;

	}

	// Check Jetpack Breadcrumbs are available before outputting them.
	if ( function_exists( 'jetpack_breadcrumbs' ) ) {

		jetpack_breadcrumbs();

	}

}


/**
 * Display social links using a custom menu.
 *
 * This is a wrapper for 'jetpack_social_menu' and stops PHP errors if Jetpack
 * is not enabled.
 */
function jarvis_social_links() {

	// Check Jetpack Social Menu is available before trying to display it.
	if ( function_exists( 'jetpack_social_menu' ) ) {

		jetpack_social_menu();

	}

}


/**
 * Remove some of the default Jetpack styles.
 *
 * The styles are taken care of by the default theme styles, so custom styles are not required.
 */
function jarvis_remove_jetpack_stylesheets() {

	// Remove contact form styles.
	wp_dequeue_style( 'grunion.css' );

	// Remove infinite scroll styles.
	wp_dequeue_style( 'the-neverending-homepage' );

	// Remove related posts styles.
	wp_dequeue_style( 'jetpack_related-posts' );

}

add_action( 'wp_enqueue_scripts', 'jarvis_remove_jetpack_stylesheets', 100 );


/**
 * Stop Jetpack from concatenating internal CSS.
 *
 * We dequeue a number of the Jetpack styles so this stops them from being loaded.
 */
add_filter( 'jetpack_implode_frontend_css', '__return_false' );


/**
 * Use the Jetpack Video Embed HTML to make sure the video post types are responsive.
 *
 * Has a simple fallback in case Jetpack is not being used.
 *
 * @param string $html Video html.
 * @return string html wrapper with the video wrapper.
 */
function jarvis_video_wrapper( $html ) {

	if ( function_exists( 'jetpack_responsive_videos_embed_html' ) ) {

		// If Jetpack integrated function exists then uses that.
		return jetpack_responsive_videos_embed_html( $html );

	} else {

		// If not use this. It does enough that I we can style the videos with css.
		return '<div class="jetpack-video-wrapper">' . $html . '</div>';

	}

}


/**
 * Change the size of the Related Posts thumbnail images.
 *
 * This improves display of the related posts images on larger screens and
 * retina screens. It also makes the responsive styles work more nicely since
 * the images fill the screen better.
 *
 * @param array $thumbnail_size Default thumbnail properties.
 * @return array
 */
function jarvis_related_posts_thumbnail_size( $thumbnail_size ) {

	$thumbnail_size['width'] = 500;
	$thumbnail_size['height'] = 330;

	return $thumbnail_size;

}

add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'jarvis_related_posts_thumbnail_size' );


/**
 * Get a post class based upon the colours of the specified image.
 *
 * Uses Jetpacks Tonesque - which must be initialised before this function will work.
 * Will return 'foreground-dark' if the text colour should be black, and 'foreground-light'
 * if the text colour should be white.
 *
 * @param array $image Image to check the brightness of.
 * @return array
 */
function jarvis_image_tone( $image ) {

	if ( ! class_exists( 'Tonesque' ) ) {

		return false;

	}

	if ( $image ) {

		// Add a light or dark class depending upon the image.
		$contrast = new Tonesque( $image );
		$contrast->color();
		$black_or_white = $contrast->contrast();

		if ( '0,0,0' === $black_or_white ) {
			$class = 'foreground-dark';
		} else {
			$class = 'foreground-light';
		}
	}

	return $class;

}


/**
 * The function to display Author Bio in a theme.
 */
function jarvis_author_bio() {

	$options = get_theme_support( 'jetpack-content-options' );
	$author_bio = null;

	if ( ! empty( $options[0]['author-bio'] ) ) {
		$author_bio = $options[0]['author-bio'];
	}

	// If the theme doesn't support "jetpack-content-options['author-bio']", don't continue.
	if ( true !== $author_bio ) {
		return;
	}

	// If "jetpack_content_author_bio" is false and we aren't in the customizer, don't continue.
	if ( ! get_option( 'jetpack_content_author_bio', 1 ) ) {
		return;
	}

	// If we aren't on a single post, don't continue.
	if ( ! is_single() ) {
		return;
	}

	// Display the author bio.
	jarvis_contributor();

}


/**
 * Custom function to check for a post thumbnail;
 * If Jetpack is not available, fall back to has_post_thumbnail()
 *
 * @param object|int $post Post object or Post id for post you want to check.
 */
function jarvis_has_post_thumbnail( $post = null ) {

	if ( function_exists( 'jetpack_has_featured_image' ) ) {

		return jetpack_has_featured_image( $post );

	} else {

		return has_post_thumbnail( $post );

	}

}


/**
 * Custom function to get the URL of a post thumbnail;
 * If Jetpack is not available, fall back to wp_get_attachment_image_src()
 *
 * @param  int    $post_id           Post ID.
 * @param  string $size              Post Thumbnail image size.
 * @return string
 */
function jarvis_get_attachment_image_src( $post_id, $size ) {

	if ( function_exists( 'jetpack_featured_images_fallback_get_image_src' ) ) {

		return jetpack_featured_images_fallback_get_image_src( $post_id, get_post_thumbnail_id( $post_id ), $size );

	} else {

		return jarvis_featured_image_src( $post_id, $size )[0];

	}

}


/**
 * Show/ Hide Featured Image outside of the loop.
 *
 * Seems strange that Jetpack doesn't include this function for us but there you
 * go.
 */
function jarvis_jetpack_featured_image_display() {

	if ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {

		return true;

	} else {

		$options = get_theme_support( 'jetpack-content-options' );
		$featured_images = null;

		if ( ! empty( $options[0]['featured-images'] ) ) {
			$featured_images = $options[0]['featured-images'];
		}

		$settings = array(
			'post-default' => ( isset( $featured_images['post-default'] ) && false === $featured_images['post-default'] ) ? '' : 1,
			'page-default' => ( isset( $featured_images['page-default'] ) && false === $featured_images['page-default'] ) ? '' : 1,
		);

		$settings = array_merge(
			$settings,
			array(
				'post-option' => get_option( 'jetpack_content_featured_images_post', $settings['post-default'] ),
				'page-option' => get_option( 'jetpack_content_featured_images_page', $settings['page-default'] ),
			)
		);

		if ( ( ! $settings['post-option'] && is_single() )
			|| ( ! $settings['page-option'] && is_singular() && is_page() ) ) {
			return false;
		} else {
			return true;
		}
	}

}
