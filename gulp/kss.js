/* jshint esnext: true */
'use strict';

const shell = require( 'gulp-shell' );

export default function sass_docs( done ) {

	shell.task( [ './node_modules/.bin/kss --config ./kss-config.json' ] );

	done();

}
