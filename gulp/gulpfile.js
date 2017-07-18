let gulp = require('gulp');
let scss = require('gulp-sass');

gulp.task('default', () => {
    return gulp.src('gulp/assets/scss/calendar.scss')
        .pipe(scss())
        .pipe(gulp.dest('src/CalendarBundle/Resources/public/css'));
});