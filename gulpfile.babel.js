/* jshint esnext: true */
'use strict';

// External dependencies.
import { parallel, watch, series } from 'gulp';

// Internal dependencies.
import styles, { editor_styles, customizer_styles } from './gulp/sass';
import { scripts, customizerPreview, customizerControls } from './gulp/scripts';
import compress from './gulp/zip';

export const build = series(
	parallel(
		styles,
		editor_styles,
		customizer_styles,
		scripts,
		customizerPreview,
		customizerControls
	),
	compress
);
export const buildScripts = scripts;
export const buildCustomizerPreview = customizerPreview;
export const buildStyles = parallel( styles, editor_styles, customizer_styles );
export const buildZip = compress;

export const watchFiles = () => {
	watch( [ '*.scss', './assets/sass/**/*.scss' ], series( styles ) );
	watch( './assets/scripts/src-global/*.js', series( scripts ) );
	watch( './assets/scripts/src-customizer-preview/*.js', series( customizerPreview ) );
	watch( './assets/scripts/src-customizer-controls/*.js', series( customizerControls ) );
};

export default watchFiles;

