import { tns } from "tiny-slider"
import L from "leaflet"

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
    // Setting up the map
    // ==================
    // Need to reset icon location due to webpack issue
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
        iconUrl: require('leaflet/dist/images/marker-icon.png'),
        shadowUrl: require('leaflet/dist/images/marker-shadow.png')
    });
    const map = L.map('map').setView([51.5, -0.09], 17);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>'
    }).addTo(map);
    L.marker([51.5, -0.09]).addTo(map);
}