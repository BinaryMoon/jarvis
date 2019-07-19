/**
 * Live updates for the site description.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit Hesder font.
			wp.customize(
				'jarvis_header_font',
				function( value ) {
					value.bind(
						function( to ) {
							document.body.style.setProperty( '--font-header', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

			// Edit Body font.
			wp.customize(
				'jarvis_body_font',
				function( value ) {
					value.bind(
						function( to ) {
							console.log( 'body font' );
							document.body.style.setProperty( '--font-body', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

		}
	);

} )( jQuery );