<?php
/**
 * Archive Pagination
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	the_posts_pagination(
		array(
			'mid_size' => 2,
			'prev_text' => esc_html__( 'Newer', 'jarvis' ),
			'next_text' => esc_html__( 'Older', 'jarvis' ),
			'before_page_number' => '<span class="screen-reader-text"> ' . esc_html__( 'page', 'jarvis' ) . ' </span>',
		)
	);
