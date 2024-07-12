// Hero Counter
    var counters = $(".rg-counter");
    var countersQuantity = counters.length;
    var counter = [];

    for (i = 0; i < countersQuantity; i++) {
        counter[i] = parseInt(counters[i].innerHTML);
    }
    
    var count = function (start, value, id) {
        var localStart = start;
        setInterval(function () {
            if (localStart < value) {
                localStart++;
                counters[id].innerHTML = localStart + '+';
            }
        }, 5);
    }

    for (j = 0; j < countersQuantity; j++) {
        count(0, counter[j], j);
    }
    
    // Services Counter
    var serviceCounters = $(".rg-service-counter");
    var serviceCountersQuantity = serviceCounters.length;
    var serviceCounter = [];

    for (k = 0; k < serviceCountersQuantity; k++) {
        serviceCounter[k] = parseInt(serviceCounters[k].innerHTML);
    }

    var count = function (start, value, id) {
        var localStart = start;
        setInterval(function () {
            if (localStart < value) {
                localStart++;
                serviceCounters[id].innerHTML = localStart;
            }
        }, 50);
    }

    for (l = 0; l < serviceCountersQuantity; l++) {
        count(0, serviceCounter[l], l);
    }

$(document).ready(function () {
    
    $(".search-select-2").select2();
    
    $('#rg-project-dropdown').select2({
        placeholder: "Select project",
        dropdownParent: $('.rg-project-dropdown'),
    });
    
    if (!Cookies.get('modalShown')) {
      showModal();
    }
    $('#popupmodal').on('hidden.bs.modal', function (e) {
        
        Cookies.set('modalShown', 'true', { expires: 7 }); 
    })
    document.getElementById('closepopup').addEventListener('click', function() {
      $('#popupmodal').modal('hide')
    });  
    if (!Cookies.get('modalShownBlog') && window.location.pathname === '/blog') {
      showModalBlog();
    }
    $('#exampleModalBlogMessage').on('hidden.bs.modal', function (e) {
        
        Cookies.set('modalShownBlog', 'true', { expires: 7 }); 
    })
    document.getElementById('closepopup').addEventListener('click', function() {
      $('#exampleModalBlogMessage').modal('hide')
    });  
    

    // const ContactPopup_phone_false = document.querySelector("#ContactPopup_phone_false");
    // window.intlTelInput(ContactPopup_phone_false, {
    //     utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
    // });
    // Services Slick Slider
   $('.rg-services-slider').slick({
        dots: true,
        arrows: false,
        infinite: false,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 2,
        autoplay: false,
        autoplaySpeed: 2000,
        // adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });

    // Featured Slick Slider
    $('.rg-featured-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 2,
        autoplay: false,
        autoplaySpeed: 2000,
        // adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 890,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });
    // Our Clients Slick Slider
    $('.rg-partners-list').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 500,
        slidesToShow: 6,
        slidesToScroll: 6,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
        ]
    });
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('.rg-featured-slider').slick('setPosition');
    });

    // Members Slick Slider
    $('.rg-members-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: false,
        autoplaySpeed: 2000,
        // adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });

    // Testimonials Slick Slider
    $('.rg-testimonials-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        // slidesToScroll: 3,
        autoplay: false,
        autoplaySpeed: 2000,
        centerMode: true,
        centerPadding: '60px',
        // adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '20px',
                    adaptiveHeight: true,
                }
            },
        ]
    });

    //subscribe_modal
    $('#subscribe_modal').click(function(){
        $('#exampleModalBlogMessage').modal('show');
    });
    
    $('#rg_min_price').on('change', function() {
    var selectedMinPrice = parseInt($(this).val());

    // Enable all max price options first
    $('#maxPrice option').prop('disabled', false);

    // Disable max price options that are lower than the selected min price
    $('#rg_max_price option').each(function() {
      var maxPrice = parseInt($(this).val());
      if (maxPrice < selectedMinPrice) {
        $(this).prop('disabled', true);
      }
    });

    // Refresh Select2 to reflect the changes
    $('#rg_max_price').select2('destroy').select2();
  });
   $('#rg_max_price').on('change', function() {
    var selectedMinPrice = parseInt($(this).val());

    // Enable all max price options first
    $('#rg_min_price option').prop('disabled', false);

    // Disable max price options that are lower than the selected min price
    $('#rg_min_price option').each(function() {
      var maxPrice = parseInt($(this).val());
      if (maxPrice > selectedMinPrice) {
        $(this).prop('disabled', true);
      }
    });

    // Refresh Select2 to reflect the changes
    $('#rg_min_price').select2('destroy').select2();
  });
  $('#mobile-minsqft').on('change', function() {
    var selectedMinPrice = parseInt($(this).val());

    // Enable all max price options first
    $('#mobile-maxsqft option').prop('disabled', false);

    // Disable max price options that are lower than the selected min price
    $('#mobile-maxsqft option').each(function() {
      var maxPrice = parseInt($(this).val());
      if (maxPrice < selectedMinPrice) {
        $(this).prop('disabled', true);
      }
    });

    // Refresh Select2 to reflect the changes
    $('#mobile-maxsqft').select2('destroy').select2({placeholder: "Max sqft"});
  });
  $('#mobile-maxsqft').on('change', function() {
    var selectedMaxsqft = parseInt($(this).val());

    // Enable all max price options first
    $('#mobile-minsqft option').prop('disabled', false);

    // Disable max price options that are lower than the selected min price
    $('#mobile-minsqft option').each(function() {
      var minsqft = parseInt($(this).val());
      if (minsqft > selectedMaxsqft) {
        $(this).prop('disabled', true);
      }
    });

    // Refresh Select2 to reflect the changes
    $('#mobile-minsqft').select2('destroy').select2({placeholder: "MIn sqft"});
  });
    $('#rg_where').on('select2:select', function (e) {
        const selectedOption = e.params.data;
        
        if (selectedOption.element.parentElement.tagName === 'OPTGROUP') {
                // Get the parent group label
                
            //const parentLabel = selectedOption.element.parentElement.label;
            const parentLabel = (selectedOption.element.parentElement.label).toLowerCase();
            const parentopt = parentLabel.replace(/ /g, "-");

            // Find the parent option and unselect it
            const parentOption = $('#rg_where option[value="' + parentopt + '"]').prop('selected', false);
           
            //parentOption.prop('selected', false);
            $('#rg_where').trigger('change');
        }else{
            const parentLabel = selectedOption.element.parentElement.label;
             console.log(parentLabel)
            $('#rg_where optgroup[label="' + parentLabel + '"] option').prop('selected', false);
            $('#rg_where').trigger('change');
        }
    });
    
    const backgroundImageElement = $('#backgroundImage');
    images = [];
    console.log(banners);
    for (var i = 0; i < banners.length; i++) {
        
        images.push(banners[i].image);
    }
    //console.log(images);
    //const images = ['https://www.dev.rgestate.com/theme/assets/images/hero.jpg', 'https://www.dev.rgestate.com/theme/assets/images/hero-01.jpg', 'https://www.dev.rgestate.com/theme/assets/images/hero-02.jpg']; // Add your image URLs here
    let currentImageIndex = 0;

    function changeBackgroundImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        const imageUrl = "https://www.rgestate.com/uploads/files/"+images[currentImageIndex];
        backgroundImageElement.css('background-image', `url(${imageUrl})`);
    }

    function startImageChangeTimer() {
        changeBackgroundImage();
        setInterval(changeBackgroundImage, 5000); // Change image every 5 seconds
    }

    startImageChangeTimer();
    $(".rg-hero-form").show();
});


