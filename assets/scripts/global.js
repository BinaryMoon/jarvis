/**
 * The main javascript file for the theme, this makes the magic happen
 *
 * Filename: global.js v1
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @package Jarvis
 */

/* global jarvis_site_settings, wp */

; ( function( window, document, $ ) {

	'use strict';

	/**
	 * JS mobile detection.
	 * Is this a touch enabled device or not?
	 *
	 * @return boolean
	 */
	var is_touch_device = function() {

		return ( ( 'ontouchstart' in window ) || ( navigator.MaxTouchPoints > 0 ) || ( navigator.msMaxTouchPoints > 0 ) );

	};

	/**
	 * Smooth scroll to # anchor.
	 *
	 * @param  object e Element.
	 * @return false
	 */
	var scroll_to_hash = function( e ) {

		var $target = $( e.hash );

		if ( $target.length ) {
			var targetOffset = $target.offset().top - parseInt( $( 'html' ).css( 'margin-top' ) );
			$( 'html,body' ).animate( { scrollTop: targetOffset }, 750 );
			focus_element( e.hash );
		}

		return false;

	};

	/**
	 * Set an elements focus.
	 * If required sets a tabindex for elements that can't normally be focused.
	 *
	 * @param  string id ID of object to focus.
	 */
	var focus_element = function( id ) {

		var element = document.getElementById( id.replace( '#', '' ) );

		if ( element ) {

			if ( !( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
				element.tabIndex = -1;
			}

			element.focus();
		}

	};

	/**
	 * Set default heights for social media widgets.
	 */
	var social_widget_heights = function() {

		// Twitter.
		$( 'a.twitter-timeline' ).each(
			function() {

				var thisHeight = $( this ).attr( 'height' );
				$( this ).parent().css( 'min-height', thisHeight + 'px' );

			}
		);

		// Facebook.
		$( '.fb-page' ).each(
			function() {

				var $set_height = $( this ).data( 'height' );
				var $show_facepile = $( this ).data( 'show-facepile' );
				var $show_posts = $( this ).data( 'show-posts' ); // AKA stream.
				var $min_height = $set_height; // Set the default 'min-height'.

				// These values are defaults from the FB widget.
				var $no_posts_no_faces = 130;
				var $no_posts = 220;

				if ( $show_posts ) {

					// Showing posts; may also be showing faces and/or cover -
					// the latter doesn't affect the height at all.
					$min_height = $set_height;

				} else if ( $show_facepile ) {

					// Showing facepile with or without cover image - both would
					// be same height.
					// If the user selected height is lower than the no_posts
					// height, we'll use that instead.
					$min_height = ( $set_height < $no_posts ) ? $set_height : $no_posts;

				} else {

					// Either just showing cover, or nothing is selected (both
					// are same height).
					// If the user selected height is lower than the
					// no_posts_no_faces height, we'll use that instead.
					$min_height = ( $set_height < $no_posts_no_faces ) ? $set_height : $no_posts_no_faces;

				}

				// Apply min-height to .fb-page container.
				$( this ).css( 'min-height', $min_height + 'px' );

			}
		);

	};

	/**
	 * Attachment page navigation.
	 */
	var attachment_page_navigation = function() {

		if ( $( 'body' ).hasClass( 'attachment' ) ) {

			$( document ).keydown(
				function( e ) {

					if ( $( 'textarea, input' ).is( ':focus' ) ) {
						return;
					}

					var url = false;

					switch ( e.which ) {

						// Left arrow key (previous attachment).
						case 37:
							url = $( '.image-previous a' ).attr( 'href' );
							break;

						// Right arrow key (next attachment).
						case 39:
							url = $( '.image-next a' ).attr( 'href' );
							break;

					}

					if ( url.length ) {
						window.location = url;
					}

				}
			);

		}

	};


	// Trigger window resize event to fix video size issues.
	// Don't use jqueries trigger event since that only triggers methods hooked
	// to events, and not the events themselves.
	var resize_window = function() {

		if ( typeof ( Event ) === 'function' ) {
			window.dispatchEvent( new Event( 'resize' ) );
		} else {
			var event = window.document.createEvent( 'UIEvents' );
			event.initUIEvent( 'resize', true, false, window, 0 );
			window.dispatchEvent( event );
		}

	};


	/**
	 * Setup Masonry layouts.
	 */
	var masonry_setup = function() {

		// Masonry grid sizer.
		$( '.content-masonry, .sidebar-footer' ).prepend( '<div class="grid-sizer"></div>' );

		// Blog post content.
		var $grid = $( '.content-masonry' ).masonry(
			{
				itemSelector: 'article',
				columnWidth: '.grid-sizer',
				gutter: 0,
				isOriginLeft: !$( 'body' ).is( '.rtl' ),
				percentPosition: true
			}
		);

		// Update again once images have loaded.
		$grid.imagesLoaded(
			function() {

				$grid.masonry( 'layout' );

			}
		);


		// Add masonry reposition event after 600 milliseconds.
		// This accounts for Jetpacks responsive videos resizing 500 ms
		// after a resize event.

		var resize_orient = null;

		$( window ).on(
			'orientationchange resize jetpack-lazy-loaded-image',
			function() {

				clearTimeout( resize_orient );

				resize_orient = setTimeout(
					function() {

						$grid.masonry( 'layout' );

					},
					600
				);

			}
		);

		// Update on infinite scroll load.
		$( 'body' ).on(
			'post-load jetpack-lazy-loaded-image',
			function() {

				// Make sure we are viewing a page that uses Masonry.
				if ( 'undefined' === typeof ( $grid ) || 0 === $grid.length ) {
					return;
				}

				// Grab infinite scroll items and move them to the content area.
				var $new_articles = $( '.infinite-wrap' ).find( 'article' ).hide();
				$grid.append( $new_articles );
				$( '.infinite-wrap, .infinite-loader' ).remove();

				// When images are loaded appended infinite scroll items to Masonry.
				$grid.imagesLoaded(
					function() {

						$grid
							.masonry( 'appended', $new_articles )
							.masonry( 'reloadItems' )
							.masonry( 'layout' );

						// Make sure elements that resize based on container
						// size have the correct dimensions.
						resize_window();

					}
				);

			}
		);

		// Footer widgets.
		$( '.sidebar-footer .widget' ).imagesLoaded(
			function() {

				var $footer_widgets = null;

				// Initialise masonry footer widgets.
				$footer_widgets = $( '.sidebar-footer' ).masonry(
					{
						itemSelector: '.widget',
						columnWidth: '.grid-sizer',
						gutter: 0,
						isOriginLeft: !$( 'body' ).is( '.rtl' ),
						percentPosition: true
					}
				);

				// Update again once images have loaded.
				$footer_widgets.imagesLoaded(
					function() {

						$footer_widgets.masonry( 'layout' );

					}
				);

				// Reflow widgets after 2 seconds to ensure the correct position
				// due to dynamic widgets like facebook and twitter loading.
				setTimeout(
					function() {
						$footer_widgets.masonry( 'layout' );
					},
					2000
				);

				// Reflow Footer Widgets if changed in the Customizer.
				if ( 'undefined' !== typeof wp && wp.customize && wp.customize.selectiveRefresh ) {

					wp.customize.selectiveRefresh.bind(
						'sidebar-updated',
						function( sidebarPartial ) {
							if ( 'sidebar-2' === sidebarPartial.sidebarId ) {
								$footer_widgets.masonry( 'reloadItems' );
								$footer_widgets.masonry( 'layout' );
							}
						}
					);

				}

			}
		);

	};

	/**
	 * Do all the stuffs.
	 */
	$( document ).ready(
		function() {

			social_widget_heights();

			attachment_page_navigation();

			// Masonry layout.
			$( window ).load(
				function() {

					if ( $.isFunction( $.fn.masonry ) ) {

						masonry_setup();

					}

				}
			);

			// Featured content slides.
			if ( $.isFunction( $.fn.elementalSlides ) ) {

				$( '.showcase' ).elementalSlides(
					{
						'nav_arrows': true,
						'autoplay': parseInt( jarvis_site_settings.slider.autoplay )
					}
				);

			}

			// Menu toggle.
			$( '.menu-toggle' ).on(
				'click',
				function() {

					var $parent = $( this ).parent();
					var $menu = $parent.find( '#nav' );
					var $this = $( this );

					$parent.toggleClass( 'menu-on' );

					if ( $parent.hasClass( 'menu-on' ) ) {

						// Menu is shown.
						$menu.attr( 'aria-expanded', 'true' );
						$this.attr( 'aria-expanded', 'true' );

					} else {

						// Menu is hidden.
						$menu.attr( 'aria-expanded', 'false' );
						$this.attr( 'aria-expanded', 'false' );

					}

				}
			);

			// Dropdown menu touch screen improvements.
			// Only performed on touch devices.
			if ( is_touch_device() ) {

				// If a dropdown menu is tapped on a touch device then focus the menu.
				$( '.menu-item-has-children > a' ).on(
					'touchstart',
					function( e ) {

						// Hide any visible menus.
						$( '.menu li' ).removeClass( 'focus' );

						var $parent = $( this ).parent( 'li' );

						/**
						 * If the parent is not focused then cancel the click.
						 * This prevents the page from changing before children can
						 * be seen and selected.
						 * If you click a link again then the link will be followed.
						 */
						if ( !$parent.hasClass( 'focus' ) && !$( '.menu' ).hasClass( 'menu-on' ) ) {
							e.preventDefault();
						}

						$parent.toggleClass( 'focus' );

					}
				);

				// If you tap on the page body then the page will remove focus from all menu items.
				$( 'body' ).on(
					'touchstart',
					function( e ) {
						if ( !$( e.target ).closest( '.menu li' ).length ) {
							$( '.menu li' ).removeClass( 'focus' );
						}
					}
				);

			}

			/**
			 * Add href to links without so that dropdowns work properly on
			 * touch devices.
			 */
			$( '.menu' ).find( 'a:not([href])' ).on(
				'click',
				function( e ) {

					e.preventDefault();

				}
			).attr( 'href', '#' ).addClass( 'menu-no-href' );

			// Smooth scroll to element.
			$( '.scroll-to' ).click(
				function() {

					return scroll_to_hash( this );

				}
			);

			// Mobile device detection.
			if ( is_touch_device() ) {
				$( 'html' ).addClass( 'device-touch' );
			} else {
				$( 'html' ).addClass( 'device-click' );
			}

			// Pre-select password field on password protected post.
			$( '.post-password-form input[type="password"]' ).focus();

			// Add author icon to comment author titles.
			var user_icon = $( '.user-icon-container' ).html();
			$( '.bypostauthor > article .fn' ).append( user_icon );

			// Skip link fix.
			// based on https://github.com/Automattic/_s/blob/master/js/skip-link-focus-fix.js .
			var isIe = /(trident|msie)/i.test( navigator.userAgent );

			if ( isIe && document.getElementById && window.addEventListener ) {
				window.addEventListener(
					'hashchange',
					function() {

						var id = location.hash.substring( 1 );

						if ( !( /^[A-z0-9_-]+$/.test( id ) ) ) {
							return;
						}

						focus_element( id );

					},
					false
				);
			}
		}
	);

} )( window, document, jQuery );
