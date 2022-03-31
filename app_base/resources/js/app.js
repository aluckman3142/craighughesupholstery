require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Vue = require('vue').default

Vue.component('example-component', require('./components/ExampleComponent.vue').default)
Vue.component('navbar', require('./components/Navbar.vue').default)
Vue.component('slider-component', require('./components/SliderComponent.vue').default)
Vue.component('categories-component', require('./components/CategoriesComponent.vue').default)
Vue.component('before-after-component', require('./components/BeforeAfterComponent.vue').default)
Vue.component('testimonial-component', require('./components/TestimonialComponent.vue').default)
Vue.component('product-component', require('./components/ProductComponent.vue').default)
Vue.component('vue-cool-lightbox', require('./components/LightboxComponent.vue').default)
Vue.component('video-feed', require('./components/VideoFeedComponent.vue').default)

const app = new Vue({
  el: '#app',
})
