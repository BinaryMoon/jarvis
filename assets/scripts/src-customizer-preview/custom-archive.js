/**
 * Live updates for the archive customizations.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			/**
			 * Note: archive_header_height is updated in custom-site-header to
			 * keep header related properties together.
			 */

			// Edit Archive Article Layout.
			wp.customize(
				'jarvis_archive_articles',
				function( value ) {
					value.bind(
						function( to ) {

							$( 'body' )
								.removeClass( 'archive-articles-0 archive-articles-1 archive-articles-2 archive-articles-3 archive-articles-4' )
								.addClass( 'archive-articles-' + to );

						}
					);
				}
			);

		}
	);

} )( jQuery );