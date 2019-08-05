<?php
/**
 * Edit Post Link
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	// Only edit posts on single posts.
	if ( ! is_singular() ) {
		return;
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screenreaders. */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'jarvis' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			esc_html( get_the_title() )
		),
		'<span class="edit-link meta">',
		'</span>'
	);
