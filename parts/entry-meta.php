<?php
/**
 * Post Meta Data
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>

	<div class="post-meta-data entry-meta">

<?php
	jarvis_post_time();

	jarvis_comments_link();

	jarvis_post_author();

	jarvis_the_main_category();

	get_template_part( 'parts/edit-post' );
?>

	</div>
