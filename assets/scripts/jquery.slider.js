/**
 * Super simple javascript slider.
 *
 * Filename: jquery.slider.js v1.5.4
 *
 * Created by Ben Gillbanks <https://www.binarymoon.co.uk/>
 * Available under GPL2 license
 *
 * @package Jarvis
 */

/* global jarvis_site_settings */

; ( function( $ ) {

	$.fn.elementalSlides = function( options ) {

		var defaults = {
			interval: 5000,
			group_selector: 'article',
			nav_arrows: false,
			autoplay: 0
		};

		options = $.extend( defaults, options );

		return this.each( function() {

			// Set the timer that determines how long each slide appears for.
			var start_timer = function() {

				if ( !autoplay || 0 === autoplay ) {

					return;

				}

				clearInterval( timer );

				timer = setInterval(
					function() {
						next();
					},
					interval
				);

			};

			// Stop the timer - used to pause the slider.
			var stop_timer = function() {

				clearInterval( timer );

			};

			// Display the selected slide.
			var show_slide = function( slide ) {

				var $slide = $this.find( slide );

				// Quit if the slide is already the current one.
				if ( $slide.hasClass( 'current' ) ) {
					return;
				}

				articles.fadeOut( 500 ).removeClass( 'current' );
				$slide.fadeIn( 500 ).addClass( 'current' );

			};

			// Get the slide id.
			var get_slide_id = function( tab ) {

				return '#slide_' + tab.data( 'slide' );

			};

			// Display the next slide in the list.
			var next = function() {

				var next_slide = nav.find( '.selected' ).removeClass( 'selected' ).next( '.tab' );

				// Loop round if at the end.
				if ( 0 === next_slide.length ) {
					next_slide = nav.find( '.tab:first' );
				}

				next_slide.addClass( 'selected' );
				show_slide( get_slide_id( next_slide ) );

			};

			// Display the previous slide.
			var previous = function() {

				var next_slide = nav.find( '.selected' ).removeClass( 'selected' ).prev( '.tab' );

				// Loop round if at the start.
				if ( 0 === next_slide.length ) {
					next_slide = nav.find( '.tab:last' );
				}

				next_slide.addClass( 'selected' );
				show_slide( get_slide_id( next_slide ) );

			};

			var $this = $( this );
			var timer;
			var slide_count = 0;

			// Remove empty slides.
			$this.children( options.group_selector ).filter(
				function() {

					return $.trim( this.innerHTML ).length < 1;

				}
			).remove();

			var articles = $this.children( options.group_selector );
			var nav = $this.find( 'nav' );
			var interval = $this.data( 'interval' ) || options.interval;
			var autoplay = options.autoplay;

			// Quit if there is nothing to display.
			if ( articles.length <= 1 ) {

				// Make sure the slides are visible. They should be hidden by default.
				articles.fadeIn();
				return;

			}

			$this.attr( 'aria-live', 'polite' );

			// Create slide navigation if it doesn't exist.
			// The navigation is the dots that you can use to select a slide to jump to.
			if ( 0 === nav.length ) {

				nav = $( '<nav></nav>' );
				nav.attr( 'aria-label', jarvis_site_settings.i18n.slide_controls_label );
				$this.prepend( nav );

			}

			// Loop through articles and create buttons for the nav.
			articles.each(
				function() {

					slide_count++;
					$( this ).attr( 'id', 'slide_' + slide_count );
					var tab = $( '<button type="button" data-slide="' + slide_count + '" class="tab"><span class="screen-reader-text">' + jarvis_site_settings.i18n.slide_number.replace( '#', slide_count ) + '</span></button>' );
					nav.append( tab );

				}
			);

			// Click navigation items.
			nav.find( 'button' ).on(
				'click',
				function( e ) {

					e.preventDefault();

					var $this = $( this );

					show_slide( get_slide_id( $this ) );
					nav.find( 'button' ).removeClass( 'selected' );
					$this.addClass( 'selected' );

					start_timer();

				}
			);

			// Stop the animation when links on each slide are focused.
			articles.find( 'a' ).on(
				'focus',
				function() {

					stop_timer();

				}
			);

			// Restart the animation when links on each slide lose focus.
			articles.find( 'a' ).on(
				'blur',
				function() {

					start_timer();

				}
			);

			// Stop the animation when the mouse hovers the content (hover
			// implies the user is reading the content).
			$this[ ( $.fn.hoverIntent ) ? 'hoverIntent' : 'hover' ](
				function() {

					stop_timer();

				}, function() {

					start_timer();

				}
			);

			// Add next and previous links to the slider nav.
			if ( options.nav_arrows ) {

				var arrow_next = $( '<button type="button" class="arrow arrow-next">' + jarvis_site_settings.i18n.slide_next + '</button>' );
				var arrow_prev = $( '<button type="button" class="arrow arrow-prev">' + jarvis_site_settings.i18n.slide_prev + '</button>' );

				arrow_next.on(
					'click',
					function( e ) {

						e.preventDefault();

						next();

						start_timer();

					}
				);

				arrow_prev.on(
					'click',
					function( e ) {

						e.preventDefault();

						previous();

						start_timer();

					}
				);

				nav.append( arrow_next );
				nav.prepend( arrow_prev );

			}

			// Set the first slide as the current one
			// this stops the fade in & out effect.
			var $first = nav.find( '.tab:first' );
			$( get_slide_id( $first ) ).addClass( 'current' );

			// Select the first slide.
			$first.click();

			// Start timer (in case the nav is not being used).
			start_timer();

		} );

	};

} )( jQuery );
