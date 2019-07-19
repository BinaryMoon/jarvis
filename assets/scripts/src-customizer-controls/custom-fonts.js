
; ( function( $ ) {

	var api = wp.customize;

	// font picker
	$( document ).ready(
		function() {

			$( '.jarvis-font-picker' ).each(
				function() {

					var $this = $( this );
					var $select = $this.find( 'select' );
					var $options = $select.find( 'option' );
					var $container = $( '<div class="jarvis-font-selector"></div>' )
						.data( 'parentID', $select.prop( 'id' ) );

					$options.each(
						function() {

							var $this = $( this );
							var button = $( '<button>' + $this.html() + '</button>' )
								.attr( 'type', 'button' )
								.css( 'font-family', $this.data( 'font-family' ) )
								.data( 'value', $this.attr( 'value' ) );

							if ( $this.is( ':selected' ) ) {
								button.addClass( 'selected' );
							}

							button.on(
								'click',
								selectFont
							);

							$container.append( button );

						}
					);

					$this.append( $container );

				}
			);

		}
	);

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Detect when the fonts section is expanded (or closed) so we can
			 * adjust the font heights accordingly.
			 */
			wp.customize.section(
				'jarvis_fonts',
				function( section ) {
					section.expanded.bind(
						function( isExpanding ) {

							// Quit if collapsing. No need to change anything.
							if ( !isExpanding ) {
								return;
							}

							// Calculate for all font selectors.
							$( '.jarvis-font-selector' ).each(
								function() {

									var $this = $( this );
									var index = parseInt( $this.find( '.selected' ).index() );
									var item_height = $this.find( 'button:first' ).outerHeight( true );
									$this.scrollTop( index * item_height );

								}
							);

						}
					);
				}
			);
		}
	);

	/**
	 * Select a new font and update the setting.
	 */
	var selectFont = function( e ) {

		e.preventDefault();

		var $this = $( this );

		$this.parent().find( 'button' ).removeClass( 'selected' );
		$this.addClass( 'selected' );

		var value = $this.data( 'value' );
		var parentID = $( this ).parent().data( 'parentID' );

		api.instance( parentID ).set( value );

	};

} )( jQuery );
