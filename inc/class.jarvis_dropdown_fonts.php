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
 * Display specified list of Google fonts with Font preview
 */
class Jarvis_Font_Selector extends WP_Customize_Control {

	/**
	 * Widget properties
	 *
	 * @var array
	 */
	public $choices = array();

	public $default = '';


	/**
	 * Construct the widget
	 *
	 * @param type $manager
	 * @param type $id
	 * @param type $args
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$this->choices = $args['choices'];
		$this->default = $args['default-font'];
		parent::__construct( $manager, $id, $args );

	}


	/**
	 * Display a list of fonts as a select dropdown
	 * will be converted by javascript to make a html list of fonts to select
	 */
	public function render_content() {

		$value = $this->value();
?>
	<label class="jarvis-font-picker">
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<select <?php $this->link(); ?> id="<?php echo esc_attr( $this->id ); ?>">
<?php
	foreach ( $this->choices as $k => $v ) {
?>
			<option data-font-family="<?php echo esc_attr( $v[1] ); ?>" value="<?php echo esc_attr( $k ); ?>" <?php echo selected( $value, $k, false ); ?>><?php echo esc_html( $v[0] ); ?></option>
<?php
	}
?>
		</select>
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
	</label>
<?php
	}

}

