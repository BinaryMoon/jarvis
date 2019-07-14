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
