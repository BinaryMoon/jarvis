/**
 * Live updates for the single post customizations.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit Single Post Layout.
			wp.customize(
				'jarvis_single_layout',
				function( value ) {
					value.bind(
						function( to ) {

							$( 'body' )
								.removeClass( 'single-layout-0 single-layout-1' )
								.addClass( 'single-layout-' + to );

						}
					);
				}
			);

		}
	);

} )( jQuery );