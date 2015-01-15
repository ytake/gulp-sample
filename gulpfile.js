'use strict';
var gulp = require('gulp'),
    shell = require('gulp-shell'),
    elixir = require('laravel-elixir'),
    notify = require('gulp-notify');

var configure = {
    "php_server": {
        "port": 8881,
        "path": "public"
    }
};

gulp.task('php_server', ['watch'], function () {
    var phpPort = configure.php_server.port,
        phpPath = configure.php_server.path;
    return gulp.src('')
        .pipe(notify({
            title: "booting php server",
            message: 'localhost:' + phpPort
        }))
        .pipe(shell('php -S localhost:' + phpPort+ ' -t ' + phpPath, {ignoreErrors: true }))
        .on('error', notify.onError({
            title: "php server error",
            message: "Error(s) occurred ..."
        }))
});

gulp.task('default',function(){
    console.log(this);
});

gulp.task("test",function(){
    gulp.src('tests/*.php')
        .pipe(phpunit())
        .on('error', notify.onError({
            title: "Gulp PHP Unit",
            message: "Error(s) occurred during testing..."
        }))
        .pipe(notify({
            title: "Gulp PHP Unit",
            message: 'Successfully ran test!'
        }));
});


gulp.task('watch', function(){
    gulp.watch(['src/**/*.php'], ['php_server']);
});
