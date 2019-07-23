/**
 * Live updates for the archive customizations.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit Archive Layout.
			wp.customize(
				'jarvis_archive_layout',
				function( value ) {
					value.bind(
						function( to ) {

							$( 'body' )
								.removeClass( 'archive-layout-0 archive-layout-1' )
								.addClass( 'archive-layout-' + to );

						}
					);
				}
			);

		}
	);

} )( jQuery );