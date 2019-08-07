/* jshint esnext: true */
'use strict';

const gulp = require( 'gulp' );
const wpPot = require( 'gulp-wp-pot' );

export default function translate() {

	return gulp.src( '**/*.php' )
		.pipe(
			wpPot(
				{
					domain: 'jarvis',
					package: 'Jarvis'
				}
			)
		)
		.pipe( gulp.dest( './languages/jarvis.pot' ) );

}
