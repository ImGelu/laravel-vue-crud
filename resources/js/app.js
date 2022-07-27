import './bootstrap';
import '../css/app.css';
import 'vue-select/dist/vue-select.css';

import {createApp} from 'vue'
import {createPinia} from 'pinia'
import App from './App.vue'
import router from './router'
import vSelect from 'vue-select'

const pinia = createPinia()
const app = createApp(App)

app.use(pinia).use(router).component('v-select', vSelect);

app.mount('#app')
