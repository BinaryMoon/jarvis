; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit site description.
			wp.customize(
				'blogdescription',
				function( value ) {
					value.bind(
						function( to ) {
							$( '.site-description' ).text( to );
						}
					);
				}
			);

		}
	);

} )( jQuery );