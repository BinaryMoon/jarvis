/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const concat = require( 'gulp-concat' );
const uglify = require( 'gulp-uglify' );
const rename = require( 'gulp-rename' );

export default function scripts() {

	const destPath = './assets/scripts/';
	const scriptsSrc = [
		'./assets/scripts/site/!(ready)*.js',
		'./assets/scripts/site/ready.js'
	];

	return src( scriptsSrc )
		.pipe(
			concat( 'global.js' )
		)
		.pipe(
			dest( destPath )
		)
		.pipe(
			uglify()
		)
		.pipe(
			rename( 'global.min.js' )
		)
		.pipe(
			dest( destPath )
		);

}
