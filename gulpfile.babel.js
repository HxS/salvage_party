import gulp from 'gulp';
import sass from 'gulp-sass';
import compass from 'compass-importer';
import plumber from 'gulp-plumber';
import browserify from 'browserify';
import babelify from 'babelify';
import minifyify from 'minifyify'
import source from 'vinyl-source-stream';
import marked from 'marked';
import bulkSass from 'gulp-sass-bulk-import'
import bourbon from 'node-bourbon'
import neat from 'node-neat'

bourbon.with(["./sass/*.scss", "./sass/**/*.scss"]);
neat.with(["./sass/*.scss", "./sass/**/*.scss"]);

gulp.task('watch', () => {
  gulp.watch(["js/src/*.babel.js", "js/src/**/*.babel.js"], ["browserify"]);
  gulp.watch(["sass/*.scss", "sass/**/*.scss"], ["sass"]);
});

gulp.task('sass', () => {
  gulp.src('./sass/build.scss')
    .pipe(plumber())
    .pipe(bulkSass())
    .pipe(sass({
      importer: compass,
      includePaths: bourbon.includePaths.concat(neat.includePaths)
    }))
    .pipe(gulp.dest('./'));
});

gulp.task('browserify', () => {
  browserify({
    entries: ['./js/src/app.babel.js'],
    debug: true
  })
    .transform(babelify)
    .plugin(minifyify, { output: './js/app.babel.min.js' })
    .bundle()
    .on("error", function (err) {
      console.log("Error : " + err.message);
      this.emit("end");
    })
    .pipe(source("app.babel.js"))
    .pipe(gulp.dest("./js/"));
});

gulp.task("default", ['sass', 'browserify', 'watch']);
