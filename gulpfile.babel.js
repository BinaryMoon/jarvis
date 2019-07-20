/* jshint esnext: true */
'use strict';

// External dependencies.
import { parallel, watch, series } from 'gulp';

// Internal dependencies.
import styles, { editor_styles, customizer_styles } from './gulp/sass';
import scriptsGlobal, { customizerPreview, customizerControls } from './gulp/scripts';
import compress from './gulp/zip';
import rtl from './gulp/rtl';

export const build = series(
	parallel(
		styles,
		editor_styles,
		customizer_styles,
		scriptsGlobal,
		customizerPreview,
		customizerControls
	),
	rtl,
	compress
);
export const buildScripts = scriptsGlobal;
export const buildCustomizerPreview = customizerPreview;
export const buildStyles = parallel( styles, editor_styles, customizer_styles );
export const buildZip = compress;
export const buildRTL = rtl;

export const watchFiles = () => {
	watch( [ '*.scss', './assets/sass/**/*.scss' ], series( parallel( styles, editor_styles ), rtl ) );
	watch( './assets/sass/customizer/*.scss', customizer_styles );
	watch( './assets/scripts/src-global/*.js', scriptsGlobal );
	watch( './assets/scripts/src-customizer-preview/*.js', customizerPreview );
	watch( './assets/scripts/src-customizer-controls/*.js', customizerControls );
};

export default watchFiles;
