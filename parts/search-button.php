<?php
/**
 * Search Button
 *
 * A button that links to the search page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>

	<a href="<?php echo esc_url( site_url( '/?s' ) ); ?>" class="search-link">
		<?php jarvis_svg( 'search' ); ?>
		<span class="screen-reader-text"><?php esc_html__( 'Search', 'jarvis' ); ?></span>
	</a>
