
; ( function( $ ) {

	var api = wp.customize;

	// font picker
	$( document ).ready(
		function() {

			$( '.jarvis-font-picker label' ).on(
				'click',
				selectFont
			);

		}
	);

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Detect when the fonts section is expanded (or closed) so we can
			 * adjust the font heights accordingly.
			 */
			wp.customize.section(
				'jarvis_fonts',
				function( section ) {
					section.expanded.bind(
						function( isExpanding ) {

							// Quit if collapsing. No need to change anything.
							if ( !isExpanding ) {
								return;
							}

							// Calculate for all font selectors.
							$( '.jarvis-font-picker' ).each(
								function() {

									var $this = $( this );
									var index = parseInt( $this.find( '.selected' ).index() ) - 1;
									var item_height = $this.find( 'label:first' ).outerHeight( true );
									// We divide the index by 2 since we are counting inputs AND labels.
									$this.scrollTop( index * ( item_height / 2 ) );

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

		var $this = $( this );

		// Deselect all labels.
		$this.parent().find( 'label' ).removeClass( 'selected' );
		// Select current label.
		$this.addClass( 'selected' );

		var $input = $( '#' + $this.attr( 'for' ) );
		var value = $input.attr( 'value' );
		var parentID = $input.attr( 'name' );

		api.instance( parentID ).set( value );

	};

} )( jQuery );
