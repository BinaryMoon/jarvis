<?php
/**
 * A Theme Customizer Control that adds a category dropdown select box.
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 *
 * @package    Jarvis
 * @subpackage ThemeCustomizerCustomControls
 * @author     Ben Gillbanks <ben@prothemedesign.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Leave this file if the WP_Customize_Control class does not exist since it
 * will create php errors.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {

	return null;

}

/**
 * A custom control that displays a category dropdown selection for use in the Customizer.
 *
 * Displays a dropdown box that contains a list of categories that can be selected from.
 * Also displays options for 'No Categories', and 'All Categories'.
 */
class Jarvis_Category_Dropdown_Custom_Control extends WP_Customize_Control {

	/**
	 * Render category dropdown element
	 */
	public function render_content() {

		$value = $this->value();

		if ( empty( $value ) ) {
			$value = -2;
		}

		$cats = get_categories();

?>
	<label>
		<span class="customize-category-select-control customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<select <?php $this->link(); ?>>
			<option value="-2" <?php echo selected( $value, -2, false ); ?>><?php echo esc_html__( 'No Categories (Hide)', 'jarvis' ); ?></option>
			<option value="-1" <?php echo selected( $value, -1, false ); ?>><?php echo esc_html__( 'All Categories', 'jarvis' ); ?></option>
<?php
		foreach ( $cats as $cat ) {
			echo '<option value="' . absint( $cat->term_id ) . '"' . selected( $value, $cat->term_id, false ) . '>' . esc_html( $cat->name ) . '</option>';
		}
?>
		</select>
	</label>
<?php

	}

}
