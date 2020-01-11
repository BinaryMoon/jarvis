<?php
/**
 * Custom control for Algori Blogger Documentation link.
 *
 * Class WP_Customize_Control is loaded only when theme customizer is acutally
 * used.
 * So, I've defined my custom class within the algori_blogger_customize_register
 * function that is binded to the 'customize_register' action.
 *
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/#custom-controls-sections-and-panels.
 * @package Jarvis
 */

/**
 * Add a link to the theme docs.
 */
class Jarvis_Doc_Link extends WP_Customize_Control {

	/**
	 * The Control type.
	 * Has to be something unique.
	 *
	 * @var string
	 */
	public $type = 'jarvis_documentation_link';

	/**
	 * Render the control's content.
	 *
	 * @return void
	 */
	public function render_content() {

?>

	<p><?php esc_html_e( 'Jarvis is designed to be simple and flexible. Most of the settings can be changed in the Customizer. For more details check out the following links:', 'jarvis' ); ?></p>
	<ul style="margin-bottom: 15px;">
	<li><a href="https://github.com/BinaryMoon/jarvis/wiki/Getting-Started"><?php esc_html_e( 'Getting Started', 'jarvis' ); ?></a></li>
	<li><a href="https://github.com/BinaryMoon/jarvis/wiki/Recommended-Plugins"><?php esc_html_e( 'Recommended Plugins', 'jarvis' ); ?></a></li>
	</ul>
	<a href="https://github.com/BinaryMoon/jarvis/wiki" class="button button-primary" id="jarvis-doc-link" target="_blank">
		<?php esc_html_e( 'Theme Documentation', 'jarvis' ); ?>
	</a>

<?php

	}

}
