 
 function generateSlider1(ids){
    var slickObj = $('#'+ids).find('.slide');
    
	  slickObj.slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  	responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}, 
			 , {
				breakpoint: 767,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
			 , {
				breakpoint: 580,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			]
});
	   
 }
 function carosels(ids){
		
	 
		$('#'+ids).find('.simple-slick-carousel1').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: true,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});
		$('#'+ids).find('.simple-slick-carousel0').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: true,
			arrows: true,
			autoplay: true,
			autoplaySpeed: 2000,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}, 
			 , {
				breakpoint: 580,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			]
		});
		}
var myVar;
var loaded_array = [];
function loadNext(){
		var loaderElement = 	 $('.fixed_loaders').first().not('.loaded');
		var  ids  = loaderElement.attr('id');
		if(loaded_array.indexOf(ids) == -1)
		{
			loaded_array.push(ids);
		}
		else{
			return false; 
		}
		
		$('#'+ids+'_top').show();
		var  url  = loaderElement.attr('data-url');
		var  class_e  = loaderElement.attr('class');
	    loaderElement.addClass('loading');
	    if(!$('#'+ids).attr('loaded') ) {
						clearTimeout(myVar);
						myVar = setTimeout(function(){	$.get(url,function(data){
							 if(data=='1'){
								 
								 $('#'+ids).remove();
								 $('#'+ids+'_loader').remove();
								 loadNext();
								 //	window.scrollTo(0, 50); 
								 return false;
							 }
								$('#'+ids).html(data).slideDown({ 
								complete: function(){
								$('#'+ids+'_loader').hide();
								}});
								carosels(ids)
								$('#'+ids).attr('class', 'loaded');
								
							})
							}, 500)
		 }
}		
(function ($) {
	"use strict";
	$(document).ready(function () {
		
		var fixed_loaders = $('.fixed_loaders').length;
		
		if(fixed_loaders>0){
	 
			$(window).scroll(function() {
			  if(false==false){
				
				  var loaderElement = 	 $('.fixed_loaders').first().not('.loaded');
				  var  ids  = loaderElement.attr('id');
				  if(ids==undefined){ return false; };
				  
				  var  url  = loaderElement.attr('data-url');
				  var  class_e  = loaderElement.attr('class');
			      if(class_e!='loading'){
				  if($(window).scrollTop() >= $('.home_section').offset().top + $('.home_section').outerHeight() - window.innerHeight) {
    
					  
						if(loaded_array.indexOf(ids) == -1)
						{
							loaded_array.push(ids);
						}
						else{
							return false; 
						}
						$('#'+ids+'_top').show();
					    loaderElement.addClass('loading');
					    return false; 
					   if(!$('#'+ids).attr('loaded') ) {
						clearTimeout(myVar);
						console.log(ids);
						myVar = setTimeout(function(){	$.get(url,function(data){
							 if(data=='1'){
								 $('#'+ids).remove();
								 $('#'+ids+'_loader').remove();
								 //	window.scrollTo(0, 50); 
								 loadNext();
								 return false;
							 }
							  $('#'+ids+'_loader').remove();
								$('#'+ids).html(data).slideDown({ 
								complete: function(){
								$('#'+ids+'_loader').hide();
								}});
								carosels(ids)
								$('#'+ids).attr('class', 'loaded');
								//$('#'+ids+'_loader').hide();
							})
							}, 500)
						}
						;
					  
				  }
				  }
			  }
			//	if ($(window).scrollTop() + $(window).height() >= $('#'+ids).offset().top) {
			})
			/*
			$.each($('.fixed_loaders'),function(){ 
				
					var ids =   $(this).attr('id');
					var  url =   $(this).attr('data-url');
					if(ids !== undefined){
						console.log('1');
						$(window).scroll(function() {
						 
						//check if your div is visible to user
						// CODE ONLY CHECKS VISIBILITY FROM TOP OF THE PAGE
						if ($(window).scrollTop() + $(window).height() >= $('#'+ids).offset().top) {
							if(!$('#'+ids).attr('loaded') ) {
								 
							$.get(url,function(data){
								 
								$('#'+ids).html(data);
								$('#'+ids).attr('class', 'loaded');
								$('#'+ids+'_loader').hide();
							})
						//not in ajax.success due to multiple sroll events
						 



						}
						}
						});
					}
				
				
				  }) 
				  * */
		}
		 
		



		$(function () {
			function mmenuInit() {
				var wi = $(window).width();
				if (wi <= '1024') {
					$(".mmenu-init").remove();
					$("#navigation").clone().addClass("mmenu-init").insertBefore("#navigation").removeAttr('id').removeClass('style-1 style-2').find('ul, div').removeClass('style-1 style-2 mega-menu mega-menu-content mega-menu-section').removeAttr('id');
					$(".mmenu-init").find("ul").addClass("mm-listview");
					$(".mmenu-init").find(".mobile-styles .mm-listview").unwrap();
					$(".mmenu-init").mmenu({
						"counters": true
					}, {
						offCanvas: {
							pageNodetype: "#base-container"
						}
					});
					var mmenuAPI = $(".mmenu-init").data("mmenu");
					var $icon = $(".hamburger");
					$(".mmenu-trigger").click(function () {
						 
						mmenuAPI.open();
					});
					mmenuAPI.bind("open:finish", function () {						 
						setTimeout(function () {
							$icon.addClass("is-active");
						});
					});
					mmenuAPI.bind("close:finish", function () {
					 
						setTimeout(function () {
							$icon.removeClass("is-active");
						});
					});
				}
				$(".mm-next").addClass("mm-fullsubopen");
			}
			mmenuInit();
			
			$(window).resize(function () {
				mmenuInit();
			});
		});
		$('.user-menu').on('click', function () {
			$(this).toggleClass('active');
		});
		$("#header").not("#header.not-sticky").clone(true).addClass('cloned sticky').insertAfter("#header");
		$("#navigation.style-2").clone(true).addClass('cloned sticky').insertAfter("#navigation.style-2");
		$("#logo .sticky-logo").clone(true).prependTo("#navigation.style-2.cloned ul#responsive");
		var headerOffset = $("#header-container").height() * 2;
		$(window).scroll(function () {
			if ($(window).scrollTop() >= headerOffset) {
				$("#header.cloned").addClass('sticky').removeClass("sticky");
				$("#navigation.style-2.cloned").addClass('sticky').removeClass("sticky");
			} else {
				$("#header.cloned").addClass('sticky').removeClass("sticky");
				$("#navigation.style-2.cloned").addClass('sticky').removeClass("sticky");
			}
		});
		var pxShow = 600;
		var scrollSpeed = 500;
		$(window).scroll(function () {
			if ($(window).scrollTop() >= pxShow) {
				$("#backtotop").addClass('visible');
			} else {
				$("#backtotop").removeClass('visible');
			}
		});
		$('#backtotop a').on('click', function () {
			$('html, body').animate({
				scrollTop: 0
			}, scrollSpeed);
			return false;
		});

		function inlineCSS() {
			$(".main-search-container, section.fullwidth, .listing-slider .item, .address-container, .img-box-background, .image-edge, .edge-bg").each(function () {
				var attrImageBG = $(this).attr('data-background-image');
				var attrColorBG = $(this).attr('data-background-color');
				if (attrImageBG !== undefined) {
					$(this).css('background-image', 'url(' + attrImageBG + ')');
				}
				if (attrColorBG !== undefined) {
					$(this).css('background', '' + attrColorBG + '');
				}
			});
		}
		inlineCSS();

		function parallaxBG() {
			$('.parallax').prepend('<div class="parallax-overlay"></div>');
			$(".parallax").each(function () {
				var attrImage = $(this).attr('data-background');
				var attrColor = $(this).attr('data-color');
				var attrOpacity = $(this).attr('data-color-opacity');
				if (attrImage !== undefined) {
					$(this).css('background-image', 'url(' + attrImage + ')');
				}
				if (attrColor !== undefined) {
					$(this).find(".parallax-overlay").css('background-color', '' + attrColor + '');
				}
				if (attrOpacity !== undefined) {
					$(this).find(".parallax-overlay").css('opacity', '' + attrOpacity + '');
				}
			});
		}
		parallaxBG();
		$('.category-box').each(function () {
			$(this).append('<div class="category-box-background"></div>');
			$(this).children('.category-box-background').css({
				'background-image': 'url(' + $(this).attr('data-background-image') + ')'
			});
		});
		$('.img-box').each(function () {
			$(this).append('<div class="img-box-background"></div>');
			$(this).children('.img-box-background').css({
				'background-image': 'url(' + $(this).attr('data-background-image') + ')'
			});
		});
		if ("ontouchstart" in window) {
			document.documentElement.className = document.documentElement.className + " touch";
		}
		if (!$("html").hasClass("touch")) {
			$(".parallax").css("background-attachment", "fixed");
		}

		function fullscreenFix() {
			var h = $('body').height();
			$(".content-b").each(function (i) {
				if ($(this).innerHeight() > h) {
					$(this).closest(".fullscreen").addClass("overflow");
				}
			});
		}
		$(window).resize(fullscreenFix);
		fullscreenFix();

		function backgroundResize() {
			var windowH = $(window).height();
			$(".parallax").each(function (i) {
				var path = $(this);
				var contW = path.width();
				var contH = path.height();
				var imgW = path.attr("data-img-width");
				var imgH = path.attr("data-img-height");
				var ratio = imgW / imgH;
				var diff = 100;
				diff = diff ? diff : 0;
				var remainingH = 0;
				if (path.hasClass("parallax") && !$("html").hasClass("touch")) {
					remainingH = windowH - contH;
				}
				imgH = contH + remainingH + diff;
				imgW = imgH * ratio;
				if (contW > imgW) {
					imgW = contW;
					imgH = imgW / ratio;
				}
				path.data("resized-imgW", imgW);
				path.data("resized-imgH", imgH);
				path.css("background-size", imgW + "px " + imgH + "px");
			});
		}
		$(window).resize(backgroundResize);
		$(window).focus(backgroundResize);
		backgroundResize();

		function parallaxPosition(e) {
			var heightWindow = $(window).height();
			var topWindow = $(window).scrollTop();
			var bottomWindow = topWindow + heightWindow;
			var currentWindow = (topWindow + bottomWindow) / 2;
			$(".parallax").each(function (i) {
				var path = $(this);
				var height = path.height();
				var top = path.offset().top;
				var bottom = top + height;
				if (bottomWindow > top && topWindow < bottom) {
					var imgH = path.data("resized-imgH");
					var min = 0;
					var max = -imgH + heightWindow;
					var overflowH = height < heightWindow ? imgH - height : imgH - heightWindow;
					top = top - overflowH;
					bottom = bottom + overflowH;
					var value = 0;
					if ($('.parallax').is(".titlebar")) {
						value = min + (max - min) * (currentWindow - top) / (bottom - top) * 2;
					} else {
						value = min + (max - min) * (currentWindow - top) / (bottom - top);
					}
					var orizontalPosition = path.attr("data-oriz-pos");
					orizontalPosition = orizontalPosition ? orizontalPosition : "50%";
					$(this).css("background-position", orizontalPosition + " " + value + "px");
				}
			});
		}
		if (!$("html").hasClass("touch")) {
			$(window).resize(parallaxPosition);
			$(window).scroll(parallaxPosition);
			parallaxPosition();
		}
		if (navigator.userAgent.match(/Trident\/7\./)) {
			$('body').on("mousewheel", function () {
				event.preventDefault();
				var wheelDelta = event.wheelDelta;
				var currentScrollPosition = window.pageYOffset;
				window.scrollTo(0, currentScrollPosition - wheelDelta);
			});
		}
		var config = {
			'.chosen-select': {
				disable_search_threshold: 10,
				width: "100%"
			},
			'.chosen-select-deselect': {
				allow_single_deselect: true,
				width: "100%"
			},
			'.chosen-select-no-single': {
				disable_search_threshold: 100,
				width: "100%"
			},
			'.chosen-select-no-single.no-search': {
				disable_search_threshold: 10,
				width: "100%"
			},
			'.chosen-select-no-results': {
				no_results_text: 'Oops, nothing found!'
			},
			'.chosen-select-width': {
				width: "95%"
			}
		};
		for (var selector in config) {
			if (config.hasOwnProperty(selector)) {
				$(selector).chosen(config[selector]);
			}
		}
		$('.mfp-gallery-container').each(function () {
			$(this).magnificPopup({
				type: 'image',
				delegate: 'a.mfp-gallery',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: false,
				preloader: true,
				removalDelay: 0,
				mainClass: 'mfp-fade',
				gallery: {
					enabled: true,
					tCounter: ''
				}
			});
		});
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
		$('.mfp-image').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			mainClass: 'mfp-fade',
			image: {
				verticalFit: true
			}
		});
		$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		$('.fullwidth-slick-carousel').slick({
			centerMode: true,
			centerPadding: '15%',
			slidesToShow: 3,
			dots: true,
			arrows: false,
			responsive: [{
				breakpoint: 1441,
				settings: {
					centerPadding: '10%',
					slidesToShow: 3
				}
			}, {
				breakpoint: 1025,
				settings: {
					centerPadding: '10px',
					slidesToShow: 2,
				}
			}, {
				breakpoint: 767,
				settings: {
					centerPadding: '10px',
					slidesToShow: 1
				}
			}]
		});
		$('.testimonial-carousel').slick({
			centerMode: true,
			centerPadding: '34%',
			slidesToShow: 1,
			dots: true,
			arrows: false,
			responsive: [{
				breakpoint: 1025,
				settings: {
					centerPadding: '10px',
					slidesToShow: 2,
				}
			}, {
				breakpoint: 767,
				settings: {
					centerPadding: '10px',
					slidesToShow: 1
				}
			}]
		});
		$('.listing-slider').slick({
			centerMode: true,
			centerPadding: '20%',
			slidesToShow: 2,
			responsive: [{
				breakpoint: 1367,
				settings: {
					centerPadding: '15%'
				}
			}, {
				breakpoint: 1025,
				settings: {
					centerPadding: '0'
				}
			}, {
				breakpoint: 767,
				settings: {
					centerPadding: '0',
					slidesToShow: 1
				}
			}]
		});
		if($('.simple-slick-carousel').length!= 0 ){
		$('.simple-slick-carousel').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 2000,
			dots: true,
			arrows: true,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});
		}
		if($('.simple-slick-carousel1').length!= 0 ){
		$('.simple-slick-carousel1').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: true,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});
		}
		if($('.simple-slick-carousel0').length!= 0 ){
		$('.simple-slick-carousel0').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: true,
			arrows: true,
			autoplay: true,
			autoplaySpeed: 2000,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}, {
				breakpoint: 581,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			
			}, {
				breakpoint: 580,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			
			]
		});
		}
		$('.simple-fw-slick-carousel').slick({
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			dots: true,
			arrows: false,
			responsive: [{
				breakpoint: 1610,
				settings: {
					slidesToShow: 4,
				}
			}, {
				breakpoint: 1365,
				settings: {
					slidesToShow: 3,
				}
			}, {
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
				}
			}, {
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
				}
			}]
		});
		$('.logo-slick-carousel').slick({
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 4,
			dots: true,
			arrows: true,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});
		var $tabsNav = $('.tabs-nav'),
		$tabsNavLis = $tabsNav.children('li');
		$tabsNav.each(function () {
			var $this = $(this);
			$this.next().children('.tab-content').stop(true, true).hide().first().show();
			$this.children('li').first().addClass('active').stop(true, true).show();
		});
		$tabsNavLis.on('click', function (e) {
			var $this = $(this);
			$this.siblings().removeClass('active').end().addClass('active');
			$this.parent().next().children('.tab-content').stop(true, true).hide().siblings($this.find('a').attr('href')).fadeIn();
			e.preventDefault();
		});
		var hash = window.location.hash;
		var anchor = $('.tabs-nav a[href="' + hash + '"]');
		if (anchor.length === 0) {
			$(".tabs-nav li:first").addClass("active").show();
			$(".tab-content:first").show();
		} else {
			anchor.parent('li').click();
		}
		var $accor = $('.accordion');
		$accor.each(function () {
			$(this).toggleClass('ui-accordion ui-widget ui-helper-reset');
			$(this).find('h3').addClass('ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all');
			$(this).find('div').addClass('ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom');
			$(this).find("div").hide();
		});
		var $trigger = $accor.find('h3');
		$trigger.on('click', function (e) {
			var location = $(this).parent();
			if ($(this).next().is(':hidden')) {
				var $triggerloc = $('h3', location);
				$triggerloc.removeClass('ui-accordion-header-active ui-state-active ui-corner-top').next().slideUp(300);
				$triggerloc.find('span').removeClass('ui-accordion-icon-active');
				$(this).find('span').addClass('ui-accordion-icon-active');
				$(this).addClass('ui-accordion-header-active ui-state-active ui-corner-top').next().slideDown(300);
			}
			e.preventDefault();
		});
		$(".toggle-container").hide();
		$('.trigger, .trigger.opened').on('click', function (a) {
			$(this).toggleClass('active');
			a.preventDefault();
		});
		$(".trigger").on('click', function () {
			$(this).next(".toggle-container").slideToggle(300);
		});
		$(".trigger.opened").addClass("active").next(".toggle-container").show();
		$(".tooltip.top").tipTip({
			defaultPosition: "top"
		});
		$(".tooltip.bottom").tipTip({
			defaultPosition: "bottom"
		});
		$(".tooltip.left").tipTip({
			defaultPosition: "left"
		});
		$(".tooltip.right").tipTip({
			defaultPosition: "right"
		});
		$('.like-icon, .widget-button, .like-button').on('click', function (e) {
			e.preventDefault();
			$(this).toggleClass('liked');
			$(this).children('.like-icon').toggleClass('liked');
		});
		$('.more-search-options-trigger').on('click', function (e) {
			e.preventDefault();
			$('.more-search-options, .more-search-options-trigger').toggleClass('active');
			$('.more-search-options.relative').animate({
				height: 'toggle',
				opacity: 'toggle'
			}, 300);
		});
		$(window).on('load resize', function () {
			var winWidth = $(window).width();
			var headerHeight = $("#header-container").height();
			$('.fs-inner-container, .fs-inner-container.map-fixed, #dashboard').css('padding-top', headerHeight);
			if (winWidth < 992) {
				$('.fs-inner-container.map-fixed').insertBefore('.fs-inner-container.content');
			} else {
				$('.fs-inner-container.content').insertBefore('.fs-inner-container.map-fixed');
			}
		});
		$(window).on('load resize', function () {
			$('.dashboard-stat-content h4').counterUp({
				delay: 100,
				time: 800
			});
		});
		$('.leave-rating input').change(function () {
			var $radio = $(this);
			$('.leave-rating .selected').removeClass('selected');
			$radio.closest('label').addClass('selected');
		});
		$('.dashboard-nav ul li a').on('click', function () {
			if ($(this).closest('li').has('ul').length) {
				$(this).parent('li').toggleClass('active');
			}
		});
		$(window).on('load resize', function () {
			var wrapperHeight = window.innerHeight;
			var headerHeight = $("#header-container").height();
			var winWidth = $(window).width();
			if (winWidth > 992) {
				$(".dashboard-nav-inner").css('max-height', wrapperHeight - headerHeight);
			} else {
				$(".dashboard-nav-inner").css('max-height', '');
			}
		});
		$(".tip").each(function () {
			var tipContent = $(this).attr('data-tip-content');
			$(this).append('<div class="tip-content">' + tipContent + '</div>');
		});
		$(".verified-badge.with-tip").each(function () {
			var tipContent = $(this).attr('data-tip-content');
			$(this).append('<div class="tip-content">' + tipContent + '</div>');
		});
		$(window).on('load resize', function () {
			var verifiedBadge = $('.verified-badge.with-tip');
			verifiedBadge.find('.tip-content').css({
				'width': verifiedBadge.outerWidth(),
				'max-width': verifiedBadge.outerWidth(),
			});
		});
		$(".add-listing-section").each(function () {
			var switcherSection = $(this);
			var switcherInput = $(this).find('.switch input');
			if (switcherInput.is(':checked')) {
				$(switcherSection).addClass('switcher-on');
			}
			switcherInput.change(function () {
				if (this.checked === true) {
					$(switcherSection).addClass('switcher-on');
				} else {
					$(switcherSection).removeClass('switcher-on');
				}
			});
		});
		$('.dashboard-responsive-nav-trigger').on('click', function (e) {
			e.preventDefault();
			$(this).toggleClass('active');
			var dashboardNavContainer = $('body').find(".dashboard-nav");
			if ($(this).hasClass('active')) {
				$(dashboardNavContainer).addClass('active');
			} else {
				$(dashboardNavContainer).removeClass('active');
			}
		});
		$(window).on('load resize', function () {
			var msgContentHeight = $(".message-content").outerHeight();
			var msgInboxHeight = $(".messages-inbox ul").height();
			if (msgContentHeight > msgInboxHeight) {
				$(".messages-container-inner .messages-inbox ul").css('max-height', msgContentHeight)
			}
		});

		function newMenuItem() {
			var newElem = $('tr.pricing-list-item.pattern').first().clone();
			newElem.find('input').val('');
			newElem.appendTo('table#pricing-list-container');
		}
		if ($("table#pricing-list-container").is('*')) {
			$('.add-pricing-list-item').on('click', function (e) {
				e.preventDefault();
				newMenuItem();
			});
			$(document).on("click", "#pricing-list-container .delete", function (e) {
				e.preventDefault();
				$(this).parent().parent().remove();
			});
			$('.add-pricing-submenu').on('click', function (e) {
				e.preventDefault();
				var newElem = $('' +
					'<tr class="pricing-list-item pricing-submenu">' +
					'<td>' +
					'<div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>' +
					'<div class="fm-input"><input type="text" placeholder="Category Title" /></div>' +
					'<div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div>' +
					'</td>' +
					'</tr>');
				newElem.appendTo('table#pricing-list-container');
			});
			$('table#pricing-list-container tbody').sortable({
				forcePlaceholderSize: true,
				forceHelperSize: false,
				placeholder: 'sortableHelper',
				zIndex: 999990,
				opacity: 0.6,
				tolerance: "pointer",
				start: function (e, ui) {
					ui.placeholder.height(ui.helper.outerHeight());
				}
			});
		}
		var fieldUnit = $('.pricing-price').children('input').attr('data-unit');
		$('.pricing-price').children('input').before('<i class="data-unit">' + fieldUnit + '</i>');
		$("a.close").removeAttr("href").on('click', function () {
			function slideFade(elem) {
				var fadeOut = {
					opacity: 0,
					transition: 'opacity 0.5s'
				};
				elem.css(fadeOut).slideUp();
			}
			slideFade($(this).parent());
		});

		function close_panel_dropdown() {
			$('.panel-dropdown').removeClass("active");
			$('.fs-inner-container.content').removeClass("faded-out");
		}
		$('.panel-dropdown a').on('click', function (e) {
			if ($(this).parent().is(".active")) {
				close_panel_dropdown();
			} else {
				close_panel_dropdown();
				$(this).parent().addClass('active');
				$('.fs-inner-container.content').addClass("faded-out");
			}
			e.preventDefault();
		});
		$('.panel-buttons button').on('click', function (e) {
			$('.panel-dropdown').removeClass('active');
			$('.fs-inner-container.content').removeClass("faded-out");
		});
		var mouse_is_inside = false;
		$('.panel-dropdown').hover(function () {
			mouse_is_inside = true;
		}, function () {
			mouse_is_inside = false;
		});
		$("body").mouseup(function () {
			if (!mouse_is_inside) close_panel_dropdown();
		});
		$('.checkboxes.categories input').on('change', function () {
			if ($(this).hasClass('all')) {
				$(this).parents('.checkboxes').find('input').prop('checked', false);
				$(this).prop('checked', true);
			} else {
				$('.checkboxes input.all').prop('checked', false);
			}
		});
		$('input[type="range"].distance-radius').rangeslider({
			polyfill: false,
			onInit: function () {
				this.output = $('<div class="range-output" />').insertBefore(this.$range).html(this.$element.val());
				var radiustext = $('.distance-radius').attr('data-title');
				$('.range-output').after('<i class="data-radius-title">' + radiustext + '</i>');
			},
			onSlide: function (position, value) {
				this.output.html(value);
			}
		});
		$('.show-more-button').on('click', function (e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$('.show-more').toggleClass('visible');
			if ($('.show-more').is(".visible")) {
				var el = $('.show-more'),
				curHeight = el.height(),
				autoHeight = el.css('height', 'auto').height();
				el.height(curHeight).animate({
					height: autoHeight
				}, 400);
			} else {
				$('.show-more').animate({
					height: '450px'
				}, 400);
			}
		});
		$(window).on('load resize', function () {
			var containerWidth = $(".container").width();
			$('.listing-nav-container.cloned .listing-nav').css('width', containerWidth);
		});
		if (document.getElementById("listing-nav") !== null) {
			$(window).scroll(function () {
				var window_top = $(window).scrollTop();
				var div_top = $('.listing-nav').not('.listing-nav-container.cloned .listing-nav').offset().top + 90;
				if (window_top > div_top) {
					$('.listing-nav-container.cloned').addClass('stick');
				} else {
					$('.listing-nav-container.cloned').removeClass('stick');
				}
			});
		}
		$(".listing-nav-container").clone(true).addClass('cloned').prependTo("body");
		$('.listing-nav a, a.listing-address, .star-rating a').on('click', function (e) {
			e.preventDefault();
			$('html,body').scrollTo(this.hash, this.hash, {
				gap: {
					y: -20
				}
			});
		});
		$(".listing-nav li:first-child a, a.add-review-btn, a[href='#add-review']").on('click', function (e) {
			e.preventDefault();
			$('html,body').scrollTo(this.hash, this.hash, {
				gap: {
					y: -100
				}
			});
		});
		$(window).on('load resize', function () {
			var aChildren = $(".listing-nav li").children();
			var aArray = [];
			for (var i = 0; i < aChildren.length; i++) {
				var aChild = aChildren[i];
				var ahref = $(aChild).attr('href');
				aArray.push(ahref);
			}
			$(window).scroll(function () {
				var windowPos = $(window).scrollTop();
				for (var i = 0; i < aArray.length; i++) {
					var theID = aArray[i];
					var divPos = $(theID).offset().top - 150;
					var divHeight = $(theID).height();
					if (windowPos >= divPos && windowPos < (divPos + divHeight)) {
						$("a[href='" + theID + "']").addClass("active");
					} else {
						$("a[href='" + theID + "']").removeClass("active");
					}
				}
			});
		});
		var radios = document.querySelectorAll('.payment-tab-trigger > input');
		for (var i = 0; i < radios.length; i++) {
			radios[i].addEventListener('change', expandAccordion);
		}

		function expandAccordion(event) {
			var allTabs = document.querySelectorAll('.payment-tab');
			for (var i = 0; i < allTabs.length; i++) {
				allTabs[i].classList.remove('payment-tab-active');
			}
			event.target.parentNode.parentNode.classList.add('payment-tab-active');
		}
		var shake = "No";
		$('#message').hide();
		$('#contact input[type=text], #contact input[type=number], #contact input[type=email], #contact input[type=url], #contact input[type=tel], #contact select, #contact textarea').each(function () {});
		$('#name, #comments, #subject').focusout(function () {
			if (!$(this).val()) {
				$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
			} else {
				$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
			}
			$('#submit').prop('disabled', false).removeClass('disabled');
		});
		$('#email').focusout(function () {
			if (!$(this).val() || !isEmail($(this).val())) {
				$(this).addClass('error').parent().find('mark').removeClass('valid').addClass('error');
			} else {
				$(this).removeClass('error').parent().find('mark').removeClass('error').addClass('valid');
			}
		});
		$('#email').focusin(function () {
			$('#submit').prop('disabled', false).removeClass('disabled');
		});
		$('#submit').on('click', function () {
			$("#contact-message").slideUp(200, function () {
				$('#contact-message').hide();
				$('#name, #subject, #phone, #comments, #website, #email').triggerHandler("focusout");
				if ($('#contact mark.error').size() > 0) {
					if (shake == "Yes") {
						$('#contact').effect('shake', {
							times: 2
						}, 75, function () {
							$('#contact input.error:first, #contact textarea.error:first').focus();
						});
					} else $('#contact input.error:first, #contact textarea.error:first').focus();
					return false;
				}
			});
		});
		$('#contactform').submit(function () {
			if ($('#contact mark.error').size() > 0) {
				if (shake == "Yes") {
					$('#contact').effect('shake', {
						times: 2
					}, 75);
				}
				return false;
			}
			var action = $(this).attr('action');
			$('#contact #submit').after('<img src="images/loader.gif" class="loader" />');
			$('#submit').prop('disabled', true).addClass('disabled');
			$.post(action, $('#contactform').serialize(), function (data) {
				$('#contact-message').html(data);
				$('#contact-message').slideDown();
				$('#contactform img.loader').fadeOut('slow', function () {
					$(this).remove();
				});
				if (data.match('success') !== null) $('#contactform').slideUp('slow');
			});
			return false;
		});

		function isEmail(emailAddress) {
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
		}
	});
})(this.jQuery);
/*!* jquery.scrollto.js 0.0.1 - https://github.com/yckart/jquery.scrollto.js
 * Copyright (c) 2012 Yannick Albert (http://yckart.com)
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php).
 **/
 $.scrollTo = $.fn.scrollTo = function (x, y, options) {
 	if (!(this instanceof $)) return $.fn.scrollTo.apply($('html, body'), arguments);
 	options = $.extend({}, {
 		gap: {
 			x: 0,
 			y: 0
 		},
 		animation: {
 			easing: 'swing',
 			duration: 600,
 			complete: $.noop,
 			step: $.noop
 		}
 	}, options);
 	return this.each(function () {
 		var elem = $(this);
 		elem.stop().animate({
 			scrollLeft: !isNaN(Number(x)) ? x : $(y).offset().left + options.gap.x,
 			scrollTop: !isNaN(Number(y)) ? y : $(y).offset().top + options.gap.y
 		}, options.animation);
 	});
 };

 function numericalRating(ratingElem) {
 	$(ratingElem).each(function () {
 		var dataRating = $(this).attr('data-rating');
 		if (dataRating >= 4.0) {
 			$(this).addClass('high');
 		} else if (dataRating >= 3.0) {
 			$(this).addClass('mid');
 		} else if (dataRating < 3.0) {
 			$(this).addClass('low');
 		}
 	});
 }
 numericalRating('.numerical-rating');

 function starRating(ratingElem) {
 	$(ratingElem).each(function () {
 		var dataRating = $(this).attr('data-rating');

 		function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
 			return ('' +
 				'<span class="' + firstStar + '"></span>' +
 				'<span class="' + secondStar + '"></span>' +
 				'<span class="' + thirdStar + '"></span>' +
 				'<span class="' + fourthStar + '"></span>' +
 				'<span class="' + fifthStar + '"></span>');
 		}
 		var fiveStars = starsOutput('star', 'star', 'star', 'star', 'star');
 		var fourHalfStars = starsOutput('star', 'star', 'star', 'star', 'star half');
 		var fourStars = starsOutput('star', 'star', 'star', 'star', 'star empty');
 		var threeHalfStars = starsOutput('star', 'star', 'star', 'star half', 'star empty');
 		var threeStars = starsOutput('star', 'star', 'star', 'star empty', 'star empty');
 		var twoHalfStars = starsOutput('star', 'star', 'star half', 'star empty', 'star empty');
 		var twoStars = starsOutput('star', 'star', 'star empty', 'star empty', 'star empty');
 		var oneHalfStar = starsOutput('star', 'star half', 'star empty', 'star empty', 'star empty');
 		var oneStar = starsOutput('star', 'star empty', 'star empty', 'star empty', 'star empty');
 		if (dataRating >= 4.75) {
 			$(this).append(fiveStars);
 		} else if (dataRating >= 4.25) {
 			$(this).append(fourHalfStars);
 		} else if (dataRating >= 3.75) {
 			$(this).append(fourStars);
 		} else if (dataRating >= 3.25) {
 			$(this).append(threeHalfStars);
 		} else if (dataRating >= 2.75) {
 			$(this).append(threeStars);
 		} else if (dataRating >= 2.25) {
 			$(this).append(twoHalfStars);
 		} else if (dataRating >= 1.75) {
 			$(this).append(twoStars);
 		} else if (dataRating >= 1.25) {
 			$(this).append(oneHalfStar);
 		} else if (dataRating < 1.25) {
 			$(this).append(oneStar);
 		}
 	});
 }
 starRating('.star-rating');
