/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const sass = require( 'gulp-sass' );
const autoprefixer = require( 'gulp-autoprefixer' );

/**
 * Build SASS files.
 */
export function process_styles( source = 'style.scss', destination = './' ) {

	/**
	 * Uses node-sass options:
	 * https://github.com/sass/node-sass#options
	 */
	return src( source )
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
		.pipe( dest( destination ) );

}

export default function styles() {

	return process_styles();

}

export function editor_styles() {

	return process_styles( './assets/sass/editor-styles.scss', './assets/css/' );

}

export function customizer_styles() {

	return process_styles( './assets/sass/customizer.scss', './assets/css/' );

}