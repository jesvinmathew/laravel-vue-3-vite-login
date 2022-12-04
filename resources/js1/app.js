import './bootstrap';
//import '../sass/app.scss'

import { createApp } from 'vue';
import Router from '@/router'
import store from '@/store'

//import App from './layouts/App.vue';
//import setupInterceptors from './services/setupInterceptors';
import BootstrapVue3 from 'bootstrap-vue-3';

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css';


const app = createApp({})
app.use(Router)
app.use(store)
app.use(BootstrapVue3)
app.mount('#app')
/*
createApp(App)
    .use(BootstrapVue3)
    .use(router)
    .use(store)
    .mount("#app")*/

