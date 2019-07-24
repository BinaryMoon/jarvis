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

/*!
 * eventslibjs v1.2.0
 * A tiny event delegation helper library.
 * (c) 2019 Chris Ferdinandi
 * MIT License
 * http://github.com/cferdinandi/events
 */
( function( root, factory ) {
	if ( typeof define === 'function' && define.amd ) {
		define( [], ( function() {
			return factory( root );
		} ) );
	} else if ( typeof exports === 'object' ) {
		module.exports = factory( root );
	} else {
		root.events = factory( root );
	}
} )( typeof global !== 'undefined' ? global : typeof window !== 'undefined' ? window : this, ( function( window ) {

	'use strict';

	//
	// Variables
	//

	var publicAPIs = {};
	var activeEvents = {};


	//
	// Methods
	//

	/**
	 * Get the index for the listener
	 * @param  {Array}   arr      The listeners for an event
	 * @param  {Array}   listener The listener details
	 * @return {Integer}          The index of the listener
	 */
	var getIndex = function( arr, selector, callback ) {
		for ( var i = 0; i < arr.length; i++ ) {
			if (
				arr[ i ].selector === selector &&
				arr[ i ].callback.toString() === callback.toString()
			) return i;
		}
		return -1;
	};

	/**
	 * Check if the listener callback should run or not
	 * @param  {Node}         target   The event.target
	 * @param  {String|Node}  selector The selector to check the target against
	 * @return {Boolean}               If true, run listener
	 */
	var doRun = function( target, selector ) {
		if ( [
			'*',
			'window',
			'document',
			'document.documentElement',
			window,
			document,
			document.documentElement
		].indexOf( selector ) > -1 ) return true;
		if ( typeof selector !== 'string' && selector.contains ) {
			return selector === target || selector.contains( target );
		}
		return target.closest( selector );
	};

	/**
	 * Handle listeners after event fires
	 * @param {Event} event The event
	 */
	var eventHandler = function( event ) {
		if ( !activeEvents[ event.type ] ) return;
		activeEvents[ event.type ].forEach( ( function( listener ) {
			if ( !doRun( event.target, listener.selector ) ) return;
			listener.callback( event );
		} ) );
	};

	/**
	 * Add an event
	 * @param  {String}   types    The event type or types (comma separated)
	 * @param  {String}   selector The selector to run the event on
	 * @param  {Function} callback The function to run when the event fires
	 */
	publicAPIs.on = function( types, selector, callback ) {

		// Make sure there's a selector and callback
		if ( !selector || !callback ) return;

		// Loop through each event type
		types.split( ',' ).forEach( ( function( type ) {

			// Remove whitespace
			type = type.trim();

			// If no event of this type yet, setup
			if ( !activeEvents[ type ] ) {
				activeEvents[ type ] = [];
				window.addEventListener( type, eventHandler, true );
			}

			// Push to active events
			activeEvents[ type ].push( {
				selector: selector,
				callback: callback
			} );

		} ) );

	};

	/**
	 * Remove an event
	 * @param  {String}   types    The event type or types (comma separated)
	 * @param  {String}   selector The selector to remove the event from
	 * @param  {Function} callback The function to remove
	 */
	publicAPIs.off = function( types, selector, callback ) {

		// Loop through each event type
		types.split( ',' ).forEach( ( function( type ) {

			// Remove whitespace
			type = type.trim();

			// if event type doesn't exist, bail
			if ( !activeEvents[ type ] ) return;

			// If it's the last event of it's type, remove entirely
			if ( activeEvents[ type ].length < 2 || !selector ) {
				delete activeEvents[ type ];
				window.removeEventListener( type, eventHandler, true );
				return;
			}

			// Otherwise, remove event
			var index = getIndex( activeEvents[ type ], selector, callback );
			if ( index < 0 ) return;
			activeEvents[ type ].splice( index, 1 );

		} ) );

	};

	/**
	 * Add an event, and automatically remove it after it's first run
	 * @param  {String}   types    The event type or types (comma separated)
	 * @param  {String}   selector The selector to run the event on
	 * @param  {Function} callback The function to run when the event fires
	 */
	publicAPIs.once = function( types, selector, callback ) {
		publicAPIs.on( types, selector, ( function temp( event ) {
			callback( event );
			publicAPIs.off( types, selector, temp );
		} ) );
	};

	/**
	 * Get an immutable copy of all active event listeners
	 * @return {Object} Active event listeners
	 */
	publicAPIs.get = function() {
		var obj = {};
		for ( var type in activeEvents ) {
			if ( activeEvents.hasOwnProperty( type ) ) {
				obj[ type ] = activeEvents[ type ];
			}
		}
		return obj;
	};


	//
	// Return public APIs
	//

	return publicAPIs;

} ) );
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

/**
 * Get the parents of the specified html element.
 */
; ( function() {

	var getParents = function( elem, selector ) {

		// Set up a parent array
		var parents = [];

		// Push each parent element to the array
		for ( ; elem && elem !== document; elem = elem.parentNode ) {
			if ( selector ) {
				if ( elem.matches( selector ) ) {
					parents.push( elem );
				}
				continue;
			}
			parents.push( elem );
		}

		return parents;

	};

	window.jarvis = window.jarvis || {};

	window.jarvis.getParents = getParents;

} )();

