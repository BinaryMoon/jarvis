/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const concat = require( 'gulp-concat' );
const uglify = require( 'gulp-uglify' );
const rename = require( 'gulp-rename' );

export default function scripts() {

	const destPath = './assets/scripts/';

	return src( './assets/scripts/site/*.js' )
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
