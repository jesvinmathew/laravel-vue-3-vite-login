import './bootstrap';
import Router from '@/router'
import store from '@/store'

import { createApp } from 'vue/dist/vue.esm-bundler';

import App from './App.vue';
import BootstrapVue3 from 'bootstrap-vue-3';

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css';

const app = createApp(App)
app.use(Router)
app.use(store)
app.use(BootstrapVue3)
app.mount('#app')