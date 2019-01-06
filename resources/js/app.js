
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import App from './App'

import Chatkit from '@pusher/chatkit'
Vue.use(Chatkit);

/*---- SETUP CHATKIT USER ------------*/
const tokenProvider = new Chatkit.TokenProvider({
    url: "https://us1.pusherplatform.io/services/chatkit_token_provider/v1/663b8744-26ef-4713-9a95-6aac9c5329d1/token"
});

window.chatManager = new Chatkit.ChatManager({
    instanceLocator: "v1:us1:663b8744-26ef-4713-9a95-6aac9c5329d1",
    userId: atob(window.uid),
    tokenProvider: tokenProvider
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    render:h=>h(App),
});
