<?php
/**
 * Reusable Template Functions
 *
 * Functions that can be used directly inside theme files to add functionality/
 * features to the theme.
 *
 * @package Jarvis
 * @subpackage TemplateTags
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Prints HTML with meta information for the current post-date or time.
 *
 * The time is generated by {@see jarvis_human_time_diff}.
 */
function jarvis_post_time() {

	$time_string = sprintf(
		'<time class="entry-date published updated dt-published" datetime="%1$s">%2$s</time>',
		esc_attr( (string) get_the_date( 'c' ) ),
		esc_attr( (string) get_the_date() )
	);

	$posted_on = '<a href="' . esc_url( (string) get_permalink() ) . '" class="u-url" rel="bookmark">' . $time_string . '</a>';

	/**
	 * $posted_on is not escaped because all of the html that makes up the
	 * string is escaped. The code is directly above this comment.
	 */
	echo '<span class="posted-on meta">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}


/**
 * Prints HTML with the author meta data.
 */
function jarvis_post_author() {

	if ( ! is_single() || is_attachment() ) {
		return;
	}

	echo sprintf(
		'<span class="byline meta author v-card"><a class="url fn n p-name u-url" href="%s">%s</a></span>',
		esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);

}


/**
 * Display a link to the Jarvis Comments.
 *
 * Used in post meta, and adds a smooth scroll effect to add context to the
 * comments position.
 */
function jarvis_comments_link() {

	if ( post_password_required() ) {
		return;
	}

	if ( ! post_type_supports( (string) get_post_type(), 'comments' ) ) {
		return;
	}

	// Only display the comments link if there are comments to read.
	if ( ! get_comments_number() ) {
		return;
	}

	$class = '';

	echo '<span class="comment-count meta">';

	comments_popup_link(
		sprintf(
			wp_kses(
				/* translators: %s: post title */
				__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'jarvis' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			esc_html( get_the_title() )
		),
		false,
		false,
		$class
	);

	echo '</span>';

}


/**
 * Get the posts custom read more text and, if available, display it instead of
 * 'read more'.
 */
function jarvis_read_more_text() {

	// Get post data.
	$post = get_post();
	$custom_readmore = get_extended( $post->post_content );

	if ( ! empty( $custom_readmore['more_text'] ) ) {

		echo esc_html( $custom_readmore['more_text'] );
		return;

	}

	$post_title = get_the_title();

	if ( ! $post_title ) {

		esc_html_e( 'Read more', 'jarvis' );
		return;

	}

	// Default text value.
	printf(
		/* translators: %s: post title */
		esc_html__( 'Read more %s', 'jarvis' ),
		'<span class="screen-reader-text">' . esc_html( $post_title ) . '</span>'
	);

}


/**
 * Get a list of children pages for the current page.
 *
 * @return WP_Query
 */
function jarvis_child_pages() {

	return new WP_Query(
		array(
			'post_type' => 'page',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_parent' => get_the_ID(),
			'posts_per_page' => 99,
			'no_found_rows' => true,
		)
	);

}


/**
 * Display a specific user and their contributor info.
 *
 * This is used at the end of blog posts, and on the contributor-page.php custom
 * page template.
 *
 * @param integer $user_id ID of current contributor.
 * @param integer $post_count Optional post count for current contributor. If
 *                            set then also display a list of recent blog posts.
 */
function jarvis_contributor( $user_id = null, $post_count = null ) {

	if ( ! get_theme_mod( 'jarvis_single_show_author_details', true ) && ! is_customize_preview() ) {
		return false;
	}

	// If no user id set then get th user for the current post.
	if ( ! $user_id ) {
		$user_id = (int) get_the_author_meta( 'ID' );
	}

?>

	<section class="entry-author contributor h-card">

		<?php echo get_avatar( $user_id, 250, '', '', array( 'class' => 'u-photo' ) ); ?>

		<div class="entry">

			<h2 class="author v-card">
				<a class="url fn n p-name u-url" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
					<?php the_author_meta( 'display_name', $user_id ); ?>
				</a>
			</h2>

<?php

	the_author_meta( 'description', $user_id );

	if ( $post_count ) {

?>

		<p>
			<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
<?php
		/* Translators: %d: Number of articles written by a particular author. */
		printf( esc_html( _n( '%d Article', '%d Articles', (int) $post_count, 'jarvis' ) ), (int) $post_count );
?>
			</a>
		</p>

<?php

	}

?>

		</div>

	</section>

<?php

}


/**
 * Display a list of all of the project categories.
 */
function jarvis_project_terms() {

	$terms = get_terms(
		'toolbelt-portfolio-type',
		array(
			'number' => 20,
			'orderby' => 'count',
			'order' => 'DESC',
		)
	);

	// Make sure the term exists and has some results.
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return;
	}

	// Highlight currently selected page.
	$class = 'current-page';

	// Get the term for the current page.
	$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	// We're on a project category page, and not the main portfolio page, so reset the class.
	if ( $current_term ) {
		$class = '';
	}

	// All clear - let's display the terms.
?>
	<p class="projects-terms entry-meta">

		<span class="project-terms-intro">
			<?php esc_html_e( 'Categories:', 'jarvis' ); ?>
		</span>

		<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'All', 'jarvis' ); ?></a>

<?php
		foreach ( (array) $terms as $t ) {
			$class = '';

			if ( $current_term && $current_term->term_id === (int) $t->term_id ) {
				$class = 'current-page';
			}

			$url = get_term_link( $t );

			if ( ! is_wp_error( $url ) ) {
?>
		<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $t->name ); ?></a>
<?php

			}
		}

