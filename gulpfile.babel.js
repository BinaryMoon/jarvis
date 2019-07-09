/* jshint esnext: true */
'use strict';

// External dependencies.
import { parallel, watch, series } from 'gulp';

// Internal dependencies.
import styles from './gulp/sass';


export const build = parallel( styles );

export const watchStyles = () => {
	watch( [ '*.scss', './assets/sass/**/*.scss' ], series( styles ) );
};

export default watchStyles;

