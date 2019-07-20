/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const rtlcss = require( 'gulp-rtlcss' );
const rename = require( 'gulp-rename' );
const change = require( 'gulp-change' );
const cleancss = require( 'gulp-clean-css' );
const autoprefixer = require( 'gulp-autoprefixer' );


export default function rtl() {

	return src( './style.css' )
		.pipe( rtlcss() )
		.pipe( change( cssRTL ) )
		.pipe( rename( 'rtl.css' ) )
		.pipe(
			autoprefixer(
				{
					cascade: false
				}
			)
		)
		.pipe(
			cleancss(
				{
					format: 'beautify'
				}
			)
		)
		.pipe( dest( './' ) );

}

/**
 * Remove non RTL properties
 */
const cssRTL = function( content ) {

	// list of lines from rtl css.
	let content_old = [];

	// Processed list of lines.
	let content_new = [];

	// List of properties from https://github.com/twitter/css-flip that we will
	// transfer.
	const properties = [
		'background-position', 'background-position-x',
		'border-bottom-left-radius', 'border-bottom-right-radius',
		'border-color', 'border-left', 'border-left-color', 'border-left-style',
		'border-left-width', 'border-radius', 'border-right',
		'border-right-color', 'border-right-style', 'border-right-width',
		'border-style', 'border-top-left-radius', 'border-top-right-radius',
		'border-width', 'box-shadow', 'clear', 'direction', 'float', 'left',
		'margin', 'margin-left', 'margin-right', 'padding', 'padding-left',
		'padding-right', 'right', 'text-align',
		'transition-property', 'unicode-bidi', '-webkit-transform', '-webkit-transform-origin'
	];

	// special properties that should not be ignored.
	const special_properties = [
		'padding: 0',
		'margin: 0'
	];

	// merge the two arrays.
	Array.prototype.push.apply( properties, special_properties );

	// split content into array of lines so we can loop through them
	content_old = content.split( "\n" );

	// loop through the lines
	for ( var i = 0; i < content_old.length; i++ ) {

		/**
		 * Store current line so we have less characters to type (and to
		 * simplify code a bit)
		 */
		var line = content_old[ i ];

		// Check to see if line ends in a ;
		if ( ';' === line.charAt( line.length - 1 ) ) {

			// Loop through properties and check if they match the current line
			for ( var p = 0; p < properties.length; p++ ) {

				var property = properties[ p ] + ':';

				// if valid property then add to the export list.
				// Otherwise it gets ignored
				if ( line.trim().startsWith( property ) ) {

					line = line.replace( '-webkit-', '' );
					content_new.push( line );

				}

			}

		} else {

			// It's a selector/ comment or something so add it to the list.
			// Empty selectors will get removed later with cssnano
			content_new.push( line );

		}

	}

	// join list of lines so we can return it as a single string
	content = content_new.join( "\n" );

	// remove settings that don't matter
	content = content.replace( /clear:\sboth;/g, '' );
	content = content.replace( /float:\snone;/g, '' );
	content = content.replace( /text-align:\scenter;/g, '' );
	content = content.replace( /margin:\s0;/g, '' );
	content = content.replace( /padding:\s0;/g, '' );

	// Remove permanent comments.
	content = content.replace( /\/\*\*!/g, '/**' );
	content = content.replace( /\/\*!/g, '/*' );

	return content;

};
