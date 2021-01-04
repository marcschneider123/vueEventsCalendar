//IE11 polyfill
import "@babel/polyfill"

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

const moment = require('moment')
require('moment/locale/de')

Vue.use(require('vue-moment'), {
	moment
})
// var SocialSharing = require('vue-social-sharing');
// Vue.use(SocialSharing);

import VueScrollTo from 'vue-scrollto'
Vue.use(VueScrollTo, {
	offset: -70,
})

import backToTop from './components/layout/backToTop';
import events from './views/events';

const app = new Vue({
	el: '#app',
	data: {
		//
	},
	components: {
		backToTop,
		events
	},
	mounted: function() {
		// console.log("mounted")
	}
});