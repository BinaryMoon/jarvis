var menuTouch = function() {

	if ( !is_touch_device() ) {
		return;
	}


	// If a dropdown menu is tapped on a touch device then focus the menu.
	events.on(
		'touchend',
		'#nav > .menu-item-has-children > a',
		function( e ) {

			var $parents = getParents( e.target, 'li' );
			var $parent = $parents[ 0 ];

			/**
			 * If the parent is not focused then cancel the click.
			 * This prevents the page from changing before children can be seen
			 * and selected.
			 * If you click a link again then the link will be followed.
			 */
			if ( !$parent.classList.contains( 'focus' ) && !document.querySelector( '.menu' ).classList.contains( 'menu-on' ) ) {
				removeFocus();
				e.preventDefault();
			}

			$parent.classList.add( 'focus' );

		}
	);

	// If you tap on the page body then the page will remove focus from all menu items.
	events.on(
		'touchstart',
		'body',
		function( e ) {

			var $parents = getParents( e.target, 'li' );

			if ( !$parents.length ) {
				removeFocus();
			}

		}
	);


	/**
	 * Remove the focus from the parent menu items.
	 */
	var removeFocus = function() {

		var list = document.querySelectorAll( '#nav > li' );

		list.forEach(
			function( item, index ) {
				list[ index ].classList.remove( 'focus' );
			}
		);

	};

};