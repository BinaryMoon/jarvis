/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const rtlcss = require( 'gulp-rtlcss' );
const concat = require( 'gulp-concat' );
const rename = require( 'gulp-rename' );
const change = require( 'gulp-change' );
const cleancss = require( 'gulp-clean-css' );
const autoprefixer = require( 'gulp-autoprefixer' );
const line_ending = require( 'gulp-line-ending-corrector' );


export default function rtl() {

	let source = [
		'./style.css',
		// './assets/css/plugin*.min.css',
	];

	let clean_css_options = {
		level: 1,
		format: 'beautify'
	};

	return src( source )
		.pipe( concat( 'rtl.css' ) )
		.pipe( line_ending( { verbose: true, eolc: 'LF', encoding: 'utf8' } ) )
		.pipe( rtlcss() )
		.pipe( change( cssRTL ) )
		.pipe(
			autoprefixer(
				{
					cascade: false
				}
			)
		)
		.pipe( cleancss( clean_css_options ) )
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

	/**
	 * List of properties from https://github.com/twitter/css-flip that we will
	 * transfer.
	 */
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

	// special properties that should be removed from rtl.css.
	const ignore_properties = [
		'padding: 0;',
		'margin: 0;',
		'border-radius: 0;',
		'clear: both',
		'text-align: center',
		'margin: 0 auto;',
	];

	// split content into array of lines so we can loop through them
	content_old = content.split( /\n|\r\n|\r|\n\r/ );

	// loop through the lines
	for ( var i = 0; i < content_old.length; i++ ) {

		/**
		 * Store current line so we have less characters to type (and to
		 * simplify code a bit)
		 */
		let line = content_old[ i ].trim().replace( '-webkit-', '' );

		/**
		 * Get the last character in the current line.
		 */
		let last_character = line.charAt( line.length - 1 );

		// Check to see if line ends in a ;
		if ( '{' !== last_character && '}' !== last_character && ',' !== last_character ) {

			let found = properties.findIndex( p => line.startsWith( p + ':' ) );
			let ignore = ignore_properties.findIndex( p => line.startsWith( p ) );

			if ( found > -1 && ignore === -1 ) {
				content_new.push( line );
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
