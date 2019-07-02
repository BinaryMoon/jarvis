/* jshint esnext: true */
'use strict';

const gulp = require( 'gulp' );
const sass = require( 'gulp-sass' );

const styles = function() {

	/**
	 * Uses node-sass options:
	 * https://github.com/sass/node-sass#options
	 */
	return gulp.src( '*.scss' )
		.pipe( sass(
			{
				indentType: 'tab',
				indentWidth: 1,
				outputStyle: 'expanded',
				precision: 3,

			}
		).on( 'error', sass.logError ) )
		.pipe( gulp.dest( './' ) );

};



exports.build = gulp.parallel( styles );

exports.default = () => {

	gulp.watch( [ '*.scss', './assets/sass/**/*.scss' ], gulp.series( styles ) );

};