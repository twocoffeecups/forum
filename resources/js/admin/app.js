import '../bootstrap';

import '../../adminlte/js/jquery.min.js';
import '../../adminlte/js/adminlte.min.js';
import '../../adminlte/js/bootstrap.bundle.min.js';

import {createApp} from "vue";
import App from "./App.vue";
import router from "../router";

const app = createApp(App);

app.use(router);
app.mount('#admin-app');
