/* jshint esnext: true */
'use strict';

const { src, dest } = require( 'gulp' );
const cleancss = require( 'gulp-clean-css' );
const critical = require( 'critical' );
const autoprefixer = require( 'gulp-autoprefixer' );

/**
 * Build SASS files.
 */
export default function criticalCSS() {

	critical.generate(
		{
			base: './',
			src: 'http://localhost/wordpress-themes/',
			dest: 'style.critical.css',
			css: [ './style.css' ],
			dimensions: [
				{
					width: 320,
					height: 480
				},
				{
					width: 768,
					height: 1024
				},
				{
					width: 1280,
					height: 960
				}
			],
		}
	);

	return src( './style.critical.css' )
		.pipe(
			autoprefixer(
				{
					cascade: false
				}
			)
		)
		.pipe(
			cleancss(
				{
					level: 2
				}
			)
		)
		.pipe( dest( './' ) );

};
