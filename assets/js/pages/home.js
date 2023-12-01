import { tns } from "tiny-slider"

if (document.getElementById('homepage') !== null) {
    // Slider on homepage
    // ==================
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
    tns({
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
}
