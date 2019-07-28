/**
 * Live updates for the header text colour.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Change header text color.
			wp.customize(
				'header_textcolor',
				function( value ) {

					value.bind(
						function( to ) {

							// Hide title and description.
							if ( 'blank' === to ) {

								$( '.branding .site-title, .branding .site-description' ).css(
									{
										'clip': 'rect(1px, 1px, 1px, 1px)',
										'position': 'absolute'
									}
								);

							} else {

								$( '.branding .site-title, .branding .site-description' ).css(
									{
										'clip': 'auto',
										'position': 'relative'
									}
								);

								$( '.branding .site-title, .branding .site-title a, .branding .site-title a:hover, .branding p.site-description' ).css(
									{
										'color': to
									}
								);

							}
						}
					);
				}
			);

		}
	);

} )( jQuery );