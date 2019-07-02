<?php
/**
 * Contributors Listing Template Partial
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$contributors = get_users(
		array(
			'fields'  => 'ID',
			'order'   => 'DESC',
			'who'     => 'authors',
		)
	);

	foreach ( $contributors as $contributor_id ) {

		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {

			continue;

		}

		jarvis_contributor( $contributor_id, $post_count );

	}
