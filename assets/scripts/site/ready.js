/*!
 * The main javascript file for the theme, this makes the magic happen
 *
 * Filename: global.js v1
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @package Jarvis
 */

jarvis.ready(
	function() {

		events.on(
			'click',
			'a[href^="#"]',
			jarvis.focusElement
		);

		// Mobile device detection.
		var touchClass = 'device-click';
		if ( jarvis.is_touch_device() ) {
			touchClass = 'device-touch';
		}
		document.querySelector( 'html' ).classList.add( touchClass );

		jarvis.menuTouch();

		jarvis.menuToggle();

		/**
		 * Add href to links without so that dropdowns work properly on
 		 * touch devices.
 		 */
		events.on(
			'click',
			'.menu a:not([href])',
			function( e ) {
				e.preventDefault();
			}
		);

		// Ensure links with no hrefs don't break the navigation.
		var menuNoLinks = document.querySelectorAll( 'a:not([href])' );

		menuNoLinks.forEach(
			function( item, index ) {
				menuNoLinks[ index ].classList.add( 'menu-no-href' );
				menuNoLinks[ index ].setAttribute( 'hreg', '#' );
			}
		);

	}
);