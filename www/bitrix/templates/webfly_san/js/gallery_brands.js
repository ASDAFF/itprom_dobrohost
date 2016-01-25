$(document).ready(function() {
    var options = {
        auto: false,
        visible: 8,
        circular: false,
        speed: 1000,
        pause: true,
        btnGo: $('div.nav a'),
        btnNext: '.next_brands',
        btnPrev: '.prev_brands',
        activeClass: 'active'
    };


    $('.slideshow_brands').jCarouselLite(options);
});