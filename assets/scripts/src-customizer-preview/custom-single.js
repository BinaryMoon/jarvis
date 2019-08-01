/**
 * Live updates for the single post customizations.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			/**
			 * Note: single_header_height is updated in custom-site-header to
			 * keep header related properties together.
			 */

			/**
			 * Set default values.
			 */
			$( '.byline' ).css( 'display', wp.customize( 'jarvis_single_show_author' )() ? 'inline' : 'none' );
			$( '.posted-on' ).css( 'display', wp.customize( 'jarvis_single_show_date' )() ? 'inline' : 'none' );
			$( '.entry-terms' ).css( 'display', wp.customize( 'jarvis_single_show_categories' )() ? 'block' : 'none' );
			$( '.content-single .contributor' ).css( 'display', wp.customize( 'jarvis_single_show_author_details' )() ? 'grid' : 'none' );

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

			wp.customize(
				'jarvis_single_show_categories',
				function( value ) {

					value.bind(
						function( to ) {

							$( '.entry-terms' ).css( 'display', to ? 'block' : 'none' );

						}
					);
				}
			);

			wp.customize(
				'jarvis_single_show_author_details',
				function( value ) {

					value.bind(
						function( to ) {

							$( '.content-single .contributor' ).css( 'display', to ? 'grid' : 'none' );

						}
					);
				}
			);

		}
	);

} )( jQuery );