function createSearchUrl(event,formObject){

    event.preventDefault();
    var params = '?';
    var searchUrl = '/';
    var stateSelected = [];
    
    var propertyType = $('#property_purpose').val();

    if( propertyType === '' ){
        
        propertyType = 'sale';
    }

    
    var search_type = $('#search_type').val();
     var rg_type ='';
    if(search_type ==='residential'){
        rg_type = $('#rg_type').val();
    }else{
        rg_type = $('#rg_type2').val();
    }
    stateSelected = $('#rg_where').val();
    var bathroom = $('#rg_bath').val();
    var bedroom = $('#rg_bed').val();
    var rg_min_price= $('#rg_min_price').val();
    var rg_max_price = $('#rg_max_price').val();
    var mobile_minsqft = $('#mobile-minsqft').val();
    var mobile_maxsqft = $('#mobile-maxsqft').val();
    
    
    searchUrl += 'property-for-'+propertyType;
    searchUrl += '/'+search_type;
    
    if(rg_type !== ''){

    	searchUrl+= "/"+rg_type;
    }
    if(bathroom !== ''){

    	params+= '&bathrooms='+bathrooms;
    }
    if(bedroom !== ''){

    	params+= '&bedroom='+bedroom;
    }
    
    if(rg_max_price !== ''){

    	params+= '&maxPrice='+rg_max_price;
    }
    if(mobile_minsqft !== ''){

    	params+= '&minSqft='+mobile_minsqft;
    }
    if(mobile_maxsqft !== ''){

    	params+= '&maxSqft='+mobile_maxsqft;
    }
    var firstElement;
    console.log(stateSelected);
    if(stateSelected.length > 0){
        //console.log(stateSelected)
        var statesArray = stateSelected;
        firstElement = statesArray[0]
        var restElements = statesArray.slice(1);
        var restString = restElements.join(':');
         params+= '&area='+restString;
         searchUrl += '/'+firstElement+""+params;

    }
   

    location.href = searchUrl;

}
function OpenFavouriteNew(e) {
    console.log(add_to_fav);
    var $element = $(e);
    var isActive = $element.hasClass("active");
    var fun = $element.attr("data-function");
    var id = $element.attr("data-id");
    var after = $element.attr("data-after");

    if (isActive) {
        $element.removeClass("active");
    } else {
        $element.addClass("active");
    }

    $.get(add_to_fav, { id: id, fun: fun, after: after }, function(response) {
        var parsedResponse = JSON.parse(response);

        if (parsedResponse.status === "1") {
            if (parsedResponse.after === "saved_fave") {
                var counter = $("#dataCounter");
                var favButton = $("#fav_button_" + parsedResponse.id);

                if (parsedResponse.class !== "") {
                    var currentCounter = parseInt(counter.html()) || 0;
                    counter.html(currentCounter + 1);
                } else {
                    var currentCounter = parseInt(counter.html()) || 0;
                    counter.html(currentCounter - 1);
                }
            } else if (parsedResponse.after === "saved_search") {
                var urlButton = $("#fav_button_url");

                if (parsedResponse.class !== "") {
                    urlButton.addClass("active");
                    urlButton.html("Remove Search");
                } else {
                    urlButton.html("Save Search");
                }

                successAlert("Success!", parsedResponse.message);
            }
        } else {
            errorAlert("Error!", parsedResponse.message);
        }
    });
}
function checkScrollFav() {
    currentPageFav++, currentPageFav > 2 && (offsetFav = (currentPageFav - 2) * limitFav), jQuery.ajax(slugFav + "?offset=" + offsetFav + "&limit=" + limitFav + "&is_form=1", {
        data: {
            formData: ""
        },
        asynchronous: !0,
        evalScripts: !0,
        method: "get",
        beforeSend: function() {
            scrollFav = !1, loadingDivFav.html(loadingHtmlFav)
        },
        success: function(e, t, i) {
            loadingDivFav.html(""), "1" == e ? ("2" == currentPageFav && $("#emptyResults").removeClass("d-none"), stopPaginationFav = !1, $("#ldmore").html("")) : (e = JSON.parse(e), $("#shortlist_items").append(e.dataHtml), $("#emptyResults").addClass("d-none"), scrollFav = !0, "1" == e.future && $("#ldmore").html(loadMoreHtmlFav))
        }
    })
}
var offcanvasRight = document.getElementById('offcanvasRight')
offcanvasRight.addEventListener('show.bs.offcanvas', function () {
  $("#emptyResults").addClass("d-none"), offsetFav = 0, currentPageFav = 1, stopPaginationFav = !0, scrollFav = !1, $("#shortlist_items").html(""), checkScrollFav()
})
function submitids(k){
    var propId = $(k).parent().find('#property_id');    
    var e=propId.val();  
    if(e==''){ 
        propId.focus();
    return false;
        
    }  
    $(".val-loa").addClass("lding"),
    $.get(get_property,{val:e},function(e){
        "0"==(e=JSON.parse(e)).status&&($(".val-loa").removeClass("lding"),$(".val-error").addClass("lding"),propId.val("")),"1"==e.status&&($(".val-loa").html("Please Wait.."),location.href=e.url)})
    
} 
function enterKeyPressed(event) {
    if (event.keyCode == 13) {  $('#submitids').click();   return true;}   
    
}
document.addEventListener("DOMContentLoaded", function() {
      var rg_search_form = document.getElementById("rg-search-form");
      var commercial = document.getElementById("commercial");
      var residential = document.getElementById("residential");
      var minsqft = document.getElementById("minsqft-container");
      var maxsqft = document.getElementById("maxsqft-container");
      
      var beds = document.getElementById("beds-container");
      var bathrooms = document.getElementById("bathrooms-container");  
      var search_type = document.getElementById("search_type");
      var comType = document.getElementById("com-type");
      var redType = document.getElementById("red-type");
  commercial.addEventListener("click", function() {
      
      search_type.value = "commercial";
    if (!commercial.classList.contains("active")) {
      comType.classList.remove("d-none");
      redType.classList.add("d-none");  
      beds.classList.add("d-none");
      bathrooms.classList.add("d-none");
      minsqft.classList.remove("d-none");
      maxsqft.classList.remove("d-none");
      commercial.classList.add("active");
      residential.classList.remove("active");
    }
  });

  residential.addEventListener("click", function() {
        search_type.value = "residential";
    if (!residential.classList.contains("active")) {
        
      redType.classList.remove("d-none");
      comType.classList.add("d-none");
      beds.classList.remove("d-none");
      bathrooms.classList.remove("d-none");
      minsqft.classList.add("d-none");
      maxsqft.classList.add("d-none");
      commercial.classList.remove("active");
      residential.classList.add("active");
    }
  });
});

