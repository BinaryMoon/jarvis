
; ( function( $ ) {

	var api = wp.customize;
	var default_text = 'Default';

	// font picker
	$( document ).ready(
		function() {

			$( '.jarvis-font-picker' ).each(
				function() {

					var $this = $( this );
					var $select = $this.find( 'select' );
					var $options = $select.find( 'option' );
					var new_selector = $( '<ul class="jarvis-font-selector"></ul>' );
					var current_index = 0;

					$options.each(
						function() {

							current_index++;

							var $this = $( this );
							var family = $this.data( 'font-family' );
							var value = $this.attr( 'value' );
							var li = $( '<li>' + $this.html() + '</li>' )
								.css( 'font-family', family )
								.data( 'index', current_index )
								.data( 'value', value );

							if ( $this.is( ':selected' ) ) {

								li.addClass( 'selected' );

							}

							li.on(
								'click',
								function() {

									var $this = $( this );

									$this.parent().find( 'li' ).removeClass( 'selected' );
									$this.addClass( 'selected' );

									var value = $this.data( 'value' );

									if ( default_text === value ) {
										value = '';
									}

									var parent = $( this ).parent().closest( 'li' ).find( 'select' );
									api.instance( parent.prop( 'id' ) ).set( value );

								}
							);

							new_selector.append( li );

						}
					);

					$this.append( new_selector );

				}
			);

		}
	);

	wp.customize.bind(
		'ready',
		function() {

			// Detect when the color section is expanded (or closed) so we can adjust the font heights accordingly.
			wp.customize.section(
				'colors',
				function( section ) {
					section.expanded.bind(
						function( isExpanding ) {

							// Quit if collapsing. No need to change anything.
							if ( !isExpanding ) {
								return;
							}

							$( '.styleguide-font-selector' ).each(
								function() {
									var $this = $( this );
									var index = parseInt( $this.find( '.selected' ).data( 'index' ) ) - 1;
									var item_height = $this.find( 'li:first' ).outerHeight();
									$this.scrollTop( index * item_height );
								}
							);

						}
					);
				}
			);
		}
	);


} )( jQuery );
