/**
 * Live-update changed settings in real time in the Customizer preview.
 *
 * Filename: customizer-preview.js v1
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#javascript-driven-widget-support
 *
 * @package jarvis
 */

/* global wp */

; ( function() {

	wp.customize.bind(
		'ready',
		function() {

			// Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
			wp.customize.section(
				'jarvis_credits',
				function( section ) {

					section.expanded.bind(
						function( isExpanding ) {

							// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
							wp.customize.previewer.send(
								'jarvis_credits_expand',
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

// Silence is golden!