function removethisShortlist(k) {
    var id_delete = $(k).attr('data-id');
    if (id_delete != undefined) {
        $.get(deleteFav, {
            id: id_delete
        }, function(data) {
            $(k).closest('.lst-prop').remove();
            var totalf = $('#shortlist_items').find('.lst-prop').length;
            if (totalf == '0') {
                $('#emptyResults').removeClass('hide');
            }
            var current = parseInt($('body').find('#dataCounter').html());

            if (!isNaN(current)) {
                $('.dataCounter-fav').html(current - 1);
            }
        })
    }

}
function OpenCallNewlatest(t) {
    if (void 0 !== $(t).attr("data-phone")) return showPhoneNumber(t), callstatistcsupdate(t), !1
}
var contentPhone = "";

function showPhoneNumber(t) {
    var e = $(t).attr("data-phone"),
        a = $(t).attr("data-agent"),
        n = $(t).attr("data-ref"),
        s = contentPhone.replace("[PHONENUMBER]", e);
    s = (s = (s = s.replace("[PHONENUMBER]", e)).replace("[AGENTNAME]", a)).replace("[REFERENCENUMBER]", n), 
     $("#contactUsModal").modal("show")
     $("#phone-modal").html(s)
    $("#contactUsLabel").html(Contact_title)
}

