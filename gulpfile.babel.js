/* jshint esnext: true */
'use strict';

const { src, dest, parallel, watch, series } = require( 'gulp' );
const sass = require( 'gulp-sass' );
const autoprefixer = require( 'gulp-autoprefixer' );


/**
 * Build SASS files.
 */
const styles = function() {

	/**
	 * Uses node-sass options:
	 * https://github.com/sass/node-sass#options
	 */
	return src( '*.scss' )
		.pipe(
			sass(
				{
					indentType: 'tab',
					indentWidth: 1,
					outputStyle: 'expanded',
					precision: 3,

				}
			)
				.on( 'error', sass.logError )
		)
		.pipe(
			autoprefixer(
				{
					cascade: false
				}
			)
		)
		.pipe( dest( './' ) );

};



exports.build = parallel( styles );

exports.default = () => {

	watch( [ '*.scss', './assets/sass/**/*.scss' ], series( styles ) );

};
