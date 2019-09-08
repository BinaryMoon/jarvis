<?php
/**
 * Add Support for EditorsKit Plugin
 *
 * @package Jarvis
 * @subpackage EditorsKit
 * @author Jeffrey Carandang <jeffreycarandang.com>
 * @link https://editorskit.com/
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Add classname suggestions.
 *
 * @param array $classes Default classnames.
 * @return array Add theme utility classes.
 */
function jarvis_editorskit_classnames( $classes ) {

	$theme_classes = array(
		'block-info',
		'block-help',
		'block-alert',
		'block-success',
		'block-error',
		'block-announcement',
		'block-intro',
		'block-border',
		'block-border-dashed',
	);

	$classes = array_merge( $classes, $theme_classes );

	return $classes;
}

add_filter( 'jarvis_editorskit_classnames', 'editorskit_jarvis_classnames', 10, 3 );
