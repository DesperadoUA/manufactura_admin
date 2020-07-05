const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify');

const cssFiles = ['./app/css/swiper.min.css', './app/css/bootstrap-grid.min.css', './app/css/common.css',
    './app/css/style_sass.css', './admin_modules/module_1/style.css',
    './admin_modules/module_2/style.css', './admin_modules/module_3/style.css', './admin_modules/module_4/style.css',
    './admin_modules/module_5/style.css', './admin_modules/module_6/style.css'];
const jsFiles = ['./app/js/config.js', './app/js/staff.js', './app/js/editor.js',
    './app/js/transliteral_url.js', './app/js/add_slider_img.js',
    './app/js/editor_menu_1.js', './app/js/editor_menu_2.js',
    './app/js/common.js', './admin_modules/module_1/script.js', './admin_modules/module_2/script.js',
	'./admin_modules/module_3/script.js'];
const sassFiles = ['./app/css/header.scss', './app/css/footer.scss', './app/css/main_page.scss',
    './app/css/pagination.scss', './app/css/admin_template.scss', './app/css/header_admin.scss',
    './app/css/sitebar.scss', './app/css/slider_block.scss', './app/css/user_register.scss',
    './app/css/button.scss', './app/css/global_block_data.scss', './app/css/settings_template.scss',
    './app/css/menu_template.scss', './app/css/price_template.scss', './app/css/price.scss'];

function sass_style() {

   return gulp.src(sassFiles)
      .pipe(concat('style_sass.css'))
      .pipe(sass().on('error', sass.logError))
      .pipe(autoprefixer({
         browsers: ['> 0.1%'],
         cascade: false
      }))
      .pipe(cleanCSS({ level: 2 }))
      .pipe(gulp.dest('./app/css/'));
}

function styles() {
   return gulp.src(cssFiles)
      .pipe(concat('style.css'))
      .pipe(autoprefixer({
         browsers: ['> 0.1%'],
         cascade: false
      }))
      .pipe(cleanCSS({ level: 2 }))
      .pipe(gulp.dest('./template/css/'));
}

function script() {
   return gulp.src(jsFiles)
      .pipe(concat('script.js'))
      /* .pipe(uglify(
          {toplevel: true}
       ))*/
      .pipe(gulp.dest('./template/js/'));
}

function watch() {
   gulp.watch('./app/css/*.css', styles);
   gulp.watch('./admin_modules/*/*.css', styles);
   gulp.watch('./admin_modules/*/*.js', script);
   gulp.watch('./app/js/*.js', script);
   gulp.watch('./app/css/*.scss', sass_style);
}
gulp.task('styles', styles);
gulp.task('script', script);
gulp.task('sass_style', sass_style);
gulp.task('watch', watch);