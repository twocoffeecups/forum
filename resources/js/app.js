import './bootstrap';

import { createApp } from 'vue'
import App from './App.vue'
import router from './router/forum'
// import axios from "axios";

// vuex store
import store from "./store";

// Quill
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

// i18n
import { createI18n } from 'vue-i18n';
import { defaultLocale, languages } from './locales/index'
const messages = Object.assign(languages);
const i18n = createI18n({
    legacy:false,
    locale: defaultLocale,
    fallbackLocale:'en',
    messages,
})

// Toast
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
const toastOptions = {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false
};

import './assets/main.css'

const app = createApp(App)

// app.component('font-awesome-icon', FontAwesomeIcon)
app.component('QuillEditor', QuillEditor)
app.use(Toast, toastOptions);
app.use(router);
app.use(store);
app.use(i18n);


//axios.defaults.withCredentials = true;
//app.config.globalProperties.axios = axios;

app.mount('#app')
