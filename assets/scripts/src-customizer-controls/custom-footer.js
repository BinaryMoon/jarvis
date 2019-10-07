/* global wp */

; ( function() {

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Detect when the credits section is expanded (or closed) so we can
			 * adjust the preview accordingly.
			 */
			wp.customize.section(
				'jarvis_credits',
				function( section ) {

					/**
					 * Scroll down to the footer when the credits section is
					 * opened.
					 */
					section.expanded.bind(
						function( isExpanding ) {

							/**
							 * Value of isExpanding will = true if you're
							 * entering the section, false if you're leaving it.
							 */
							wp.customize.previewer.send(
								'jarvis_credits_expand',
								{
									expanded: isExpanding
								}
							);

							/**
							 * Display the description by default.
							 *
							 * This code is largely borrowed from the additional
							 * css customizer panel.
							 * @see https://github.com/WordPress/WordPress/blob/51f43144413c1456e19907a9ce403a89bdf254a1/wp-admin/js/customize-controls.js
							 *
							 * The description includes docs explaining the available shortcuts.
							 */
							var description = section.container.find( '.section-meta .customize-section-description:first' );

							/**
							 * Check for the jarvisExpanded class.
							 *
							 * This prevents the description from being opened
							 * every time. It will only open once.
							 */
							if ( !description.hasClass( 'jarvisExpanded' ) ) {

								/**
								 * Open the description, and add a class that we
								 * can check later to prevent constantly opening
								 * the description.
								 */
								description
									.addClass( 'open' )
									.addClass( 'jarvisExpanded' )
									.show()
									.trigger( 'toggled' );

								section.container.find( '.customize-help-toggle' )
									.attr( 'aria-expanded', 'true' );

							}

							/**
							 * Setup the 'close' description button.
							 */
							section.container.find( '.section-description-buttons .section-description-close' ).on(
								'click',
								function() {
									section.container.find( '.section-meta .customize-section-description:first' )
										.removeClass( 'open' )
										.slideUp();

									section.container.find( '.customize-help-toggle' )
										.attr( 'aria-expanded', 'false' )
										.focus(); // Avoid focus loss.
								}
							);
						}

					);

				}
			);

		}
	);

} )();
