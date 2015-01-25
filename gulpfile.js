var gulp = require('gulp'),
    bower = require('bower'),
    shell = require('gulp-shell'),
    react = require('gulp-react'),
    notify = require('gulp-notify'),
    phpunit = require('gulp-phpunit'),
    minifyCSS = require('gulp-minify-css'),
    urlAdjuster = require('gulp-css-url-adjuster'),
    gulpFilter = require('gulp-filter'),
    mainBowerFiles = require('main-bower-files'),
    browserSync = require('browser-sync'),
    _       = require('lodash'),
    plumber = require('gulp-plumber');

var configure = {
    "php_server": {
        "port": 8000,
        "path": "public"
    }
};

/**
 * bowerインストール
 * $ gulp bower
 */
gulp.task('bower', function () {
    return bower.commands.install([], {save: true}, {})
        .on('end', function (data) {
            console.log(data);
        });
});

/**
 * bower install後に各assetsファイルを指定のディレクトリへ設置します
 * $ gulp publish
 * bowerタスクは自動で実行されます
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
        .pipe(urlAdjuster({
            replace: ['../fonts/', ''],
            prepend: '/assets/fonts/'
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest('public/assets/css'))
        .pipe(cssFilter.restore())
        .pipe(fontFilter)
        .pipe(gulp.dest('public/assets/fonts'))
        .pipe(fontFilter.restore())
        .pipe(imageFilter)
        .pipe(gulp.dest('public/images'));
});

/**
 * browser reload
 * $ gulp browserSync
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
 * browser reload
 * $ gulp browserReload
 */
gulp.task('browserReload', function (){
    browserSync.reload();
});

/**
 * built in serverを実行します
 * $ gulp boot
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
        .pipe(
            shell('php -S 127.0.0.1:' + phpPort + ' -t ' + phpPath,
                {ignoreErrors: true}
            )
        );
});

/**
 * React.js コンパイル
 * $ gulp react
 */
gulp.task('react', function () {
    return gulp.src('resources/react/**/*.jsx')
        .pipe(react())
        .pipe(minifyCSS())
        .pipe(gulp.dest('public/js'));
});

/**
 * phpunit実行
 * $ gulp phpunit
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

/**
 * watchを使って自動で実行されます
 */
gulp.task('default', ['browserSync', 'publish'], function () {
    gulp.watch(['tests/*Test.php'], ['phpunit']);
    gulp.watch(['src/**/*.php', 'resources/views/**/*.twig'], ['browserReload']);
    gulp.watch(['resources/react/**/*.jsx'], ['browserReload', 'react']);
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