/**
 * JS mobile detection.
 */
; ( function() {

	/**
	 * Is this a touch enabled device or not?
	 *
	 * @return boolean
	 */
	var is_touch_device = function() {

		return ( ( 'ontouchstart' in window ) || ( navigator.MaxTouchPoints > 0 ) || ( navigator.msMaxTouchPoints > 0 ) );

	};

	window.jarvis = window.jarvis || {};

	window.jarvis.is_touch_device = is_touch_device;

} )();

/**
 * Mobile menu toggle.
 *
 * Toggles the menu visibility on small screens.
 */
; ( function() {

	var menuToggle = function() {

		// The toggle action.
		var toggle = function( e ) {

			var $parent = document.querySelector( '.menu-primary' );
			var $menu = document.querySelector( '#nav' );
			var $this = e.target;

			$parent.classList.toggle( 'menu-on' );

			// If the menu has been turned on.
			// Add ARIA hints to help screen readers know what is active.
			if ( $parent.classList.contains( 'menu-on' ) ) {

				// Menu is shown.
				$menu.setAttribute( 'aria-expanded', 'true' );
				$this.setAttribute( 'aria-expanded', 'true' );

			} else {

				// Menu is hidden.
				$menu.setAttribute( 'aria-expanded', 'false' );
				$this.setAttribute( 'aria-expanded', 'false' );

			}

		};

		// Setup the click event.
		events.on(
			'click',
			'.menu-toggle',
			toggle
		);

	};

	window.jarvis = window.jarvis || {};

	window.jarvis.menuToggle = menuToggle;

} )();

/**
 * Improve menu behaviour for touch devices.
 */

; ( function() {

	var menuTouch = function() {

		if ( !jarvis.is_touch_device() ) {
			return;
		}

		/**
		 * If a dropdown menu is tapped on a touch device then focus the menu.
		 * If the menu is closed don't follow the link.
		 * If the menu is open then go to the relevant page.
		 *
		 * This allows dropdown menus to display properly.
		 */
		events.on(
			'touchend',
			'#nav > .menu-item-has-children > a',
			function( e ) {

				var $parents = jarvis.getParents( e.target, 'li' );
				var $parent = $parents[ 0 ];

				/**
				 * If the parent is not focused then cancel the click.
				 * This prevents the page from changing before children can be seen
				 * and selected.
				 * If you click a link again then the link will be followed.
				 */
				if (
					!$parent.classList.contains( 'focus' )
					&& !document.querySelector( '.menu' ).classList.contains( 'menu-on' )
				) {
					removeFocus();
					e.preventDefault();
				}

				$parent.classList.add( 'focus' );

			}
		);

		// If you tap on the page body then remove focus from all menu items.
		events.on(
			'touchstart',
			'body',
			function( e ) {

				var $parents = jarvis.getParents( e.target, 'li' );

				if ( !$parents.length ) {
					removeFocus();
				}

			}
		);


		/**
		 * Remove the focus from the parent menu items.
		 */
		var removeFocus = function() {

			// Grab all parents. We only use the top level so can ignore the others.
			var list = document.querySelectorAll( '#nav > li' );

			list.forEach(
				function( item ) {
					item.classList.remove( 'focus' );
				}
			);

		};

	};

	window.jarvis = window.jarvis || {};

	window.jarvis.menuTouch = menuTouch;

} )();

/**
 * closest() polyfill
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
 */
if ( window.Element && !Element.prototype.closest ) {
	Element.prototype.closest = function( s ) {
		var matches = ( this.document || this.ownerDocument ).querySelectorAll( s ),
			i,
			el = this;
		do {
			i = matches.length;
			while ( --i >= 0 && matches.item( i ) !== el ) { }
		} while ( ( i < 0 ) && ( el = el.parentElement ) );
		return el;
	};
}
// Element.matches() polyfill
if ( !Element.prototype.matches ) {
	Element.prototype.matches =
		Element.prototype.matchesSelector ||
		Element.prototype.mozMatchesSelector ||
		Element.prototype.msMatchesSelector ||
		Element.prototype.oMatchesSelector ||
		Element.prototype.webkitMatchesSelector ||
		function( s ) {
			var matches = ( this.document || this.ownerDocument ).querySelectorAll( s ),
				i = matches.length;
			while ( --i >= 0 && matches.item( i ) !== this ) { }
			return i > -1;
		};
}
/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
; ( function() {

	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {

		window.addEventListener(
			'hashchange',
			function() {

				var id = location.hash.substring( 1 );
				var element;

				if ( !( /^[A-z0-9_-]+$/.test( id ) ) ) {
					return;
				}

				element = document.getElementById( id );

				if ( element ) {
					if ( !( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
						element.tabIndex = -1;
					}

					element.focus();
				}

			},
			false
		);
	}

} )();
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
			function( item ) {
				item.classList.add( 'menu-no-href' );
				item.setAttribute( 'href', '#' );
			}
		);

	}
);