?>
	</p>
<?php

}


/**
 * Display featured images.
 *
 * But only if the archive article layout supports it, or it's a customizer
 * preview.
 */
function jarvis_archive_image() {

	$archive_articles = (int) get_theme_mod( 'jarvis_archive_articles', '0' );

	/**
	 * Featured images do not display on $archive_articles = 0 however we still
	 * display them if it's the customizer preview so that we can easily toggle
	 * between layouts.
	 */
	if ( ! is_customize_preview() ) {

		if ( 0 === $archive_articles ) {
			return false;
		}
	}

	return get_the_post_thumbnail( (int) get_the_ID(), 'jarvis-archive' );

}


/**
 * Display credits content.
 *
 * @param  boolean $wrapper True to display wrapper, false for just contents.
 */
function jarvis_credits_content( $wrapper = true ) {

	/**
	 * Contents is not escaped here. It is already escaped in the
	 * jarvis_credits_get_content function.
	 */
	$contents = jarvis_credits_get_content();

	if ( $contents && $wrapper ) {

		echo '<div class="site-info">' . $contents . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}

	if ( $contents && ! $wrapper ) {

		echo $contents; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}

}


/**
 * Display credits content.
 *
 * @return string The html to display for the credits.
 */
function jarvis_credits_get_content() {

	$default = '(privacy)(|)(ptd)(|)(top)';
	$separator = '<span role="separator" aria-hidden="true" class="sep"></span>';
	$top_link = '<a href="#header">' . esc_html__( 'Top', 'jarvis' ) . '</a>';
	/* Translators: %1$s = theme name, %2$s = theme author website */
	$pro_theme_link = sprintf( esc_html__( 'Theme: %1$s by %2$s', 'jarvis' ), 'Jarvis', '<a href="https://prothemedesign.com/" rel="nofollow">Pro Theme Design</a>' );

	/**
	 * The theme mod is escaped when the function returns its value.
	 */
	$contents = get_theme_mod( 'jarvis_credits_content', $default );

	$contents = str_ireplace( '(YEAR)', gmdate( 'Y' ), $contents );
	$contents = str_ireplace( '(C)', '&copy;', $contents );
	$contents = str_ireplace( '(|)', $separator, $contents );
	$contents = str_ireplace( '(SEP)', $separator, $contents );
	$contents = str_ireplace( '(TOP)', $top_link, $contents );
	$contents = str_ireplace( '(FEED)', '<a href="' . get_feed_link() . '">' . esc_html__( 'RSS Feed', 'jarvis' ) . '</a>', $contents );
	$contents = str_ireplace( '(PRIVACY)', get_the_privacy_policy_link(), $contents );
	$contents = str_ireplace( '(PTD)', $pro_theme_link, $contents );

	$contents = apply_filters( 'jarvis_footer_content', $contents );

	return wp_kses_post( $contents );

}


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

	// Check for Toolbelt breadcrumbs.
	if ( function_exists( 'toolbelt_breadcrumbs' ) ) {

		toolbelt_breadcrumbs();
		return;

	}

	// Check Jetpack Breadcrumbs are available before outputting them.
	if ( function_exists( 'jetpack_breadcrumbs' ) ) {

		jetpack_breadcrumbs();
		return;

	}

}


/**
 * Display the Toolbelt social menu, but only if the plugin is enabled.
 */
function jarvis_social_menu() {

	if ( function_exists( 'toolbelt_social_menu' ) ) {

		toolbelt_social_menu();

	}

}


/**
 * Embed an svg directly into the webpage.
 *
 * @param string $key The key for the svg file. This is the filename without the .svg.
 */
function jarvis_svg( $key ) {

	require get_parent_theme_file_path( 'assets/svg/' . $key . '.svg' );

}
