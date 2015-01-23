'use strict';

var gulp = require('gulp'),
    bower = require('bower'),
    shell = require('gulp-shell'),
    elixir = require('laravel-elixir'),
    notify = require('gulp-notify'),
    phpunit = require('gulp-phpunit');

var configure = {
    "php_server": {
        "port": 8888,
        "path": "public"
    }
};

gulp.task('boot', function () {

    var phpPort = configure.php_server.port,
        phpPath = configure.php_server.path;
    return gulp.src('')
        .pipe(notify({
            title: "booting php server",
            message: 'localhost:' + phpPort
        }))
        .pipe(shell('php -S localhost:' + phpPort + ' -t ' + phpPath
        + ' > /dev/null 2>&1 &', {ignoreErrors: true}));
});

gulp.task('bower', function () {
    return bower.commands.install([], {save: true}, {})
        .on('end', function (data) {
            console.log(data);
        });
});

gulp.task("phpunit", function () {

    var options = {
        debug: false,
        notify: true
    };
    return gulp.src('tests/*Test.php')
        .pipe(phpunit('', options))
        .on('error', notify.onError({
            title: "Gulp PHP Unit",
            message: "Error(s) occurred during testing..."
        }))
        .pipe(notify({
            title: "Gulp PHP Unit",
            message: 'Successfully ran test!'
        }));
});

gulp.task('default', ['bower', 'boot'], function () {
    gulp.watch(['src/**/*.php'], ['phpunit']);
});
