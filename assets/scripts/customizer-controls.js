/**
 * Modify the customizer controls for the colours panel.
 */
; ( function( $ ) {

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Check for changes in the dark mode checkbox.
			 *
			 * This lets us show and hide the dark mode background colour when
			 * the checkbox is ticked. Taking it out of view when it's not needed.
			 */
			wp.customize(
				'jarvis_dark_mode',
				function( setting ) {

					wp.customize.control(
						'jarvis_dark_mode_colour',
						function( control ) {

							/**
							 * Display the dark mode background colour.
							 */
							var visibility = function() {
								if ( setting.get() ) {
									control.container.slideDown( 180 );
								} else {
									control.container.slideUp( 180 );
								}
							};

							visibility();
							setting.bind( visibility );

						}
					);

				}
			);
		}
	);

} )( jQuery );

/**
 * Live preview for fonts.
 */
; ( function( $ ) {

	// font picker
	$( document ).ready(
		function() {

			$( '.jarvis-font-picker label' ).on(
				'click',
				selectFont
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
							$( '.jarvis-font-picker' ).each(
								function() {

									var $this = $( this );
									var index = parseInt( $this.find( '.selected' ).index() ) - 1;
									var item_height = $this.find( 'label:first' ).outerHeight( true );
									// We divide the index by 2 since we are counting inputs AND labels.
									$this.scrollTop( index * ( item_height / 2 ) );

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

		var $this = $( this );

		// Deselect all labels.
		$this.parent().find( 'label' ).removeClass( 'selected' );
		// Select current label.
		$this.addClass( 'selected' );

		var $input = $( '#' + $this.attr( 'for' ) );
		var value = $input.attr( 'value' );
		var parentID = $input.attr( 'name' );

		wp.customize.instance( parentID ).set( value );

	};

} )( jQuery );

/* global wp */

; ( function() {

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Detect when the credits section is expanded (or closed) so we can
			 * adjust the preview accordingly.
			 */
			wp.customize.section(
				'jarvis_credits',
				function( section ) {

					/**
					 * Scroll down to the footer when the credits section is
					 * opened.
					 */
					section.expanded.bind(
						function( isExpanding ) {

							/**
							 * Value of isExpanding will = true if you're
							 * entering the section, false if you're leaving it.
							 */
							wp.customize.previewer.send(
								'jarvis_credits_expand',
								{
									expanded: isExpanding
								}
							);

							/**
							 * Display the description by default.
							 *
							 * This code is largely borrowed from the additional
							 * css customizer panel.
							 * @see https://github.com/WordPress/WordPress/blob/51f43144413c1456e19907a9ce403a89bdf254a1/wp-admin/js/customize-controls.js
							 *
							 * The description includes docs explaining the available shortcuts.
							 */
							var description = section.container.find( '.section-meta .customize-section-description:first' );

							/**
							 * Check for the jarvisExpanded class.
							 *
							 * This prevents the description from being opened
							 * every time. It will only open once.
							 */
							if ( !description.hasClass( 'jarvisExpanded' ) ) {

								/**
								 * Open the description, and add a class that we
								 * can check later to prevent constantly opening
								 * the description.
								 */
								description
									.addClass( 'open' )
									.addClass( 'jarvisExpanded' )
									.show()
									.trigger( 'toggled' );

								section.container.find( '.customize-help-toggle' )
									.attr( 'aria-expanded', 'true' );

							}

							/**
							 * Setup the 'close' description button.
							 */
							section.container.find( '.section-description-buttons .section-description-close' ).on(
								'click',
								function() {
									section.container.find( '.section-meta .customize-section-description:first' )
										.removeClass( 'open' )
										.slideUp();

									section.container.find( '.customize-help-toggle' )
										.attr( 'aria-expanded', 'false' )
										.focus(); // Avoid focus loss.
								}
							);
						}

					);

				}
			);

		}
	);

} )();

/* global wp */

; ( function() {

	wp.customize.bind(
		'ready',
		function() {

			/**
			 * Detect when the header section is expanded (or closed) so we can
			 * adjust the preview accordingly.
			 */
			wp.customize.section(
				'jarvis_header',
				function( section ) {

					/**
					 * Scroll to the header when the header section is opened.
					 */
					section.expanded.bind(
						function( isExpanding ) {

							/**
							 * Value of isExpanding will = true if you're
							 * entering the section, false if you're leaving it.
							 */
							wp.customize.previewer.send(
								'jarvis_header_expand',
								{
									expanded: isExpanding
								}
							);

						}

					);

				}
			);

		}
	);

} )();

// Silence is golden!