<?php
/**
 * A Theme Customizer Control that adds a custom dropdown select box.
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 *
 * @package Jarvis
 * @subpackage ThemeCustomizerCustomControls
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Leave this file if the WP_Customize_Control class does not exist since it will create php errors.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {

	return null;

}


/**
 * A custom control that displays a dropdown box filled with a list of user defined 'things'.
 *
 * Displays a dropdown box filled with the contents of ...
 */
class Jarvis_Dropdown_Custom_Control extends WP_Customize_Control {

	/**
	 * Control parameters
	 *
	 * @var array
	 */
	public $params;

	/**
	 * Default seleted object id
	 *
	 * @var integer
	 */
	public $default;


	/**
	 * Initialize the dropdown custom control
	 *
	 * @param object $manager Control parent object.
	 * @param int    $id Customizer control id.
	 * @param array  $args Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$this->params = $args['params'];
		$this->default = (int) $args['default'];
		parent::__construct( $manager, $id, $args );

	}


	/**
	 * Render form elements for this control
	 */
	public function render_content() {

		$value = $this->value();

		if ( empty( $value ) ) {
			$value = $this->default;
		}
?>
	<label>
		<span class="customize-select-control customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<select <?php $this->link(); ?>>
<?php
		foreach ( $this->params as $k => $v ) {
?>
			<option value="<?php echo esc_attr( $k ); ?>" <?php echo selected( $value, $k, false ); ?>><?php echo esc_html( $v ); ?></option>
<?php
		}
?>
		</select>
	</label>
<?php

	}

}
