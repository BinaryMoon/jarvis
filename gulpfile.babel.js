/* jshint esnext: true */
'use strict';

// External dependencies.
import { parallel, watch, series } from 'gulp';

// Internal dependencies.
import styles from './gulp/sass';
import { scripts, customizerScripts } from './gulp/scripts';
import compress from './gulp/zip';

export const build = series(
	parallel( styles, scripts, customizerScripts ),
	compress
);
export const buildScripts = scripts;
export const buildCustomizerScripts = customizerScripts;
export const buildStyles = styles;
export const buildZip = compress;

export const watchFiles = () => {
	watch( [ '*.scss', './assets/sass/**/*.scss' ], series( styles ) );
	watch( './assets/scripts/src/*.js', series( scripts ) );
	watch( './assets/scripts-customizer/src/*.js', series( customizerScripts ) );
};

export default watchFiles;

