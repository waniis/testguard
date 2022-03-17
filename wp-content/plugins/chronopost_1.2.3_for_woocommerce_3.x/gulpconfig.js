/**
 * gulpconfig.js
 * (c) Adexos <contact@adexos.fr>
 */

//styles
var SASS_DIR = 'public/scss';
var CSS_DIR =  'public/css';

module.exports = {
    /**
     * Source folders.
     * @see {@link https://github.com/gulpjs/gulp/blob/master/docs/API.md#gulpsrcglobs-options}
     */
    src: {
        scss:    [SASS_DIR + '/**/*.scss']
    },

    /**
     * Destination folders.
     * @see {@link https://github.com/gulpjs/gulp/blob/master/docs/API.md#gulpdestpath-options}
     */
    dest: {
        css:     CSS_DIR
    },

    /**
     * HTTP path of the website/application root.
     * Used by spritesmith to generate URLs for the background-url declaration. Most often, leave "/".
     */
    httpPath: '/',

    /**
     * Autoprefixer.
     * @see {@link https://www.npmjs.com/package/gulp-autoprefixer}
     */
    autoprefixer: {
        browsers: ['> 1%', 'ie >= 9'],
        cascade:  false
    },

    /**
     * gulp-combine-media-queries
     * @see {@link https://www.npmjs.com/package/gulp-combine-media-queries}
     */
    cmq: {
        log: true,
        use_external: false
    },

    /**
     * BrowserSync.
     * @see {@link https://browsersync.io/docs/options/}
     */
    browserSync: {
        proxy: 'chronopost.local/'
    }
};
