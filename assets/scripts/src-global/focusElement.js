/**
 * Focus an html element based upon a link target.
 */
; ( function() {

	var focusElement = function( e ) {

		// Make sure there is a target.
		if ( !e.target.hash ) {
			return;
		}

		focusSelector( e.target.hash );

	};

	/**
	 * Focus the first element with the specified selector.
	 */
	var focusSelector = function( selector ) {

		var e = document.querySelector( selector );

		if ( e ) {

			if ( !( /^(?:a|select|input|button|textarea)$/i.test( e.tagName ) ) ) {
				e.tabIndex = -1;
			}

			e.focus();

		}

	};

	window.jarvis = window.jarvis || {};

	window.jarvis.focusElement = focusElement;
	window.jarvis.focusSelector = focusSelector;

} )();
