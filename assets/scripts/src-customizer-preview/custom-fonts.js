/**
 * Live updates for the site description.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit Title font.
			wp.customize(
				'jarvis_title_font',
				function( value ) {
					value.bind(
						function( to ) {
							document.body.style.setProperty( '--font-title', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

			// Edit Header font.
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
							document.body.style.setProperty( '--font-body', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

			// Edit Meta font.
			wp.customize(
				'jarvis_meta_font',
				function( value ) {
					value.bind(
						function( to ) {
							document.body.style.setProperty( '--font-meta', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

		}
	);

} )( jQuery );