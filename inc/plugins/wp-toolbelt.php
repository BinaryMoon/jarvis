<?php
/**
 * WP Post Series
 *
 * @package Jarvis
 */

function jarvis_toolbelt_related_posts_thumbnail_size() {

	return 'jarvis-archive';

}

add_filter( 'toolbelt_related_posts_thumbnail_size', 'jarvis_toolbelt_related_posts_thumbnail_size' );
