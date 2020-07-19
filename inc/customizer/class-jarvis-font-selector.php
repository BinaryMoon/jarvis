<?php
/**
 * Theme Customizer classes
 *
 * @package Jarvis
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Display specified list of fonts with preview
 */
class Jarvis_Font_Selector extends WP_Customize_Control {

	/**
	 * Widget properties
	 *
	 * @var array<string, string>
	 */
	public $choices = array();

	/**
	 * The default value.
	 *
	 * @var string
	 */
	public $default = '';


	/**
	 * Construct the widget
	 *
	 * @param WP_Customize_Manager                       $manager WP_Customize_Control manager object.
	 * @param string                                     $id The control id.
	 * @param array<string, array<string, array>|string> $args The control parameters.
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$this->choices = $args['choices'];
		$this->default = $args['default-font'];
		parent::__construct( $manager, $id, $args );

	}


	/**
	 * Display a list of fonts as a select dropdown
	 * will be converted by javascript to make a html list of fonts to select
	 *
	 * @return void
	 */
	public function render_content() {

		$value = $this->value();

?>

	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

	<span class="description customize-control-description">

<?php
		printf(
			wp_kses(
				/* translators: %s = the name of the default font */
				__( 'The default font is <strong>%s</strong>', 'jarvis' ),
				array( 'strong' => array() )
			),
			esc_attr( $this->default )
		);
?>

	</span>

	<div class="jarvis-font-picker">

<?php

		$id = 0;

		foreach ( $this->choices as $k => $v ) {

			$selected_class = '';
			if ( $k === $value ) {
				$selected_class = 'selected';
			}

?>

		<input
			type="radio"
			value="<?php echo esc_attr( $k ); ?>"
			id="<?php echo esc_attr( $this->id . $id ); ?>"
			name="<?php echo esc_attr( $this->id ); ?>"
			<?php echo checked( $value, $k, false ); ?> />
		<label
			style="font-family:<?php echo esc_attr( $v[1] ); ?>"
			for="<?php echo esc_attr( $this->id . $id ); ?>"
			class="<?php echo esc_attr( $selected_class ); ?>"><?php echo esc_html( $v[0] ); ?></label>

<?php

			$id ++;

		}

?>

	</div>

<?php

	}

}

