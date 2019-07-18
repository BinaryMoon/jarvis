/**
 * Add a customizer-preview class to the html element.
 *
 * This is used to prevent the smooth scrolling from working so that we don't
 * get lots of jumping around when elements are updated.
 */
; ( function( $ ) {

	$( 'html' ).addClass( 'customizer-preview' );

} )( jQuery );