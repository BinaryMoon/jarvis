/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const change = require( 'gulp-change' );
const svgmin = require( 'gulp-svgmin' );

export default function optimizeSVG() {

	return src( './assets/svg/src/*.svg' )
		.pipe(
			svgmin(
				{
					plugins: [
						{
							removeViewBox: false
						}
					]
				}
			)
		)
		.pipe( change( svgAddProperties ) )
		.pipe( dest( './assets/svg/' ) );

}

const svgAddProperties = function( content ) {

	const new_content = 'aria-hidden="true" role="img" class="icon"';
	content = content.replace( '<svg', '<svg ' + new_content );
	content = content.replace( /stroke=\"\#111\"/g, '' );
	content = content.replace( /fill=\"none\"/g, '' );

	return content;

}
