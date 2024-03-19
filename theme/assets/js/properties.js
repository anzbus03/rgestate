$(document).ready(function () {

    // Hero Select2
    $("#rg_status").select2({
        dropdownParent: $('.rg-status'),
        placeholder: "Status",
    });
    $("#rg_type").select2({
        dropdownParent: $('.rg-type'),
        placeholder: "Type",
    });
    $("#rg_cities").select2({
        dropdownParent: $('.rg-cities'),
        placeholder: "Cities",
    });
    $("#rg_bedrooms").select2({
        dropdownParent: $('.rg-bedrooms'),
        placeholder: "Bedrooms",
    });

    // Services Slick Slider
    $('.rg-img-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
    });

    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('.rg-img-slider').slick('setPosition');
    });

    $('.rg-sidebar-slider').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
    });

});