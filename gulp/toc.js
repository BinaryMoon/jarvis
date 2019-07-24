/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const change = require( 'gulp-change' );

export default function toc() {

	return src( './style.css' )
		.pipe( change( cssTOC ) )
		.pipe( dest( './' ) );

}

const cssTOC = function( content ) {

	// list of lines from.
	var content_old = [];

	// processed list of lines
	var content_new = [];

	// table of contents
	var toc = [];

	// split content into array of lines so we can loop through them
	content_old = content.split( "\n" );

	var section = 0;
	var section_sub = 0;

	// loop through the lines
	for ( var i = 0; i < content_old.length; i++ ) {

		// store current line so we have less characters to type (and to simplify code a bit)
		var line = content_old[ i ];

		if ( line.trim().startsWith( '* # ' ) ) {
			section++;
			section_sub = 0;
			line = line.replace( '#', section + '.0' );
			toc.push( line );
		}

		if ( line.trim().startsWith( '* ## ' ) ) {
			section_sub++;
			line = line.replace( '##', section + '.' + section_sub );
			var line_toc = line.replace( '* ', '*    ' );
			toc.push( line_toc );
		}

		content_new.push( line );

	}

	// join list of lines so we can return it as a single string
	content = content_new.join( "\n" );

	content = content.replace( ' * [TOC]', toc.join( "\n" ) );

	return content;

};