<?php

/**
 * Add infinite scroll scripts to footer.
 */
function toolbelt_is_footer()
{
}
/**
 * Add infinite scroll styles to header.
 *
 * Normally I include styles before they are needed, but this ensures they are
 * added before the pagination is displayed.
 */
function toolbelt_is_head()
{
}
/**
 * Initialize Infinite Scroll styles.
 */
function toolbelt_is_init()
{
}
/**
 * Add the load more button to the template.
 *
 * @param string $template The navigation template to be modified.
 * @param string $class The type of navigation being generated.
 * @return string
 */
function toolbelt_is_html($template, $class)
{
}
/**
 * Get the html for the 'load more' button.
 *
 * @return string The load more html.
 */
function toolbelt_is_button()
{
}
/**
 * Add body class letting the world know Infinite scroll is enabled.
 *
 * @param array $classes List of current classes.
 * @return array
 */
function toolbelt_is_class($classes)
{
}
/**
 * Should we setup infinite scroll?
 *
 * @return bool
 */
function toolbelt_is_active()
{
}
/**
 * Set REST routes for IS.
 */
function toolbelt_is_rest()
{
}
/**
 * Fallback post renderer for when themes don't support Infinite Scroll.
 */
function toolbelt_is_render()
{
}
/**
 * Display the REST posts.
 *
 * @param WP_REST_Request $data The REST response data.
 * @return array
 */
function toolbelt_is_rest_response($data)
{
}
/**
 * Add social sharing buttons to the post content.
 *
 * @param string $content The post content to append the sharing option to.
 * @return string The post content with the sharing options appended.
 */
function toolbelt_social_sharing($content)
{
}
/**
 * Get a list of social networks and their sharing links.
 */
function toolbelt_social_networks()
{
}
/**
 * Display the cookie data in the footer.
 */
function toolbelt_cookie_footer()
{
}
/**
 * Get the cookie banner message.
 */
function toolbelt_cookie_message()
{
}
/**
 * Work out what buttons to display in the cookie bar.
 */
function toolbelt_cookie_buttons()
{
}
/**
 * Display the social menu.
 */
function toolbelt_social_menu()
{
}
/**
 * Embed an svg directly into the webpage.
 *
 * @param string $key The key for the svg file. This is the filename without the .svg.
 * @return string
 */
function toolbelt_social_menu_svg($key)
{
}
/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function toolbelt_social_menu_icons()
{
}
/**
 * Display SVG icons in social navigation.
 *
 * @since 1.0.0
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  object  $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function toolbelt_social_menu_nav_menu_icons($item_output, $item, $depth, $args)
{
}
/**
 * Register Portfolio post type and associated taxonomies.
 */
function toolbelt_portfolio_register_post_types()
{
}
/**
 * Add the portfolio post type to the related post types.
 *
 * @param array $types The current list of post types.
 * @return array
 */
function toolbelt_portfolio_related_posts_type($types)
{
}
/**
 * Add the portfolio post type to the related post types.
 *
 * @param array $types The current list of post types.
 * @return array
 */
function toolbelt_portfolio_social_sharing_post_types($types)
{
}
/**
 * Change ‘Title’ column label.
 * Add Featured Image column.
 *
 * @param array $columns A list of all the current columns.
 * @return array
 */
function toolbelt_portfolio_edit_admin_columns($columns)
{
}
/**
 * Add featured image to column.
 *
 * @param string $column The name of the coloumn being checked.
 * @param int    $post_id The id of the post for the current row.
 */
function toolbelt_portfolio_image_column($column, $post_id)
{
}
/**
 * Adjust image column width.
 *
 * @param string $hook The id for the current page.
 */
function toolbelt_portfolio_enqueue_admin_styles($hook)
{
}
/**
 * Link headings.
 *
 * @package toolbelt
 */
/**
 * Add heading anchors to the page/ post content.
 *
 * @param string $content The post content to add the anchors to.
 */
function toolbelt_heading_anchors($content)
{
}
/**
 * Add the anchors to the specified tag.
 *
 * @param object $doc The DOMDocument object for the current page.
 * @param string $tag The tag to search and add the anchor to.
 * @return object The modified DOMDocument object.
 */
function toolbelt_heading_ids($doc, $tag)
{
}
/**
 * Featured Attachment.
 *
 * If there's no featured image then return the first post attachment.
 *
 * @package toolbelt
 */
/**
 * Fill empty post thumbnails with images from the first attachment added to a
 * post.
 *
 * @param string  $html Current html for thumbnail image.
 * @param integer $post_id ID for specified post.
 * @param integer $thumbnail_id ID for thumbnail image.
 * @param string  $size expected Thumbnail size.
 * @param array   $attr Image attributes.
 * @return string
 */
function toolbelt_post_thumbnail_html($html, $post_id, $thumbnail_id, $size, $attr = array())
{
}
/**
 * Use ative lazy loading.
 *
 * @package toolbelt
 */
/**
 * Add 'loading="lazy" to images.
 *
 * @param string $content The content to check.
 * @return string
 */
function toolbelt_lazy_load_image($content)
{
}
/**
 * Add 'loading="lazy" to iframes.
 *
 * @param string $content The content to check.
 * @return string
 */
function toolbelt_lazy_load_iframe($content)
{
}
/**
 * Add related posts to the end of the_content.
 *
 * @param string $content The post content that we will be appending.
 * @return string
 */
function toolbelt_related_posts($content)
{
}
/**
 * Get the related posts content.
 * With html formatting.
 */
function toolbelt_related_posts_get()
{
}
/**
 * Get the html for the related posts output.
 *
 * @param array $related_posts A list of the related posts to output.
 * @return string
 */
