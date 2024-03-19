jQuery(document).ready(function (e) {
	jQuery(".fancybox a").on('click', function () {
		jQuery.fancybox.open({
			src: '#founders-message',
			type: 'inline',
			opts: {
				afterShow: function (instance, current) {
					console.info('done!');
				}
			}
		});
	});
	jQuery('.multipleSelect').multipleSelect({});
	jQuery('.ms-choice .placeholder').html('Facilities');
	var maxHeight = -1;
	jQuery('.property-widget .content').each(function () {
		if (jQuery(this).height() > maxHeight) {
			maxHeight = jQuery(this).height();
		}
	});
	jQuery('.property-widget .content').height(maxHeight);
	busy = false;
	jQuery(".subpage-banner").click(function () {
		if (jQuery(".nice-select").hasClass("open")) {
			jQuery(".subpage-banner").css("z-index", "13");
		}
	});
	if (document.documentElement.clientWidth > 768) {
		var fadeDelayAttr;
		var fadeDelay;
		jQuery(".animate-on-load").each(function () {
			if (jQuery(this).data("delay")) {
				fadeDelayAttr = jQuery(this).data("delay");
				fadeDelay = fadeDelayAttr;
			} else {
				fadeDelay = 0;
			}
			jQuery(this).delay(fadeDelay).queue(function () {
				jQuery(this).addClass('animated').clearQueue();
			});
		});
		jQuery('.animate-it').appear();
		jQuery(document.body).on('appear', '.animate-it', function (e, jQueryaffected) {
			var fadeDelayAttr;
			var fadeDelay;
			jQuery(this).each(function () {
				if (jQuery(this).data("delay")) {
					fadeDelayAttr = jQuery(this).data("delay")
					fadeDelay = fadeDelayAttr;
				} else {
					fadeDelay = 0;
				}
				jQuery(this).delay(fadeDelay).queue(function () {
					jQuery(this).addClass('animated').clearQueue();
				});
			})
		});
		jQuery('select:not(.multipleSelect)').niceSelect();
	}
	jQuery('.news-carousel').breakingNews();
	jQuery('.parallax-window').parallax();
	if (document.documentElement.clientWidth > 1024) {
		jQuery(".nav-btn").on("click", function () {
			jQuery("body").toggleClass("noscroll");
			jQuery(".fade-out").fadeToggle(200);
			setTimeout(function () {
				jQuery("body").toggleClass("show-main-nav");
			}, 50);
		});
	} else {
		jQuery(".nav-btn").on("click", function () {
			jQuery(".fade-out").fadeToggle(200);
			setTimeout(function () {
				jQuery("body").toggleClass("show-mobile-nav");
				setTimeout(function () {
					jQuery("body").toggleClass("mobile-nav-bg");
				}, 400);
			}, 50);
		});
	}
	jQuery(".show-ourdivisions").on("click", function () {
		jQuery("body").addClass("show-ourdivisions");
	});
	jQuery(".go-home").on("click", function () {
		jQuery("body").removeClass("show-ourdivisions");
	});
	jQuery(".site-footer .mobile-toggle").on("click", function () {
		jQuery(this).parent().find("ul").slideToggle();
		jQuery(this).toggleClass("active");
	});
	jQuery(".property-search-btn").on("click", function () {
		jQuery("body").toggleClass('search-shown');
		jQuery("body").toggleClass("noscroll");
	});
	jQuery(".detail-right .specs .view-more").on("click", function () {
		jQuery(this).parent(".hidden").toggleClass("active");
		jQuery(this).parent().find(".each").slideToggle(200);
		jQuery(this).html("View less");
	});
	jQuery('.gallery-mobile-carousel').owlCarousel({
		margin: 0,
		loop: false,
		dots: false,
		items: 1,
		nav: true,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
	});
	jQuery('.featured-properties-carousel').owlCarousel({
		margin: 14,
		loop: false,
		dots: true,
		responsive: {
			0: {
				items: 1
			},
			601: {
				items: 2
			},
			1025: {
				items: 3
			},
			1100: {
				items: 3
			}
		}
	});
	jQuery('.sectors-carousel').owlCarousel({
		margin: 8,
		loop: false,
		dots: false,
		nav: true,
		responsive: {
			0: {
				items: 2
			},
			601: {
				items: 3
			},
			900: {
				items: 4
			},
			1100: {
				items: 5
			}
		}
	});
	jQuery('.featured-projects-carousel').owlCarousel({
		margin: 8,
		loop: false,
		dots: true,
		responsive: {
			0: {
				items: 1
			},
			601: {
				items: 2
			},
			1100: {
				items: 3
			}
		}
	});
	jQuery(".footer h3").on("click", function () {
		jQuery(this).parent().find("ul").slideToggle();
		jQuery(this).toggleClass("active");
	});
	jQuery('.scroll').each(function () {
		var $this = jQuery(this),
			target = this.hash;
		jQuery(this).click(function (e) {
			e.preventDefault();
			if ($this.length > 0) {
				if ($this.attr('href') == '#') {} else {
					jQuery('html, body').animate({
						scrollTop: (jQuery(target).offset().top) - -1
					}, 1000);
				}
			}
		});
	});
});
jQuery('.book_viewing').on('click', function () {
	jQuery('#PropertyLink').val(jQuery('#property_link').val());
	jQuery('#PropertyName').val(jQuery('#property_name').val());
	jQuery('#PropertyImage').val(jQuery('#property_image').val());
	jQuery('#PropertyId').val(jQuery('#property_id').val());
	jQuery('#PropertyPrice').val(jQuery('#property_price').val());
	jQuery('#reference_num').val(jQuery('#eni_system_reference').val());
})

jQuery('.project_view_book').on('click', function () {
	jQuery('#ProjectLink').val(jQuery('#project_link').val());
	jQuery('#ProjectName').val(jQuery('#project_name').val());
	jQuery('#ProjectImage').val(jQuery('#project_image').val());
	jQuery('#ProjectId').val(jQuery('#project_id').val());
	jQuery('#ProjectPrice').val(jQuery('#project_price').val());
})
jQuery('.count_plus').on('click', function () {
	var val = jQuery('.num_of_bedroom').val();
	val++;
	jQuery('.num_of_bedroom').val(val);
})
jQuery('.count_minus').on('click', function () {
	var val = jQuery('.num_of_bedroom').val();
	val--;
	if (val > 0)
		jQuery('.num_of_bedroom').val(val);
});
jQuery('.Message').live('change', function () {
	var name_value = jQuery('input[name=Name]').val();
	var your_email_value = jQuery('input[name=Email]').val();
	var your_number_value = jQuery('input[name=Phone]').val();
	var ref_number = jQuery('#ProjectId').val();
	var souceofcontact = jQuery('#Source').val();
	var dateforviewing = jQuery('#birthday').val();
	var PreferredTimeforcall = jQuery('#TimeofCall').val();
	var Messages = jQuery('#Message').val();
	var reference_num = jQuery('#reference_num').val();
	jQuery.ajax({
		type: "post",
		dataType: "json",
		url: crm_property_booking.ajax_url,
		data: {
			action: 'tft_handle_ajax_request',
			'name_value': name_value,
			'your_email_value': your_email_value,
			'your_number_value': your_number_value,
			'reference_id': reference_num,
			'souceofcontact': souceofcontact,
			'dateforviewing': dateforviewing,
			'PreferredTimeforcall': PreferredTimeforcall,
			'Messages': Messages,
		},
		success: function (msg) {
			console.log(msg);
		}
	});
});
