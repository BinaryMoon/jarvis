<?php
/**
 * A Theme Customizer Control that adds drag and drop functionality.
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
 * A list control with drag and drop facilities.
 *
 * A custom control that displays a list of user defined items.
 * The list can be added to with items from a dropdown control.
 * The list can be rearranged with drag and drop.
 * This is great for selecting and reordering categories so that a user can
 * decide how they display on the site.
 */
class Jarvis_DragDrop_List_Control extends WP_Customize_Control {

	/**
	 * Type of control (for css and js targetting)
	 *
	 * @var string
	 */
	public $type = 'dragdrop-list';

	/**
	 * Construct the Drag and Drop list control.
	 *
	 * @param object $manager Control parent object.
	 * @param int    $id Customizer control id.
	 * @param array  $args Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		parent::__construct( $manager, $id, $args );

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}


	/**
	 * Display list of checkboxes for categories.
	 */
	public function render_content() {

		// Display label.
		if ( ! empty( $this->label ) ) {
?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
<?php
		}

		// Display description.
		if ( ! empty( $this->description ) ) {
?>
		<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
<?php
		}

		// Get the list of selected categories from the string and convert them to an array.
		$values = array_map( 'intval', explode( ',', $this->value() ) );

		// Displays selected items.
		echo '<ul class="jarvis-sortable">';
		foreach ( get_categories() as $category ) {
			if ( in_array( (int) $category->term_id, $values, true ) ) {
				echo '<li data-value="' . (int) $category->term_id . '">' . esc_html( $category->name ) . '</li>';
			}
		}
		echo '</ul>';

		// Displays selectable items.
		echo '<select class="jarvis-dragdrop-select">';
		echo '<option disabled selected value="default">' . esc_html__( 'Select a category to display +', 'jarvis' ) . '</option>';
		foreach ( get_categories() as $category ) {
			if ( ! in_array( (int) $category->term_id, $values, true ) ) {
				echo '<option value="' . (int) $category->term_id . '">' . esc_html( $category->name ) . '</option>';
			}
		}
		echo '</select>';

		// Hidden input field that stores the saved category list.
?>
		<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" class="jarvis-hidden-categories" <?php $this->link(); ?> value="<?php echo esc_html( $this->value() ); ?>">
<?php
	}


	/**
	 * Scripts and styles required for the drag and drop control.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_style( 'jarvis-theme-customizer', get_theme_file_uri( '/assets/css/customizer.css' ), null, '1.0' );
		wp_enqueue_script( 'jarvis-theme-customizer', get_theme_file_uri( '/assets/scripts/customize-controls.js' ), array( 'jquery' ), '1.0', true );

	}

}
