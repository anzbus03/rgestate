 
$(window).load(function () {
  $('.flexslider').flexslider({
    touch: true,
    slideshow: false,
    controlNav: true,
    slideshowSpeed: 7000,
    animationSpeed: 600,
    initDelay: 0,
    start: function(slider) { // fires when the slider loads the first slide
      var slide_count = slider.count - 1;

      $(slider)
        .find('img.lazy:eq(0)')
        .each(function() {
          var src = $(this).attr('data-src');
          $(this).attr('src', src).removeAttr('data-src');
        });
    },
    before: function (slider) { // fires asynchronously with each slider animation
      var slides = slider.slides,
        index = slider.animatingTo,
        $slide = $(slides[index]),
        $img = $slide.find('img[data-src]'),
        current = index,
        nxt_slide = current + 1,
        prev_slide = current - 1;

      $slide
        .parent()
        .find('img.lazy:eq(' + current + '), img.lazy:eq(' + prev_slide + '), img.lazy:eq(' + nxt_slide + ')')
        .each(function () {
          var src = $(this).attr('data-src');
          $(this).attr('src', src).removeAttr('data-src');
        });
    }
  });
});
