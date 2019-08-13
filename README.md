# Jarvis
## A WordPress theme for Gutenberg

Jarvis is a highly optimised theme, designed with sustainable principles in mind, using modern web development techniques.

* [Wiki](https://github.com/BinaryMoon/jarvis/wiki)
* [Theme Styleguide](https://binarymoon.github.io/jarvis/)

## Philosophy

I want Jarvis to be a lightweight theme. To do this I have:

* Removed images
* Used system fonts
* Minimised complex features like widgets, and nav
* Removed jQuery, and kept Javascript to an absolute minimum



# Development

If you wish to work on Jarvis you will need to have node and npm set up. You can then run `npm install` to get the required packages. Once setup you just have to run `npm run dev` in order to set up the watcher. Npm will then take care of everything for you.

## Directory Structure

* __assets__ - Files that could be included on the site. Mostly Javascript and CSS. Includes a SASS directory which gets built from but does not get included in a built zip.
* __gulp__ - Contains the code for the different gulp tasks used to generate the site.
* __inc__ - Holds all of the PHP files that add functionality to the site. This includes functions and filters that can be called from the theme.
* __parts__ - Template parts that can be included from theme files.
* __templates__ - Individual page templates that can be selected from the post/ page editor.

## npm Scripts

* `npm run dev` Watch for css and script changes, and compile them when required.
* `npm run build` Compile css, scripts, and then generate a zip file containing the theme ready for installation.

## Gulp Scripts

Jarvis uses Gulp to process files. You probably won't need to use it, but just in case the available tasks are:

* `gulp build` Build all of the files, and generate a zip containing the most up to date version of the theme.
* `gulp watchFiles` Watch the development files for changes and build if required.
* `gulp buildScripts` Combine and minify the theme javascript.
* `gulp buildCustomizerPreview` Combine and minify the theme Customizer preview javascript.
* `gulp buildCustomizerControls` Combine and minify the theme Customizer controls javascript.
* `gulp buildStyles` Process the .scss files and generate the theme styles.
* `gulp buildZip` Generate a release ready zip file containing the theme files only.
* `gulp buildRTL` Generate the RTL.css file.
* `gulp buildTOC` Generate Table of Contents for style.css file.
* `gulp buildCritical` Create [critical path CSS](https://www.smashingmagazine.com/2015/08/understanding-critical-css/#what-is-critical-css) styles.
* `gulp buildSVG` Clean up exported svg files.
* `gulp buildPot` Build the latest version of the __.pot__ language file.