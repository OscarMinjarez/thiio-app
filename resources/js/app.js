import './bootstrap';
import "../css/app.css";
import { createApp } from 'vue';
import App from "./layouts/App.vue";
import vuetify from "./vuetify";
import router from './router';

const app = createApp(App);

app.use(router);
app.use(vuetify);

app.mount("#app");