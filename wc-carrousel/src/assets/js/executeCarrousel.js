import { Carousel, initTWE} from '../../../node_modules/tw-elements/js/tw-elements.es.min.js';
initTWE({Carousel});
new Carousel(document.getElementById("carrousel_start"),{
    interval: 5000
})