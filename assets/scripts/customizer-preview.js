/**
 * Live updates for the background colour.
 *
 * Technically background colour is already updated in real time. This adds a
 * corresponding class to the html element so that we can have readable text.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			wp.customize(
				'background_color',
				function( value ) {
					value.bind(
						function( to ) {

							var newClass = brightness( to ) ? 'is-light-theme' : 'is-dark-theme';
							$( 'body' ).removeClass( 'is-dark-theme is-light-theme' ).addClass( newClass );

						}
					);
				}
			);

		}
	);

	/**
	 * Calculate the brightness of the colour, and then decide if the
	 * contrasting colour should be light or dark.
	 */
	function brightness( color ) {

		if ( !color ) {
			return 0;
		}

		var lighter_than = 130;

		color = color.replace( '#', '' );

		// Calculate straight from RGB.
		var r = parseInt( '' + color[ 0 ] + color[ 1 ], 16 );
		var g = parseInt( '' + color[ 2 ] + color[ 3 ], 16 );
		var b = parseInt( '' + color[ 4 ] + color[ 5 ], 16 );

		return ( ( r * 299 + g * 587 + b * 114 ) / 1000 > lighter_than );

	}

} )( jQuery );
/**
 * Live updates for the archive customizations.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			/**
			 * Note: archive_header_height is updated in custom-site-header to
			 * keep header related properties together.
			 */

			// Edit Archive Layout.
			wp.customize(
				'jarvis_archive_layout',
				function( value ) {
					value.bind(
						function( to ) {

							$( 'body' )
								.removeClass( 'archive-layout-0 archive-layout-1' )
								.addClass( 'archive-layout-' + to );

						}
					);
				}
			);

			// Edit Archive Article Layout.
			wp.customize(
				'jarvis_archive_articles',
				function( value ) {
					value.bind(
						function( to ) {

							$( 'body' )
								.removeClass( 'archive-articles-0 archive-articles-1 archive-articles-2' )
								.addClass( 'archive-articles-' + to );

						}
					);
				}
			);

		}
	);

} )( jQuery );
/**
 * Live updates for the site description.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit Title font.
			wp.customize(
				'jarvis_title_font',
				function( value ) {
					value.bind(
						function( to ) {
							document.body.style.setProperty( '--font-title', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

			// Edit Header font.
			wp.customize(
				'jarvis_header_font',
				function( value ) {
					value.bind(
						function( to ) {
							document.body.style.setProperty( '--font-header', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

			// Edit Body font.
			wp.customize(
				'jarvis_body_font',
				function( value ) {
					value.bind(
						function( to ) {
							document.body.style.setProperty( '--font-body', jarvis_fonts[ to ][ 1 ] );
						}
					);
				}
			);

		}
	);

} )( jQuery );
/**
 * Live-update changed settings in real time in the Customizer preview.
 *
 * Filename: customizer-preview.js v1
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#javascript-driven-widget-support
 *
 * @package jarvis
 */

; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Site title.
			wp.customize(
				'jarvis_credits_content',
				function( value ) {
					value.bind(
						function( to ) {
							$( '.site-info' ).html( to );
						}
					);
				}
			);

			// Header text color.
			wp.customize(
				'jarvis_display_credits',
				function( value ) {

					value.bind(
						function( to ) {

							if ( to ) {
								$( '.site-info' ).show();
							} else {
								$( '.site-info' ).hide();
							}

						}
					);

				}
			);

			// Fired by jarvis_credits expansion.
			wp.customize.preview.bind(
				'jarvis_credits_expand',
				function( data ) {

					// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
					if ( true === data.expanded ) {
						scroll_to( '.site-info' );
					}

				}
			);

		}
	);


	/**
	 * Scroll the page to the specified element.
	 *
	 * @param  {string} e CSS element identifier.
	 * @return {boolean}
	 */
	var scroll_to = function( e ) {

		var $target = $( e );

		if ( $target.length ) {
			var targetOffset = $target.offset().top - parseInt( $( 'html' ).css( 'margin-top' ) );
			$( 'html,body' ).animate( { scrollTop: targetOffset }, 750 );
		}

		return false;

	};

} )( jQuery );

