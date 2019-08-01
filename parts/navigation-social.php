<?php
/**
 * Display Social Navigation Menu
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */


?>

<nav class="menu menu-social" aria-label="<?php esc_attr_e( 'Social Menu', 'jarvis' ); ?>">

<?php

	wp_nav_menu(
		array(
			'theme_location' => 'social',
			'menu_id' => 'menu-social',
			'menu_class' => 'menu-wrap',
			'container' => false,
			'item_spacing' => 'discard',
			'fallback_cb' => false,
			'depth' => 1,
			'link_before' => '<span class="screen-reader-text">',
			'link_after' => '</span>' . jarvis_svg( 'share', false ),
		)
	);

?>

</nav>
