// Init
// ==================
import './scss/app.scss';

// Imports
// ==================
import Vue from 'vue';
import Map from './js/components/Map';
import { demo } from "./js/functions";

// Pages
// ==================
import './js/pages/home';
import './js/pages/property';

new Vue({
  el: '#app',
  components: { 'map-component': Map }
});

// Click on newsletter button
// ==================
document.getElementById('newsletter-btn').addEventListener('click', demo);

// Smooth scrolling to html anchor
// https://stackoverflow.com/a/7717572/19209643
// ==================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        let attr = this.getAttribute('href');
        if (attr === '#') {
            // FIXME: issue with leaflet
            // demo();
            return;
        }

        let selector = document.querySelector(attr);
        if (selector != null) {
            selector.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
