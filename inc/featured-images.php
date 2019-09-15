<?php
/**
 * Featured Images
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 *
 * @package Jarvis
 * @subpackage FeaturedImages
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Set up the custom images sizes.
 */
function jarvis_featured_images() {

	/**
	 * Add support for post thumbnails.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Ideal header image size.
	 * Can also be used for single page/ post header images.
	 */
	add_image_size( 'jarvis-header', 1600, 900, true );

	// Archive & homepage thumbnails.
	add_image_size( 'jarvis-archive', 720, 405, true );

}

add_action( 'after_setup_theme', 'jarvis_featured_images' );


/**
 * Get post thumbnail source url.
 *
 * If a thumbnail doesn't exist then use the first attachment. This reduces user
 * confusion since they don't always understand or set a featured image.
 *
 * @param integer $post_id ID for the post that you want to get the thumbnail
 *                         url for.
 * @param string  $thumbnail_size Size of the thumbnail image. Defaults to
 *                                'jarvis-archive'.
 * @param array   $attr Attributes to pass to `wp_get_attachment_image_src` -
 *                      this will probably be css classes.
 * @return string|boolean
 */
function jarvis_featured_image_src( $post_id = null, $thumbnail_size = 'jarvis-archive', $attr = array() ) {

	// Ensure the post id is set.
	if ( ! $post_id ) {

		$post_id = get_the_ID();

	}

	// If there's still no post id then quit.
	if ( ! $post_id ) {

		return false;

	}

	$thumbnail_id = get_post_thumbnail_id( (int) $post_id );

	if ( ! $thumbnail_id ) {

		return false;

	}

	// Grab the featured image for the specified post.
	$image = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size );

	// If there's no featured image then grab an attachment image and use that instead.
	if ( ! $image[0] ) {

		$images = get_attached_media( 'image', $post_id );

		if ( $images ) {
			foreach ( $images as $child_id => $attachment ) {

				$image = wp_get_attachment_image_src( (int) $child_id, $thumbnail_size );
				break;

			}
		}
	}

	if ( is_array( $image ) ) {

		$image = $image[0];

	}

	if ( $image ) {

		return $image;

	} else {

		return false;

	}

}


