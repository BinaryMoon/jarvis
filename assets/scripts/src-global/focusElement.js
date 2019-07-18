/**
 * Focus an html element based upon a link target.
 */
; ( function() {

	var focusElement = function( e ) {

		// Make sure there is a target.
		if ( !e.target.hash ) {
			return;
		}

		// Try to grab the target element.
		var element = document.querySelector( e.target.hash );

		// If there is an element to use - then let's focus it.
		if ( element ) {

			if ( !( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
				element.tabIndex = -1;
			}

			element.focus();

		}

	};

	window.jarvis = window.jarvis || {};

	window.jarvis.focusElement = focusElement;

} )();
