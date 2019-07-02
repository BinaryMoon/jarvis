/**
 * Theme Customizer code
 *
 * Filename: theme-customizer.js v1.1
 *
 * Created by Ben Gillbanks <http://www.binarymoon.co.uk/>
 * Available under GPL2 license
 *
 * @package Jarvis
 */

/* global wp */

; ( function( $ ) {

	var api = wp.customize;

	$( document ).ready(
		function() {

			$( '.jarvis-category-checkbox' ).on(
				'change',
				function() {

					var $this = $( this );
					var id = $this.closest( 'li' ).find( '.jarvis-hidden-categories' ).prop( 'id' );
					var categories = [];

					$this.closest( 'li' ).find( '.jarvis-category-checkbox' ).each(
						function() {

							var $this = $( this );
							if ( true === $this.prop( 'checked' ) ) {
								var element = $this.prop( 'id' ).split( '-' );
								categories.push( element[ 1 ] );
							}

						}
					);

					api.instance( id ).set( categories.join() );

				}
			);

			$( '.jarvis-dragdrop-select' ).on(
				'change',
				function() {

					var $this = $( this );
					var selected = $this.find( ':selected' );
					var new_li = '<li data-value="' + selected.val() + '">' + selected.text() + '</li>';

					$this.parent().find( '.jarvis-sortable' ).append( new_li );
					list_add_close_button();

					$this.val( 'default' );

					selected.remove();

					list_update();

				}
			);

			$( '.jarvis-sortable' ).sortable(
				{
					placeholder: 'jarvis-highlight',
					update: function() {
						list_update();
					}
				}
			);

			list_add_close_button();

		}
	);

	var list_close_button = function( element ) {

		var close = $( '<a href="" class="jarvis-close">&times;</a>' );

		$( element ).append( close );

		close.on(
			'click',
			function() {

				var $this = $( this );
				var parent = $this.parent();
				var select = $this.closest( '.customize-control' ).find( '.jarvis-dragdrop-select' );
				$this.remove();

				var new_option = '<option value="' + parent.data( 'value' ) + '">' + parent.text() + '</option>';
				select.append( new_option );
				parent.remove();

				list_update();
				return false;

			}
		);

	};

	var list_update = function() {

		$( '.jarvis-sortable' ).each(
			function() {

				var list = [];
				var id = $( this ).closest( 'li' ).find( '.jarvis-hidden-categories' ).prop( 'id' );

				$( this ).find( 'li' ).each(
					function() {
						list.push( $( this ).data( 'value' ) );
					}
				);

				api.instance( id ).set( list.join() );

			}
		);

	};

	var list_add_close_button = function() {

		$( '.jarvis-sortable li' ).each(
			function() {

				if ( 0 === $( this ).find( 'a.jarvis-close' ).length ) {
					list_close_button( this );
				}

			}
		);

	};

} )( jQuery );
