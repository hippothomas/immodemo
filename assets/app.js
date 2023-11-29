/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './scss/app.scss';

// Slider on homepage
// ==================
import { tns } from "tiny-slider"

let sliderbarDiv = document.getElementById('sliderbar-topoffer');
const SLIDER_CHILD_COUNT = document.getElementById('topoffers_slider').childElementCount;

/**
 * Dynamically change slider bar width
 * @param {int} index
 * @param {int} count
 */
function sliderBarWidth(index, count) {
    let width = (index / count) * 100;
    sliderbarDiv.style.width = width + "%";
}
// Slider instantiation
let slider = tns({
    container: '.wrapper_offers',
    items: 3,
    gutter: 20,
    controlsContainer: '.arrows_section',
    prevButton: '.arrow-left',
    nextButton: '.arrow-right',
    nav: false,
    onInit: () => {
        sliderBarWidth(1, SLIDER_CHILD_COUNT);
    }
});
// Slider bar show current position in slider
slider.events.on('indexChanged', (i) => {
    sliderBarWidth(i.displayIndex, i.slideCount);
});

// References slider on homepage
// ==================
// Slider instantiation
let ref_slider = tns({
    container: '.references_slider',
    items: 2,
    gutter: 20,
    mouseDrag: true,
    controls: false,
    navContainer: '.references_slider_dots',
    autoplay: true,
    autoplayButtonOutput: false,
    slideBy: 2,
    speed: 1500,
    autoplayTimeout: 10000
});

// Click on newsletter button
// ==================
document.getElementById('newsletter-btn').addEventListener('click', () => {
    alert("Merci de l'intérêt que vous portez à ce site mais c'est un site de démo, tout est donc fictif. Si le site vous plaît, n'hésitez pas à consulter mon site hippolyte-thomas.fr pour plus d'informations.");
});
