/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 
require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('article-component',require('./components/ArticleComponent.vue'))
import App from './components/ExampleComponent.vue';
import Article from './components/ArticleComponent.vue';
import register from './components/register.vue';
import login from './components/login.vue';
import Vue from 'vue';

// Define a new component called button-counter
Vue.component('button-counter', {
    data: function () {
      return {
        count: 0
      }
    },
    template: '<button v-on:click="count++">You clicked me {{ count }} times.</button>'
  })
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
const app = new Vue({
    el: '#app',
    
});*/
if($("#app").length > 0){
new Vue({
    render: h => h(App)
}).$mount("#app");

}
if($("#article").length > 0){
new Vue({
    render: h => h(Article)
}).$mount("#article");
}
if($("#register").length > 0){
  new Vue({
      render: h => h(register)
  }).$mount("#register");
  }
  if($("#login").length > 0){
    new Vue({
        render: h => h(login)
    }).$mount("#login");
    }
//new Vue({ el: '#components-demo' })