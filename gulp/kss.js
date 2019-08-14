/* jshint esnext: true */
'use strict';

const exec = require( 'child_process' ).exec;

export default function sass_docs( done ) {

	exec( './node_modules/.bin/kss --config ./kss-config.json' );

	done();

}
