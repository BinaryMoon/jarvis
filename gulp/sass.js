/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const sass = require( 'gulp-sass' );
const rename = require( 'gulp-rename' );
const autoprefixer = require( 'gulp-autoprefixer' );
const cleancss = require( 'gulp-clean-css' );
const change = require( 'gulp-change' );

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
			).on( 'error', sass.logError )
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

export function minifyStyles() {

	return src( './style.css' )
		.pipe( rename( 'style.min.css' ) )
		.pipe(
			change( removeComments )
		)
		.pipe(
			cleancss(
				{
					level: 2
				}
			)
		)
		.pipe( dest( './' ) );


}

export default function styles() {

	return process_styles();

}

export function editor_styles() {

	return process_styles( './assets/sass/editor-styles.scss', './assets/css/' );

}

export function editor_blocks() {

	return process_styles( './assets/sass/editor-blocks.scss', './assets/css/' );

}

export function customizer_styles() {

	return process_styles( './assets/sass/customizer.scss', './assets/css/' );

}

/**
 * Remove comments from the source so that they can be minified away.
 */
const removeComments = function( content ) {

	content = content.replace( /\/\*\*!/g, '/**' );
	content = content.replace( /\/\*!/g, '/*' );

	return content;

}