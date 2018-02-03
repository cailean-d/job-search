'use strict';

var gulp            = require('gulp'),
    uniqid          = require('uniqid'),
    concat          = require('gulp-concat'),
    uglify          = require('gulp-uglify'),
    clean           = require('gulp-clean'),
    gutil           = require('gulp-util'),
    cleanCSS        = require('gulp-clean-css'),
    autoprefixer    = require('gulp-autoprefixer'),
    inject          = require('gulp-inject'),
    gulpRemoveHtml  = require('gulp-remove-html'),
    htmlmin         = require('gulp-html-minifier'),
    {phpMinify}     = require('@cedx/gulp-php-minify'),
    apidoc          = require('gulp-apidoc');

gulp.task('clean-prod', function(){
    return gulp.src('./.prod/', {read: false})
    .pipe(clean());
});

gulp.task('build-js', function() {
    return gulp.src('./js/*.js')
    .pipe(concat("bundle-" + uniqid() + ".js"))
    .pipe(uglify({ mangle: {reserved: ['jQuery', '$']} }))
    .on('error', function (err) { gutil.log(gutil.colors.red('[Error]'), err.toString()); })
    .pipe(gulp.dest('./.prod/'));
})

gulp.task('build-css', function(){
    return gulp.src('./css/*.css')
    .pipe(concat("bundle-" + uniqid() + ".css"))
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(cleanCSS({level: {1: {specialComments: 0}}}))
    .pipe(gulp.dest('./.prod/'));
})

gulp.task('build-index', function () {
    return gulp.src("./index.php")
    .pipe(phpMinify())
    .pipe(inject(gulp.src(['./.prod/*.js', './.prod/*.css'], {read: false}), {ignorePath: '/.prod', addRootSlash: false}))
    .pipe(gulpRemoveHtml())
    .pipe(htmlmin({collapseWhitespace: true, removeComments : true, ignoreCustomFragments : false}))
    .pipe(gulp.dest('./.prod/'));
});

gulp.task('apidoc-dev', function(done){
    apidoc({
      src: "app/api",
      dest: "public/doc",
      config: "./",
      includeFilters: [ ".*\\.php$" ]
    }, done);
});

gulp.task('test-php', function() {
    return gulp.src(['./app/**/*.php', '!./app/doc/**/*.*'])
      .pipe(concat('all.php'))
      .pipe(gulp.dest('./test/'));
});

gulp.task('test-js', function() {
    return gulp.src(['./public/javascript/*.js'])
      .pipe(concat('all.js'))
      .pipe(gulp.dest('./test/'));
});

gulp.task('test-css', function() {
    return gulp.src(['./public/stylesheet/*.css'])
      .pipe(concat('all.css'))
      .pipe(gulp.dest('./test/'));
});

gulp.task('test-all', function() {
    return gulp.src([
        './public/stylesheet/*.css', 
        './app/**/*.php', 
        '!./app/doc/**/*.*', 
        './public/javascript/*.js'
        ])
      .pipe(concat('all.txt'))
      .pipe(gulp.dest('./test/'));
});