function toolbelt_related_posts_html($related_posts)
{
}
/**
 * Get a list of possible related posts.
 *
 * @param string $post_type The post type.
 * @param string $post_taxonomy The post taxonomy name.
 * @return array
 */
function toolbelt_related_posts_get_data($post_type, $post_taxonomy)
{
}
/**
 * Return an array containing information about the current related post.
 *
 * @return array
 */
function toolbelt_related_posts_add()
{
}
/**
 * Random Redirect
 *
 * @package toolbelt
 */
/**
 * Randomly redirect to a blog post.
 *
 * If the post url has ?random on it.
 */
function toolbelt_random_redirect()
{
}
/**
 * Get the id of a random post that we can redirect to.
 */
function toolbelt_random_get_post()
{
}
/**
 * Load the Responsive videos plugin.
 */
function toolbelt_responsive_video_init()
{
}
/**
 * Add the toolbelt video styles.
 */
function toolbelt_responsive_video_styles()
{
}
/**
 * Adds a wrapper to videos.
 *
 * @param string $html The video embed html to wrap.
 * @return string
 */
function toolbelt_responsive_video_embed_html($html)
{
}
/**
 * Check if oEmbed is a `$video_patterns` provider video before wrapping.
 *
 * @param mixed  $html The cached HTML result, stored in post meta.
 * @param string $url  he attempted embed URL.
 * @return string
 */
function toolbelt_responsive_video_maybe_wrap_oembed($html, $url = \null)
{
}
/**
 * Remove the responsive video wrapper in embed blocks.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 * @return string $block_content String of rendered HTML.
 */
function toolbelt_responsive_video_remove_wrap_oembed($block_content, $block)
{
}
/**
 * Add simple 404 page for static files.
 *
 * Means that full page requests are not made if things like images or scripts
 * do not exist.
 *
 * @package toolbelt
 */
/**
 * Do a 404 response for the files that don't need to be accessed.
 */
function toolbelt_404_response()
{
}
/**
 * Widget Display Admin.
 *
 * @package toolbelt
 */
/**
 * Display the widget display rules input.
 *
 * @param object $widget The widget instance.
 * @param null   $return Return null if new fields are added.
 * @param array  $instance The widgets settings.
 */
function toolbelt_widget_display_form($widget, $return, $instance)
{
}
/**
 * Update the widget settings.
 *
 * @param array $instance     The settings to save.
 * @param array $new_instance The new settings that may have changed.
 * @return array
 */
function toolbelt_widget_display_update_callback($instance, $new_instance)
{
}
/**
 * Check if the widget should be displayed or not.
 *
 * @param string $logic Logic to check.
 * @return bool
 */
function toolbelt_widget_display($logic)
{
}
/**
 * Check if the widget with the specified token should be visible.
 *
 * @param string $token The token to check.
 * @return bool
 */
function toolbelt_widget_display_check_token($token = '')
{
}
/**
 * Get the widget logic property for the specified id.
 *
 * @param int $widget_id The id to get the information for.
 * @return string
 */
function toolbelt_widget_display_by_id($widget_id)
{
}
/**
 * Frontend settings for widgets.
 *
 * @package toolbelt
 */
/**
 * Set or unset the widgets.
 *
 * @param array $sidebar_widgets List of widgets to check.
 * @return array
 */
function toolbelt_widget_display_filter_sidebars_widgets($sidebar_widgets)
{
}
/**
 * Add the
 */
function toolbelt_widget_display_customizer()
{
}
/**
 * Display sidebar widgets, fading out the widgets that should be hidden on the
 * current page.
 *
 * @param array $widget The widget properties.
 */
function toolbelt_widget_display_dynamic_sidebar($widget)
{
}
/**
 * Disable author urls in comments.
 *
 * @package toolbelt
 */
/**
 * Disable comment author links.
 *
 * By default 'get_comment_author_link' returns a html link. This stips out the
 * html and leaves just the commenter name.
 *
 * @param string $author_link Author link to simplify.
 * @return string
 */
function toolbelt_disable_comment_author_links($author_link)
{
}
/**
 * Remove URL field from comments form.
 *
 * @param array $fields List of form fields to display.
 * @return array
 */
function toolbelt_comment_form_fields($fields)
{
}
/**
 * A function to display breadcrumbs on a category or single post/ page.
 * Should work for all post types.
 *
 * This module must be:
 * a) enabled in the plugin settings
 * b) have the function below added to the theme. It won't work without this
 * function.
 */
function toolbelt_breadcrumbs()
{
}
/**
 * Get the type of breadcrumb trail to generate.
 *
 * This works out if it's a post or taxonomy trail.
 *
 * @return false|array Item 0 = breadcrumb type (taxonomy or post), Item 1 = type of breadcrumb type. Eg, archive or tag.
 */
function toolbelt_breadcrumb_type()
{
}
/**
 * Generate a hierarchical breadcrumb trail.
 *
 * @param string $taxonomy The taxonomy type for the archive.
 * @return string
 */
function toolbelt_breadcrumb_tax_hierarchical($taxonomy)
{
}
/**
 * Generate a post breadcrumb trail.
 *
 * By post I am referring to any single post type that supports a hierarchy.
 * This includes pages, and custom post types that can have a parent child
 * relationships.
 *
 * @return string
 */
function toolbelt_breadcrumb_post_hierarchical()
{
}
/**
 * Return the parents for a given taxonomy term ID.
 *
 * @param int    $term Taxonomy term whose parents will be returned.
 * @param string $taxonomy Taxonomy name that the term belongs to.
 * @param array  $visited Terms already added to prevent duplicates.
 *
 * @return string A list of links to the term parents.
 */
function toolbelt_get_term_parents($term, $taxonomy, $visited = array())
{
}