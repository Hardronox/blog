
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Noty = require('noty');

require ("./js_modules/angular.min.js");
require ("./js_modules/angular-ui-router.min.js");
require ("./js_modules/ui-bootstrap-tpls-1.2.5.min.js");

require ("./angular/main.module.js");
require ("./angular/main.config.js");
require ("./angular/main.controller.js");
require ("./angular/search.controller.js");
require ("./site/deleteObject.js");
require ("./site/home.js");
require ("./site/likes.js");
require ("./site/modal.js");
require ("./site/my-articles.js");
require ("./site/subscribe.js");
require ("./site/comments.js");
require ("./site/write-article.js");

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

//window.axios = require('axios');

//window.axios.defaults.headers.common = {
//    'X-CSRF-TOKEN': window.Laravel.csrfToken,
//    'X-Requested-With': 'XMLHttpRequest'
//};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