function callstatistcsupdate(t) {
    var e = $(t).attr("data-prop");
    $.get(call_statistics, {
        reactid: e
    }, function(t) {})
}
$(function() {
    contentPhone = '<ul class=""><li class="d-flex align-items-center justify-content-between border-bottom pb-4"><span class="rg-fs-14 rg-text-gray-500">'+Phone_title+'</span><a href="tel:[PHONENUMBER]" class="rg-text-blue rg-fs-20">[PHONENUMBER]</a></li><li class="d-flex align-items-center justify-content-between border-bottom py-4"><span class="rg-fs-14 rg-text-gray-500">'+Agent_title+'</span><span class="rg-fs-14 rg-text-dark">[AGENTNAME]</span></li>'+ CALLING_title
});
function OpenFormClickNew(e) {
    var t = $(e).attr("data-reactid");
    if (void 0 === t) return !1;
    $("#emailModal").modal("show"), 
    $("#email-model").html("<div style='position:relative;min-height: 200px;'><div class='loading '><div class='spinner rmsdf'><div class='bounce1'></div>  <div class='bounce2'></div>  <div class='bounce3'></div></div><div class='clearfix'></div></div></div>"), 
    $.get(propertyUrl + "/id/" + t, function(e) {
        $("#email-model").html(e)
    })
}
function showModal() {
    
    $('#popupmodal').modal("show")
}
function showModalBlog() {
    
    $('#exampleModalBlogMessage').modal("show")
}

