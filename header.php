<?php
/**
 * Header Template
 *
 * Display the site header content (logo, site title, description).
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#header-php
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	/**
	 * Split the document head into a separate file so that it can more easily be included in different templates.
	 * For example templates that don't include the default site header layout.
	 */
	get_template_part( 'parts/head' );

?>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="webpage">

	<a href="#site-content" class="screen-reader-shortcut"><?php esc_html_e( 'Skip to content', 'jarvis' ); ?></a>

	<header class="site-header" id="header" role="banner">

		<?php the_custom_logo(); ?>

		<div class="branding">

<?php
	if ( is_front_page() && ! is_paged() ) {
?>
			<h1 class="site-title">
				<?php bloginfo( 'name' ); ?>
			</h1>
<?php
	} else {
?>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</p>
<?php
	}

	// Get site description.
	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
?>
			<p class="site-description">
				<?php echo $description; /* WPCS: xss ok. */ ?>
			</p>
<?php
	}
?>

		</div>

		<nav class="menu menu-primary" aria-label="<?php esc_attr_e( 'Primary Menu', 'jarvis' ); ?>">

			<button class="menu-toggle" type="button" aria-controls="primary-menu" aria-expanded="false">
<?php
	jarvis_svg( 'menu-rows' );
	esc_html_e( 'Menu', 'jarvis' );
?>
			</button>

<?php
	wp_nav_menu(
		array(
			'theme_location' => 'menu-1',
			'menu_id' => 'nav',
			'menu_class' => 'menu-wrap',
			'container' => false,
			'item_spacing' => 'discard',
			'fallback_cb' => false,
		)
	);
?>

		</nav>

	</header>

	<?php do_action( 'before' ); ?>

	<div class="container" id="site-content">
<?php
	jarvis_header();

	get_template_part( 'parts/jetpack-featured-content' );
