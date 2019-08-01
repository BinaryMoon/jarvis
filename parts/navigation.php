<?php
/**
 * Display Navigation Menu
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */


// There's no menu so quit.
if ( ! has_nav_menu( 'menu-1' ) ) {
	return;
}

?>

<button class="menu-toggle" type="button" aria-controls="primary-menu" aria-expanded="false">
	<?php esc_html_e( 'Menu', 'jarvis' ); ?>
</button>


<nav class="menu menu-primary" aria-label="<?php esc_attr_e( 'Primary Menu', 'jarvis' ); ?>">

<?php

	get_template_part( 'parts/search-button' );

	wp_nav_menu(
		array(
			'theme_location' => 'menu-1',
			'menu_id' => 'menu-primary',
			'menu_class' => 'menu-wrap',
			'container' => false,
			'item_spacing' => 'discard',
			'fallback_cb' => false,
		)
	);

?>

</nav>