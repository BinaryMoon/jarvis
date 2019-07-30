/**
 * Live updates for the site description.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit Header Layout.
			wp.customize(
				'jarvis_header_layout',
				function( value ) {
					value.bind(
						function( to ) {

							var count = 2;
							var selectors = '';

							for ( i = 0; i <= count; i++ ) {
								selectors += ' header-layout-' + i;
							}

							$( 'body' )
								.removeClass( selectors )
								.addClass( 'header-layout-' + to );

						}
					);
				}
			);

			// Edit Archive Header Height.
			wp.customize(
				'jarvis_archive_header_height',
				function( value ) {
					value.bind(
						header_height
					);
				}
			);

			// Edit Single Header Height.
			wp.customize(
				'jarvis_single_header_height',
				function( value ) {
					value.bind(
						header_height
					);
				}
			);

			var hide_element = {
				'clip': 'rect(1px, 1px, 1px, 1px)',
				'position': 'absolute'
			};

			var show_element = {
				'clip': 'auto',
				'position': 'relative'
			};


			// Edit Site title display.
			wp.customize(
				'jarvis_site_title',
				function( value ) {
					value.bind(
						function( display ) {

							switch ( parseInt( display ) ) {

								// Hide the site description.
								case 1:

									$( '.branding .site-title' ).css( show_element );
									$( '.branding .site-description' ).css( hide_element );

									break;

								// Hide everything.
								case 2:

									$( '.branding .site-title, .branding .site-description' ).css( hide_element );

									break;

								// Show everything.
								default:

									$( '.branding .site-title, .branding .site-description' ).css( show_element );

							}

						}
					);
				}
			);


		}
	);

	var header_height = function( to ) {

		var count = 2;
		var selectors = '';

		for ( i = 0; i <= count; i++ ) {
			selectors += ' header-height-' + i;
		}

		$( 'body' )
			.removeClass( selectors )
			.addClass( 'header-height-' + to );

	};

} )( jQuery );