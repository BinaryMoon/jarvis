/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const concat = require( 'gulp-concat' );
const uglify = require( 'gulp-uglify' );
const rename = require( 'gulp-rename' );

export function scripts( slug = 'global' ) {

	console.log( 'build scripts', slug );

	const destPath = './assets/scripts/';
	const scriptsSrc = [
		'./assets/scripts/src-' + slug + '/!(ready)*.js',
		'./assets/scripts/src-' + slug + '/ready.js'
	];

	console.log( scriptsSrc );

	return src( scriptsSrc )
		.pipe(
			concat( slug + '.js' )
		)
		.pipe(
			dest( destPath )
		)
		.pipe(
			uglify()
		)
		.pipe(
			rename( slug + '.min.js' )
		)
		.pipe(
			dest( destPath )
		);

}

export default function scriptsGlobal() {

	return scripts();

}

export function customizerPreview() {

	return scripts( 'customizer-preview' );

}

export function customizerControls() {

	return scripts( 'customizer-controls' );

}
