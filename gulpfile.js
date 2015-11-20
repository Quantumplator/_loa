var gulp       = require('gulp'),
  browserSync  = require('browser-sync'),
  critical     = require('critical'),
  autoprefixer = require('gulp-autoprefixer'),
  bower        = require('gulp-bower'),
  compass      = require('gulp-compass'),
  concat       = require('gulp-concat-util'),
  gulpif       = require('gulp-if'),
  mincss       = require('gulp-minify-css'),
  minhtml      = require('gulp-minify-html'),
  pixrem       = require('gulp-pixrem'),
  rename       = require('gulp-rename'),
  size         = require('gulp-size'),
  uglify       = require('gulp-uglify'),
  gutil        = require('gulp-util'),
  pjson        = require('./package.json'),
  reload       = browserSync.reload;

// paths to resources
var paths = {
  bower: './bower_components',
  styles: './src/scss/style.scss',
  scss: './src/scss/**/*.scss',
  scripts: './src/js/**/*.js',
  crit: './src/crit/**/*.js',
  img: './src/img/**/*',
  php: './**/*.php',
  css: './**/*.css',
  js: './js/**/*.js',
  src: './src/**/*'
}

// destinations for resources
var dest = {
  css: '',
  php: '',
  inc: './inc',
  scripts: './js',
  images: './img'
}

// environment variables
var env,
    currentProj;

//***** UPDATE THIS FOR EACH PROJECT - SHOULD BE YOUR localhost/dir - NO TRAILING SLASH! *****
currentProj = 'mom/loa';

// build per environment
env = process.env.NODE_ENV || 'development';


// DEVELOPER! gulp to install bower devDependencies if you get your fork on
// * not included in default task
gulp.task('bower', function() { 
  return bower()
    .pipe(gulp.dest(paths.bower)) 
});

// DEVELOPER! gulp after updating loadCSS(path) to uglify and pipe to production
gulp.task('loadCSS', function() {
  return gulp.src(paths.crit)
    .pipe(concat('detects.js'))
    .pipe(uglify())
    .pipe(size())
    .pipe(gulp.dest(dest.scripts));
});


// BROWSER-SYNC
gulp.task('browser-sync', function() {
  // watch files
  var files = [
    paths.php,
    paths.scss,
    paths.js,
    paths.images
  ];
  // sync with reloader.js (to prevent multiple tabs)
  browserSync.use({
    plugin: function () { /* noop */ },
    hooks: {
      'client:js': require("fs").readFileSync("./src/gulp/reloader.js", "utf-8") // Link to your file
    }
  });
  // initialize browsersync
  browserSync.init(files, {
    // browsersync with a php server
    proxy: 'http://localhost:8888/' + currentProj + '/',
    notify: false,
    open: false // Single window; prevents a new tab for every instance, use browser bookmark HOW TO FIX SOCKET ERRORS?
  });
});


// COMPASS
gulp.task('compass', function() {
  return gulp.src(paths.styles)
    .pipe(compass({
      style: 'expanded',
      css: '',
      sass: 'src/scss',
      image: 'img'
    }))
    .pipe(pixrem())
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(size())
    .pipe(gulpif(env==='production', mincss()))
    .pipe(gulpif(env==='production', size()))
    .pipe(gulp.dest(dest.css));
});


// JAVASCRIPT
gulp.task('js', function() {
  return gulp.src(paths.scripts)
    .pipe(concat('main.js'))
    .pipe(size())
    .pipe(gulp.dest(dest.scripts))
    .pipe(gulpif(env==='production', uglify()))
    .pipe(gulpif(env==='production', rename('main.min.js')))
    .pipe(gulpif(env==='production', size()))
    .pipe(gulpif(env==='production', gulp.dest(dest.scripts)));
});


// DEFAULT
gulp.task('default', ['compass', 'js', 'browser-sync'], function(){
  gulp.watch(paths.scss, ['compass']);
  gulp.watch(paths.scripts, ['js']);
});




