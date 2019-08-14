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

	<div class="entry-meta">

<?php

	jarvis_post_time();

	jarvis_post_author();

	jarvis_comments_link();

	get_template_part( 'parts/edit-post' );

?>

	</div>
