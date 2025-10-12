import $ from 'jquery';
window.$ = $;
window.jQuery = $;

import 'bootstrap';
import 'admin-lte'; // otomatis cari dari node_modules

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';