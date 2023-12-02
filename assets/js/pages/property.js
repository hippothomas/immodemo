import { tns } from "tiny-slider"

if (document.getElementById('property') !== null) {
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
}