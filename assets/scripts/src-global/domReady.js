/*!
 * Run event after the DOM is ready
 * (c) 2017 Chris Ferdinandi, MIT License, https://gomakethings.com
 * https://vanillajstoolkit.com/helpers/ready/
 * @param  {Function} fn Callback function
 */
; ( function() {

	var ready = function( fn ) {

		// Sanity check.
		if ( 'function' !== typeof fn ) {
			return;
		}

		// If document is already loaded, run method.
		if ( 'interactive' === document.readyState || 'complete' === document.readyState ) {
			return fn();
		}

		// Otherwise, wait until document is loaded.
		document.addEventListener( 'DOMContentLoaded', fn, false );

	};

	window.jarvis = window.jarvis || {};

	window.jarvis.ready = ready;

} )();
