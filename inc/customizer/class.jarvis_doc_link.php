<?php
/**
 * Custom control for Algori Blogger Documentation link.
 *
 * Class WP_Customize_Control is loaded only when theme customizer is acutally used.
 * So, I've defined my custom class within the algori_blogger_customize_register function that is binded to the 'customize_register' action.
 *
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/#custom-controls-sections-and-panels.
 */

class Jarvis_Doc_Link extends WP_Customize_Control {

	public $type = 'jarvis_documentation_link';

	/**
	 * Render the control's content.
	 */
	public function render_content() {

?>

	<a href="https://github.com/BinaryMoon/jarvis/wiki" class="button button-primary" id="jarvis-doc-link" target="_blank">
		<?php esc_html_e( 'Documentation', 'jarvis' ); ?>
	</a>

<?php

	}

}
