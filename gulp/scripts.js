/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const concat = require( 'gulp-concat' );
const uglify = require( 'gulp-uglify' );
const rename = require( 'gulp-rename' );

export function scripts( path = 'scripts', file = 'global' ) {

	const destPath = './assets/' + path + '/';
	const scriptsSrc = [
		'./assets/' + path + '/src/!(ready)*.js',
		'./assets/' + path + '/src/ready.js'
	];

	return src( scriptsSrc )
		.pipe(
			concat( file + '.js' )
		)
		.pipe(
			dest( destPath )
		)
		.pipe(
			uglify()
		)
		.pipe(
			rename( file + '.min.js' )
		)
		.pipe(
			dest( destPath )
		);

}

export function customizerScripts() {

	return scripts( 'scripts-customizer', 'preview' );

}
