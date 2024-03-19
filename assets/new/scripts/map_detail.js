
// loader start
// loader end
jQuery(function ($) {
    "use strict";
 
		$(".fancybox").fancybox({
		openEffect  : "fade",
		closeEffect : "fade",
		type : "image"
		});

    
    //scroll sections on clicking Links
    $(".scroll").on('click', function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });
    //scroll nav colors
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 70) { // Set position from top to add class
            $('.navbar').addClass("shrink");
            $('.green .navbar-brand> img').attr('src', 'images/logo-green-dark.png');
            $("#index5 #menu_bars").addClass('active2');

        }
        else {
            $('.navbar').removeClass("shrink");
            $('.green .navbar-brand> img').attr('src', 'images/logo-green-white.png');
            $("#index5 #menu_bars").removeClass('active2');
        }


    });
    // Push Menus
    var $menuLeft = $(".pushmenu-left");
    var $menuRight = $(".pushmenu-right");
    var $toggleleft = $("#menu_bars.left");
    var $toggleright = $("#menu_bars.right");
    $toggleright.on("click", function() {
        $(this).toggleClass("active");
        $(".pushmenu-push").toggleClass("pushmenu-push-toleft");
        $menuRight.toggleClass("pushmenu-open");
        $("body").toggleClass("pushmenu-push-toLeft");
        $(".navbar").toggleClass("navbar-right");
        return false;
    });
  

    /* ================================== cover sliders start ============================ */

        var swiper = new Swiper('.main-slider', {
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            speed: 1600,
            effect: "fade",
            loop: false,
            autoplay: 5000
        });



        var swiper = new Swiper('.parallax-slider', {
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            speed: 600,
            autoplay: 5000
        });


    /* ================================== cover sliders end ============================ */

    // portfolio filtering
    $(".project-wrapper").mixItUp();
    //portfolio fancybox setting
    // Popup
   
    //Video Popup

    //Happy Client Slider
   

    //blog text slider
   
   

     


});
