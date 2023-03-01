const gulp = require("gulp");
const path = require("path");
const gulpIf = require('gulp-if');
const webpack = require("webpack");
const webpackStream = require("webpack-stream");
const webpackConfig = require("./webpack.config.js");
const gulpSass = require("gulp-sass");
const sourcemaps = require("gulp-sourcemaps");
const tildeImporter = require("node-sass-tilde-importer");
const concat = require("gulp-concat");
const autoprefixer = require('gulp-autoprefixer');
const groupCssMediaQueries = require('gulp-group-css-media-queries');
const cleanCSS = require('gulp-clean-css');
const plumber = require("gulp-plumber");
const argv = require("yargs").argv;
argv.production = argv.production || false;
const isProduction = argv.production;


function js(cb) {
    return gulp.src("./src/index.js")
        .pipe(plumber())
        .pipe(webpackStream(webpackConfig), webpack)
        .pipe(gulp.dest("./assets/"));
}

function scss(cb) {
    return gulp.src(["./src/style.scss", "./src/blocks/**/index.scss"])
        .pipe(plumber())
        .pipe(gulpIf(!isProduction, sourcemaps.init()))
        .pipe(gulpSass({
            importer: tildeImporter
        }))
        .pipe(concat("style.css"))
        .pipe(
            gulpIf(isProduction, autoprefixer({
                    overrideBrowserslist: ['last 1 versions'], grid: true
                })
            ))
        .pipe( gulpIf(isProduction, groupCssMediaQueries()) )
        // .pipe( gulpIf(isProduction, cleanCSS()) )
        .pipe(gulpIf(!isProduction, sourcemaps.write("./")))
        .pipe(gulp.dest("./assets/"));
}

function watch(cb) {
    gulp.watch("./src/**/*.scss", gulp.series(scss));
    gulp.watch("./src/**/*.js", gulp.series(js));
    cb();
}

function test(cb) {
    console.log(path.resolve(__dirname, './assets'))
    cb();
}

exports.scss = scss;
exports.js = js;
exports.watch = watch;

exports.default = gulp.series(
    gulp.parallel(
        js,
        scss
    )
);
