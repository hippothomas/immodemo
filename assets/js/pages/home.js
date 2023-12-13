import { tns } from "tiny-slider"

export function home() {
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
        items: 1,
        gutter: 20,
        prevButton: '.arrow-left',
        nextButton: '.arrow-right',
        nav: false,
        responsive: {
            550: {
                items: 2
            },
            750: {
                items: 3
            }
        },
        onInit: () => {
            sliderBarWidth(1, SLIDER_CHILD_COUNT);
        }
    });
    // Slider bar show current position in slider
    slider.events.on('indexChanged', (i) => {
        sliderBarWidth(i.displayIndex, i.slideCount);
    });

    // References controls
    // ==================
    const REF_SLIDER_CHILD_COUNT = document.getElementById('references_slider').childElementCount;

    /**
     * Dynamically generate dots controls for reference slider
     */
    function initReferencesControls(){
        let childCount = REF_SLIDER_CHILD_COUNT;
        if (window.innerWidth > 750) {
            childCount = childCount / 2;
        }
        // Reset the controls div
        document.getElementById('references_controls').innerHTML = '';
        // Generate the good amount of dots
        for (let i = 0; i < childCount; i++) {
            const dot = document.createElement('div');
            dot.className = 'dot';
            document.getElementById('references_controls').appendChild(dot);
        }
    }
    initReferencesControls();
    window.addEventListener("resize", () => initReferencesControls());

    // References slider on homepage
    // ==================
    tns({
        container: '.references_slider',
        items: 1,
        gutter: 20,
        mouseDrag: true,
        controls: false,
        navContainer: '.references_slider_dots',
        autoplay: true,
        autoplayButtonOutput: false,
        slideBy: 1,
        speed: 1500,
        autoplayTimeout: 10000,
        responsive: {
            750: {
                items: 2,
                slideBy: 2
            },
        }
    });
}
