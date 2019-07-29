/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const change = require( 'gulp-change' );
const svgo = require( 'gulp-svgo' );

export default function optimizeSVG() {

	return src( './assets/svg/src/*.svg' )
		.pipe( change( svgAddProperties ) )
		.pipe( svgo() )
		.pipe( dest( './assets/svg/' ) );

}

function svgAddProperties( content ) {

	var new_content = 'aria-hidden="true" role="img" class="icon"';
	content = content.replace( '<svg', '<svg ' + new_content );
	content = content.replace( 'stroke="#111111"', '' );

	return content;

}
