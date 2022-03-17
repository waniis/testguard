'use strict'
/**
 * gulpfile.js
 * (c) Adexos <contact@adexos.fr>
 */

/**
 * Configuration loading.
 */
var config = require('./gulpconfig');

/**
 * Gulp & plugins loading.
 */
var gulp = require('gulp');

var autoprefixer = require('gulp-autoprefixer');
var browserSync  = require('browser-sync').create();
var buffer       = require('vinyl-buffer');
var cache        = require('gulp-cache');
var cleancss     = require('gulp-cleancss');
var sass         = require('gulp-sass');

/**
 * BrowserSync.
 */
gulp.task('browserSync', function() {
    browserSync.init(config.browserSync);
});

/**
 * Sass compiler, then live reload by BrowserSync.
 */
gulp.task('sass', function() {
    return gulp
        .src(config.src.scss)
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer(config.autoprefixer))
        .pipe(cleancss())
        //.pipe(cmq(config.cmq))
        .pipe(gulp.dest(config.dest.css))
        .pipe(browserSync.reload({stream: true}))
    ;
});

/**
 * Gulp watcher.
 */
gulp.task('watch', ['browserSync'], function() {
    gulp.watch(config.src.scss, ['sass']);
    gulp.watch(config.liveReload, browserSync.reload);
});
