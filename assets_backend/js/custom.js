var dompet = function () {
	"use strict"
	/* Search Bar ============ */
	var screenWidth = $(window).width();
	var screenHeight = $(window).height();


	var handleNiceSelect = function () {
		if (jQuery('.default-select').length > 0) {
			jQuery('.default-select').niceSelect();
		}
	}

	var handlePreloader = function () {
		setTimeout(function () {
			jQuery('#preloader').remove();
			$('#main-wrapper').addClass('show');
		}, 800);

	}

	var handleMetisMenu = function () {
		if (jQuery('#menu').length > 0) {
			$("#menu").metisMenu();
		}
		jQuery('.metismenu > .mm-active ').each(function () {
			if (!jQuery(this).children('ul').length > 0) {
				jQuery(this).addClass('active-no-child');
			}
		});
	}

	var handleAllChecked = function () {
		$("#checkAll").on('change', function () {
			$("td input, .email-list .custom-checkbox input").prop('checked', $(this).prop("checked"));
		});
	}

	var handleNavigation = function () {
		$(".nav-control").on('click', function () {

			$('#main-wrapper').toggleClass("menu-toggle");

			$(".hamburger").toggleClass("is-active");
		});
	}

	var handleCurrentActive = function () {
		for (var nk = window.location,
			o = $("ul#menu a").filter(function () {

				return this.href == nk;

			})
				.addClass("mm-active")
				.parent()
				.addClass("mm-active"); ;) {

			if (!o.is("li")) break;

			o = o.parent()
				.addClass("mm-show")
				.parent()
				.addClass("mm-active");
		}
	}

	var handleMiniSidebar = function () {
		$("ul#menu>li").on('click', function () {
			const sidebarStyle = $('body').attr('data-sidebar-style');
			if (sidebarStyle === 'mini') {
				console.log($(this).find('ul'))
				$(this).find('ul').stop()
			}
		})
	}

	var handleMinHeight = function () {
		var win_h = window.outerHeight;
		var win_h = window.outerHeight;
		if (win_h > 0 ? win_h : screen.height) {
			$(".content-body").css("min-height", (win_h + 300) + "px");
		};
	}

	var handleDataAction = function () {
		$('a[data-action="collapse"]').on("click", function (i) {
			i.preventDefault(),
				$(this).closest(".card").find('[data-action="collapse"] i').toggleClass("mdi-arrow-down mdi-arrow-up"),
				$(this).closest(".card").children(".card-body").collapse("toggle");
		});

		$('a[data-action="expand"]').on("click", function (i) {
			i.preventDefault(),
				$(this).closest(".card").find('[data-action="expand"] i').toggleClass("icon-size-actual icon-size-fullscreen"),
				$(this).closest(".card").toggleClass("card-fullscreen");
		});



		$('[data-action="close"]').on("click", function () {
			$(this).closest(".card").removeClass().slideUp("fast");
		});

		$('[data-action="reload"]').on("click", function () {
			var e = $(this);
			e.parents(".card").addClass("card-load"),
				e.parents(".card").append('<div class="card-loader"><i class=" ti-reload rotate-refresh"></div>'),
				setTimeout(function () {
					e.parents(".card").children(".card-loader").remove(),
						e.parents(".card").removeClass("card-load")
				}, 2000)
		});
	}

	var handleHeaderHight = function () {
		const headerHight = $('.header').innerHeight();
		$(window).scroll(function () {
			if ($('body').attr('data-layout') === "horizontal" && $('body').attr('data-header-position') === "static" && $('body').attr('data-sidebar-position') === "fixed")
				$(this.window).scrollTop() >= headerHight ? $('.dlabnav').addClass('fixed') : $('.dlabnav').removeClass('fixed')
		});
	}

	var handleDlabScroll = function () {
		jQuery('.dlab-scroll').each(function () {
			var scroolWidgetId = jQuery(this).attr('id');
			const ps = new PerfectScrollbar('#' + scroolWidgetId, {
				wheelSpeed: 2,
				wheelPropagation: true,
				minScrollbarLength: 20
			});
			ps.isRtl = false;
		})
	}

	var handleMenuTabs = function () {
		if (screenWidth <= 991) {
			jQuery('.menu-tabs .nav-link').on('click', function () {
				if (jQuery(this).hasClass('open')) {
					jQuery(this).removeClass('open');
					jQuery('.fixed-content-box').removeClass('active');
					jQuery('.hamburger').show();
				} else {
					jQuery('.menu-tabs .nav-link').removeClass('open');
					jQuery(this).addClass('open');
					jQuery('.fixed-content-box').addClass('active');
					jQuery('.hamburger').hide();
				}
				//jQuery('.fixed-content-box').toggleClass('active');
			});
			jQuery('.close-fixed-content').on('click', function () {
				jQuery('.fixed-content-box').removeClass('active');
				jQuery('.hamburger').removeClass('is-active');
				jQuery('#main-wrapper').removeClass('menu-toggle');
				jQuery('.hamburger').show();
			});
		}
	}

	var handleChatbox = function () {
		jQuery('.bell-link').on('click', function () {
			jQuery('.chatbox').addClass('active');
		});
		jQuery('.chatbox-close').on('click', function () {
			jQuery('.chatbox').removeClass('active');
		});
	}

	var handlePerfectScrollbar = function () {
		if (jQuery('.dlabnav-scroll').length > 0) {
			//const qs = new PerfectScrollbar('.dlabnav-scroll');
			const qs = new PerfectScrollbar('.dlabnav-scroll');

			qs.isRtl = false;
		}
	}

	var handleBtnNumber = function () {
		$('.btn-number').on('click', function (e) {
			e.preventDefault();

			fieldName = $(this).attr('data-field');
			type = $(this).attr('data-type');
			var input = $("input[name='" + fieldName + "']");
			var currentVal = parseInt(input.val());
			if (!isNaN(currentVal)) {
				if (type == 'minus')
					input.val(currentVal - 1);
				else if (type == 'plus')
					input.val(currentVal + 1);
			} else {
				input.val(0);
			}
		});
	}

	var handleDlabChatUser = function () {
		jQuery('.dlab-chat-user-box .dlab-chat-user').on('click', function () {
			jQuery('.dlab-chat-user-box').addClass('d-none');
			jQuery('.dlab-chat-history-box').removeClass('d-none');
			//$(".chatbox .msg_card_body").height(vHeightArea());
			//$(".chatbox .msg_card_body").css('height',vHeightArea());
		});

		jQuery('.dlab-chat-history-back').on('click', function () {
			jQuery('.dlab-chat-user-box').removeClass('d-none');
			jQuery('.dlab-chat-history-box').addClass('d-none');
		});

		jQuery('.dlab-fullscreen').on('click', function () {
			jQuery('.dlab-fullscreen').toggleClass('active');
		});

		/* var vHeight = function(){ */

		/* } */


	}


	var handleDlabFullScreen = function () {
		jQuery('.dlab-fullscreen').on('click', function (e) {
			if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
				/* Enter fullscreen */
				if (document.exitFullscreen) {
					document.exitFullscreen();
				} else if (document.msExitFullscreen) {
					document.msExitFullscreen(); /* IE/Edge */
				} else if (document.mozCancelFullScreen) {
					document.mozCancelFullScreen(); /* Firefox */
				} else if (document.webkitExitFullscreen) {
					document.webkitExitFullscreen(); /* Chrome, Safari & Opera */
				}
			}
			else { /* exit fullscreen */
				if (document.documentElement.requestFullscreen) {
					document.documentElement.requestFullscreen();
				} else if (document.documentElement.webkitRequestFullscreen) {
					document.documentElement.webkitRequestFullscreen();
				} else if (document.documentElement.mozRequestFullScreen) {
					document.documentElement.mozRequestFullScreen();
				} else if (document.documentElement.msRequestFullscreen) {
					document.documentElement.msRequestFullscreen();
				}
			}
		});
	}

	var handleshowPass = function () {
		jQuery('.show-pass').on('click', function () {
			jQuery(this).toggleClass('active');
			if (jQuery('#dlab-password').attr('type') == 'password') {
				jQuery('#dlab-password').attr('type', 'text');
			} else if (jQuery('#dlab-password').attr('type') == 'text') {
				jQuery('#dlab-password').attr('type', 'password');
			}
		});
	}

	var heartBlast = function () {
		$(".heart").on("click", function () {
			$(this).toggleClass("heart-blast");
		});
	}

	var handleDlabLoadMore = function () {
		$(".dlab-load-more").on('click', function (e) {
			e.preventDefault();	//STOP default action
			$(this).append(' <i class="fa fa-refresh"></i>');

			var dlabLoadMoreUrl = $(this).attr('rel');
			var dlabLoadMoreId = $(this).attr('id');

			$.ajax({
				method: "POST",
				url: dlabLoadMoreUrl,
				dataType: 'html',
				success: function (data) {
					$("#" + dlabLoadMoreId + "Content").append(data);
					$('.dlab-load-more i').remove();
				}
			})
		});
	}

	var handleLightgallery = function () {
		if (jQuery('#lightgallery').length > 0) {
			$('#lightgallery ,#lightgallery-1 ,#lightgallery-2 ').lightGallery({
				loop: true,
				thumbnail: true,
				exThumbImage: 'data-exthumbimage'
			});
		}
	}
	var handleCustomFileInput = function () {
		$(".custom-file-input").on("change", function () {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	}

	var vHeight = function () {
		var ch = $(window).height() - 206;
		$(".chatbox .msg_card_body").css('height', ch);
	}

	var domoPanel = function () {
		if (jQuery('.dlab-demo-content').length > 0) {
			const ps = new PerfectScrollbar('.dlab-demo-content');
			$('.dlab-demo-trigger').on('click', function () {
				$('.dlab-demo-panel').addClass('show');
			});
			$('.dlab-demo-close, .bg-close').on('click', function () {
				$('.dlab-demo-panel').removeClass('show');
			});

			$('.dlab-demo-bx').on('click', function () {
				$('.dlab-demo-bx').removeClass('demo-active');
				$(this).addClass('demo-active');
			});
		}
	}

	var handleDatetimepicker = function () {
		if (jQuery("#datetimepicker1").length > 0) {
			$('#datetimepicker1').datetimepicker({
				inline: true,
			});
		}
	}

	var handleCkEditor = function () {
		if (jQuery("#ckeditor").length > 0) {
			ClassicEditor
				.create(document.querySelector('#ckeditor'), {
					// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
				})
				.then(editor => {
					window.editor = editor;
				})
				.catch(err => {
					console.error(err.stack);
				});
		}
	}

	var handleMenuPosition = function () {

		if (screenWidth > 1024) {
			$(".metismenu  li").unbind().each(function (e) {
				if ($('ul', this).length > 0) {
					var elm = $('ul:first', this).css('display', 'block');

					var off = elm.offset();
					var l = off.left;
					var w = elm.width();
					var elm = $('ul:first', this).removeAttr('style');
					var docH = $("body").height();
					var docW = $("body").width();

					if (jQuery('html').hasClass('rtl')) {
						var isEntirelyVisible = (l + w <= docW);
					} else {
						var isEntirelyVisible = (l > 0) ? true : false;
					}

					if (!isEntirelyVisible) {
						$(this).find('ul:first').addClass('left');
					} else {
						$(this).find('ul:first').removeClass('left');
					}
				}
			});
		}
	}
	var handleThemeMode = function () {

		jQuery('.dz-theme-mode').on('click', function () {
			jQuery(this).toggleClass('active');

			if (jQuery(this).hasClass('active')) {
				jQuery('body').attr('data-theme-version', 'dark');
			} else {
				jQuery('body').attr('data-theme-version', 'light');
			}
		});


	}


	/* Function ============ */
	return {
		init: function () {
			handleMetisMenu();
			handleAllChecked();
			handleNavigation();
			handleCurrentActive();
			handleMiniSidebar();
			handleMinHeight();
			handleDataAction();
			handleHeaderHight();
			//handleDlabScroll();
			handleMenuTabs();
			handleChatbox();
			//handlePerfectScrollbar();
			handleBtnNumber();
			handleDlabChatUser();
			handleDlabFullScreen();
			handleshowPass();
			heartBlast();
			handleDlabLoadMore();
			handleLightgallery();
			handleCustomFileInput();
			vHeight();
			domoPanel();
			handleDatetimepicker();
			handleCkEditor();
			handleThemeMode();
		},


		load: function () {
			handlePreloader();
			handleNiceSelect();
		},

		resize: function () {
			vHeight();

		},

		handleMenuPosition: function () {

			handleMenuPosition();
		},
	}

}();

/* Document.ready Start */
jQuery(document).ready(function () {
	$('[data-bs-toggle="popover"]').popover();
	'use strict';
	dompet.init();

});
/* Document.ready END */

/* Window Load START */
jQuery(window).on('load', function () {
	'use strict';
	dompet.load();
	setTimeout(function () {
		dompet.handleMenuPosition();
	}, 1000);

});
/*  Window Load END */
/* Window Resize START */
jQuery(window).on('resize', function () {
	'use strict';
	dompet.resize();
	setTimeout(function () {
		dompet.handleMenuPosition();
	}, 1000);
});
/*  Window Resize END */
jQuery(document).ready(function ($) {

	ajaxData = {};
	if ($('meta[name=csrf-token-name]').length && $('meta[name=csrf-token-value]').length) {
		var csrfTokenName = $('meta[name=csrf-token-name]').attr('content');
		var csrfTokenValue = $('meta[name=csrf-token-value]').attr('content');
		ajaxData[csrfTokenName] = csrfTokenValue;
	}

	// input/select/textarea fields help text
	$('.has-help-text').popover();
	$(document).on('blur', '.has-help-text', function (e) {
		if ($(this).data('bs.popover')) {
			// this really doesn't want to behave correct unless forced this way!
			$(this).data('bs.popover').destroy();
			$('.popover').remove();
			$(this).popover();
		}
	});

	// buttons with loading state
	$('button.btn-submit').button().on('click', function () {
		$(this).button('loading');
	});

	$('.left-side').on('mouseenter', function () {
		$('.timeinfo').stop().fadeIn();
	}).on('mouseleave', function () {
		$('.timeinfo').stop().fadeOut();
	});
});
// var allowSubmit = true;
// function showAjaxModal(k) {
// 	var myTag = $('head > script[src$="js/elfinder.min.js"],script[src$="js/elfinder.full.js"]:first'),
// 		baseUrl, hide, fi, cnt;
// 	var baseUrl = myTag.attr('src').replace(/js\/[^\/]+$/, '');

// 	if (baseUrl == undefined) { return false; }
// 	dataId = $(k).attr('data-id');

// 	var dataWidth = $(k).attr('data-width');
// 	if (dataWidth !== undefined) {
// 		$('#modal-7').find('.modal-dialog').css('width', dataWidth);
// 	}
// 	else {
// 		$('#modal-7').find('.modal-dialog').css('width', '800px');
// 	}

// 	fieldid = $(k).attr('data-fieldid');
// 	dataRelation = $(k).attr('data-relation');
// 	dataRelation_id = $(k).attr('data-relation_id');
// 	disableEditer = $(k).attr('data-disableediter');
// 	fieldid = $(k).attr('data-fieldid');
// 	lan = ($(k).data('lan') == undefined) ? 'ar' : $(k).data('lan');

// 	$('#text').html($('#' + fieldid).val());

// 	if (dataId == undefined) return false;
// 	$('#modal-7').find('#modelContent').html('loading..');
// 	jQuery('#modal-7').modal('show', { backdrop: 'static' });
// 	var csrfToken = $("#csrf_token").val();

// 	$.ajax({
// 		url: 'backend/index.php/translate/addTerm/id/' + dataId + '/relation/' + dataRelation + '/relationID/' + dataRelation_id + '/disableEditer/' + disableEditer + '/lan/' + lan,
// 		type: 'POST',
// 		data:{
// 			csrf_token: csrfToken
// 		},
// 		success: function (response) {


// 			jQuery('#modal-7 #modelContent').html(response);
// 		}
// 	});
// }
var translatingFieldsObject;
function saveFormFunction_grid_update(form, data, hasError) {

	form.find("button.btn-submit").html("loading");
	if (!hasError) {

		$.ajax({

			"type": "POST",
			"url": form.attr('action'),
			"data": form.serialize(),
			"success": function (data) {

				if (parseInt(data) >= parseInt(1)) {


					if (translatingFieldsObject != undefined) {
						var existingValues = translatingFieldsObject.val();
						translatingFieldsObject.val(existingValues + '|' + data);
					}
					form.find(".messageDiv").html('<div class="bg-success padding5px marginbottom5px" style=" margin:5px 16px;padding:8px 5px ">Successfully Translated </div>').show();
					setTimeout(function () { $('#modal-7').modal('hide'); }, 1000);

				}
				else {


					form.find("button.btn-submit").html("Save Changes");
					form.find(".messageDiv").html('<div class="bg-danger padding5px marginbottom5px"><input type="text" style="opacity:0; ;height: 0px;width:0px;" value="#" id="focuser">' + data + '</div>').show().focus();
					$("#focuser").focus();
					$(window).scrollTop(0);
				}
			},

		});
	}
	else {
		form.find("button.btn-submit").button("reset");
		alert('error');
	}
}
function checkAllFunction(k, e) {
	e.stopPropagation();
	e.preventDefault()
	if ($(k).is(':checked')) {
		$('.chk').prop('checked', true);
	}
	else {
		$('.chk').prop('checked', false)
	}
}
function applyTanslation() {
	$('tbody tr').each(function () {
		var string_input = $(this).find("td:first").find('span').text();

		if ($(this).find('.chk').is(':checked')) {

			$(this).find('.inps').val(string_input);

		}

	})

}
