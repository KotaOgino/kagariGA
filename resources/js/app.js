/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
require('jquery-drawer');
require('tablesorter');

$(function() {
  // ドロワーメニュー
  $('.drawer').drawer();
  $('.drawer-dropdown').hover(function() {
    $('ul:not(:animated)', this).slideDown();
  }, function() {
    $('ul.drawer-dropdown-menu', this).slideUp();
  });
});

import Vue from 'vue'

import Vuetify from 'vuetify/lib'

import colors from 'vuetify/es5/util/colors'

// ルーティングの定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'

Vue.use(Vuetify, {
  theme: {
    primary: colors.blue.darken2,
    accent: colors.grey.darken3,
    secondary: colors.amber.darken3,
    info: colors.teal.lighten1,
    warning: colors.amber.base,
    error: colors.deepOrange.accent4,
    success: colors.green.accent3
  }
})

import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';

export default new Vuetify();


// Vue.jsの実行
document.addEventListener('DOMContentLoaded', function() {
  new Vue({
    el: '#app',
    router, // ルーティングの定義を読み込む
    // Vuetixfy,
    components: {
      App
    }, // ルートコンポーネントの使用を宣言する
    template: '<App />' // ルートコンポーネントを描画する
  });
});
