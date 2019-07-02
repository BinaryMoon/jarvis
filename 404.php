<?php
/**
 * Error - 404 File Not Found
 *
 * Error page template. Makes use of the `parts/content-empty` partial. This is
 * for design consistency and to reduce duplication.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#404-php
 *
 * @package Jarvis
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main id="main" class="main-content">

		<?php get_template_part( 'parts/content-empty' ); ?>

	</main>

<?php
	get_footer();