!function(t){var i=function(t){var i,a=[];if(t.length)return"span"===t[0].tagName.toLowerCase()?(t.find(":checked").each(function(){a.push(this.value)}),a.join(",")):"checkbox"===(i=t.attr("type"))||"radio"===i?t.filter(":checked").val():t.val()};t.fn.yiiactiveform=function(a){return this.each(function(){var e=t.extend({},t.fn.yiiactiveform.defaults,a||{}),s=t(this);void 0===e.validationUrl&&(e.validationUrl=s.attr("action")),t.each(e.attributes,function(a){this.value=i(s.find("#"+this.inputID)),e.attributes[a]=t.extend({},{validationDelay:e.validationDelay,validateOnChange:e.validateOnChange,validateOnType:e.validateOnType,hideErrorMessage:e.hideErrorMessage,inputContainer:e.inputContainer,errorCssClass:e.errorCssClass,successCssClass:e.successCssClass,beforeValidateAttribute:e.beforeValidateAttribute,afterValidateAttribute:e.afterValidateAttribute,validatingCssClass:e.validatingCssClass},this)}),s.data("settings",e),e.submitting=!1;var n=function(a,n){n&&(a.status=2),t.each(e.attributes,function(){this.value!==i(s.find("#"+this.inputID))&&(this.status=2,n=!0)}),n&&(void 0!==e.timer&&clearTimeout(e.timer),e.timer=setTimeout(function(){e.submitting||s.is(":hidden")||(void 0===a.beforeValidateAttribute||a.beforeValidateAttribute(s,a))&&(t.each(e.attributes,function(){2===this.status&&(this.status=3,t.fn.yiiactiveform.getInputContainer(this,s).addClass(this.validatingCssClass))}),t.fn.yiiactiveform.validate(s,function(i){var n=!1;t.each(e.attributes,function(){2!==this.status&&3!==this.status||(n=t.fn.yiiactiveform.updateInput(this,i,s)||n)}),void 0!==a.afterValidateAttribute&&a.afterValidateAttribute(s,a,i,n)}))},a.validationDelay))};if(t.each(e.attributes,function(a,e){this.validateOnChange&&s.find("#"+this.inputID).change(function(){n(e,!1)}).blur(function(){2!==e.status&&3!==e.status&&n(e,!e.status)}),this.validateOnType&&s.find("#"+this.inputID).keyup(function(){e.value!==i(t(this))&&n(e,!1)})}),e.validateOnSubmit){s.on("mouseup keyup",":submit",function(){s.data("submitObject",t(this))});var r=!1;s.submit(function(){return r?(r=!1,!0):(void 0!==e.timer&&clearTimeout(e.timer),e.submitting=!0,void 0===e.beforeValidate||e.beforeValidate(s)?t.fn.yiiactiveform.validate(s,function(i){var a=!1;if(t.each(e.attributes,function(){a=t.fn.yiiactiveform.updateInput(this,i,s)||a}),t.fn.yiiactiveform.updateSummary(s,i),void 0!==e.afterValidate&&!e.afterValidate(s,i,a)||a)e.submitting=!1;else{r=!0;var n=s.data("submitObject")||s.find(":submit:first");n.length?n.click():s.submit()}}):e.submitting=!1,!1)})}s.bind("reset",function(){setTimeout(function(){t.each(e.attributes,function(){this.status=0;var a=s.find("#"+this.errorID);t.fn.yiiactiveform.getInputContainer(this,s).removeClass(this.validatingCssClass+" "+this.errorCssClass+" "+this.successCssClass),a.html("").hide(),this.value=i(s.find("#"+this.inputID))}),s.find("label, :input").each(function(){t(this).removeClass(e.errorCss)}),t("#"+e.summaryID).hide().find("ul").html(""),void 0===e.focus||window.location.hash||s.find(e.focus).focus()},1)}),void 0===e.focus||window.location.hash||s.find(e.focus).focus()})},t.fn.yiiactiveform.getInputContainer=function(t,i){return void 0===t.inputContainer?i.find("#"+t.inputID).closest("div"):i.find(t.inputContainer).filter(':has("#'+t.inputID+'")')},t.fn.yiiactiveform.updateInput=function(a,e,s){a.status=1;var n,r,u=!1,o=s.find("#"+a.inputID),d=s.data("settings").errorCss;return o.length&&(u=null!==e&&t.isArray(e[a.id])&&e[a.id].length>0,n=s.find("#"+a.errorID),(r=t.fn.yiiactiveform.getInputContainer(a,s)).removeClass(a.validatingCssClass+" "+a.errorCssClass+" "+a.successCssClass),r.find("label, :input").each(function(){t(this).removeClass(d)}),u?(n.html(e[a.id][0]),r.addClass(a.errorCssClass)):(a.enableAjaxValidation||a.clientValidation)&&r.addClass(a.successCssClass),a.hideErrorMessage||n.toggle(u),a.value=i(o)),u},t.fn.yiiactiveform.updateSummary=function(i,a){var e=t(i).data("settings"),s="";if(void 0!==e.summaryID){if(a){var n=[];for(var r in e.attributes)e.attributes[r].summary&&n.push(e.attributes[r].id);t.each(e.attributes,function(){-1!==t.inArray(this.id,n)&&t.isArray(a[this.id])&&t.each(a[this.id],function(t,i){s=s+"<li>"+i+"</li>"})})}t("#"+e.summaryID).toggle(""!==s).find("ul").html(s)}},t.fn.yiiactiveform.validate=function(a,e,s){var n=t(a),r=n.data("settings"),u=!1,o={};if(t.each(r.attributes,function(){var t,a=[];void 0===this.clientValidation||!r.submitting&&2!==this.status&&3!==this.status||(t=i(n.find("#"+this.inputID)),this.clientValidation(t,a,this),a.length&&(o[this.id]=a)),!this.enableAjaxValidation||a.length||!r.submitting&&2!==this.status&&3!==this.status||(u=!0)}),!u||r.submitting&&!t.isEmptyObject(o))r.submitting?setTimeout(function(){e(o)},200):e(o);else{var d=n.data("submitObject"),l="&"+r.ajaxVar+"="+n.attr("id");d&&d.length&&(l+="&"+d.attr("name")+"="+d.attr("value")),t.ajax({url:r.validationUrl,type:n.attr("method"),data:n.serialize()+l,dataType:"json",success:function(i){null!==i&&"object"==typeof i?(t.each(r.attributes,function(){this.enableAjaxValidation||delete i[this.id]}),e(t.extend({},o,i))):e(o)},error:function(){void 0!==s&&s()}})}},t.fn.yiiactiveform.getSettings=function(i){return t(i).data("settings")},t.fn.yiiactiveform.defaults={ajaxVar:"ajax",validationUrl:void 0,validationDelay:200,validateOnSubmit:!1,validateOnChange:!0,validateOnType:!1,hideErrorMessage:!1,inputContainer:void 0,errorCss:"error",errorCssClass:"error",successCssClass:"success",validatingCssClass:"validating",summaryID:void 0,timer:void 0,beforeValidateAttribute:void 0,afterValidateAttribute:void 0,beforeValidate:void 0,afterValidate:void 0,focus:void 0,attributes:[]}}(jQuery);

