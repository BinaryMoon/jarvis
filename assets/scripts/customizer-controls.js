
; ( function( $ ) {

	var api = wp.customize;
	var default_text = 'Default';

	// font picker
	$( document ).ready(
		function() {

			$( '.jarvis-font-picker' ).each(
				function() {

					var $this = $( this );
					var $select = $this.find( 'select' );
					var $options = $select.find( 'option' );
					var $container = $( '<div class="jarvis-font-selector"></div>' );

					$options.each(
						function() {

							var $this = $( this );
							var family = $this.data( 'font-family' );
							var value = $this.attr( 'value' );
							var button = $( '<button>' + $this.html() + '</button>' )
								.attr( 'type', 'button' )
								.css( 'font-family', family )
								.data( 'value', value );

							if ( $this.is( ':selected' ) ) {
								button.addClass( 'selected' );
							}

							button.on(
								'click',
								selectFont
							);

							$container.append( button );

						}
					);

					$this.append( new_selector );

				}
			);

		}
	);

	wp.customize.bind(
		'ready',
		function() {

			// Detect when the color section is expanded (or closed) so we can adjust the font heights accordingly.
			wp.customize.section(
				'colors',
				function( section ) {
					section.expanded.bind(
						function( isExpanding ) {

							// Quit if collapsing. No need to change anything.
							if ( !isExpanding ) {
								return;
							}

							$( '.styleguide-font-selector' ).each(
								function() {
									var $this = $( this );
									var index = parseInt( $this.find( '.selected' ).data( 'index' ) ) - 1;
									var item_height = $this.find( 'li:first' ).outerHeight();
									$this.scrollTop( index * item_height );
								}
							);

						}
					);
				}
			);
		}
	);


	/**
	 * Select a new font and update the setting.
	 */
	var selectFont = function( e ) {

		e.preventDefault();

		var $this = $( this );

		$this.parent().find( 'button' ).removeClass( 'selected' );
		$this.addClass( 'selected' );

		var value = $this.data( 'value' );

		if ( default_text === value ) {
			value = '';
		}

		var parent = $( this ).parent().closest( 'button' ).find( 'select' );
		api.instance( parent.prop( 'id' ) ).set( value );

	}


} )( jQuery );

/**
 * Live-update changed settings in real time in the Customizer preview.
 *
 * Filename: customizer-preview.js v1
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#javascript-driven-widget-support
 *
 * @package jarvis
 */

/* global wp */

; ( function() {

	wp.customize.bind(
		'ready',
		function() {

			// Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
			wp.customize.section(
				'jarvis_credits',
				function( section ) {

					section.expanded.bind(
						function( isExpanding ) {

							// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
							wp.customize.previewer.send(
								'jarvis_credits_expand',
								{
									expanded: isExpanding
								}
							);

						}
					);

				}
			);

		}
	);

} )();

// Silence is golden!