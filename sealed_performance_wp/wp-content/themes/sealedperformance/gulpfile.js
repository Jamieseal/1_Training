/*
 * Gulp v4.0 
 * Dependencies
 */
const { src, dest, series, parallel, watch } = require('gulp');
const css_minify   = require('gulp-cssnano');
const js_minify    = require('gulp-uglify');
const scss_compile = require('gulp-scss');
const rename       = require('gulp-rename');

/*
 * Compile scss
 */
function compile_scss()
{

    return src('css/styles.scss')
           .pipe(scss_compile())
           .pipe(css_minify({discardComments: {removeAll: true}}))
           .pipe(rename({ extname: '.min.css' }))
           .pipe(dest('css'));

}


/*
 * Minify JavaScript
 */
function minify_js()
{

    return src('js/scripts.js')
           .pipe(js_minify())
           .pipe(rename({ extname: '.min.js' }))
           .pipe(dest('js'));
};


/*
 * Default task is to run a build
 */
exports.default = parallel(compile_scss, minify_js);


/*
 * Watch for changes in source files
 */
watch('js/script.js', minify_js);

watch('css/**/*.scss', compile_scss);
