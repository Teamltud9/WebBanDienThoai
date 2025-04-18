import { createApp } from 'vue'
import App from './App.vue'
import './style.css'
import router from './router/index.js'
const app = createApp(App);
app.config.warnHandler = () => {};
app.use(router);
app.mount('#app');