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
        items: 1,
        gutter: 10,
        prevButton: '.arrow-left',
        nextButton: '.arrow-right',
        nav: false,
        responsive: {
            500: {
                items: 2
            },
            700: {
                items: 3
            },
        }
    });
    // Click on contact button
    // ==================
    document.getElementById('contact-btn').addEventListener('click', demo);
}