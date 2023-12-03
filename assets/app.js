// Init
// ==================
import './scss/app.scss';

// Imports
// ==================
import { demo } from "./js/func";

// Pages
// ==================
import './js/pages/home';
import './js/pages/property';

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
        if (attr === '#') return;

        let selector = document.querySelector(attr);
        if (selector != null) {
            selector.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
