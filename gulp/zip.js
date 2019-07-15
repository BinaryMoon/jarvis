/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const zip = require( 'gulp-zip' );

const compress = function() {

	const exclude = [
		'!package.json',
		'!package-lock.json',
		'!gulpfile.babel.js',
		'!node_modules/',
		'!node_modules/**',
		'!gulp/',
		'!gulp/**',
		'!**/*.scss',
	];

	console.log( [ ...exclude, './**' ] );

	return src( [ './**', ...exclude ] )
		.pipe(
			zip( 'jarvis-theme.zip' )
		)
		.pipe(
			dest( '../.' )
		);

};

export default compress;