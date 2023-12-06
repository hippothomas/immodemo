import { tns } from "tiny-slider"
import { demo } from "../functions"

export function property() {
    // Property Slider
    // ==================
    tns({
        container: '#property-slider',
        mode: 'gallery',
        controls: false,
        navContainer: '.thumbnails_control',
        navAsThumbnails: true
    });
    // Thumbnail Control Slider
    // ==================
    tns({
        container: '.thumbnails_control',
        items: 3,
        gutter: 10,
        prevButton: '.arrow-left',
        nextButton: '.arrow-right',
        nav: false
    });
    // Click on contact button
    // ==================
    document.getElementById('contact-btn').addEventListener('click', demo);
}