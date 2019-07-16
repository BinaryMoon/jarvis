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

								$( '.masthead .site-title, .masthead .site-description' ).css(
									{
										'clip': 'rect(1px, 1px, 1px, 1px)',
										'position': 'absolute'
									}
								);

							} else {

								$( '.masthead .site-title, .masthead .site-description' ).css(
									{
										'clip': 'auto',
										'position': 'relative'
									}
								);

								$( '.masthead .site-title, .masthead .site-title a, .masthead .site-title a:hover, .masthead p.site-description' ).css(
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