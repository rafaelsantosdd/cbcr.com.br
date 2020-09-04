var gulp = require('gulp'),

	sass = require('gulp-sass'),

	imagemin = require('gulp-imagemin'),
	clean = require('gulp-clean')
	uglify = require('gulp-uglify'),
	cssmin = require('gulp-cssmin'),
	autopref = require('gulp-autoprefixer');


// =====================================================
// SASS
// =====================================================

gulp.task('sass', function() {
	return gulp.src('sass/styles.sass')
				.pipe(sass().on('error', sass.logError))
				.pipe(gulp.dest('css'));
});

gulp.task('watch', function() {
	gulp.watch('sass/*.sass', ['sass']);
});

// =====================================================
// BACKUP E MINIFICAÇÃO (DEFAULT)
// =====================================================

gulp.task('clean', function() {
	return gulp.src('cbcr-v1')
				.pipe(clean());
});

gulp.task('copy', ['clean'], function() {
	return gulp.src('**/*')
				.pipe(gulp.dest('cbcr-v1'));
});

gulp.task('build-img', function() { // Minificação das IMGS
	gulp.src('cbcr-v1/img/**/*')
		.pipe(imagemin())
		.pipe(gulp.dest('cbcr-v1/img'));
});

gulp.task('build-js', function() { // Minificação do JS
	gulp.src('cbcr-v1/js/*.js')
		.pipe(uglify())
		.pipe(gulp.dest('cbcr-v1/js'));
});

gulp.task('build-css', function() { // Minificação do CSS
	gulp.src('cbcr-v1/css/*.css')
		.pipe(autopref({
			browsers: ['last 10 versions']
		}))
		.pipe(cssmin())
		.pipe(gulp.dest('cbcr-v1/css'));
});

gulp.task('default', ['copy'], function() {
	gulp.start('build-img', 'build-css', 'build-js');
});