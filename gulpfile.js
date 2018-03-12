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
    apidoc          = require('gulp-apidoc'),
    webpack         = require("webpack");


var webpack_config = require('./webpack.prod');


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
      src: "dev/app/api",
      dest: "dev/public/doc",
      config: "./",
      includeFilters: [ ".*\\.php$" ]
    }, done);
});

gulp.task('concat-php', function() {
    return gulp.src(['./dev/app/**/*.php'])
      .pipe(concat('all.php'))
      .pipe(gulp.dest('./test/'));
});

gulp.task('concat-js', function() {
    return gulp.src(['./src/**/*', '!./src/__common/lib/**/*'])
      .pipe(concat('all.js'))
      .pipe(gulp.dest('./test/'));
});


gulp.task('concat-all', function() {
    return gulp.src([
        './dev/app/**/*.php', 
        './src/**/*', 
        '!./src/__common/lib/**/*' 
        ])
      .pipe(concat('all.txt'))
      .pipe(gulp.dest('./test/'));
});


gulp.task("webpack", function(callback) {

    webpack(webpack_config, function(err, stats) {
        if(err) throw new gutil.PluginError("webpack", err);
        gutil.log("[webpack]", stats.toString({}));
        callback();
    });

    return this;
});

gulp.task('build', ['webpack'], function() {
    
    var task1 = gulp.src(['./dev/start.php','./dev/.htaccess']).pipe(phpMinify()).pipe(gulp.dest('./.prod/'));
    var task2 = gulp.src(['./dev/app/**/*']).pipe(gulp.dest('./.prod/app/'));

    return [task1, task2];
});