import Vue from 'vue';
window.Vue = Vue;

// import _ from 'lodash'
// Vue.use(_)

// import only used functions to reduce lodash bundle size
import forEach from 'lodash/forEach'
import concat from 'lodash/concat'
import slice from 'lodash/slice'

global._ = {forEach, concat, slice}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/*
 * Font Awesome 5
 * @url https://fontawesome.com/how-to-use/with-the-api/setup/importing-icons
 */
import {library, dom }  from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons'
import {
	faFacebook as fabFaFacebook
} from '@fortawesome/free-brands-svg-icons/faFacebook'

library.add(fas, fabFaFacebook)

// Kicks off the process of finding <i> tags and replacing with <svg>
dom.watch()