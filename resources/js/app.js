require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('firends-list',  require('./components/firendsList.vue').default);
Vue.component('home-component',     require('./components/homeComponent.vue').default);
Vue.component('about-us',     require('./components/aboutUs.vue').default);
Vue.component('user-component',     require('./components/userComponent.vue').default);
Vue.component('projects-component',     require('./components/projectsComponent.vue').default);
Vue.component('comments-component',     require('./components/commentsComponent.vue').default);
Vue.component('notice-component',     require('./components/noticeComponent.vue').default);

//  Profile Page
Vue.component('country-component',     require('./components/profile/countryComponent.vue').default);

Vue.component('belongs-to',     require('./components/belongsTo.vue').default);

const lang = localStorage.getItem('lang') || 'en' ;
axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers['Accept-Language'] = lang;




const app = new Vue({
    el: '#app',
});
