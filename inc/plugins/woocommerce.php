<?php
/**
 * Add support for WooCommerce.
 *
 * @see https://wordpress.org/plugins/woocommerce/
 * @package jarvis
 */

/**
 * Add support for woocommerce
 */
function jarvis_wc_support() {

	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}

add_action( 'after_setup_theme', 'jarvis_wc_support' );


/**
 * Remove Jetpack related posts from WooCommerce products
 *
 * @param  array $options Related posts options.
 * @return array
 */
function jarvis_wc_remove_related_posts( $options ) {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return $options;
	}

	if ( is_product() ) {
		$options['enabled'] = false;
	}

	return $options;

}

add_filter( 'jetpack_relatedposts_filter_options', 'jarvis_wc_remove_related_posts' );


/**
 * Check to see if the current page is a WooCommerce page or not.
 *
 * @return boolean
 */
function jarvis_is_woocommerce() {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return false;
	}

	if ( is_woocommerce() ) {
		return true;
	}

	if ( is_account_page() ) {
		return true;
	}

	if ( is_checkout() || is_cart() ) {
		return true;
	}

	return false;

}


/**
 * Disable sidebar on WooCommerce pages
 *
 * @param  boolean $is_active_sidebar Current value of sidebar visibility.
 * @param  string  $index             Sidebar to test.
 * @return boolean                    Whether to display the sidebar or not.
 */
function jarvis_wc_is_sidebar_active( $is_active_sidebar, $index ) {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return $is_active_sidebar;
	}

	if ( 'sidebar-1' === $index ) {

		// Not WooCommerce so return default.
		if ( ! jarvis_is_woocommerce() ) {
			return $is_active_sidebar;
		}

		return false;

	}

	return $is_active_sidebar;

}

add_filter( 'is_active_sidebar', 'jarvis_wc_is_sidebar_active', 10, 2 );


/**
 * Remove default WooCommerce actions
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

