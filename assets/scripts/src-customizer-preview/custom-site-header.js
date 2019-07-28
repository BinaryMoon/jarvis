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