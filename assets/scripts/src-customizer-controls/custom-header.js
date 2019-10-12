/* global wp */

; ( function() {

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Detect when the header section is expanded (or closed) so we can
			 * adjust the preview accordingly.
			 */
			wp.customize.section(
				'jarvis_header',
				function( section ) {

					/**
					 * Scroll to the header when the header section is opened.
					 */
					section.expanded.bind(
						function( isExpanding ) {

							/**
							 * Value of isExpanding will = true if you're
							 * entering the section, false if you're leaving it.
							 */
							wp.customize.previewer.send(
								'jarvis_header_expand',
								{
									expanded: isExpanding
								}
							);

						}

					);

				}
			);

		}
	);

} )();
