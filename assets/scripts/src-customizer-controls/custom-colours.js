/**
 * Modify the customizer controls for the colours panel.
 */
; ( function( $ ) {

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Check for changes in the dark mode checkbox.
			 *
			 * This lets us show and hide the dark mode background colour when
			 * the checkbox is ticked. Taking it out of view when it's not needed.
			 */
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
