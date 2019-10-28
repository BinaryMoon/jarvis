
; ( function( $ ) {

	wp.customize.bind(
		'ready',
		function() {

			wp.customize(
				'jarvis_dark_mode',
				function( setting ) {

					wp.customize.control(
						'jarvis_dark_mode_colour',
						function( control ) {

							var visibility = function() {
								if ( setting.get() ) {
									control.container.slideDown( 180 );
								} else {
									control.container.slideUp( 180 );
								}
							};

							visibility();
							setting.bind( visibility );

						}
					);

				}
			);
		}
	);

} )( jQuery );
