// Init
// ==================
import './scss/app.scss';

// Imports
// ==================
import Vue from 'vue';
import { loadScripts, demo } from "./js/functions";

// Components
// ==================
import Map from './js/components/Map';
import CardProperty from "./js/components/CardProperty";
import Location from "./js/components/Location";

// Pages
// ==================
import { home } from './js/pages/home';
import { property } from './js/pages/property';
import { search } from  './js/pages/search';
import { contact } from  './js/pages/contact';

new Vue({
  el: '#app',
  components: {
      'map-component': Map,
      CardProperty,
      Location
  },
  mounted() {
      loadScripts('homepage', home);
      loadScripts('property', property);
      loadScripts('searchpage', search);
      loadScripts('contact', contact);
  }
});

// Click on newsletter button
document.getElementById('newsletter-btn').addEventListener('click', demo);

// Smooth scrolling to html anchor
// https://stackoverflow.com/a/7717572/19209643
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        let attr = this.getAttribute('href');
        if (attr === '#') {
            // Check if it's the leaflet controls
            const leafletControls = this.closest(".leaflet-control-zoom");
            if (!leafletControls) { demo(); }
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
