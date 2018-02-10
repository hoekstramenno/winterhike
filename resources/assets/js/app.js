
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./router');

window.moment = require('moment');

import VueCharts from 'vue-chartjs'
import { Bar, Line } from 'vue-chartjs'




// document.addEventListener("DOMContentLoaded", function() {
//     var ctx = document.getElementById("myChart");
//     var timeFormat = 'MM/DD/YYYY HH:mm';
//
//     function newDate(days) {
//         return moment().add(days, 'd').toDate();
//     }
//
//     var myChart = new Chart(ctx, {
//         type: 'line',
//         datasets: [{
//             label: "My First dataset",
//             backgroundColor: '#ff0000',
//             borderColor: 'black',
//             fill: false,
//             data: [
//                 1, 2 , 3, 4, 5, 6, 7, 8
//             ],
//         }],
//         labels: [
//             newDate(0),
//             newDate(1),
//             newDate(2),
//             newDate(3),
//             newDate(4),
//             newDate(5),
//             newDate(6)
//         ],
//         options: {
//             title:{
//                 text: "Chart.js Time Scale"
//             },
//             scales: {
//                 xAxes: [{
//                     type: "time",
//                     time: {
//                         format: timeFormat,
//                         // round: 'day'
//                         tooltipFormat: 'll HH:mm'
//                     },
//                     scaleLabel: {
//                         display: true,
//                         labelString: 'Date'
//                     }
//                 }, ],
//                 yAxes: [{
//                     scaleLabel: {
//                         display: true,
//                         labelString: 'value'
//                     }
//                 }]
//             },
//         }
//     });
// });



const router = window.router

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('flash', require('./components/Flash.vue'));
// Vue.component('example-component', require('./components/ExampleComponent.vue'));

new Vue({
    el: '#app',
    router
});