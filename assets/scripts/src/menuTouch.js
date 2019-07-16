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
