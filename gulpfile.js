var gulp       = require('gulp'),
  browserSync  = require('browser-sync'),
  autoprefixer = require('gulp-autoprefixer'),
  bower        = require('gulp-bower'),
  compass      = require('gulp-compass'),
  concat       = require('gulp-concat-util'),
  gulpif       = require('gulp-if'),
  jshint       = require('gulp-jshint'),
  mincss       = require('gulp-minify-css'),
  minhtml      = require('gulp-minify-html'),
  rename       = require('gulp-rename'),
  size         = require('gulp-size'),
  uglify       = require('gulp-uglify'),
  util         = require('gulp-util'),
  stylish      = require('jshint-stylish'),
  pjson        = require('./package.json'),
  reload       = browserSync.reload;

// paths to resources
var paths = {
  bower: './bower_components',
  scss: './src/scss/style.scss',
  crit: './src/scss/critical.scss',
  styles: './src/scss/**/*.scss',
  scripts: './src/js/**/*.js',
  main: './src/js/main.js',
  images: './src/img/**/*',
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
    outputDir,
    sassStyle,
    currentProj;

//***** UPDATE THIS FOR EACH PROJECT - SHOULD BE YOUR localhost/dir - NO TRAILING SLASH! *****
currentProj = 'mom/loa';

// build per environment
env = process.env.NODE_ENV || 'development';

if (env==='development') {
  sassStyle = 'expanded';
} else {
  sassStyle = 'compressed';
}

// DEVELOPERS! USE THIS to install bower devDependencies if you get your fork on
// * not included in default task
gulp.task('bower', function() { 
  return bower()
    .pipe(gulp.dest(paths.bower)) 
});

// Run loadCSS once to
gulp.task('loadCSS', function() {
  return gulp.src('./src/loadCSS.js')
    .pipe(uglify())
    .pipe(rename({
      basename: 'loadCSS',
      suffix: '.min'
    }))
    .pipe(gulp.dest('crit'))
    .pipe(concat.header('<script>'))
    .pipe(concat.footer('</script><noscript><link href="wp-content/themes/_loa/style.css" rel="stylesheet"></noscript>'))
    .pipe(rename({
      basename: 'loadCSS',
      extname: '.php'
    }))
    .pipe(gulp.dest(dest.inc));
});



// BROWSER-SYNC
gulp.task('browser-sync', function() {
  // watch files
  var files = [
    paths.php,
    paths.styles,
    paths.css,
    paths.js,
    paths.images
  ];


  browserSync.use({
    plugin: function () { /* noop */},
    hooks: {
      'client:js': require("fs").readFileSync("./src/reloader.js", "utf-8") // Link to your file
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


// COMPASS CRITICAL
gulp.task('compass:crit', function() {
  return gulp.src(paths.crit)
    .pipe(compass({
      style: sassStyle,
      css: 'crit',
      sass: 'src/scss',
      image: 'img'
    }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(mincss())
    .pipe(rename({
      basename: 'critical',
      suffix: '.min'
    }))
    .pipe(gulp.dest('./crit'))
    .pipe(concat.header('<style>'))
    .pipe(concat.footer('</style>'))
    .pipe(rename({
      basename: 'criticalCSS',
      extname: '.php'
    }))
    .pipe(gulp.dest(dest.inc))
    .pipe(size());
});


// COMPASS NON-CRITICAL
gulp.task('compass:noncrit', function() {
  return gulp.src(paths.scss)
    .pipe(compass({
      style: sassStyle,
      css: '',
      sass: 'src/scss',
      image: 'img'
    }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(gulp.dest(dest.css))
    .pipe(size());
});

// JAVASCRIPT
gulp.task('js', function() {
  return gulp.src(paths.scripts)
    .pipe(concat('main.js'))
    .pipe(gulp.dest(dest.scripts))
    .pipe(size())
    .pipe(gulpif(env==='pro', uglify()))
    .pipe(gulpif(env==='pro', rename('main.min.js')))
    .pipe(gulpif(env==='pro', gulp.dest('./js')))
    .pipe(gulpif(env==='pro', size()));
});

// DEFAULT
gulp.task('default', ['compass:crit', 'compass:noncrit', 'js', 'browser-sync'], function(){
  gulp.watch(paths.src, ['compass:crit', 'compass:noncrit', 'js']);
});









