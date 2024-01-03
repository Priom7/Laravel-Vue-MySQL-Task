import './bootstrap';
import { createApp } from 'vue';
import app from './components/app.vue';
import router from './router/index.js';
import "bootstrap/dist/css/bootstrap.min.css";
import bootstrap from "bootstrap/dist/js/bootstrap.bundle.js";

createApp(app).use(router, bootstrap).mount('#app');