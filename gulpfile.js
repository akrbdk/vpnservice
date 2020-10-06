// Gulp
var gulp = require('gulp');
var elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');

elixir(function(mix) {
  mix.stylus('app.styl');
});
// Plugins
var path        = require('path');
var gutil       = require('gulp-util');
var stylus      = require('gulp-stylus');
var uglify      = require('gulp-uglify');
var concat      = require('gulp-concat');
var watch       = require("gulp-watch");
var imagemin    = require('gulp-imagemin');
var del         = require('del');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;

// Caminhos
var paths = {
  css:    'app/assets/css/',
  js:     'app/assets/javascript/',
  img:    'app/assets/img/',
  stylus: 'app/assets/stylus/',
  app: 'app/',
  build: 'build/'
}

// Tarefas

// Limpar
gulp.task('clean', function() {
  return del(['build']);
});

gulp.task('scripts', ['clean'], function() {
  return gulp.src(paths.js+'vendor/*')
    .pipe(uglify())
    .pipe(concat('vendor.min.js'))
    .pipe(gulp.dest(paths.app+'assets/js/'))
    .pipe(browserSync.stream());
});

gulp.task('main', ['clean'], function() {
  return gulp.src(paths.js+'main.js')
    .pipe(uglify())
    .pipe(concat('main.min.js'))
    .pipe(gulp.dest(paths.app+'assets/js/'))
    .pipe(browserSync.stream());
});

// Copiar e minificar imagens
gulp.task('imagens', ['clean'], function() {
  return gulp.src(paths.img)
    .pipe(imagemin({optimizationLevel: 5}))
    .pipe(gulp.dest(paths.app+'build/assets/img'));
});

// Liverealod
gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: paths.app
        }
    });
});

// stylus
gulp.task('stylus', function () {
  gulp.src(paths.stylus+'main.styl')
    .pipe(stylus({
      compress: true
    }))
    .pipe(gulp.dest(paths.css))
    .pipe(browserSync.stream());
});

// Rerun the task when a file changes
gulp.task('watch', function() {
  gulp.watch(paths.js+'vendor/*', ['scripts']);
  gulp.watch(paths.js+'main.js', ['main']);
  gulp.watch(paths.img+'**/*', ['imagens']);
  gulp.watch(paths.stylus+'**/*.styl', ['stylus']);
  gulp.watch(paths.app+'*.html').on('change', browserSync.reload);
});

//taks to run
gulp.task('dev', ['clean','scripts', 'main', 'stylus', 'watch', 'browser-sync']);
gulp.task('build', ['clean', 'stylus', 'scripts', 'imagens']);


