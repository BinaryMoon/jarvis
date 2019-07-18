/**
 * Live updates for the background colour.
 *
 * Technically background colour is already updated in real time. This adds a
 * corresponding class to the html element so that we can have readable text.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			wp.customize(
				'background_color',
				function( value ) {
					value.bind(
						function( to ) {

							var newClass = brightness( to ) ? 'light-mode' : 'dark-mode';
							$( 'body' ).removeClass( 'dark-mode light-mode' ).addClass( newClass );

						}
					);
				}
			);

		}
	);

	/**
	 * Calculate the brightness of the colour, and then decide if the
	 * contrasting colour should be light or dark.
	 */
	function brightness( color ) {

		if ( !color ) {
			return 0;
		}

		var lighter_than = 130;

		color = color.replace( '#', '' );

		// Calculate straight from RGB.
		var r = parseInt( '' + color[ 0 ] + color[ 1 ], 16 );
		var g = parseInt( '' + color[ 2 ] + color[ 3 ], 16 );
		var b = parseInt( '' + color[ 4 ] + color[ 5 ], 16 );

		return ( ( r * 299 + g * 587 + b * 114 ) / 1000 > lighter_than );

	}

} )( jQuery );