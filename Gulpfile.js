"use strict";

// Load plugins
const gulp = require('gulp');
const sass = require('gulp-sass')(require('node-sass'));
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const autoprefixer = require('gulp-autoprefixer');
const cssmin = require('gulp-cssmin');
const stripDebug = require('gulp-strip-debug');
const concat = require('gulp-concat');
const gih = require('gulp-include-html');
const imagemin = require('gulp-imagemin');
const webserver = require('gulp-webserver');

// var baseDir = "./dist/";
// var assetsDir = "assets/";

var baseDir = "./site/";
var assetsDir = "webroot/";


function images() {
  return gulp.src('./frontend/img/*')
    .pipe(imagemin())
    .pipe(gulp.dest(baseDir+assetsDir+'img'))
}

function fonts() {
  return gulp.src('./frontend/fonts/*')
    .pipe(gulp.dest(baseDir+assetsDir+'font'))
}

function build() {
    return gulp.src("./frontend/html/*.html")
        .pipe(gih({
            'public':"./dist",
            baseDir:'./frontend/html/components/'
        }))
        .pipe(gulp.dest('./dist/'));
};

function css() {
  return gulp.src('frontend/scss/app/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
        browsers: ['last 5 versions'],
        cascade: true
    }))
    .pipe(cssmin())
    .pipe(gulp.dest(baseDir+assetsDir+'css/'));
}

function cssVendor() {
  return gulp.src([
    'frontend/scss/vendors/critical/*.css',
    'frontend/scss/vendors/*.scss'
    ])
    .pipe(sass().on('error', sass.logError))
    .pipe(cssmin())
    .pipe(concat('vendors.css'))
    .pipe(gulp.dest(baseDir+assetsDir+'css/'));
}

function jsVendor() {
  return gulp.src([
    'frontend/js/vendors/critical/jquery-3.6.0.min.js',
    'frontend/js/vendors/critical/bootstrap.bundle.min.js',
    'frontend/js/vendors/critical/popper.min.js',
    'frontend/js/vendors/critical/dayjs.min.js',
    'frontend/js/vendors/dayjs/*.js',
    'frontend/js/vendors/*.js',
    ])
  // .pipe(stripDebug())
  // .pipe(uglify())
  .pipe(concat('vendors.js'))
  .pipe(gulp.dest(baseDir+assetsDir+'js'));
}

function js() {
  return gulp.src([
    'frontend/js/app/*.js',
    'frontend/js/app/**/*.js'
    ])
    // .pipe(stripDebug())
    // .pipe(uglify())
    .pipe(concat('main.js'))
    .pipe(gulp.dest(baseDir+assetsDir+'js'));
}

function watchFiles(){
  gulp.watch('frontend/scss/vendors/*.scss', cssVendor);
  gulp.watch('frontend/scss/app/**/*.scss', css);
  gulp.watch('frontend/js/vendors/*.js', jsVendor);
  gulp.watch(['frontend/js/app/*.js', 'frontend/js/app/**/*.js'], js);
  gulp.watch('frontend/html/**/*.html', build);
  gulp.watch(['./frontend/img/*.svg', './frontend/img/*.png', './frontend/img/*.jpg', './frontend/img/*.gif'], gulp.parallel(images, css));
}

function server() {
  return gulp.src('dist')
    .pipe(webserver({
      port: 8000,
      livereload: true,
      directoryListing: false,
      open: true,
      fallback: './dist/index.html'
    })
  );
}

//Descriptions for the common tasks
images.description = "Copy images to the Cake img folder";
css.description = "Compile all the SASS files into one minified CSS and place it on the Cake folder";
cssVendor.description = "Combine all the vendor css into one file and place it on the Cake Folder";

// const compile = gulp.parallel(adminCss, adminCssVendor, adminJs, adminJsVendor);
// const defaultTasks = gulp.series(gulp.parallel(adminCss, adminCssVendor, adminJs, adminJsVendor), watchFiles);
const compile = gulp.parallel(css, cssVendor, js, jsVendor);
const defaultTasks = gulp.series(gulp.parallel(images, fonts, css, cssVendor, js, jsVendor), watchFiles);
const serve = gulp.series(gulp.parallel(compile, server));

exports.images = images;
exports.fonts = fonts;
exports.cssVendor = cssVendor;
exports.jsVendor = jsVendor;
exports.css = css;
exports.js = js;
exports.build = build;
exports.watch = watchFiles;
exports.compile = compile;
exports.default = defaultTasks;
exports.serve = serve;
