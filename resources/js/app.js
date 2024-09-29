import './bootstrap';
import 'tailwindcss/tailwind.css';

import { createApp } from 'vue'
import router from './router';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import App from "./App.vue";

const app = createApp(App)

app
.use(router)
.use(VueSweetalert2)
.mount("#app");