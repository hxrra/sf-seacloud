(function() {
    "use strict";

    /**
     * Testimonials slider
     */
    document.querySelectorAll('.slider').forEach((slider) => {
        let range = slider.querySelector('input');
        let text = slider.querySelector('span > span');
        range.addEventListener('change', (e) => {
            text.textContent = e.target.value;
        })
    })

})()
