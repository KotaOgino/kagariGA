const mix = require('laravel-mix');
const vuetifyLoader = require('vuetify-loader/lib/plugin');

mix.js('resources/js/app.js', 'public/js');

mix.autoload({
    'jquery': ['$', 'window.jQuery'],
    'iscroll': ['IScroll', 'window.IScroll'],
});

mix.sass('resources/sass/app.scss', 'public/css');

mix.styles([
  'resources/css/style.css',
  'resources/css/ga_style.css',
], 'public/css/all.css');

// モーダル
mix.scripts([
  'resources/js/modal.js',
], 'public/js/all.js');

// mix.scripts([
//   'resources/js/vue.js',
// ], 'public/js/app.js');

// サイト追加時のみ
mix.scripts([
  'resources/js/addsite.js',
], 'public/js/addsite.js');

//分析画面のみ
mix.scripts([
  'resources/js/improvement.js',
  'resources/js/get-sc-data.js',
  'resources/js/table-scroll.js',
  'resources/js/data-diff.js',
], 'public/js/analysis.js');

// Vue
mix.webpackConfig({
  plugins: [new vuetifyLoader()]
});
