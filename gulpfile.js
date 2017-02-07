// Requires gulp
var gulp = require('gulp');

// Requires the gulp-sass plugin
var sass = require('gulp-sass');

//Requires Browser Sync
var browserSync = require('browser-sync').create();

//Requires gulp mamp 
var mamp = require('gulp-mamp');

//Requires gulp-useref
var useref = require('gulp-useref');

gulp.task('hello', function () {
	console.log ('Hello Edy, you sly pure spirit you! You needed yet another pick me up, didnt you? Of course you did. Youre amazing! Never forget that. Also, never forget that you have the capacity to learn anything you put your mind to! Case in point, youre finally learning all about Gulp! Stand tall and be proud.');
});

gulp.task('sass', function(){
  return gulp.src('spirit-foundation/src/assets/scss/app.scss') // Grabs app.scss in the directory specified
    .pipe(sass().on('error', sass.logError)) // Using gulp-sass, also logs errors when running sass task on gulp
    .pipe(gulp.dest('spirit-foundation/dist/assets/css')) // Stores compiled code into the specified directory
    .pipe(browserSync.reload({ // initiates browserSync reload so that I can see changes immediately after being compiled in effect!
    	stream: true
    }))
});

//gulp watch settings
gulp.task ('watch', ['browserSync', 'sass'], function(){
	gulp.watch('spirit-foundation/src/assets/scss/app.scss', ['sass']); // Gulp watches any changes made to app.scss in the specified directory and then runs the gulp task "sass"
	//add other watchers here
	// Reloads the browser whenever HTML or JS files change 
	gulp.watch('*.php', browserSync.reload);
	gulp.watch('js/**/*.js', browserSync.reload);
});


//This tells browser sync where's the root of my server for browser refresh
gulp.task('browserSync', function() {
  browserSync.init({
    proxy: 'localhost/wordpress-experiments/'
  });
})

gulp.task('useref', function(){
  return gulp.src(' *.html')
    .pipe(useref())
    .pipe(gulp.dest('dist'))
});

//Other requires...
var uglify = require('gulp-uglify');
var gulpIf = require('gulp-if');

gulp.task('useref', function(){
  return gulp.src('*.html')
    .pipe(useref())
    // Minifies only if it's a JavaScript file
    .pipe(gulpIf('*.js', uglify()))
    .pipe(gulp.dest('dist'))
});

// Require cssnano
var cssnano = require('gulp-cssnano');

gulp.task('useref', function(){
  return gulp.src('*.html')
    .pipe(useref())
    .pipe(gulpIf('*.js', uglify()))
    // Minifies only if it's a CSS file
    .pipe(gulpIf('*.css', cssnano()))
    .pipe(gulp.dest('dist'))
});

// Require imagemin
var imagemin = require('gulp-imagemin');

gulp.task('images', function(){
  return gulp.src('images/**/*.+(png|jpg|gif|svg)')
  .pipe(imagemin())
  .pipe(gulp.dest('dist/images'))
});

// Require gulp-cache
var cache = require('gulp-cache');

gulp.task('images', function(){
  return gulp.src('images/**/*.+(png|jpg|jpeg|gif|svg)')
  // Caching images that ran through imagemin
  .pipe(cache(imagemin({
      interlaced: true
    })))
  .pipe(gulp.dest('dist/images'))
});

// Adds fonts to dist/fonts from a hypothetical fonts folder in my theme file. I might not need this.
gulp.task('fonts', function() {
  return gulp.src('fonts/**/*')
  .pipe(gulp.dest('dist/fonts'))
});

// Require del
var del = require('del');

gulp.task('clean:dist', function() {
  return del.sync('dist');
});

// Clears cache of local environment
gulp.task('cache:clear', function (callback) {
return cache.clearAll(callback)
});

// This runs the clean dist command followed by sass, useref, optimize images, and move fonts in that order. Useful to run all optimizing scripts.
gulp.task('build', function (callback) {
  runSequence('clean:dist', 
    ['sass', 'useref', 'images', 'fonts'],
    callback
  )
});


//Similar idea from the task above, but this one runs all development tasks in one go in order. 
gulp.task('default', function (callback) {
  runSequence(['sass','browserSync', 'watch'],
    callback
  )
});

