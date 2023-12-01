// Init
// ==================
import './scss/app.scss';

// Pages
// ==================
import './js/pages/home.js';
import './js/pages/property.js';

// Click on newsletter button
// ==================
document.getElementById('newsletter-btn').addEventListener('click', () => {
    alert("Merci de l'intérêt que vous portez à ce site mais c'est un site de démo, tout est donc fictif. Si le site vous plaît, n'hésitez pas à consulter mon site hippolyte-thomas.fr pour plus d'informations.");
});

// Smooth scrolling to html anchor
// https://stackoverflow.com/a/7717572/19209643
// ==================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
