var menuToggle = function() {

	var toggle = function( e ) {

		var $parent = document.querySelector( '.menu-primary' );
		var $menu = document.querySelector( '#nav' );
		var $this = e.target;

		$parent.classList.toggle( 'menu-on' );

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

	events.on(
		'click',
		'.menu-toggle',
		toggle
	);

};
