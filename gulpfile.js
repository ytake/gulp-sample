var gulp = require('gulp'),
    bower = require('bower'),
    shell = require('gulp-shell'),
    react = require('gulp-react'),
    notify = require('gulp-notify'),
    phpunit = require('gulp-phpunit'),
    urlAdjuster = require('gulp-css-url-adjuster'),
    gulpFilter = require('gulp-filter'),
    mainBowerFiles = require('main-bower-files'),
    browserSync = require('browser-sync'),
    _       = require('lodash'),
    plumber = require('gulp-plumber');

var reload = browserSync.reload;

var configure = {
    "php_server": {
        "port": 8000,
        "path": "public"
    }
};

/**
 * bowerインストール
 *
 */
gulp.task('bower', function () {
    return bower.commands.install([], {save: true}, {})
        .on('end', function (data) {
            console.log(data);
        });
});

/**
 * bower install後に各assetsファイルを指定のディレクトリへ設置します
 */
gulp.task('publish', ['bower'], function () {
    var jsFilter = gulpFilter('**/*.js');
    var cssFilter = gulpFilter('**/*.css');
    var fontFilter = gulpFilter([
        '**/*webfont*',
        "**/Font*",
        "**/glyphicons-*"
    ]);
    var imageFilter = gulpFilter(['**/*.png', "**/*.gif"]);
    return gulp.src(
        mainBowerFiles({
            paths: {
                bowerDirectory: 'vendor/bower_components',
                bowerrc: '.bowerrc',
                bowerJson: 'bower.json'
            }
        })
    )
        .pipe(jsFilter)
        .pipe(gulp.dest('public/assets/js'))
        .pipe(jsFilter.restore())
        .pipe(cssFilter)
        .pipe(gulp.dest('public/assets/css'))
        .pipe(cssFilter.restore())
        .pipe(fontFilter)
        .pipe(gulp.dest('public/assets/fonts'))
        .pipe(fontFilter.restore())
        .pipe(imageFilter)
        .pipe(gulp.dest('public/images'));
});

gulp.task("initialize", ['publish'], function () {
    return gulp.src(
        [
            'public/assets/css/font-awesome.min.css',
            'public/assets/css/bootstrap.min.css'
        ])
        .pipe(urlAdjuster({
            replace: ['../fonts/', ''],
            prepend: '/assets/fonts/'
        }))
        .pipe(gulp.dest('public/assets/css'));
});

/**
 * browser reload
 */
gulp.task('browserSync', function () {
    browserSync({
        open: true,
        port: 3001,
        proxy: "127.0.0.1:" + configure.php_server.port,
        notify: false
    });
});

/**
 * built in serverを実行します
 */
gulp.task('boot', function () {
    var phpPort = configure.php_server.port,
        phpPath = configure.php_server.path;
    return gulp.src('')
        .pipe(plumber())
        .pipe(notify({
            title: "booting php server",
            message: '127.0.0.1:' + phpPort
        }))
        .pipe(shell('php -S 127.0.0.1:' + phpPort + ' -t ' + phpPath
        + ' > /dev/null 2>&1 &', {ignoreErrors: true}));
});

/**
 * React.js コンパイル
 */
gulp.task('react', function () {
    return gulp.src('resources/react/**/*.jsx')
        .pipe(react())
        .pipe(gulp.dest('public/js'));
});

/**
 * phpunit実行
 */
gulp.task("phpunit", function () {

    var options = {
        debug: false,
        notify: true
    };
    return gulp.src('tests/*Test.php')
        .pipe(plumber())
        .pipe(phpunit('', options))
        .on('error', notify.onError(testNotification('fail', 'phpunit')))
        .pipe(notify(testNotification('pass', 'phpunit')));
});

gulp.task('default', ['browserSync', 'initialize'], function () {
    gulp.watch(['src/**/*.php'], ['phpunit']);
    gulp.watch(['src/**/*.php'], reload);
});

/**
 *
 * @param status
 * @param pluginName
 * @param override
 * @returns {{title: string, message: string, icon: string}}
 */
function testNotification(status, pluginName, override) {
    var options = {
        title:   ( status == 'pass' ) ? 'Tests Passed' : 'Tests Failed',
        message: ( status == 'pass' ) ? '\n\nAll tests have passed!\n\n' : '\n\nOne or more tests failed...\n\n',
        icon:    __dirname + '/node_modules/gulp-' + pluginName +'/assets/test-' + status + '.png'
    };
    options = _.merge(options, override);
    return options;
}