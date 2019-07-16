; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit site title.
			wp.customize(
				'blogname',
				function( value ) {
					value.bind(
						function( to ) {
							$( '.site-title' ).text( to );
						}
					);
				}
			);

		}
	);

} )( jQuery );