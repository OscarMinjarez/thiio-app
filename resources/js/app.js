import './bootstrap';
import { createApp } from 'vue';
import App from "./layouts/App.vue";
import vuetify from "./vuetify";

createApp(App).use(vuetify).mount("#app");