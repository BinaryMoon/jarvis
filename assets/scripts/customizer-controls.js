
; ( function( $ ) {

	var api = wp.customize;
	var default_text = 'Default';

	// font picker
	$( document ).ready(
		function() {

			$( '.jarvis-font-picker' ).each( function() {

				var $this = $( this );
				var $select = $this.find( 'select' );
				var $options = $select.find( 'option' );
				var new_selector = $( '<ul class="styleguide-font-selector"></ul>' );
				var current_index = 0;

				$options.each(
					function() {

						current_index++;

						var $this = $( this );
						var family = $this.data( 'font-family' );
						var li = $( '<li>' + $this.html() + '</li>' )
							.css( 'font-family', family )
							.data( 'index', current_index );

						if ( $this.is( ':selected' ) ) {

							li.addClass( 'selected' );

						}

						li.on(
							'click',
							function() {

								var $this = $( this );
								$this.parent().find( 'li' ).removeClass( 'selected' );
								$this.addClass( 'selected' );

								var value = $this.text();

								if ( default_text === value ) {
									value = '';
								}

								var parent = $( this ).parent().closest( 'li' ).find( 'select' );
								api.instance( parent.prop( 'id' ) ).set( value );

							}
						);

						new_selector.append( li );

					}
				);

				$this.append( new_selector );

			}
			);

		} );

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
									console.log( index, item_height, index * item_height );
								}
							);

						}
					);
				}
			);
		}
	);


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