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

			wp.customize(
				'jarvis_single_show_author',
				function( value ) {
					value.bind(
						function( to ) {

							$( '.byline' ).css( 'display', to ? 'inline' : 'none' );

						}
					);
				}
			);

			wp.customize(
				'jarvis_single_show_date',
				function( value ) {
					value.bind(
						function( to ) {

							$( '.posted-on' ).css( 'display', to ? 'inline' : 'none' );

						}
					);
				}
			);

		}
	);

} )( jQuery );