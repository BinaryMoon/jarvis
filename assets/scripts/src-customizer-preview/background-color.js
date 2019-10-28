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
				'jarvis_light_mode_colour',
				function( value ) {
					value.bind( set_colour );
				}
			);

			wp.customize(
				'jarvis_dark_mode_colour',
				function( value ) {
					value.bind( set_colour );
				}
			);

		}
	);

	/**
	 * Set the background colour and make sure the font is the appropriate colour.
	 */
	function set_colour( to ) {

		var style = document.body.style;

		style.setProperty( '--background-color-light', to );
		style.setProperty( '--background-color-dark', to );

		style.setProperty( '--foreground-color-light', brightness( to ) ? '#000' : '#fff' );
		style.setProperty( '--foreground-color-dark', brightness( to ) ? '#000' : '#fff' );

		style.setProperty( '--foreground-contrast-color-light', brightness( to ) ? '#fff' : '#000' );
		style.setProperty( '--foreground-contrast-color-dark', brightness( to ) ? '#fff' : '#000' );

	}

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