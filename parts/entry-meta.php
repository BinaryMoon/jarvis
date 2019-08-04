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

	$author = jarvis_post_author();
	if ( $author ) {
		echo '<span class="byline meta">' . $author . '</span>';
	}

	jarvis_comments_link();

	get_template_part( 'parts/edit-post' );

?>

	</div>
