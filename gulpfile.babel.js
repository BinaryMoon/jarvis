/* jshint esnext: true */
'use strict';

// External dependencies.
import { parallel, watch, series } from 'gulp';

// Internal dependencies.
import styles from './gulp/sass';
import scripts from './gulp/scripts';
import compress from './gulp/zip';

export const build = parallel( styles, scripts );
export const buildScripts = scripts;
export const buildStyles = styles;
export const buildZip = compress;

export const watchFiles = () => {
	watch( [ '*.scss', './assets/sass/**/*.scss' ], series( styles ) );
	watch( './assets/scripts/site/*.js', series( scripts ) );
};

export default watchFiles;

