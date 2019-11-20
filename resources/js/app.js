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
// ルーティングの定義をインポートする
import Vuetify from 'vuetify'
import "vuetify/dist/vuetify.min.css";
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'

Vue.use(Vuetify)

// Vue.jsの実行
document.addEventListener('DOMContentLoaded', function() {
  new Vue({
  el: '#app',
  // vuetify: new Vuetify(),
  router, // ルーティングの定義を読み込む
  Vuetify,
  components: { App }, // ルートコンポーネントの使用を宣言する
  template: '<App />' // ルートコンポーネントを描画する
});
});
