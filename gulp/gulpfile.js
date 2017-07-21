let gulp = require('gulp');
let scss = require('gulp-sass');

gulp.task('scss', () => {
    return gulp.src('gulp/assets/scss/calendar.scss')
        .pipe(scss())
        .pipe(gulp.dest('src/CalendarBundle/Resources/public/css'));
});

gulp.task('watch', ['scss'], function(){
    gulp.watch('gulp/assets/scss/**/*.scss', ['scss'])
});

gulp.task('default', ['scss']);
