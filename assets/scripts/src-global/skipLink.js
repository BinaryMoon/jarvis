/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
; ( function() {

	window.addEventListener(
		'hashchange',
		function() {

			var id = location.hash.substring( 1 );

			if ( !( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			var element = document.getElementById( id );

			if ( element ) {
				if ( !( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.setAttribute( 'tabindex', -1 );
				}

				element.focus();
			}

		},
		false
	);

} )();