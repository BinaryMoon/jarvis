<?php
/**
 * Generic Search Form
 *
 * Displays the search form in all it's locations. The search widget, and
 * anywhere `get_search_form()` is called.
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'jarvis' ); ?></span>
		<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="search-field text" autocomplete="off" />
	</label>

	<button class="search-submit"><?php echo esc_html__( 'Search', 'jarvis' ); ?></button>

</form>
