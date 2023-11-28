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
let slider = tns({
    container: '.wrapper_offers',
    items: 3,
    gutter: 20,
    controlsContainer: '.arrows_section',
    prevButton: '.arrow-left',
    nextButton: '.arrow-right',
    nav: false
});