/**
 * Live updates for the single post customizations.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			/**
			 * Note: single_header_height is updated in custom-site-header to
			 * keep header related properties together.
			 */

			/**
			 * Set default values.
			 */
			$( '.byline' ).css( 'display', wp.customize( 'jarvis_single_show_author' )() ? 'inline' : 'none' );
			$( '.posted-on' ).css( 'display', wp.customize( 'jarvis_single_show_date' )() ? 'inline' : 'none' );
			$( '.entry-terms' ).css( 'display', wp.customize( 'jarvis_single_show_categories' )() ? 'block' : 'none' );
			$( '.content-single .contributor' ).css( 'display', wp.customize( 'jarvis_single_show_author_details' )() ? 'grid' : 'none' );

			// Edit Single Post Layout.
			wp.customize(
				'jarvis_single_layout',
				function( value ) {
					value.bind(
						function( to ) {

							$( 'body' )
								.removeClass( 'single-layout-0 single-layout-1' )
								.addClass( 'single-layout-' + to );

						}
					);
				}
			);

			wp.customize(
				'jarvis_single_show_author',
				function( value ) {

					value.bind(
						function( to ) {

							$( '.byline' ).css( 'display', to ? 'inline' : 'none' );

						}
					);
				}
			);

			wp.customize(
				'jarvis_single_show_date',
				function( value ) {

					value.bind(
						function( to ) {

							$( '.posted-on' ).css( 'display', to ? 'inline' : 'none' );

						}
					);
				}
			);

			wp.customize(
				'jarvis_single_show_categories',
				function( value ) {

					value.bind(
						function( to ) {

							$( '.entry-terms' ).css( 'display', to ? 'block' : 'none' );

						}
					);
				}
			);

			wp.customize(
				'jarvis_single_show_author_details',
				function( value ) {

					value.bind(
						function( to ) {

							$( '.content-single .contributor' ).css( 'display', to ? 'grid' : 'none' );

						}
					);
				}
			);

		}
	);

} )( jQuery );
/**
 * Live updates for the site description.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit Header Layout.
			wp.customize(
				'jarvis_header_layout',
				function( value ) {
					value.bind(
						function( to ) {

							var count = 2;
							var selectors = '';

							for ( i = 0; i <= count; i++ ) {
								selectors += ' header-layout-' + i;
							}

							$( 'body' )
								.removeClass( selectors )
								.addClass( 'header-layout-' + to );

						}
					);
				}
			);

			// Edit Archive Header Height.
			wp.customize(
				'jarvis_archive_header_height',
				function( value ) {
					value.bind(
						header_height
					);
				}
			);

			// Edit Single Header Height.
			wp.customize(
				'jarvis_single_header_height',
				function( value ) {
					value.bind(
						header_height
					);
				}
			);

			var hide_element = {
				'clip': 'rect(1px, 1px, 1px, 1px)',
				'position': 'absolute'
			};

			var show_element = {
				'clip': 'auto',
				'position': 'relative'
			};

			// Edit Site title display.
			wp.customize(
				'jarvis_site_title',
				function( value ) {
					value.bind(
						function( display ) {

							switch ( parseInt( display ) ) {

								// Hide the site description.
								case 1:

									$( '.branding .site-title' ).css( show_element );
									$( '.branding .site-description' ).css( hide_element );

									break;

								// Hide everything.
								case 2:

									$( '.branding .site-title, .branding .site-description' ).css( hide_element );

									break;

								// Show everything.
								default:

									$( '.branding .site-title, .branding .site-description' ).css( show_element );

							}

						}
					);
				}
			);

			// Edit Site title color.
			wp.customize(
				'jarvis_title_color',
				function( value ) {
					value.bind(
						function( new_color ) {
							document.body.style.setProperty( '--title-color', new_color );
						}
					);
				}
			);


		}
	);

	var header_height = function( to ) {

		var count = 2;
		var selectors = '';

		for ( i = 0; i <= count; i++ ) {
			selectors += ' header-height-' + i;
		}

		$( 'body' )
			.removeClass( selectors )
			.addClass( 'header-height-' + to );

	};

} )( jQuery );
/**
 * Add a customizer-preview class to the html element.
 *
 * This is used to prevent the smooth scrolling from working so that we don't
 * get lots of jumping around when elements are updated.
 */
; ( function( $ ) {

	$( 'html' ).addClass( 'customizer-preview' );

} )( jQuery );
/**
 * Live updates for the site description.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit site description.
			wp.customize(
				'blogdescription',
				function( value ) {
					value.bind(
						function( to ) {
							$( '.site-description' ).text( to );
						}
					);
				}
			);

		}
	);

} )( jQuery );
/**
 * Live updates for the site name.
 */
; ( function( $ ) {

	wp.customize.bind(
		'preview-ready',
		function() {

			// Edit site title.
			wp.customize(
				'blogname',
				function( value ) {
					value.bind(
						function( to ) {
							$( '.site-title' ).text( to );
						}
					);
				}
			);

		}
	);

} )( jQuery );
// Keep this for the gulp task!