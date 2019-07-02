<?php
/**
 * Head Template
 *
 * Includes the code required to initialise the theme head (styles, js etc).
 *
 * The head is kept as small as is reasonably possible. Any head content
 * should be hooked into the wp_head filter.
 *
 * Styles and scripts and enqueued through the {@see jarvis_enqueue} function found
 * in inc/wordpress.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Johannes
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
