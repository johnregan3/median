// Defining base paths
var basePaths = {
    src: './src/'
};

// Defining requirements
var gulp         = require( 'gulp' ),
    concat       = require( 'gulp-concat' ),
    plumber      = require( 'gulp-plumber' ),
    sass         = require( 'gulp-sass' ),
    rename       = require( 'gulp-rename' ),
    ignore       = require( 'gulp-ignore' ),
    sourcemaps   = require( 'gulp-sourcemaps' ),
    cleanCSS     = require( 'gulp-clean-css' ),
    uglify       = require( 'gulp-uglify' ),
    gulpSequence = require( 'gulp-sequence' );

/**
 * Run: gulp watch
 * Run: gulp w
 *
 * This is where the action happens.
 *
 * Run this to watch the development files in /src, generate the minified versions
 * where appropriate, and update Browser Sync.
 *
 * Starts the watcher for all .scss and js files, and minimizes images.
 */
gulp.task( 'watch', function() {
    gulp.watch( './src/sass/**/*.scss', [ 'styles' ] );
    gulp.watch( './src/js/admin.js', [ 'admin-scripts' ] );
} );

/**
 * Run: gulp styles
 *
 * Runs the sass and minify-css sequence.
 */
gulp.task( 'styles', function( callback ) {
    gulpSequence( 'sass', 'minify-css' )( callback )
} );

/**
 * Run: gulp sass
 *
 * Compiles /src/sass/*.scss files into the /css directory.
 */
gulp.task( 'sass', function() {
    return gulp.src( './src/sass/*.scss' )
    .pipe( plumber( {
        errorHandler: function( err ) {
            console.log( err );
            this.emit( 'end' );
        }
    } ) )
    .pipe( sass() )
    .pipe( gulp.dest( './css' ) )
    .on( 'end', function() {
        console.log( 'sass task complete' );
    } );
} );

/**
 * Run: gulp minify-css
 *
 * Minifies the /css/theme.css file.
 */
gulp.task( 'minify-css', function() {
    return gulp.src( './css/theme.css' )
    .pipe( sourcemaps.init( { loadMaps: true } ) )
    .pipe( cleanCSS( { compatibility: '*' } ) )
    .pipe( plumber( {
        errorHandler: function( err ) {
            console.log( err );
            this.emit( 'end' );
        }
    } ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( sourcemaps.write( './' ) )
    .pipe( gulp.dest( './css/' ) )
    .on( 'end', function() {
        console.log( 'minify-css task complete' );
    } );
} );

/**
 * Run: gulp admin-scripts
 *
 * Minifies /src/js/admin.js into /js/admin.min.js.
 */
gulp.task( 'admin-scripts', function() {
    return gulp.src( './src/js/admin.js' )
    .pipe( sourcemaps.init( { loadMaps: true } ) )
    .pipe( concat( 'admin.js' ) )
    .pipe( gulp.dest( './js/' ) )
    .pipe( uglify() )
    .pipe( plumber( function( error ) {
        console.error( error.message );
        this.emit( 'end' );
    } ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( plumber( function( error ) {
        console.error( error.message );
        this.emit( 'end' );
    } ) )
    .pipe( sourcemaps.write( './' ) )
    .pipe( gulp.dest( './js/' ) )
    .on( 'end', function() {
        console.log( 'admin-scripts task complete' );
    } );
} );
