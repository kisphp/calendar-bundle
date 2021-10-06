const { series } = require('gulp');

var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var clean = require('gulp-clean');

const config = {
    'source_file': 'gulp/assets/scss/calendar.scss',
    'target_directory': 'src/CalendarBundle/Resources/public/css',
};

function cleanCss() {
    return gulp.src(config.target_directory, {read: false})
        .pipe(clean());
}

function buildCss() {
    return gulp.src(config.source_file)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(config.target_directory))
}

exports.build = buildCss;
exports.default = series(cleanCss, buildCss);
