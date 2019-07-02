<?php
/**
 * Comment Form Template
 *
 * Reusable code for displaying comments on a page
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	if ( comments_open() || get_comments_number() ) {

		comments_template( '', true );

	}
