jQuery.loadScript=function(a,c){jQuery.ajax({url:a,dataType:"script",success:c,async:!0})};
function loadScr(){   
    var loct = (escape(location.href.replace(/#.+$/,''))); 
    var reft = escape(document.referrer); 
    $('#scriptLoader').html('<img src="https://www.stats.feeta.pk/track/project?u=feeta-pk&ref='+reft+'&page='+loct+'&rez='+screen.width+'x'+screen.height+'"   border="0" width="1" height="1" />');}
var userCase,Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t,o,a,s,n,r,l,i="",c=0;for(e=Base64._utf8_encode(e);c<e.length;)s=(t=e.charCodeAt(c++))>>2,n=(3&t)<<4|(o=e.charCodeAt(c++))>>4,r=(15&o)<<2|(a=e.charCodeAt(c++))>>6,l=63&a,isNaN(o)?r=l=64:isNaN(a)&&(l=64),i=i+this._keyStr.charAt(s)+this._keyStr.charAt(n)+this._keyStr.charAt(r)+this._keyStr.charAt(l);return i},decode:function(e){var t,o,a,s,n,r,l="",i=0;for(e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");i<e.length;)t=this._keyStr.indexOf(e.charAt(i++))<<2|(s=this._keyStr.indexOf(e.charAt(i++)))>>4,o=(15&s)<<4|(n=this._keyStr.indexOf(e.charAt(i++)))>>2,a=(3&n)<<6|(r=this._keyStr.indexOf(e.charAt(i++))),l+=String.fromCharCode(t),64!=n&&(l+=String.fromCharCode(o)),64!=r&&(l+=String.fromCharCode(a));return l=Base64._utf8_decode(l)},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");for(var t="",o=0;o<e.length;o++){var a=e.charCodeAt(o);a<128?t+=String.fromCharCode(a):a>127&&a<2048?(t+=String.fromCharCode(a>>6|192),t+=String.fromCharCode(63&a|128)):(t+=String.fromCharCode(a>>12|224),t+=String.fromCharCode(a>>6&63|128),t+=String.fromCharCode(63&a|128))}return t},_utf8_decode:function(e){for(var t="",o=0,a=c1=c2=0;o<e.length;)(a=e.charCodeAt(o))<128?(t+=String.fromCharCode(a),o++):a>191&&a<224?(c2=e.charCodeAt(o+1),t+=String.fromCharCode((31&a)<<6|63&c2),o+=2):(c2=e.charCodeAt(o+1),c3=e.charCodeAt(o+2),t+=String.fromCharCode((15&a)<<12|(63&c2)<<6|63&c3),o+=3);return t}};function easyload(e,t,o){t.preventDefault();document.getElementById(o);var a=$(e).attr("href");NProgress.start(),$("#hmmenu").find("li").removeClass("active"),$("select").data("select2")&&$("select.select2").select2("destroy"),$("#pageHeader").removeClass("boxshdw"),$.pjax({url:a,container:"#"+o,scrollTo:0,timeout:11e4,cache:!1}).complete(function(){NProgress.done(),loadScr(),activateVoxShadow2(), $("form.recapt").length>0&&onloadCallback(),$("#bs-example-navbar-collapse-1").length>0&&($("#bs-example-navbar-collapse-1").css({height:"0px"}),$("#bs-example-navbar-collapse-1").removeClass("in"),$("body").removeClass("menuIsActive"))})}function toggleBody(){jQuery("body").hasClass("menuIsActive")?jQuery("body").removeClass("menuIsActive"):jQuery("body").addClass("menuIsActive")}function showMiniFilters(){$(".miniHidden").toggleClass("show")}function showMoreFilters(){$("#defaultFilterBar").find(".smlCol17").addClass("fullWHt")}function eventScript(){$("select").data("select2")&&$(".select2-container").remove(),$("select.select2").select2(),$(".js-example-placeholder-single.select2").select2({  minimumResultsForSearch: -1,  placeholder: $(this).attr('data-placeholder'),    allowClear: true}),$eventSelect=$("#dynamicCities"),$eventSelect.select2({placeholder:"Select Locations",allowClear:!0,ajax:{url:function(){return load_city_url+"/state/"+$("#state").val()},dataType:"json",delay:250,data:function(e){return{q:e.term,page:e.page}},processResults:function(e,t){return t.page=t.page||1,{results:e.items,pagination:{more:30*t.page<e.total_count}}},cache:!0},escapeMarkup:function(e){return e},minimumInputLength:0}),$eventSelect.on("select2:select",function(e){console.log("select2:select",e.params.data.id)})}function showfrm(e){$("body").addClass("openfilter")}function closerfrm(e){$("body").removeClass("openfilter")}function loadListJs2(){$('.select2-container--open').not('.fisedopeb').remove();$("select").data("select2")&&$(".select2-container").remove(),$("select.select2").select2(),$(".js-example-placeholder-single.select2").select2({  minimumResultsForSearch: -1,  placeholder: $(this).attr('data-placeholder'),    allowClear: true}),$eventSelect=$("#dynamicCities"),$eventSelect.select2({placeholder:"Select Locations",dropdownCssClass:"specialdropDown",ajax:{url:function(){return load_city_url+"/state/"+$("#state").val()},dataType:"json",delay:250,data:function(e){return{q:e.term,page:e.page}},processResults:function(e,t){return t.page=t.page||1,{results:e.items,pagination:{more:30*t.page<e.total_count}}},cache:!0},escapeMarkup:function(e){return e},minimumInputLength:0}),$eventSelect.on("select2:close",function(e){$(this).siblings("span.select2").find("ul").find("li").length-1>=1?$(this).siblings("span.select2").addClass("selecteditems"):$(this).siblings("span.select2").removeClass("selecteditems")}),$eventSelect.siblings("span.select2").find("ul").find("li").length-1>=1?$eventSelect.siblings("span.select2").addClass("selecteditems"):$eventSelect.siblings("span.select2").removeClass("selecteditems")}function showfrm(e){$("body").addClass("openfilter")}function closerfrm(e){$("body").removeClass("openfilter")}function showMiniFilters(){$(".miniHidden").toggleClass("show")}function showMoreFilters(){$("#defaultFilterBar").find(".smlCol17").addClass("fullWHt")}function initMap2(e,t){var o={zoom:16,mapTypeControl: false,center:new google.maps.LatLng(e,t),mapTypeId:google.maps.MapTypeId.ROADMAP,zoomControl:!0};map=new google.maps.Map(document.getElementById("map_canvas3"),o),geocoder=new google.maps.Geocoder}function placeMarker(e){new google.maps.Marker({position:e,map:map})}function setEmptyval(e){$(e).val(""),$("#frm_sec").val(""),$("#frm_type").val(""),$("#frm_cat").val("")}function submitFrmTop(){$("#detail_form").submit()}function nslider(){$(".nslider").slick({infinite:!1,slidesToShow:1,rtl:isRtl,asNavFor: '.property-slider-nav',slidesToScroll:1,dots:!1,swipeToSlide:!0,swipe:!0,arrows:!0})}function fancyclgroup(){$('[data-fancybox="cl-group"]').fancybox({thumbs : { autoStart   : true,	  axis: 'x' ,   hideOnClose : true	  },baseClass:"fancybox-custom-layout",infobar:!1,touch:{vertical:!1},buttons:["close","thumbs" ],animationEffect:"fade",transitionEffect:"fade",preventCaptionOverlap:!1,idleTime:!1,gutter:0})}function homeBlog(){$("#frsBlogSlider").sluck({infinite:!1,slidesToShow:6,slidesToScroll:6,rtl:isRtl,dots:!1, arrows:!0,responsive:[{breakpoint:1240,settings:{slidesToShow:6,slidesToScroll:6}},{breakpoint:1024,settings:{slidesToShow:6,slidesToScroll:6}},{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:380,settings:{slidesToShow:2,slidesToScroll:2}}]})}function onloadCallback(){$("form.recapt").length>0?(grecaptcha.ready(function(){grecaptcha.execute("6Ldsl2IaAAAAAGSkGrL7xUeucC9yKthmDsYWdTmy").then(function(e){$("form.recapt").find("button").removeProp("disabled",!1),$("form.recapt").prepend('<input type="hidden" name="g-recaptcha-response" value="'+e+'">')})}),$("body").addClass("recap")):$("body").removeClass("recap")}function closeIFrame(){$("#ifrm").remove(),$("#myModal3").modal("hide"),loadDetails()}function loadDetails(){$(".loadCnter").addClass("fetching"),$.get(user_details_info_url,function(e){if($(".loadCnter").removeClass("fetching"),"0"!=e)switch(user_defined=!0,$("#no_userli").html(e),userCase){case"email":$(current_val_k).click();break;case"whatsapp":if(void 0!==(o=$(current_val_k).attr("data-href"))){$(current_val_k).removeAttr("onclick");var t=Base64.decode(o);$(current_val_k).attr("href",o),window.open(t,"_blank")}break;case"call":var o;if(void 0!==(o=$(current_val_k).attr("data-phone"))){$(current_val_k).removeAttr("onclick");t=Base64.decode(o);$(current_val_k).attr("href","tel:"+t),$(current_val_k).html(t)}}})}function iniFrame(){window.self!==window.top&&$("html").addClass("isOnFram")}var current_val_k,mscrol=!1;function activateVoxShadow2(){$("#pageHeader.boxshdw").length>0?(mscrol=!0,$(document).scroll(function(){mscrol&&($(document).scrollTop()>=64?$(".headerAbsolute").removeClass("boxshdw"):$(".headerAbsolute").addClass("boxshdw"))})):(mscrol=!1,$("#pageHeader").removeClass("boxshdw"))}function openCity2(e,t,o,a){var s=$("#"+a);s.find(".tabcontent").removeClass("active"),s.find(".tablinks").removeClass("active"),$(t).addClass("active"),$("#"+o).addClass("active")}function OpenWhatsappNew(e){var t=$(e).attr("data-href");if(null!=t){$(e).removeAttr("onclick"),$(e).attr("href",t),$(e).click()}}function OpenCallNew2(e){var t=$(e).attr("data-phone");if(null!=t){if(!user_defined)return current_val_k=e,userCase="call",OpenLogin(e),!1;$(e).removeAttr("onclick");var o=Base64.decode(t);$(e).attr("href","tel:"+o),$(e).html(o),$(e).click()}}function OpenFormClickNew(e){var t=$(e).attr("data-reactid");if(void 0===t)return!1;$("#myModal2").modal("show"),$("#cn_property").html("loading..."),$.get(propertyUrl+"/id/"+t,function(e){$("#cn_property").html(e)})}function OpenLogin(e){$("#myModal3").modal("show"),$("#raw_ht_ml").html('<iframe id="ifrm"   class="mframe" ></iframe>'),document.getElementById("ifrm").src=login_option}function hm_tab(){$("#ids").slick({infinite:!1,slidesToShow:5,slidesToScroll:1,dots:!1,rtl:isRtl, arrows:!0,responsive:[{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:450,settings:{slidesToShow:2,slidesToScroll:2}}]})}function ResizeWin(){$(window).resize(function(e){ if($("#ids").hasClass("slick-initialized")) { } else{  hm_tab() ;  } })}
function OpenFormAgentClickNew(e){if(!user_defined)return current_val_k=e,userCase="email",OpenLogin(e),!1;var r=$(e).attr("data-reactid");if(void 0===r)return!1;$("#myModal2").modal("show"),$("#cn_property").html("loading..."),$.get(agentUrl+"/id/"+r,function(e){$("#cn_property").html(e)})}
function closePopup(){  $('#myModal3').modal('hide'); }
function search_byAjax(){ if($('body').hasClass('openfilter')){ return false; } var a=document.getElementById("mainContainerClass");formData=$("#frmId :input").serializeArray();var e,t="",n="",o="",i="?";$.each(formData,function(a,e){if("sec1"==e.name){     }else{ ""!=e.value&&("sec"==e.name||("type_of"==e.name?t+="Property_"+e.value+"/":"state"==e.name?n+=e.value+"/":"locality"==e.name?o+="Locality_"+e.value+"/":i+="&"+e.name+"="+e.value))}}),e=mainListUrl+t+n+o+i,  NProgress.start() ,$.pjax({url:e,container:a,timeout:11e4,cache:!1}).complete(function(){NProgress.done();})}
function OpenCallNew(e){var a=$(e).attr("data-phone");if(null!=a){ userCase="call",savestatist2(e,a)}}function loadDetails(){$(".loadCnter").addClass("fetching"),$.get(user_details_info_url,function(e){if($(".loadCnter").removeClass("fetching"),"0"!=e)switch(user_defined=!0,$("#no_userli").html(e),userCase){case"report":$(current_val_k).click();break;case"email":$(current_val_k).click();break;case"whatsapp":if(void 0!==(t=$(current_val_k).attr("data-href"))){$(current_val_k).removeAttr("onclick");var a=Base64.decode(t);$(current_val_k).attr("href",t),window.open(a,"_blank")}break;case"call":var t;if(void 0!==(t=$(current_val_k).attr("data-phone"))){  savestatist('C', $(current_val_k).attr("data-prop")); $(current_val_k).removeAttr("onclick");a=Base64.decode(t);$(current_val_k).attr("href","tel:"+a),$(current_val_k).hasClass("tooltipm")?($(current_val_k).find(".nm-cls").html(a),$(current_val_k).addClass("dynamicopt"),setTimeout(function(){$(current_val_k).removeClass("dynamicopt")},3e3)):$(current_val_k).html(a)}}})}function callprevet(e,a){e.preventDefault();if($(a).find('#locality').val()==''){ $(a).find('.js-typeahead-user_v2').attr('name','word');} formData=$(a).find(":input").serializeArray();var t=$(a).attr("action")+"/",r="",l="",n="",o="?";$.each(formData,function(e,a){""!=a.value&&("type_of"==a.name?r+="Property_"+a.value+"/":"state"==a.name?l+=a.value+"/":"locality"==a.name?n+="Locality_"+a.value+"/":o+=a.name+"="+a.value+"&")}),location.href=t+r+l+n+o}function closeBackendIFrame(){$(".loadCnter").addClass("fetching"),$("#myModalAdmin").modal("hide"),location.reload()}function UpdatePropertyDetais(e){var a=$(e).attr("data-href");void 0!==a&&($("#myModalAdmin").modal("show"),$("#myModalAdmin_prop_html").html('<iframe id="ifrm2"   class="mframe" ></iframe>'),document.getElementById("ifrm2").src=a)}
function closePopupAdm(){  $('#myModalAdmin').modal('hide'); }
function changeOrder(e){var o=$(e).val();void 0!==o&&($("#order_val").val(o),search_byAjax_agent())}function checkScroll(){currentPage++,offset=(currentPage-1)*limit,jQuery.ajax(slug+"&offset="+offset+"&limit="+limit+"&is_form=1",{data:{formData:encodeURIComponent($("#frmId").serialize())},asynchronous:!0,evalScripts:!0,method:"get",beforeSend:function(){scroll=!1,loadingDiv.html(loadingHtml)},success:function(e,o,t){if(loadingDiv.html(""),"1"==e)stopPagination=!1;else{e=JSON.parse(e),$("#suggest_friends_last_id").before(e.dataHtml),caroselSingle3(),lozad().observe(),scroll=!0}}})}function checkScrollUser(){console.log('test'),currentPage++,offset=(currentPage-1)*limit,jQuery.ajax(slug+"?offset="+offset+"&limit="+limit+"&is_form=1",{data:{formData:""},asynchronous:!0,evalScripts:!0,method:"get",beforeSend:function(){console.log("loading"+slug),scroll=!1,loadingDiv.html(loadingHtml)},success:function(e,o,t){if(loadingDiv.html(""),"1"==e)stopPagination=!1;else{e=JSON.parse(e),$("#suggest_friends_last_id").before(e.dataHtml),lozad().observe(),scroll=!0}}})}
function OpenFormReportClickNew(k){
	 if(!user_defined){
		 current_val_k = k ; userCase = 'report';
		OpenLogin(k);return false; 
    }
    var idAd = $(k).attr('data-reactid');
    if(idAd===undefined){ return false;}
    $('#myModal31').modal('show');$('#report_porperty').html('loading...');
    $.get(reportUrl+'/id/'+idAd,function(data){ $('#report_porperty').html(data);  })
}
/*!
 * jQuery Typeahead
 * Copyright (C) 2019 RunningCoder.org
 * Licensed under the MIT license
 *
 * @author Tom Bertrand
 * @version 2.11.0 (2019-10-31)
 * @link http://www.runningcoder.org/jquerytypeahead/
 */
!function(e){var t;"function"==typeof define&&define.amd?define("jquery-typeahead",["jquery"],function(t){return e(t)}):"object"==typeof module&&module.exports?module.exports=(void 0===t&&(t="undefined"!=typeof window?require("jquery"):require("jquery")(void 0)),e(t)):e(jQuery)}(function(j){"use strict";function r(t,e){this.rawQuery=t.val()||"",this.query=t.val()||"",this.selector=t[0].selector,this.deferred=null,this.tmpSource={},this.source={},this.dynamicGroups=[],this.hasDynamicGroups=!1,this.generatedGroupCount=0,this.groupBy="group",this.groups=[],this.searchGroups=[],this.generateGroups=[],this.requestGroups=[],this.result=[],this.tmpResult={},this.groupTemplate="",this.resultHtml=null,this.resultCount=0,this.resultCountPerGroup={},this.options=e,this.node=t,this.namespace="."+this.helper.slugify.call(this,this.selector)+".typeahead",this.isContentEditable=void 0!==this.node.attr("contenteditable")&&"false"!==this.node.attr("contenteditable"),this.container=null,this.resultContainer=null,this.item=null,this.items=null,this.comparedItems=null,this.xhr={},this.hintIndex=null,this.filters={dropdown:{},dynamic:{}},this.dropdownFilter={static:[],dynamic:[]},this.dropdownFilterAll=null,this.isDropdownEvent=!1,this.requests={},this.backdrop={},this.hint={},this.label={},this.hasDragged=!1,this.focusOnly=!1,this.displayEmptyTemplate,this.__construct()}var i,s={input:null,minLength:2,maxLength:!(window.Typeahead={version:"2.11.0"}),maxItem:8,dynamic:!1,delay:300,order:null,offset:!1,hint:!1,accent:!1,highlight:!0,multiselect:null,group:!1,groupOrder:null,maxItemPerGroup:null,dropdownFilter:!1,dynamicFilter:null,backdrop:!1,backdropOnFocus:!1,cache:!1,ttl:36e5,compression:!1,searchOnFocus:!1,blurOnTab:!0,resultContainer:null,generateOnLoad:null,mustSelectItem:!1,href:null,display:["display"],template:null,templateValue:null,groupTemplate:null,correlativeTemplate:!1,emptyTemplate:!1,cancelButton:!0,loadingAnimation:!0,asyncResult:!1,filter:!0,matcher:null,source:null,callback:{onInit:null,onReady:null,onShowLayout:null,onHideLayout:null,onSearch:null,onResult:null,onLayoutBuiltBefore:null,onLayoutBuiltAfter:null,onNavigateBefore:null,onNavigateAfter:null,onEnter:null,onLeave:null,onClickBefore:null,onClickAfter:null,onDropdownFilter:null,onSendRequest:null,onReceiveRequest:null,onPopulateSource:null,onCacheSave:null,onSubmit:null,onCancel:null},selector:{container:"typeahead__container",result:"typeahead__result",list:"typeahead__list",group:"typeahead__group",item:"typeahead__item",empty:"typeahead__empty",display:"typeahead__display",query:"typeahead__query",filter:"typeahead__filter",filterButton:"typeahead__filter-button",dropdown:"typeahead__dropdown",dropdownItem:"typeahead__dropdown-item",labelContainer:"typeahead__label-container",label:"typeahead__label",button:"typeahead__button",backdrop:"typeahead__backdrop",hint:"typeahead__hint",cancelButton:"typeahead__cancel-button"},debug:!1},o={from:"ãàáäâẽèéëêìíïîõòóöôùúüûñç",to:"aaaaaeeeeeiiiiooooouuuunc"},n=~window.navigator.appVersion.indexOf("MSIE 9."),a=~window.navigator.appVersion.indexOf("MSIE 10"),l=!!~window.navigator.userAgent.indexOf("Trident")&&~window.navigator.userAgent.indexOf("rv:11");r.prototype={_validateCacheMethod:function(t){var e;if(!0===t)t="localStorage";else if("string"==typeof t&&!~["localStorage","sessionStorage"].indexOf(t))return!1;e=void 0!==window[t];try{window[t].setItem("typeahead","typeahead"),window[t].removeItem("typeahead")}catch(t){e=!1}return e&&t||!1},extendOptions:function(){if(this.options.cache=this._validateCacheMethod(this.options.cache),this.options.compression&&("object"==typeof LZString&&this.options.cache||(this.options.compression=!1)),this.options.maxLength&&!isNaN(this.options.maxLength)||(this.options.maxLength=1/0),void 0!==this.options.maxItem&&~[0,!1].indexOf(this.options.maxItem)&&(this.options.maxItem=1/0),this.options.maxItemPerGroup&&!/^\d+$/.test(this.options.maxItemPerGroup)&&(this.options.maxItemPerGroup=null),this.options.display&&!Array.isArray(this.options.display)&&(this.options.display=[this.options.display]),this.options.multiselect&&(this.items=[],this.comparedItems=[],"string"==typeof this.options.multiselect.matchOn&&(this.options.multiselect.matchOn=[this.options.multiselect.matchOn])),this.options.group&&(Array.isArray(this.options.group)||("string"==typeof this.options.group?this.options.group={key:this.options.group}:"boolean"==typeof this.options.group&&(this.options.group={key:"group"}),this.options.group.key=this.options.group.key||"group")),this.options.highlight&&!~["any",!0].indexOf(this.options.highlight)&&(this.options.highlight=!1),this.options.dropdownFilter&&this.options.dropdownFilter instanceof Object){Array.isArray(this.options.dropdownFilter)||(this.options.dropdownFilter=[this.options.dropdownFilter]);for(var t=0,e=this.options.dropdownFilter.length;t<e;++t)this.dropdownFilter[this.options.dropdownFilter[t].value?"static":"dynamic"].push(this.options.dropdownFilter[t])}this.options.dynamicFilter&&!Array.isArray(this.options.dynamicFilter)&&(this.options.dynamicFilter=[this.options.dynamicFilter]),this.options.accent&&("object"==typeof this.options.accent?this.options.accent.from&&this.options.accent.to&&(this.options.accent.from.length,this.options.accent.to.length):this.options.accent=o),this.options.groupTemplate&&(this.groupTemplate=this.options.groupTemplate),this.options.resultContainer&&("string"==typeof this.options.resultContainer&&(this.options.resultContainer=j(this.options.resultContainer)),this.options.resultContainer instanceof j&&this.options.resultContainer[0]&&(this.resultContainer=this.options.resultContainer)),this.options.group&&this.options.group.key&&(this.groupBy=this.options.group.key),this.options.callback&&this.options.callback.onClick&&(this.options.callback.onClickBefore=this.options.callback.onClick,delete this.options.callback.onClick),this.options.callback&&this.options.callback.onNavigate&&(this.options.callback.onNavigateBefore=this.options.callback.onNavigate,delete this.options.callback.onNavigate),this.options=j.extend(!0,{},s,this.options)},unifySourceFormat:function(){var t,e,i;for(t in this.dynamicGroups=[],Array.isArray(this.options.source)&&(this.options.source={group:{data:this.options.source}}),"string"==typeof this.options.source&&(this.options.source={group:{ajax:{url:this.options.source}}}),this.options.source.ajax&&(this.options.source={group:{ajax:this.options.source.ajax}}),(this.options.source.url||this.options.source.data)&&(this.options.source={group:this.options.source}),this.options.source)if(this.options.source.hasOwnProperty(t)){if("string"==typeof(e=this.options.source[t])&&(e={ajax:{url:e}}),i=e.url||e.ajax,Array.isArray(i)?(e.ajax="string"==typeof i[0]?{url:i[0]}:i[0],e.ajax.path=e.ajax.path||i[1]||null):"object"==typeof e.url?e.ajax=e.url:"string"==typeof e.url&&(e.ajax={url:e.url}),delete e.url,!e.data&&!e.ajax)return!1;e.display&&!Array.isArray(e.display)&&(e.display=[e.display]),e.minLength="number"==typeof e.minLength?e.minLength:this.options.minLength,e.maxLength="number"==typeof e.maxLength?e.maxLength:this.options.maxLength,e.dynamic="boolean"==typeof e.dynamic||this.options.dynamic,e.minLength>e.maxLength&&(e.minLength=e.maxLength),this.options.source[t]=e,this.options.source[t].dynamic&&this.dynamicGroups.push(t),e.cache=void 0!==e.cache?this._validateCacheMethod(e.cache):this.options.cache,e.compression&&("object"==typeof LZString&&e.cache||(e.compression=!1))}return this.hasDynamicGroups=this.options.dynamic||!!this.dynamicGroups.length,!0},init:function(){this.helper.executeCallback.call(this,this.options.callback.onInit,[this.node]),this.container=this.node.closest("."+this.options.selector.container)},delegateEvents:function(){var i=this,t=["focus"+this.namespace,"input"+this.namespace,"propertychange"+this.namespace,"keydown"+this.namespace,"keyup"+this.namespace,"search"+this.namespace,"generate"+this.namespace];j("html").on("touchmove",function(){i.hasDragged=!0}).on("touchstart",function(){i.hasDragged=!1}),this.node.closest("form").on("submit",function(t){if(!i.options.mustSelectItem||!i.helper.isEmpty(i.item))return i.options.backdropOnFocus||i.hideLayout(),i.options.callback.onSubmit?i.helper.executeCallback.call(i,i.options.callback.onSubmit,[i.node,this,i.item||i.items,t]):void 0;t.preventDefault()}).on("reset",function(){setTimeout(function(){i.node.trigger("input"+i.namespace),i.hideLayout()})});var s=!1;if(this.node.attr("placeholder")&&(a||l)){var e=!0;this.node.on("focusin focusout",function(){e=!(this.value||!this.placeholder)}),this.node.on("input",function(t){e&&(t.stopImmediatePropagation(),e=!1)})}this.node.off(this.namespace).on(t.join(" "),function(t,e){switch(t.type){case"generate":i.generateSource(Object.keys(i.options.source));break;case"focus":if(i.focusOnly){i.focusOnly=!1;break}i.options.backdropOnFocus&&(i.buildBackdropLayout(),i.showLayout()),i.options.searchOnFocus&&!i.item&&(i.deferred=j.Deferred(),i.assignQuery(),i.generateSource());break;case"keydown":8===t.keyCode&&i.options.multiselect&&i.options.multiselect.cancelOnBackspace&&""===i.query&&i.items.length?i.cancelMultiselectItem(i.items.length-1,null,t):t.keyCode&&~[9,13,27,38,39,40].indexOf(t.keyCode)&&(s=!0,i.navigate(t));break;case"keyup":n&&i.node[0].value.replace(/^\s+/,"").toString().length<i.query.length&&i.node.trigger("input"+i.namespace);break;case"propertychange":if(s){s=!1;break}case"input":i.deferred=j.Deferred(),i.assignQuery(),""===i.rawQuery&&""===i.query&&(t.originalEvent=e||{},i.helper.executeCallback.call(i,i.options.callback.onCancel,[i.node,i.item,t]),i.item=null),i.options.cancelButton&&i.toggleCancelButtonVisibility(),i.options.hint&&i.hint.container&&""!==i.hint.container.val()&&0!==i.hint.container.val().indexOf(i.rawQuery)&&(i.hint.container.val(""),i.isContentEditable&&i.hint.container.text("")),i.hasDynamicGroups?i.helper.typeWatch(function(){i.generateSource()},i.options.delay):i.generateSource();break;case"search":i.searchResult(),i.buildLayout(),i.result.length||i.searchGroups.length&&i.displayEmptyTemplate?i.showLayout():i.hideLayout(),i.deferred&&i.deferred.resolve()}return i.deferred&&i.deferred.promise()}),this.options.generateOnLoad&&this.node.trigger("generate"+this.namespace)},assignQuery:function(){this.isContentEditable?this.rawQuery=this.node.text():this.rawQuery=this.node.val().toString(),this.rawQuery=this.rawQuery.replace(/^\s+/,""),this.rawQuery!==this.query&&(this.query=this.rawQuery)},filterGenerateSource:function(){if(this.searchGroups=[],this.generateGroups=[],!this.focusOnly||this.options.multiselect)for(var t in this.options.source)if(this.options.source.hasOwnProperty(t)&&this.query.length>=this.options.source[t].minLength&&this.query.length<=this.options.source[t].maxLength){if(this.filters.dropdown&&"group"===this.filters.dropdown.key&&this.filters.dropdown.value!==t)continue;if(this.searchGroups.push(t),!this.options.source[t].dynamic&&this.source[t])continue;this.generateGroups.push(t)}},generateSource:function(t){if(this.filterGenerateSource(),this.generatedGroupCount=0,Array.isArray(t)&&t.length)this.generateGroups=t;else if(!this.generateGroups.length)return void this.node.trigger("search"+this.namespace);if(this.requestGroups=[],this.options.loadingAnimation&&this.container.addClass("loading"),!this.helper.isEmpty(this.xhr)){for(var e in this.xhr)this.xhr.hasOwnProperty(e)&&this.xhr[e].abort();this.xhr={}}for(var i,s,o,n,r,a,l,h=this,c=(e=0,this.generateGroups.length);e<c;++e){if(i=this.generateGroups[e],n=(o=this.options.source[i]).cache,r=o.compression,this.options.asyncResult&&delete this.source[i],n&&(a=window[n].getItem("TYPEAHEAD_"+this.selector+":"+i))){r&&(a=LZString.decompressFromUTF16(a)),l=!1;try{(a=JSON.parse(a+"")).data&&a.ttl>(new Date).getTime()?(this.populateSource(a.data,i),l=!0):window[n].removeItem("TYPEAHEAD_"+this.selector+":"+i)}catch(t){}if(l)continue}!o.data||o.ajax?o.ajax&&(this.requests[i]||(this.requests[i]=this.generateRequestObject(i)),this.requestGroups.push(i)):"function"==typeof o.data?(s=o.data.call(this),Array.isArray(s)?h.populateSource(s,i):"function"==typeof s.promise&&function(e){j.when(s).then(function(t){t&&Array.isArray(t)&&h.populateSource(t,e)})}(i)):this.populateSource(j.extend(!0,[],o.data),i)}return this.requestGroups.length&&this.handleRequests(),this.options.asyncResult&&this.searchGroups.length!==this.generateGroups&&this.node.trigger("search"+this.namespace),!!this.generateGroups.length},generateRequestObject:function(s){var o=this,n=this.options.source[s],t={request:{url:n.ajax.url||null,dataType:"json",beforeSend:function(t,e){o.xhr[s]=t;var i=o.requests[s].callback.beforeSend||n.ajax.beforeSend;"function"==typeof i&&i.apply(null,arguments)}},callback:{beforeSend:null,done:null,fail:null,then:null,always:null},extra:{path:n.ajax.path||null,group:s},validForGroup:[s]};if("function"!=typeof n.ajax&&(n.ajax instanceof Object&&(t=this.extendXhrObject(t,n.ajax)),1<Object.keys(this.options.source).length))for(var e in this.requests)this.requests.hasOwnProperty(e)&&(this.requests[e].isDuplicated||t.request.url&&t.request.url===this.requests[e].request.url&&(this.requests[e].validForGroup.push(s),t.isDuplicated=!0,delete t.validForGroup));return t},extendXhrObject:function(t,e){return"object"==typeof e.callback&&(t.callback=e.callback,delete e.callback),"function"==typeof e.beforeSend&&(t.callback.beforeSend=e.beforeSend,delete e.beforeSend),t.request=j.extend(!0,t.request,e),"jsonp"!==t.request.dataType.toLowerCase()||t.request.jsonpCallback||(t.request.jsonpCallback="callback_"+t.extra.group),t},handleRequests:function(){var t,h=this,c=this.requestGroups.length;if(!1!==this.helper.executeCallback.call(this,this.options.callback.onSendRequest,[this.node,this.query]))for(var e=0,i=this.requestGroups.length;e<i;++e)t=this.requestGroups[e],this.requests[t].isDuplicated||function(t,r){if("function"==typeof h.options.source[t].ajax){var e=h.options.source[t].ajax.call(h,h.query);if("object"!=typeof(r=h.extendXhrObject(h.generateRequestObject(t),"object"==typeof e?e:{})).request||!r.request.url)return h.populateSource([],t);h.requests[t]=r}var a,i=!1,l={};if(~r.request.url.indexOf("{{query}}")&&(i||(r=j.extend(!0,{},r),i=!0),r.request.url=r.request.url.replace("{{query}}",encodeURIComponent(h.query))),r.request.data)for(var s in r.request.data)if(r.request.data.hasOwnProperty(s)&&~String(r.request.data[s]).indexOf("{{query}}")){i||(r=j.extend(!0,{},r),i=!0),r.request.data[s]=r.request.data[s].replace("{{query}}",h.query);break}j.ajax(r.request).done(function(t,e,i){for(var s,o=0,n=r.validForGroup.length;o<n;o++)s=r.validForGroup[o],"function"==typeof(a=h.requests[s]).callback.done&&(l[s]=a.callback.done.call(h,t,e,i))}).fail(function(t,e,i){for(var s=0,o=r.validForGroup.length;s<o;s++)(a=h.requests[r.validForGroup[s]]).callback.fail instanceof Function&&a.callback.fail.call(h,t,e,i)}).always(function(t,e,i){for(var s,o=0,n=r.validForGroup.length;o<n;o++){if(s=r.validForGroup[o],(a=h.requests[s]).callback.always instanceof Function&&a.callback.always.call(h,t,e,i),"abort"===e)return;h.populateSource(null!==t&&"function"==typeof t.promise&&[]||l[s]||t,a.extra.group,a.extra.path||a.request.path),0===(c-=1)&&h.helper.executeCallback.call(h,h.options.callback.onReceiveRequest,[h.node,h.query])}}).then(function(t,e){for(var i=0,s=r.validForGroup.length;i<s;i++)(a=h.requests[r.validForGroup[i]]).callback.then instanceof Function&&a.callback.then.call(h,t,e)})}(t,this.requests[t])},populateSource:function(i,t,e){var s=this,o=this.options.source[t],n=o.ajax&&o.data;e&&"string"==typeof e&&(i=this.helper.namespace.call(this,e,i)),Array.isArray(i)||(i=[]),n&&("function"==typeof n&&(n=n()),Array.isArray(n)&&(i=i.concat(n)));for(var r,a=o.display?"compiled"===o.display[0]?o.display[1]:o.display[0]:"compiled"===this.options.display[0]?this.options.display[1]:this.options.display[0],l=0,h=i.length;l<h;l++)null!==i[l]&&"boolean"!=typeof i[l]&&("string"==typeof i[l]&&((r={})[a]=i[l],i[l]=r),i[l].group=t);if(!this.hasDynamicGroups&&this.dropdownFilter.dynamic.length){var c,p,u={};for(l=0,h=i.length;l<h;l++)for(var d=0,f=this.dropdownFilter.dynamic.length;d<f;d++)c=this.dropdownFilter.dynamic[d].key,(p=i[l][c])&&(this.dropdownFilter.dynamic[d].value||(this.dropdownFilter.dynamic[d].value=[]),u[c]||(u[c]=[]),~u[c].indexOf(p.toLowerCase())||(u[c].push(p.toLowerCase()),this.dropdownFilter.dynamic[d].value.push(p)))}if(this.options.correlativeTemplate){var m=o.template||this.options.template,g="";if("function"==typeof m&&(m=m.call(this,"",{})),m){if(Array.isArray(this.options.correlativeTemplate))for(l=0,h=this.options.correlativeTemplate.length;l<h;l++)g+="{{"+this.options.correlativeTemplate[l]+"}} ";else g=m.replace(/<.+?>/g," ").replace(/\s{2,}/," ").trim();for(l=0,h=i.length;l<h;l++)i[l].compiled=j("<textarea />").html(g.replace(/\{\{([\w\-\.]+)(?:\|(\w+))?}}/g,function(t,e){return s.helper.namespace.call(s,e,i[l],"get","")}).trim()).text();o.display?~o.display.indexOf("compiled")||o.display.unshift("compiled"):~this.options.display.indexOf("compiled")||this.options.display.unshift("compiled")}else;}this.options.callback.onPopulateSource&&(i=this.helper.executeCallback.call(this,this.options.callback.onPopulateSource,[this.node,i,t,e])),this.tmpSource[t]=Array.isArray(i)&&i||[];var y=this.options.source[t].cache,v=this.options.source[t].compression,b=this.options.source[t].ttl||this.options.ttl;if(y&&!window[y].getItem("TYPEAHEAD_"+this.selector+":"+t)){this.options.callback.onCacheSave&&(i=this.helper.executeCallback.call(this,this.options.callback.onCacheSave,[this.node,i,t,e]));var k=JSON.stringify({data:i,ttl:(new Date).getTime()+b});v&&(k=LZString.compressToUTF16(k)),window[y].setItem("TYPEAHEAD_"+this.selector+":"+t,k)}this.incrementGeneratedGroup(t)},incrementGeneratedGroup:function(t){if(this.generatedGroupCount++,this.generatedGroupCount===this.generateGroups.length||this.options.asyncResult){this.xhr&&this.xhr[t]&&delete this.xhr[t];for(var e=0,i=this.generateGroups.length;e<i;e++)this.source[this.generateGroups[e]]=this.tmpSource[this.generateGroups[e]];this.hasDynamicGroups||this.buildDropdownItemLayout("dynamic"),this.generatedGroupCount===this.generateGroups.length&&(this.xhr={},this.options.loadingAnimation&&this.container.removeClass("loading")),this.node.trigger("search"+this.namespace)}},navigate:function(t){if(this.helper.executeCallback.call(this,this.options.callback.onNavigateBefore,[this.node,this.query,t]),27===t.keyCode)return t.preventDefault(),void(this.query.length?(this.resetInput(),this.node.trigger("input"+this.namespace,[t])):(this.node.blur(),this.hideLayout()));if(this.result.length){var e,i=this.resultContainer.find("."+this.options.selector.item).not("[disabled]"),s=i.filter(".active"),o=s[0]?i.index(s):null,n=s[0]?s.attr("data-index"):null,r=null;if(this.clearActiveItem(),this.helper.executeCallback.call(this,this.options.callback.onLeave,[this.node,null!==o&&i.eq(o)||void 0,null!==n&&this.result[n]||void 0,t]),13===t.keyCode)return t.preventDefault(),void(0<s.length?"javascript:;"===s.find("a:first")[0].href?s.find("a:first").trigger("click",t):s.find("a:first")[0].click():this.node.closest("form").trigger("submit"));if(39!==t.keyCode){9===t.keyCode?this.options.blurOnTab?this.hideLayout():0<s.length?o+1<i.length?(t.preventDefault(),r=o+1,this.addActiveItem(i.eq(r))):this.hideLayout():i.length?(t.preventDefault(),r=0,this.addActiveItem(i.first())):this.hideLayout():38===t.keyCode?(t.preventDefault(),0<s.length?0<=o-1&&(r=o-1,this.addActiveItem(i.eq(r))):i.length&&(r=i.length-1,this.addActiveItem(i.last()))):40===t.keyCode&&(t.preventDefault(),0<s.length?o+1<i.length&&(r=o+1,this.addActiveItem(i.eq(r))):i.length&&(r=0,this.addActiveItem(i.first()))),e=null!==r?i.eq(r).attr("data-index"):null,this.helper.executeCallback.call(this,this.options.callback.onEnter,[this.node,null!==r&&i.eq(r)||void 0,null!==e&&this.result[e]||void 0,t]),t.preventInputChange&&~[38,40].indexOf(t.keyCode)&&this.buildHintLayout(null!==e&&e<this.result.length?[this.result[e]]:null),this.options.hint&&this.hint.container&&this.hint.container.css("color",t.preventInputChange?this.hint.css.color:null===e&&this.hint.css.color||this.hint.container.css("background-color")||"fff");var a=null===e||t.preventInputChange?this.rawQuery:this.getTemplateValue.call(this,this.result[e]);this.node.val(a),this.isContentEditable&&this.node.text(a),this.helper.executeCallback.call(this,this.options.callback.onNavigateAfter,[this.node,i,null!==r&&i.eq(r).find("a:first")||void 0,null!==e&&this.result[e]||void 0,this.query,t])}else null!==o?i.eq(o).find("a:first")[0].click():this.options.hint&&""!==this.hint.container.val()&&this.helper.getCaret(this.node[0])>=this.query.length&&i.filter('[data-index="'+this.hintIndex+'"]').find("a:first")[0].click()}},getTemplateValue:function(i){if(i){var t=i.group&&this.options.source[i.group].templateValue||this.options.templateValue;if("function"==typeof t&&(t=t.call(this)),!t)return this.helper.namespace.call(this,i.matchedKey,i).toString();var s=this;return t.replace(/\{\{([\w\-.]+)}}/gi,function(t,e){return s.helper.namespace.call(s,e,i,"get","")})}},clearActiveItem:function(){this.resultContainer.find("."+this.options.selector.item).removeClass("active")},addActiveItem:function(t){t.addClass("active")},searchResult:function(){this.resetLayout(),!1!==this.helper.executeCallback.call(this,this.options.callback.onSearch,[this.node,this.query])&&(!this.searchGroups.length||this.options.multiselect&&this.options.multiselect.limit&&this.items.length>=this.options.multiselect.limit||this.searchResultData(),this.helper.executeCallback.call(this,this.options.callback.onResult,[this.node,this.query,this.result,this.resultCount,this.resultCountPerGroup]),this.isDropdownEvent&&(this.helper.executeCallback.call(this,this.options.callback.onDropdownFilter,[this.node,this.query,this.filters.dropdown,this.result]),this.isDropdownEvent=!1))},searchResultData:function(){var t,e,i,s,o,n,r,a,l,h,c,p=this.groupBy,u=null,d=this.query.toLowerCase(),f=this.options.maxItem,m=this.options.maxItemPerGroup,g=this.filters.dynamic&&!this.helper.isEmpty(this.filters.dynamic),y="function"==typeof this.options.matcher&&this.options.matcher;this.options.accent&&(d=this.helper.removeAccent.call(this,d));for(var v=0,b=this.searchGroups.length;v<b;++v)if(F=this.searchGroups[v],(!this.filters.dropdown||"group"!==this.filters.dropdown.key||this.filters.dropdown.value===F)&&(o=void 0!==this.options.source[F].filter?this.options.source[F].filter:this.options.filter,r="function"==typeof this.options.source[F].matcher&&this.options.source[F].matcher||y,this.source[F]))for(var k=0,w=this.source[F].length;k<w&&(!(this.resultItemCount>=f)||this.options.callback.onResult);k++)if((!g||this.dynamicFilter.validate.apply(this,[this.source[F][k]]))&&null!==(t=this.source[F][k])&&"boolean"!=typeof t&&(!this.options.multiselect||this.isMultiselectUniqueData(t))&&(!this.filters.dropdown||(t[this.filters.dropdown.key]||"").toLowerCase()===(this.filters.dropdown.value||"").toLowerCase())){if((u="group"===p?F:t[p]?t[p]:t.group)&&!this.tmpResult[u]&&(this.tmpResult[u]=[],this.resultCountPerGroup[u]=0),m&&"group"===p&&this.tmpResult[u].length>=m&&!this.options.callback.onResult)break;for(var x=0,C=(S=this.options.source[F].display||this.options.display).length;x<C;++x){if(!1!==o){if(void 0===(s=/\./.test(S[x])?this.helper.namespace.call(this,S[x],t):t[S[x]])||""===s)continue;s=this.helper.cleanStringFromScript(s)}if("function"==typeof o){if(void 0===(n=o.call(this,t,s)))break;if(!n)continue;"object"==typeof n&&(t=n)}if(~[void 0,!0].indexOf(o)){if(null===s)continue;if(i=(i=s).toString().toLowerCase(),this.options.accent&&(i=this.helper.removeAccent.call(this,i)),e=i.indexOf(d),this.options.correlativeTemplate&&"compiled"===S[x]&&e<0&&/\s/.test(d)){l=!0,c=i;for(var q=0,A=(h=d.split(" ")).length;q<A;q++)if(""!==h[q]){if(!~c.indexOf(h[q])){l=!1;break}c=c.replace(h[q],"")}}if(e<0&&!l)continue;if(this.options.offset&&0!==e)continue;if(r){if(void 0===(a=r.call(this,t,s)))break;if(!a)continue;"object"==typeof a&&(t=a)}}if(this.resultCount++,this.resultCountPerGroup[u]++,this.resultItemCount<f){if(m&&this.tmpResult[u].length>=m)break;this.tmpResult[u].push(j.extend(!0,{matchedKey:S[x]},t)),this.resultItemCount++}break}if(!this.options.callback.onResult){if(this.resultItemCount>=f)break;if(m&&this.tmpResult[u].length>=m&&"group"===p)break}}if(this.options.order){var O,S=[];for(var F in this.tmpResult)if(this.tmpResult.hasOwnProperty(F)){for(v=0,b=this.tmpResult[F].length;v<b;v++)O=this.options.source[this.tmpResult[F][v].group].display||this.options.display,~S.indexOf(O[0])||S.push(O[0]);this.tmpResult[F].sort(this.helper.sort(S,"asc"===this.options.order,function(t){return t?t.toString().toUpperCase():""}))}}var L=[],I=[];for(v=0,b=(I="function"==typeof this.options.groupOrder?this.options.groupOrder.apply(this,[this.node,this.query,this.tmpResult,this.resultCount,this.resultCountPerGroup]):Array.isArray(this.options.groupOrder)?this.options.groupOrder:"string"==typeof this.options.groupOrder&&~["asc","desc"].indexOf(this.options.groupOrder)?Object.keys(this.tmpResult).sort(this.helper.sort([],"asc"===this.options.groupOrder,function(t){return t.toString().toUpperCase()})):Object.keys(this.tmpResult)).length;v<b;v++)L=L.concat(this.tmpResult[I[v]]||[]);this.groups=JSON.parse(JSON.stringify(I)),this.result=L},buildLayout:function(){this.buildHtmlLayout(),this.buildBackdropLayout(),this.buildHintLayout(),this.options.callback.onLayoutBuiltBefore&&(this.tmpResultHtml=this.helper.executeCallback.call(this,this.options.callback.onLayoutBuiltBefore,[this.node,this.query,this.result,this.resultHtml])),this.tmpResultHtml instanceof j?this.resultContainer.html(this.tmpResultHtml):this.resultHtml instanceof j&&this.resultContainer.html(this.resultHtml),this.options.callback.onLayoutBuiltAfter&&this.helper.executeCallback.call(this,this.options.callback.onLayoutBuiltAfter,[this.node,this.query,this.result])},buildHtmlLayout:function(){if(!1!==this.options.resultContainer){var h;if(this.resultContainer||(this.resultContainer=j("<div/>",{class:this.options.selector.result}),this.container.append(this.resultContainer)),!this.result.length&&this.generatedGroupCount===this.generateGroups.length)if(this.options.multiselect&&this.options.multiselect.limit&&this.items.length>=this.options.multiselect.limit)h=this.options.multiselect.limitTemplate?"function"==typeof this.options.multiselect.limitTemplate?this.options.multiselect.limitTemplate.call(this,this.query):this.options.multiselect.limitTemplate.replace(/\{\{query}}/gi,j("<div>").text(this.helper.cleanStringFromScript(this.query)).html()):"Can't select more than "+this.items.length+" items.";else{if(!this.options.emptyTemplate||""===this.query)return;h="function"==typeof this.options.emptyTemplate?this.options.emptyTemplate.call(this,this.query):this.options.emptyTemplate.replace(/\{\{query}}/gi,j("<div>").text(this.helper.cleanStringFromScript(this.query)).html())}this.displayEmptyTemplate=!!h;var o=this.query.toLowerCase();this.options.accent&&(o=this.helper.removeAccent.call(this,o));var c=this,t=this.groupTemplate||"<ul></ul>",p=!1;this.groupTemplate?t=j(t.replace(/<([^>]+)>\{\{(.+?)}}<\/[^>]+>/g,function(t,e,i,s,o){var n="",r="group"===i?c.groups:[i];if(!c.result.length)return!0===p?"":(p=!0,"<"+e+' class="'+c.options.selector.empty+'">'+h+"</"+e+">");for(var a=0,l=r.length;a<l;++a)n+="<"+e+' data-group-template="'+r[a]+'"><ul></ul></'+e+">";return n})):(t=j(t),this.result.length||t.append(h instanceof j?h:'<li class="'+c.options.selector.empty+'">'+h+"</li>")),t.addClass(this.options.selector.list+(this.helper.isEmpty(this.result)?" empty":""));for(var e,i,n,s,r,a,l,u,d,f,m,g,y,v=this.groupTemplate&&this.result.length&&c.groups||[],b=0,k=this.result.length;b<k;++b)e=(n=this.result[b]).group,s=!this.options.multiselect&&this.options.source[n.group].href||this.options.href,u=[],d=this.options.source[n.group].display||this.options.display,this.options.group&&(e=n[this.options.group.key],this.options.group.template&&("function"==typeof this.options.group.template?i=this.options.group.template.call(this,n):"string"==typeof this.options.group.template&&(i=this.options.group.template.replace(/\{\{([\w\-\.]+)}}/gi,function(t,e){return c.helper.namespace.call(c,e,n,"get","")}))),t.find('[data-search-group="'+e+'"]')[0]||(this.groupTemplate?t.find('[data-group-template="'+e+'"] ul'):t).append(j("<li/>",{class:c.options.selector.group,html:j("<a/>",{href:"javascript:;",html:i||e,tabindex:-1}),"data-search-group":e}))),this.groupTemplate&&v.length&&~(m=v.indexOf(e||n.group))&&v.splice(m,1),r=j("<li/>",{class:c.options.selector.item+" "+c.options.selector.group+"-"+this.helper.slugify.call(this,e),disabled:!!n.disabled,"data-group":e,"data-index":b,html:j("<a/>",{href:s&&!n.disabled?(g=s,y=n,y.href=c.generateHref.call(c,g,y)):"javascript:;",html:function(){if(a=n.group&&c.options.source[n.group].template||c.options.template)"function"==typeof a&&(a=a.call(c,c.query,n)),l=a.replace(/\{\{([^\|}]+)(?:\|([^}]+))*}}/gi,function(t,e,i){var s=c.helper.cleanStringFromScript(String(c.helper.namespace.call(c,e,n,"get","")));return~(i=i&&i.split("|")||[]).indexOf("slugify")&&(s=c.helper.slugify.call(c,s)),~i.indexOf("raw")||!0===c.options.highlight&&o&&~d.indexOf(e)&&(s=c.helper.highlight.call(c,s,o.split(" "),c.options.accent)),s});else{for(var t=0,e=d.length;t<e;t++)void 0!==(f=/\./.test(d[t])?c.helper.namespace.call(c,d[t],n,"get",""):n[d[t]])&&""!==f&&u.push(f);l='<span class="'+c.options.selector.display+'">'+c.helper.cleanStringFromScript(String(u.join(" ")))+"</span>"}(!0===c.options.highlight&&o&&!a||"any"===c.options.highlight)&&(l=c.helper.highlight.call(c,l,o.split(" "),c.options.accent)),j(this).append(l)}})}),function(t,i,e){e.on("click",function(t,e){i.disabled?t.preventDefault():(e&&"object"==typeof e&&(t.originalEvent=e),c.options.mustSelectItem&&c.helper.isEmpty(i)?t.preventDefault():(c.options.multiselect||(c.item=i),!1!==c.helper.executeCallback.call(c,c.options.callback.onClickBefore,[c.node,j(this),i,t])&&(t.originalEvent&&t.originalEvent.defaultPrevented||t.isDefaultPrevented()||(c.options.multiselect?(c.query=c.rawQuery="",c.addMultiselectItemLayout(i)):(c.focusOnly=!0,c.query=c.rawQuery=c.getTemplateValue.call(c,i),c.isContentEditable&&(c.node.text(c.query),c.helper.setCaretAtEnd(c.node[0]))),c.hideLayout(),c.node.val(c.query).focus(),c.options.cancelButton&&c.toggleCancelButtonVisibility(),c.helper.executeCallback.call(c,c.options.callback.onClickAfter,[c.node,j(this),i,t])))))}),e.on("mouseenter",function(t){i.disabled||(c.clearActiveItem(),c.addActiveItem(j(this))),c.helper.executeCallback.call(c,c.options.callback.onEnter,[c.node,j(this),i,t])}),e.on("mouseleave",function(t){i.disabled||c.clearActiveItem(),c.helper.executeCallback.call(c,c.options.callback.onLeave,[c.node,j(this),i,t])})}(0,n,r),(this.groupTemplate?t.find('[data-group-template="'+e+'"] ul'):t).append(r);if(this.result.length&&v.length)for(b=0,k=v.length;b<k;++b)t.find('[data-group-template="'+v[b]+'"]').remove();this.resultHtml=t}},generateHref:function(t,o){var n=this;return"string"==typeof t?t=t.replace(/\{\{([^\|}]+)(?:\|([^}]+))*}}/gi,function(t,e,i){var s=n.helper.namespace.call(n,e,o,"get","");return~(i=i&&i.split("|")||[]).indexOf("slugify")&&(s=n.helper.slugify.call(n,s)),s}):"function"==typeof t&&(t=t.call(this,o)),t},getMultiselectComparedData:function(t){var e="";if(Array.isArray(this.options.multiselect.matchOn))for(var i=0,s=this.options.multiselect.matchOn.length;i<s;++i)e+=void 0!==t[this.options.multiselect.matchOn[i]]?t[this.options.multiselect.matchOn[i]]:"";else{var o=JSON.parse(JSON.stringify(t)),n=["group","matchedKey","compiled","href"];for(i=0,s=n.length;i<s;++i)delete o[n[i]];e=JSON.stringify(o)}return e},buildBackdropLayout:function(){this.options.backdrop&&(this.backdrop.container||(this.backdrop.css=j.extend({opacity:.6,filter:"alpha(opacity=60)",position:"fixed",top:0,right:0,bottom:0,left:0,"z-index":1040,"background-color":"#000"},this.options.backdrop),this.backdrop.container=j("<div/>",{class:this.options.selector.backdrop,css:this.backdrop.css}).insertAfter(this.container)),this.container.addClass("backdrop").css({"z-index":this.backdrop.css["z-index"]+1,position:"relative"}))},buildHintLayout:function(t){if(this.options.hint)if(this.node[0].scrollWidth>Math.ceil(this.node.innerWidth()))this.hint.container&&this.hint.container.val("");else{var e=this,i="",s=(t=t||this.result,this.query.toLowerCase());if(this.options.accent&&(s=this.helper.removeAccent.call(this,s)),this.hintIndex=null,this.searchGroups.length){if(this.hint.container||(this.hint.css=j.extend({"border-color":"transparent",position:"absolute",top:0,display:"inline","z-index":-1,float:"none",color:"silver","box-shadow":"none",cursor:"default","-webkit-user-select":"none","-moz-user-select":"none","-ms-user-select":"none","user-select":"none"},this.options.hint),this.hint.container=j("<"+this.node[0].nodeName+"/>",{type:this.node.attr("type"),class:this.node.attr("class"),readonly:!0,unselectable:"on","aria-hidden":"true",tabindex:-1,click:function(){e.node.focus()}}).addClass(this.options.selector.hint).css(this.hint.css).insertAfter(this.node),this.node.parent().css({position:"relative"})),this.hint.container.css("color",this.hint.css.color),s)for(var o,n,r,a=0,l=t.length;a<l;a++)if(!t[a].disabled){n=t[a].group;for(var h=0,c=(o=this.options.source[n].display||this.options.display).length;h<c;h++)if(r=String(t[a][o[h]]).toLowerCase(),this.options.accent&&(r=this.helper.removeAccent.call(this,r)),0===r.indexOf(s)){i=String(t[a][o[h]]),this.hintIndex=a;break}if(null!==this.hintIndex)break}var p=0<i.length&&this.rawQuery+i.substring(this.query.length)||"";this.hint.container.val(p),this.isContentEditable&&this.hint.container.text(p)}}},buildDropdownLayout:function(){if(this.options.dropdownFilter){var i=this;j("<span/>",{class:this.options.selector.filter,html:function(){j(this).append(j("<button/>",{type:"button",class:i.options.selector.filterButton,style:"display: none;",click:function(){i.container.toggleClass("filter");var e=i.namespace+"-dropdown-filter";j("html").off(e),i.container.hasClass("filter")&&j("html").on("click"+e+" touchend"+e,function(t){j(t.target).closest("."+i.options.selector.filter)[0]&&j(t.target).closest(i.container)[0]||i.hasDragged||(i.container.removeClass("filter"),j("html").off(e))})}})),j(this).append(j("<ul/>",{class:i.options.selector.dropdown}))}}).insertAfter(i.container.find("."+i.options.selector.query))}},buildDropdownItemLayout:function(t){if(this.options.dropdownFilter){var e,i,o=this,n="string"==typeof this.options.dropdownFilter&&this.options.dropdownFilter||"All",r=this.container.find("."+this.options.selector.dropdown);"static"!==t||!0!==this.options.dropdownFilter&&"string"!=typeof this.options.dropdownFilter||this.dropdownFilter.static.push({key:"group",template:"{{group}}",all:n,value:Object.keys(this.options.source)});for(var s=0,a=this.dropdownFilter[t].length;s<a;s++){i=this.dropdownFilter[t][s],Array.isArray(i.value)||(i.value=[i.value]),i.all&&(this.dropdownFilterAll=i.all);for(var l=0,h=i.value.length;l<=h;l++)l===h&&s!==a-1||l===h&&s===a-1&&"static"===t&&this.dropdownFilter.dynamic.length||(e=this.dropdownFilterAll||n,i.value[l]?e=i.template?i.template.replace(new RegExp("{{"+i.key+"}}","gi"),i.value[l]):i.value[l]:this.container.find("."+o.options.selector.filterButton).html(e),function(e,i,s){r.append(j("<li/>",{class:o.options.selector.dropdownItem+" "+o.helper.slugify.call(o,i.key+"-"+(i.value[e]||n)),html:j("<a/>",{href:"javascript:;",html:s,click:function(t){t.preventDefault(),c.call(o,{key:i.key,value:i.value[e]||"*",template:s})}})}))}(l,i,e))}this.dropdownFilter[t].length&&this.container.find("."+o.options.selector.filterButton).removeAttr("style")}function c(t){"*"===t.value?delete this.filters.dropdown:this.filters.dropdown=t,this.container.removeClass("filter").find("."+this.options.selector.filterButton).html(t.template),this.isDropdownEvent=!0,this.node.trigger("input"+this.namespace),this.options.multiselect&&this.adjustInputSize(),this.node.focus()}},dynamicFilter:{isEnabled:!1,init:function(){this.options.dynamicFilter&&(this.dynamicFilter.bind.call(this),this.dynamicFilter.isEnabled=!0)},validate:function(t){var e,i,s=null,o=null;for(var n in this.filters.dynamic)if(this.filters.dynamic.hasOwnProperty(n)&&(i=~n.indexOf(".")?this.helper.namespace.call(this,n,t,"get"):t[n],"|"!==this.filters.dynamic[n].modifier||s||(s=i==this.filters.dynamic[n].value||!1),"&"===this.filters.dynamic[n].modifier)){if(i!=this.filters.dynamic[n].value){o=!1;break}o=!0}return e=s,null!==o&&!0===(e=o)&&null!==s&&(e=s),!!e},set:function(t,e){var i=t.match(/^([|&])?(.+)/);e?this.filters.dynamic[i[2]]={modifier:i[1]||"|",value:e}:delete this.filters.dynamic[i[2]],this.dynamicFilter.isEnabled&&this.generateSource()},bind:function(){for(var t,e=this,i=0,s=this.options.dynamicFilter.length;i<s;i++)"string"==typeof(t=this.options.dynamicFilter[i]).selector&&(t.selector=j(t.selector)),t.selector instanceof j&&t.selector[0]&&t.key&&function(t){t.selector.off(e.namespace).on("change"+e.namespace,function(){e.dynamicFilter.set.apply(e,[t.key,e.dynamicFilter.getValue(this)])}).trigger("change"+e.namespace)}(t)},getValue:function(t){var e;return"SELECT"===t.tagName?e=t.value:"INPUT"===t.tagName&&("checkbox"===t.type?e=t.checked&&t.getAttribute("value")||t.checked||null:"radio"===t.type&&t.checked&&(e=t.value)),e}},buildMultiselectLayout:function(){if(this.options.multiselect){var t,e=this;this.label.container=j("<span/>",{class:this.options.selector.labelContainer,"data-padding-left":parseFloat(this.node.css("padding-left"))||0,"data-padding-right":parseFloat(this.node.css("padding-right"))||0,"data-padding-top":parseFloat(this.node.css("padding-top"))||0,click:function(t){j(t.target).hasClass(e.options.selector.labelContainer)&&e.node.focus()}}),this.node.closest("."+this.options.selector.query).prepend(this.label.container),this.options.multiselect.data&&(Array.isArray(this.options.multiselect.data)?this.populateMultiselectData(this.options.multiselect.data):"function"==typeof this.options.multiselect.data&&(t=this.options.multiselect.data.call(this),Array.isArray(t)?this.populateMultiselectData(t):"function"==typeof t.promise&&j.when(t).then(function(t){t&&Array.isArray(t)&&e.populateMultiselectData(t)})))}},isMultiselectUniqueData:function(t){for(var e=!0,i=0,s=this.comparedItems.length;i<s;++i)if(this.comparedItems[i]===this.getMultiselectComparedData(t)){e=!1;break}return e},populateMultiselectData:function(t){for(var e=0,i=t.length;e<i;++e)this.addMultiselectItemLayout(t[e]);this.node.trigger("search"+this.namespace,{origin:"populateMultiselectData"})},addMultiselectItemLayout:function(t){if(this.isMultiselectUniqueData(t)){this.items.push(t),this.comparedItems.push(this.getMultiselectComparedData(t));var e,i=this.getTemplateValue(t),s=this,o=this.options.multiselect.href?"a":"span",n=j("<span/>",{class:this.options.selector.label,html:j("<"+o+"/>",{text:i,click:function(t){var e=j(this).closest("."+s.options.selector.label),i=s.label.container.find("."+s.options.selector.label).index(e);s.options.multiselect.callback&&s.helper.executeCallback.call(s,s.options.multiselect.callback.onClick,[s.node,s.items[i],t])},href:this.options.multiselect.href?(e=s.items[s.items.length-1],s.generateHref.call(s,s.options.multiselect.href,e)):null})});return n.append(j("<span/>",{class:this.options.selector.cancelButton,html:"×",click:function(t){var e=j(this).closest("."+s.options.selector.label),i=s.label.container.find("."+s.options.selector.label).index(e);s.cancelMultiselectItem(i,e,t)}})),this.label.container.append(n),this.adjustInputSize(),!0}},cancelMultiselectItem:function(t,e,i){var s=this.items[t];(e=e||this.label.container.find("."+this.options.selector.label).eq(t)).remove(),this.items.splice(t,1),this.comparedItems.splice(t,1),this.options.multiselect.callback&&this.helper.executeCallback.call(this,this.options.multiselect.callback.onCancel,[this.node,s,i]),this.adjustInputSize(),this.focusOnly=!0,this.node.focus().trigger("input"+this.namespace,{origin:"cancelMultiselectItem"})},adjustInputSize:function(){var i=this.node[0].getBoundingClientRect().width-(parseFloat(this.label.container.data("padding-right"))||0)-(parseFloat(this.label.container.css("padding-left"))||0),s=0,o=0,n=0,r=!1,a=0;this.label.container.find("."+this.options.selector.label).filter(function(t,e){0===t&&(a=j(e)[0].getBoundingClientRect().height+parseFloat(j(e).css("margin-bottom")||0)),s=j(e)[0].getBoundingClientRect().width+parseFloat(j(e).css("margin-right")||0),.7*i<n+s&&!r&&(o++,r=!0),n+s<i?n+=s:(r=!1,n=s)});var t=parseFloat(this.label.container.data("padding-left")||0)+(r?0:n),e=o*a+parseFloat(this.label.container.data("padding-top")||0);this.container.find("."+this.options.selector.query).find("input, textarea, [contenteditable], .typeahead__hint").css({paddingLeft:t,paddingTop:e})},showLayout:function(){!this.container.hasClass("result")&&(this.result.length||this.displayEmptyTemplate||this.options.backdropOnFocus)&&(function(){var e=this;j("html").off("keydown"+this.namespace).on("keydown"+this.namespace,function(t){t.keyCode&&9===t.keyCode&&setTimeout(function(){j(":focus").closest(e.container).find(e.node)[0]||e.hideLayout()},0)}),j("html").off("click"+this.namespace+" touchend"+this.namespace).on("click"+this.namespace+" touchend"+this.namespace,function(t){j(t.target).closest(e.container)[0]||j(t.target).closest("."+e.options.selector.item)[0]||t.target.className===e.options.selector.cancelButton||e.hasDragged||e.hideLayout()})}.call(this),this.container.addClass([this.result.length||this.searchGroups.length&&this.displayEmptyTemplate?"result ":"",this.options.hint&&this.searchGroups.length?"hint":"",this.options.backdrop||this.options.backdropOnFocus?"backdrop":""].join(" ")),this.helper.executeCallback.call(this,this.options.callback.onShowLayout,[this.node,this.query]))},hideLayout:function(){(this.container.hasClass("result")||this.container.hasClass("backdrop"))&&(this.container.removeClass("result hint filter"+(this.options.backdropOnFocus&&j(this.node).is(":focus")?"":" backdrop")),this.options.backdropOnFocus&&this.container.hasClass("backdrop")||(j("html").off(this.namespace),this.helper.executeCallback.call(this,this.options.callback.onHideLayout,[this.node,this.query])))},resetLayout:function(){this.result=[],this.tmpResult={},this.groups=[],this.resultCount=0,this.resultCountPerGroup={},this.resultItemCount=0,this.resultHtml=null,this.options.hint&&this.hint.container&&(this.hint.container.val(""),this.isContentEditable&&this.hint.container.text(""))},resetInput:function(){this.node.val(""),this.isContentEditable&&this.node.text(""),this.query="",this.rawQuery=""},buildCancelButtonLayout:function(){if(this.options.cancelButton){var e=this;j("<span/>",{class:this.options.selector.cancelButton,html:"×",mousedown:function(t){t.stopImmediatePropagation(),t.preventDefault(),e.resetInput(),e.node.trigger("input"+e.namespace,[t])}}).insertBefore(this.node)}},toggleCancelButtonVisibility:function(){this.container.toggleClass("cancel",!!this.query.length)},__construct:function(){this.extendOptions(),this.unifySourceFormat()&&(this.dynamicFilter.init.apply(this),this.init(),this.buildDropdownLayout(),this.buildDropdownItemLayout("static"),this.buildMultiselectLayout(),this.delegateEvents(),this.buildCancelButtonLayout(),this.helper.executeCallback.call(this,this.options.callback.onReady,[this.node]))},helper:{isEmpty:function(t){for(var e in t)if(t.hasOwnProperty(e))return!1;return!0},removeAccent:function(t){if("string"==typeof t){var e=o;return"object"==typeof this.options.accent&&(e=this.options.accent),t=t.toLowerCase().replace(new RegExp("["+e.from+"]","g"),function(t){return e.to[e.from.indexOf(t)]})}},slugify:function(t){return""!==(t=String(t))&&(t=(t=this.helper.removeAccent.call(this,t)).replace(/[^-a-z0-9]+/g,"-").replace(/-+/g,"-").replace(/^-|-$/g,"")),t},sort:function(s,i,o){function n(t){for(var e=0,i=s.length;e<i;e++)if(void 0!==t[s[e]])return o(t[s[e]]);return t}return i=[-1,1][+!!i],function(t,e){return t=n(t),e=n(e),i*((e<t)-(t<e))}},replaceAt:function(t,e,i,s){return t.substring(0,e)+s+t.substring(e+i)},highlight:function(t,e,i){t=String(t);var s=i&&this.helper.removeAccent.call(this,t)||t,o=[];Array.isArray(e)||(e=[e]),e.sort(function(t,e){return e.length-t.length});for(var n=e.length-1;0<=n;n--)""!==e[n].trim()?e[n]=e[n].replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&"):e.splice(n,1);s.replace(new RegExp("(?:"+e.join("|")+")(?!([^<]+)?>)","gi"),function(t,e,i){o.push({offset:i,length:t.length})});for(n=o.length-1;0<=n;n--)t=this.helper.replaceAt(t,o[n].offset,o[n].length,"<strong>"+t.substr(o[n].offset,o[n].length)+"</strong>");return t},getCaret:function(t){var e=0;if(t.selectionStart)return t.selectionStart;if(document.selection){var i=document.selection.createRange();if(null===i)return e;var s=t.createTextRange(),o=s.duplicate();s.moveToBookmark(i.getBookmark()),o.setEndPoint("EndToStart",s),e=o.text.length}else if(window.getSelection){var n=window.getSelection();if(n.rangeCount){var r=n.getRangeAt(0);r.commonAncestorContainer.parentNode==t&&(e=r.endOffset)}}return e},setCaretAtEnd:function(t){if(void 0!==window.getSelection&&void 0!==document.createRange){var e=document.createRange();e.selectNodeContents(t),e.collapse(!1);var i=window.getSelection();i.removeAllRanges(),i.addRange(e)}else if(void 0!==document.body.createTextRange){var s=document.body.createTextRange();s.moveToElementText(t),s.collapse(!1),s.select()}},cleanStringFromScript:function(t){return"string"==typeof t&&t.replace(/<\/?(?:script|iframe)\b[^>]*>/gm,"")||t},executeCallback:function(t,e){if(t){var i;if("function"==typeof t)i=t;else if(("string"==typeof t||Array.isArray(t))&&("string"==typeof t&&(t=[t,[]]),"function"!=typeof(i=this.helper.namespace.call(this,t[0],window))))return;return i.apply(this,(t[1]||[]).concat(e||[]))}},namespace:function(t,e,i,s){if("string"!=typeof t||""===t)return!1;var o=void 0!==s?s:void 0;if(!~t.indexOf("."))return e[t]||o;for(var n=t.split("."),r=e||window,a=(i=i||"get",""),l=0,h=n.length;l<h;l++){if(void 0===r[a=n[l]]){if(~["get","delete"].indexOf(i))return void 0!==s?s:void 0;r[a]={}}if(~["set","create","delete"].indexOf(i)&&l===h-1){if("set"!==i&&"create"!==i)return delete r[a],!0;r[a]=o}r=r[a]}return r},typeWatch:(i=0,function(t,e){clearTimeout(i),i=setTimeout(t,e)})}},j.fn.typeahead=j.typeahead=function(t){return e.typeahead(this,t)};var e={typeahead:function(t,e){if(e&&e.source&&"object"==typeof e.source){if("function"==typeof t){if(!e.input)return;t=j(e.input)}if(t.length){if(void 0===t[0].value&&(t[0].value=t.text()),1===t.length)return t[0].selector=t.selector||e.input||t[0].nodeName.toLowerCase(),window.Typeahead[t[0].selector]=new r(t,e);for(var i,s={},o=0,n=t.length;o<n;++o)void 0!==s[i=t[o].nodeName.toLowerCase()]&&(i+=o),t[o].selector=i,window.Typeahead[i]=s[i]=new r(t.eq(o),e);return s}}}};return window.console=window.console||{log:function(){}},Array.isArray||(Array.isArray=function(t){return"[object Array]"===Object.prototype.toString.call(t)}),"trim"in String.prototype||(String.prototype.trim=function(){return this.replace(/^\s+/,"").replace(/\s+$/,"")}),"indexOf"in Array.prototype||(Array.prototype.indexOf=function(t,e){void 0===e&&(e=0),e<0&&(e+=this.length),e<0&&(e=0);for(var i=this.length;e<i;e++)if(e in this&&this[e]===t)return e;return-1}),Object.keys||(Object.keys=function(t){var e,i=[];for(e in t)Object.prototype.hasOwnProperty.call(t,e)&&i.push(e);return i}),r});
function copyTextfnNew(k) {
  /* Get the text field */
  var copyText = $(k).find('input') ;
 
  /* Select the text field */
  copyText.select();
  //copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  
}
function savestatist2(e,a){
  
var cas = 'C';var reactid = $(e).attr("data-prop");
 $.get(statistics+'/case/'+cas+'/reactid/'+reactid,function(data){ 
 
 $(e).removeAttr("onclick");
 var t=Base64.decode(a);
 $(e).attr("href","tel:"+t);
 if($(e).hasClass("tooltipm")){
	 ($(e).find(".nm-cls").html(t),$(e).addClass("dynamicopt"),setTimeout(function(){$(e).removeClass("dynamicopt")},3e3));
	 }
	 else{
		 if(!$(e).hasClass('mob-not-fetc')){
			 $(e).addClass('dir-ltr');
		 $(e).html(t);
		 }
		 setTimeout(function() { $(e).click();  }, 500);
	 }
 
 })
}
function emailCase(k){
	var str = $(k).val();
	var strLower = str.toLowerCase();
	$(k).val(strLower.replace(/\s/g, ''));
}
function savestatist(cas,reactid){
 $.get(statistics+'/case/'+cas+'/reactid/'+reactid,function(data){})
}
function removethisCookie(){ $('#s-cookies-notification').hide(); }
    function setAcceptCookiex(k){
		var acceptUrl= $(k).attr('data-url');
	
		if(acceptUrl !== undefined){
			$(k).html('Loading..');  
			$.get(acceptUrl,function(data){
				if(data=='1'){
					removethisCookie();
					}
				})
		}
	}  function smoothScrol(){
		 document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
}
    function OpenWindow(id){
             windowpopup = true; 
             if(id=='1'){
            var url = baseid+'site/login/service/google_oauth';  
             }
             else  if(id=='6'){
            var url = baseid+'site/login/service/apple';  
             }
             else{
                    var url = baseid+'site/login/service/facebook'; 
             }
            var windowName = 'sociallogin'; 
             
            if($('html').hasClass('hidemenuiphone')){
                location.href = url;return false; 
            }
            newwindow=window.open(url,windowName,'height=600,width=650');
            
            
                var timer2 = setInterval(function(){
          if (typeof newwindow !== 'undefined' && windowpopup) {
   if(newwindow.closed){
      windowpopup = false; 
        
   }
         }
},1000);
            
            if (window.focus) { newwindow.focus()}
            return false;
            
     }
 
function areaUnitChanger(){
	$('#myModal-changeUnit').modal('show')
}
function changeOrderN(e){var o=$(e).val();void 0!==o&&($("#sort_val").val(o),search_byAjax())}
function showUpdateEdit(){$("#showUpdateEdit").removeClass("hide"),$("#showUpdateEdit").find("textarea").focus()}function showWithoutTrim(t){$("#txttrim").hasClass("texttrim-enabled")?($("#txttrim").removeClass("texttrim-enabled"),$("#asss2").focus(),$(t).html("Read Less")):($("#txttrim").addClass("texttrim-enabled"),$("#asss").focus(),$(t).html("Read More"))}
function blogSlick(){$("#content-blgsection").slick({infinite:!1,slidesToShow:8,slidesToScroll:1,responsive:[{breakpoint:992,settings:{slidesToShow:8,slidesToScroll:1}},,{breakpoint:767,settings:{slidesToShow:6,slidesToScroll:1}},{breakpoint:568,settings:{slidesToShow:4.5,slidesToScroll:1}},{breakpoint:479,settings:{slidesToShow:3.5,slidesToScroll:1}}]})}
var temp_lat = '';    var temp_lng = '';    var map;    var infowindow;
function placeMarker(a){new google.maps.Marker({position:a,map:map})}
function showPosition(e){temp_lat=e.coords.latitude,temp_lng=e.coords.longitude} 
function maplinkclick(){
	  $("#myTab a").click(function(e){
        e.preventDefault();
        $('#myTab').find('.nav-link').removeClass('active');
        $(this).addClass('active');
        var hrf = $(this).attr('href');
        $('.tab-pane').removeClass('show active')
        $(hrf).addClass('show active')
    });
}
function autocompleteLocationJson() {
    	if(typeof selectted_city != "undefined"){
			if (autoComplete2.length == '0' || selectted_city!='') {
			autoComplete2 = [];
			$.getJSON(load_location_ajax_json, function(data) {
			$.each(data,function(k,v){
			if(selectted_city.trim()==v.state.trim()){
			//autoComplete2[] = v; 
			autoComplete2.push(v)
			}
			}) 
			// autoComplete2 = data;
			console.log(autoComplete2)
			createAutocomplete();

			});
			} else {
			console.log("Not From List")
			createAutocomplete();
			}
	}
	else{
	if(autoComplete2.length == '0'){
	$.getJSON(load_location_ajax_json, function(data) {
		autoComplete2 = data; 
		 createAutocomplete();
  
	});
	}
	else{
		 console.log("Not From List")
		 createAutocomplete();
	}
	}
}


function changeInptu(){
	if($('#word').val() != $("#word_hidden").val() ){
					 $("#word_hidden").val($('#word').val()).change();
				 }
}
function createAutocomplete(){
	  $("#word").autocomplete({
        lookup: autoComplete2,
        minChars: 1,
         lookupLimit:40,
        autoSelectFirst: false,
        appendTo: "#keyword_a",
             onSelect: function (suggestion) {
				 if(suggestion.value != $("#word_hidden").val() ){
					 $("#word_hidden").removeAttr("onchange");
					 $("#hidden").removeAttr("onchange");
					 $("#word_hidden").val(suggestion.value);
					  $("#word").val(suggestion.name);
				 
					 search_byAjax();
				 }
        console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
    },
    onChange: function (value) {
        console.log(value);
    },
       
        formatResult: function(t) {
            return "<span class='suggestion-wrapper'><span class='suggestion-value'>" + t.name + "</span><span class='sub-text'>" + t.state + "</span></span>"
        }
    })
}
function createAutocompleteNormal(t, e) {
    
    $("#" + t).autocomplete({
        lookup: autoComplete2,
        minChars: 1,
        lookupLimit:40, 
        autoSelectFirst: !1,
        appendTo: "#" + e,
        onSelect: function(ts) { $("#" + t).val(ts.name).change(); },
        formatResult: function(ts) {
            return "<span class='suggestion-wrapper'><span class='suggestion-value'>" + ts.name + "</span><span class='sub-text'>" + ts.state + "</span></span>"
        }
    })
}
function autocompleteLocation2JSON(t, e) {
   if(autoComplete2.length == '0'){
 
	$.getJSON(load_location_ajax_json, function(data) {
		autoComplete2 = data; 
		 createAutocompleteNormal(t, e) 
  
	});
	}
	else{
		 
		createAutocompleteNormal(t, e) ;
	}
}
function processaddon(k) {
    $.jAlert({
        'type': 'confirm',
        'confirmQuestion': 'Are you sure to add this package?',
        'onConfirm': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            var url_load = $(k).attr('data-href');
            if (url_load !== undefined) {
                $('.loader').html('<div class="cntr"><div class="loaderspin"></div></div><div class="bg"></div>');
                $('.loader').addClass('loading');
                $.get(url_load, function(data) {

                    $('.loader').html('<div class="contenth">' + data + '</div><div class="bg"></div>');

                })
            }
            return false;
        },
        'onDeny': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            return false;
        }
    });

}
function OpenthiMod(k){
	$('#modal_komplain').modal('show');
	$('#html_b').html($(k).find('.mhtml').html())
}
function processrefresh(k) {
			 
    $.jAlert({
        'type': 'confirm',
        'confirmQuestion': 'Are you sure to refresh this Ad?',
        'onConfirm': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            var url_load = $(k).attr('data-href');
            if (url_load !== undefined) {
                $('.loaderi').html('<div class="cntr"><div class="loaderispin"></div></div><div class="bg"></div>');
                $('.loaderi').addClass('loading');
                $.get(url_load, function(data) {

                    $('.loaderi').html('<div class="contenth">' + data + '</div><div class="bg"></div>');

                })
            }
            return false;
        },
        'onDeny': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            return false;
        }
    });

}
function processfeatured(k) {
    $.jAlert({
        'type': 'confirm',
        'confirmQuestion': add_feat,
         'confirmBtnText': yes_text,
        'denyBtnText': no_text,
        'onConfirm': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            var url_load = $(k).attr('data-href');
            if (url_load !== undefined) {
                $('.loaderi').html('<div class="cntr"><div class="loaderispin"></div></div><div class="bg"></div>');
                $('.loaderi').addClass('loading');
                $.get(url_load, function(data) {

                    $('.loaderi').html('<div class="contenth">' + data + '</div><div class="bg"></div>');

                })
            }
            return false;
        },
        'onDeny': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            return false;
        }
    });

}
var ajax_location;				
 var ajax_title;				
 var ajax_body_id;	
 function closePopupGetail(){
	  
	 history.replaceState(null, ajax_title, ajax_location);
	 $('#details-page-container').removeClass('active-view');
	 $('#details-page-container').html('');$('body').removeClass("openimage");$('body').removeClass("openamenity");
	 //$('body').removeClass('ovrflw-bdy');
	 $('body').attr("id","listing");$('body').removeClass('on-detail-page');
	 document.title = ajax_title;
    // window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
 }
 $(function(){$.fancybox.defaults.hash = false; closeOutside(); })
 function closeOutside(){
 $(document).on('click',function(e) 
{
    var containerclose = $("#details-page-container.active-view").find('#its_detail_page');
	
    // if the target of the click isn't the container nor a descendant of the container
    if (containerclose.is(e.target)  && containerclose.length=='1' ) 
    {
		 
		  closePopupGetail()
    }
});

	  $('body#listing').keydown(function(e) {
  
    // ESCAPE key pressed
    console.log(e.keyCode);
    if (e.keyCode == 27) {  e.preventDefault();
	if($('body').hasClass('on-detail-page')){
	 
         closePopupGetail();
	 }
    }
});  
}
 	
function easyload2(k,e,id){
				e.preventDefault();
			  ajax_location = window.location.href ;
			  ajax_title =  document.title ;
			  ajax_body_id =  'listing' ;
			 
				var containerID =  document.getElementById(id);
				$('#'+id).addClass('active-view');
				if(id == 'details-page-container'){$('body').addClass('on-detail-page'); }else{  $('body').removeClass('on-detail-page');}
			//	$('body').addClass('ovrflw-bdy');
				var page_url = $(k).attr('href');
				NProgress.start();
				$.pjax({url: page_url , container:'#'+id,  timeout: 110000 ,scrollTo: false,cache:false   }).complete(function(){	
					scroId(id);NProgress.done(); 
					if($('form.recapt').length > 0 ){
										
										onloadCallback() ;
									} 
					
						});
			}
function saveVideo(e,t,i,r){i?alert("error"):$.ajax({type:"POST",url:r,data:e.serialize(),success:function(e){$(".loaderi").html('<div class="contenth">'+e+'</div><div class="bg"></div>')}})}function processvideo(e){$.jAlert({type:"confirm",confirmQuestion:"Are you sure to add Youtube video?",onConfirm:function(t,i){t.preventDefault(),i.parents(".jAlert").closeAlert();var r=$(e).attr("data-href");return void 0!==r&&($(".loaderi").html('<div class="cntr"><div class="loaderispin"></div></div><div class="bg"></div>'),$(".loaderi").addClass("loading"),$.get(r,function(e){$(".loaderi").html('<div class="contenth">'+e+'</div><div class="bg"></div>')})),!1},onDeny:function(e,t){return e.preventDefault(),t.parents(".jAlert").closeAlert(),!1}})}

function closePoputi() {
    $('.loader').removeClass('loading');
}

function closePoputif() {
    $('.loaderi').removeClass('loading');
}
function recentSlick(){$("#content-recente").slick({infinite:!1,slidesToShow:4,slidesToScroll:4,rtl:isRtl,responsive:[{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:1}},,{breakpoint:767,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:568,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:320,settings:{slidesToShow:2,slidesToScroll:2}}]})}
function viewedSlick(){$("#search-viewd").slick({infinite:!1,slidesToShow:4,slidesToScroll:4,rtl:isRtl,responsive:[{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:1}},,{breakpoint:767,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:568,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:320,settings:{slidesToShow:1,slidesToScroll:1}}]})}
function closePoputifsuccess() {
    location.reload();
}
function loadDetails() {
    $(".loadCnter").addClass("fetching"), $.get(user_details_info_url, function(e) {
        if ($(".loadCnter").removeClass("fetching"), "0" != e) switch (user_defined = !0, $("#no_userli").html(e), userCase) {
            case "report":
                $(current_val_k).click();
                break;
            case "mortgage":
   
                $(current_val_k).click();
                break;
                 case "submit_property":
                $(current_val_k).click();
                break;
            case "email2":
   
                $('#frm_ctnt1').submit();
                break;
            case "email":
                $(current_val_k).click();
                break;
                 case"oemail":var o;if(void 0!==(o=$(current_val_k).attr("data-email"))){$(current_val_k).removeAttr("onclick");t= o ;$(current_val_k).attr("href","mailto:"+t),$(current_val_k).html(t)}
                 break;
            case "whatsapp":
                
                if (void 0 !== (t = $(current_val_k).attr("data-href"))) {
                    $(current_val_k).removeAttr("onclick");
                    var a =  t ;
                    $(current_val_k).attr("href", a); $(current_val_k).click(); 
                }
                break;
            case "call":
                var t;
                 if (void 0 !== (t = $(current_val_k).attr("data-phone"))) {
                    savestatist('C', $(current_val_k).attr("data-prop"));
                    $(current_val_k).removeAttr("onclick");
                    a = Base64.decode(t);
                    $(current_val_k).attr("href", "tel:" + a);
                    if($(current_val_k).hasClass("tooltipm") ){
						 $(current_val_k).find(".nm-cls").html(a);
						 $(current_val_k).addClass("dynamicopt");
						 setTimeout(function() { $(current_val_k).removeClass("dynamicopt") }, 3e3);
					}else{
								if(!$(current_val_k).hasClass('mob-not-fetc')){
								    $(current_val_k).addClass('dir-ltr');
											$(current_val_k).html(a);
											
								}
								setTimeout(function() { $(current_val_k).click(); }, 500);
				   }
                }
                break;
        }
    })
}
function autocompleteLocation2JSONn(t,e){autoComplete2n=[],""!=selected_text?$.each(autoComplete2,function(t,e){selected_text.trim()==e.state.trim()&&autoComplete2n.push(e)}):autoComplete2n=autoComplete2,createAutocompleteNormaln(t,e)}function createAutocompleteNormaln(t,e){$("#"+t).autocomplete({lookup:autoComplete2n,minChars:1,lookupLimit:40,autoSelectFirst:!1,appendTo:"#"+e,onSelect:function(e){$("#"+t).val(e.name).change()},formatResult:function(t){return"<span class='suggestion-wrapper'><span class='suggestion-value'>"+t.name+"</span><span class='sub-text'>"+t.state+"</span></span>"}})}var cityid,selected_text;function getSelecttedText(t,e,o){$(function(){selected_text=""!=$(t).val()?$(t).find(" option:selected").text():"",autocompleteLocation2JSONn(e,o)})}
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports&&"function"==typeof require?t(require("jquery")):t(jQuery)}(function(t){"use strict";var e={escapeRegExChars:function(t){return t.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")},createNode:function(t){var e=document.createElement("div");return e.className=t,e.style.position="absolute",e.style.display="none",e}},s=27,i=9,n=13,o=38,a=39,l=40;function r(e,s){var i=function(){},n={ajaxSettings:{},autoSelectFirst:!1,appendTo:document.body,serviceUrl:null,lookup:null,onSelect:null,width:"auto",minChars:1,maxHeight:300,deferRequestBy:0,params:{},formatResult:r.formatResult,delimiter:null,zIndex:9999,type:"GET",noCache:!1,onSearchStart:i,onSearchComplete:i,onSearchError:i,preserveInput:!1,containerClass:"autocomplete-suggestions",tabDisabled:!1,dataType:"text",currentRequest:null,triggerSelectOnValidInput:!0,preventBadQueries:!0,lookupFilter:function(t,e,s){return-1!==t.value.toLowerCase().indexOf(s)},paramName:"query",transformResult:function(e){return"string"==typeof e?t.parseJSON(e):e},showNoSuggestionNotice:!1,noSuggestionNotice:"No results",orientation:"bottom",forceFixPosition:!1};this.element=e,this.el=t(e),this.suggestions=[],this.badQueries=[],this.selectedIndex=-1,this.currentValue=this.element.value,this.intervalId=0,this.cachedResponse={},this.onChangeInterval=null,this.onChange=null,this.isLocal=!1,this.suggestionsContainer=null,this.noSuggestionsContainer=null,this.options=t.extend({},n,s),this.classes={selected:"autocomplete-selected",suggestion:"autocomplete-suggestion"},this.hint=null,this.hintValue="",this.selection=null,this.initialize(),this.setOptions(s)}r.utils=e,t.Autocomplete=r,r.formatResult=function(t,s){var i="("+e.escapeRegExChars(s)+")";return t.value.replace(new RegExp(i,"gi"),"<strong>$1</strong>")},r.prototype={killerFn:null,initialize:function(){var e,s=this,i="."+s.classes.suggestion,n=s.classes.selected,o=s.options;s.element.setAttribute("autocomplete","off"),s.killerFn=function(e){0===t(e.target).closest("."+s.options.containerClass).length&&(s.killSuggestions(),s.disableKillerFn())},s.noSuggestionsContainer=t('<div class="autocomplete-no-suggestion"></div>').html(this.options.noSuggestionNotice).get(0),s.suggestionsContainer=r.utils.createNode(o.containerClass),(e=t(s.suggestionsContainer)).appendTo(o.appendTo),"auto"!==o.width&&e.width(o.width),e.on("mouseover.autocomplete",i,function(){s.activate(t(this).data("index"))}),e.on("mouseout.autocomplete",function(){s.selectedIndex=-1,e.children("."+n).removeClass(n)}),e.on("click.autocomplete",i,function(){s.select(t(this).data("index"))}),s.fixPositionCapture=function(){s.visible&&s.fixPosition()},t(window).on("resize.autocomplete",s.fixPositionCapture),s.el.on("keydown.autocomplete",function(t){s.onKeyPress(t)}),s.el.on("keyup.autocomplete",function(t){s.onKeyUp(t)}),s.el.on("blur.autocomplete",function(){s.onBlur()}),s.el.on("focus.autocomplete",function(){s.onFocus()}),s.el.on("change.autocomplete",function(t){s.onKeyUp(t)}),s.el.on("input.autocomplete",function(t){s.onKeyUp(t)})},onFocus:function(){this.fixPosition(),this.options.minChars<=this.el.val().length&&this.onValueChange()},onBlur:function(){this.enableKillerFn()},setOptions:function(e){var s=this.options;t.extend(s,e),this.isLocal=t.isArray(s.lookup),this.isLocal&&(s.lookup=this.verifySuggestionsFormat(s.lookup)),s.orientation=this.validateOrientation(s.orientation,"bottom"),t(this.suggestionsContainer).css({"max-height":s.maxHeight+"px",width:s.width+"px","z-index":s.zIndex})},clearCache:function(){this.cachedResponse={},this.badQueries=[]},clear:function(){this.clearCache(),this.currentValue="",this.suggestions=[]},disable:function(){this.disabled=!0,clearInterval(this.onChangeInterval),this.currentRequest&&this.currentRequest.abort()},enable:function(){this.disabled=!1},fixPosition:function(){var e=t(this.suggestionsContainer),s=e.parent().get(0);if(s===document.body||this.options.forceFixPosition){var i=this.options.orientation,n=e.outerHeight(),o=this.el.outerHeight(),a=this.el.offset(),l={top:a.top,left:a.left};if("auto"===i){var r=t(window).height(),u=t(window).scrollTop(),h=-u+a.top-n,c=u+r-(a.top+o+n);i=Math.max(h,c)===h?"top":"bottom"}if(l.top+="top"===i?-n:o,s!==document.body){var g,d=e.css("opacity");this.visible||e.css("opacity",0).show(),g=e.offsetParent().offset(),l.top-=g.top,l.left-=g.left,this.visible||e.css("opacity",d).hide()}"auto"===this.options.width&&(l.width=this.el.outerWidth()-2+"px"),e.css(l)}},enableKillerFn:function(){t(document).on("click.autocomplete",this.killerFn)},disableKillerFn:function(){t(document).off("click.autocomplete",this.killerFn)},killSuggestions:function(){var t=this;t.stopKillSuggestions(),t.intervalId=window.setInterval(function(){t.hide(),t.stopKillSuggestions()},50)},stopKillSuggestions:function(){window.clearInterval(this.intervalId)},isCursorAtEnd:function(){var t,e=this.el.val().length,s=this.element.selectionStart;return"number"==typeof s?s===e:!document.selection||((t=document.selection.createRange()).moveStart("character",-e),e===t.text.length)},onKeyPress:function(t){if(this.disabled||this.visible||t.which!==l||!this.currentValue){if(!this.disabled&&this.visible){switch(t.which){case s:this.el.val(this.currentValue),this.hide();break;case a:if(this.hint&&this.options.onHint&&this.isCursorAtEnd()){this.selectHint();break}return;case i:if(this.hint&&this.options.onHint)return void this.selectHint();if(-1===this.selectedIndex)return void this.hide();if(this.select(this.selectedIndex),!1===this.options.tabDisabled)return;break;case n:if(-1===this.selectedIndex)return void this.hide();this.select(this.selectedIndex);break;case o:this.moveUp();break;case l:this.moveDown();break;default:return}t.stopImmediatePropagation(),t.preventDefault()}}else this.suggest()},onKeyUp:function(t){var e=this;if(!e.disabled){switch(t.which){case o:case l:return}clearInterval(e.onChangeInterval),e.currentValue!==e.el.val()&&(e.findBestHint(),e.options.deferRequestBy>0?e.onChangeInterval=setInterval(function(){e.onValueChange()},e.options.deferRequestBy):e.onValueChange())}},onValueChange:function(){var e,s=this.options,i=this.el.val(),n=this.getQuery(i);this.selection&&this.currentValue!==n&&(this.selection=null,(s.onInvalidateSelection||t.noop).call(this.element)),clearInterval(this.onChangeInterval),this.currentValue=i,this.selectedIndex=-1,s.triggerSelectOnValidInput&&-1!==(e=this.findSuggestionIndex(n))?this.select(e):n.length<s.minChars?this.hide():this.getSuggestions(n)},findSuggestionIndex:function(e){var s=-1,i=e.toLowerCase();return t.each(this.suggestions,function(t,e){if(e.value.toLowerCase()===i)return s=t,!1}),s},getQuery:function(e){var s,i=this.options.delimiter;return i?(s=e.split(i),t.trim(s[s.length-1])):e},getSuggestionsLocal:function(e){var s,i=this.options,n=e.toLowerCase(),o=i.lookupFilter,a=parseInt(i.lookupLimit,10);return s={suggestions:t.grep(i.lookup,function(t){return o(t,e,n)})},a&&s.suggestions.length>a&&(s.suggestions=s.suggestions.slice(0,a)),s},getSuggestions:function(e){var s,i,n,o,a=this,l=a.options,r=l.serviceUrl;l.params[l.paramName]=e,i=l.ignoreParams?null:l.params,!1!==l.onSearchStart.call(a.element,l.params)&&(t.isFunction(l.lookup)?l.lookup(e,function(t){a.suggestions=t.suggestions,a.suggest(),l.onSearchComplete.call(a.element,e,t.suggestions)}):(a.isLocal?s=a.getSuggestionsLocal(e):(t.isFunction(r)&&(r=r.call(a.element,e)),n=r+"?"+t.param(i||{}),s=a.cachedResponse[n]),s&&t.isArray(s.suggestions)?(a.suggestions=s.suggestions,a.suggest(),l.onSearchComplete.call(a.element,e,s.suggestions)):a.isBadQuery(e)?l.onSearchComplete.call(a.element,e,[]):(a.currentRequest&&a.currentRequest.abort(),o={url:r,data:i,type:l.type,dataType:l.dataType},t.extend(o,l.ajaxSettings),a.currentRequest=t.ajax(o).done(function(t){var s;a.currentRequest=null,s=l.transformResult(t),a.processResponse(s,e,n),l.onSearchComplete.call(a.element,e,s.suggestions)}).fail(function(t,s,i){l.onSearchError.call(a.element,e,t,s,i)}))))},isBadQuery:function(t){if(!this.options.preventBadQueries)return!1;for(var e=this.badQueries,s=e.length;s--;)if(0===t.indexOf(e[s]))return!0;return!1},hide:function(){this.visible=!1,this.selectedIndex=-1,clearInterval(this.onChangeInterval),t(this.suggestionsContainer).hide(),this.signalHint(null)},suggest:function(){if(0!==this.suggestions.length){var e,s,i=this.options,n=i.groupBy,o=i.formatResult,a=this.getQuery(this.currentValue),l=this.classes.suggestion,r=this.classes.selected,u=t(this.suggestionsContainer),h=t(this.noSuggestionsContainer),c=i.beforeRender,g="";i.triggerSelectOnValidInput&&-1!==(s=this.findSuggestionIndex(a))?this.select(s):(t.each(this.suggestions,function(t,s){n&&(g+=function(t,s){var i=t.data[n];return e===i?"":'<div class="autocomplete-group"><strong>'+(e=i)+"</strong></div>"}(s,0)),g+='<div class="'+l+'" data-index="'+t+'">'+o(s,a)+"</div>"}),this.adjustContainerWidth(),h.detach(),u.html(g),t.isFunction(c)&&c.call(this.element,u),this.fixPosition(),u.show(),i.autoSelectFirst&&(this.selectedIndex=0,u.scrollTop(0),u.children().first().addClass(r)),this.visible=!0,this.findBestHint())}else this.options.showNoSuggestionNotice?this.noSuggestions():this.hide()},noSuggestions:function(){var e=t(this.suggestionsContainer),s=t(this.noSuggestionsContainer);this.adjustContainerWidth(),s.detach(),e.empty(),e.append(s),this.fixPosition(),e.show(),this.visible=!0},adjustContainerWidth:function(){var e,s=this.options,i=t(this.suggestionsContainer);"auto"===s.width&&(e=this.el.outerWidth()-2,i.width(e>0?e:300))},findBestHint:function(){var e=this.el.val().toLowerCase(),s=null;e&&(t.each(this.suggestions,function(t,i){var n=0===i.value.toLowerCase().indexOf(e);return n&&(s=i),!n}),this.signalHint(s))},signalHint:function(e){var s="";e&&(s=this.currentValue+e.value.substr(this.currentValue.length)),this.hintValue!==s&&(this.hintValue=s,this.hint=e,(this.options.onHint||t.noop)(s))},verifySuggestionsFormat:function(e){return e.length&&"string"==typeof e[0]?t.map(e,function(t){return{value:t,data:null}}):e},validateOrientation:function(e,s){return e=t.trim(e||"").toLowerCase(),-1===t.inArray(e,["auto","bottom","top"])&&(e=s),e},processResponse:function(t,e,s){var i=this.options;t.suggestions=this.verifySuggestionsFormat(t.suggestions),i.noCache||(this.cachedResponse[s]=t,i.preventBadQueries&&0===t.suggestions.length&&this.badQueries.push(e)),e===this.getQuery(this.currentValue)&&(this.suggestions=t.suggestions,this.suggest())},activate:function(e){var s,i=this.classes.selected,n=t(this.suggestionsContainer),o=n.find("."+this.classes.suggestion);return n.find("."+i).removeClass(i),this.selectedIndex=e,-1!==this.selectedIndex&&o.length>this.selectedIndex?(s=o.get(this.selectedIndex),t(s).addClass(i),s):null},selectHint:function(){var e=t.inArray(this.hint,this.suggestions);this.select(e)},select:function(t){this.hide(),this.onSelect(t)},moveUp:function(){if(-1!==this.selectedIndex)return 0===this.selectedIndex?(t(this.suggestionsContainer).children().first().removeClass(this.classes.selected),this.selectedIndex=-1,this.el.val(this.currentValue),void this.findBestHint()):void this.adjustScroll(this.selectedIndex-1)},moveDown:function(){this.selectedIndex!==this.suggestions.length-1&&this.adjustScroll(this.selectedIndex+1)},adjustScroll:function(e){var s=this.activate(e);if(s){var i,n,o,a=t(s).outerHeight();i=s.offsetTop,o=(n=t(this.suggestionsContainer).scrollTop())+this.options.maxHeight-a,i<n?t(this.suggestionsContainer).scrollTop(i):i>o&&t(this.suggestionsContainer).scrollTop(i-this.options.maxHeight+a),this.options.preserveInput||this.el.val(this.getValue(this.suggestions[e].value)),this.signalHint(null)}},onSelect:function(e){var s=this.options.onSelect,i=this.suggestions[e];this.currentValue=this.getValue(i.value),this.currentValue===this.el.val()||this.options.preserveInput||this.el.val(this.currentValue),this.signalHint(null),this.suggestions=[],this.selection=i,t.isFunction(s)&&s.call(this.element,i)},getValue:function(t){var e,s,i=this.options.delimiter;return i?1===(s=(e=this.currentValue).split(i)).length?t:e.substr(0,e.length-s[s.length-1].length)+t:t},dispose:function(){this.el.off(".autocomplete").removeData("autocomplete"),this.disableKillerFn(),t(window).off("resize.autocomplete",this.fixPositionCapture),t(this.suggestionsContainer).remove()}},t.fn.autocomplete=t.fn.devbridgeAutocomplete=function(e,s){return 0===arguments.length?this.first().data("autocomplete"):this.each(function(){var i=t(this),n=i.data("autocomplete");"string"==typeof e?n&&"function"==typeof n[e]&&n[e](s):(n&&n.dispose&&n.dispose(),n=new r(this,e),i.data("autocomplete",n))})}});
function autocompleteCity(){$("#city_d").autocomplete({serviceUrl:load_city_ajax,minChars:0,autoSelectFirst:!1,appendTo:"#city_d_a",onSearchStart:function(){},onSelect:function(t){$("#state").val()!=t.label&&(st_slug=t.value,$("#city_d").val(t.value),$("#state").val(t.label).change())},onHide:function(){"#city_d".closest(".input-groupn").removeClass("opendH")},formatResult:function(t){return"<span class='suggestion-wrapper'><span class='sub-text'>"+t.value+"</span></span>"}})}function autocompleteLocation(){$("#word").autocomplete({serviceUrl:load_location_ajax,minChars:1,autoSelectFirst:!1,appendTo:"#keyword_a",onSelect:function(t){ $('#word_hidden').val(t.value2).change();   },formatResult:function(t){return"<span class='suggestion-wrapper'><span class='suggestion-value'>"+t.value+"</span><span class='sub-text'>"+t.label+"</span></span>"}})}function autocompleteLocation2(t,e){$("#"+t).autocomplete({serviceUrl:load_location_ajax,minChars:1,autoSelectFirst:!1,appendTo:"#"+e,onSelect:function(t){},formatResult:function(t){return"<span class='suggestion-wrapper'><span class='suggestion-value'>"+t.value+"</span><span class='sub-text'>"+t.label+"</span></span>"}})}function checkImputVal(t){setTimeout(function(){$(t).val()!=st_slug&&$(t).val(st_slug)},500)}function timuteChange(){setTimeout(function(){search_byAjax()},500)}function setColr(t){setTimeout(function(){""!=$(t).val()?$(t).closest(".input-group").addClass("itmSelected"):$(t).closest(".input-group").removeClass("itmSelected")},500)}

    var infoscreen="";function initMap3(n,a,e,o){infoscreen=n,setTimeout(function(){var e={lat:temp_lat,lng:temp_lng};map=new google.maps.Map(document.getElementById(n),{center:e,zoom:13}),latlng = new google.maps.LatLng(temp_lat,temp_lng),placeMarker(latlng),infowindow=new google.maps.InfoWindow,new google.maps.places.PlacesService(map).nearbySearch({location:e,radius:3500,type:[a]},callback)},1500)}function callback(n,a){if($("#g-"+infoscreen+"-info").addClass("unload"),a===google.maps.places.PlacesServiceStatus.OK)for(var e="",o=0;o<n.length;o++){var i="p_"+n[o].id,t="";null!=n[o].rating&&(t+='<span class="g-ratingg-rating">'+n[o].rating+" <b>rating</b> </span>"),e='<li id="'+i+'" onclick="thrig(this)"><span class="g-icon"></span><span class="g-more-info"><span class="g-name">'+n[o].name+t+"</span></span></li>",$("#g-"+infoscreen+"-info").append(e),createMarker(n[o],i)}}function thrig(n){var a=$(n).attr("id");infowindow.setContent(nam[a]),infowindow.open(map,mak[a])}var mak=[],nam=[];function createMarker(n,a){var e={path:"M-20,0a20,20 0 1,0 40,0a20,20 0 1,0 -40,0",fillColor:"#34A853",fillOpacity:1,anchor:new google.maps.Point(0,0),strokeWeight:0,scale:.3},o=(n.geometry.location,new google.maps.Marker({map:map,icon:e,position:n.geometry.location}));mak[a]=o,nam[a]=n.name;$("#"+a);google.maps.event.addListener(o,"click",function(){infowindow.setContent(n.name),infowindow.open(map,this)})}
    function changeViewN2(e){var o=$(e).attr('data-val');
	  if(o!='map'){
	   $('.viewersp').removeClass('active');$(e).addClass('active'); $('#d_column').removeClass('list'); $('#d_column').removeClass('grid');$('#d_column').addClass(o);
				          // $( ".single-item" ).slick('reinit')
				        // window.dispatchEvent(new Event('resize'));
				          //setTimeout(function(){  $(window).trigger('resize'); console.log("GI") }, 800); 
				          //$(window).trigger('resize'); 
				            if ($('.single-item').hasClass('slick-initialized')) {
    $('.single-item').slick('destroy');
    caroselSingle3()
  }  
					   }
				               $.get(list_view_url,{'val':o},function(){
								    if(o=='map'){
										window.location.reload(true);
									}
								   
								   });
				           }
  function changeViewN4(e){var o=$(e).attr('data-val'); $.get(list_view_url,{'val':o},function(){  	
	  window.location.reload(true);
	  
	  
	   }); }
				           function changeOrderN2(e){var o=$(e).attr('data-val');void 0!==o&&($("#sort_val").val(o),search_byAjax())}
				           
function getUrl2(){
			 var  state_lookup =  $('#state').val();
			 return FindCities+'/state/'+state_lookup;
		 }
		 function findCities2(){
	
			$.typeahead({
    input: '.js-typeahead-user_v2',
    minLength: 0,
    order: "asc",
    dynamic: true,
    delay: 500,
    backdrop: {
        "background-color": "#fff"
    },
    template: function (query, item) {
 
     
 
        return '<span class="row1">' +
          
            '<span class="username">{{username}} </span>' +
            '<span class="id bltClss"  >{{country}}</span>' +
        "</span>"
    },
    emptyTemplate: "<span class='nresults'>no result for <span class=filtrquery> {{query}} </span></span>"+searchbtn,
    source: {
        user: {
             
          display: ["username","id"],
            ajax: function (query) {
                return {
                    type: "GET",
                    url:  getUrl2(),
                    path: "data.user",
                    data: {
                        q: "{{query}}"
                    },
                
                }
            }
 
        },
    },
    callback: {
        onClick: function (node, a, item, event) {
		if(item.city_id !=''){ $('#locality').val(item.city_id);   }
		if(item.state_id !=''){ $('#state').val(item.state_id).change();   }
	 
		     
 
        },
        onCancel:  function (node, a, item, event) {
  
 
        }, 
        onSendRequest: function (node, query) {
            console.log('request is sent')
        },
        onReceiveRequest: function (node, query) {
            console.log('request is received')
        }
    },
    debug: true
});
}
 	function submitKeyword(){
			$('#locality').val('');
			$('#word').val($('#js-typeahead-user_v2').val());search_byAjax();
		}
function getUrlh(){
			 var  state_lookup =  $('#tab-home-srch').find('.active').find('#state').val();
			 return FindCitiesh+'/state/'+state_lookup;
		 }
		 function findCitiesh(){
	
			$.typeahead({
    input: '.js-typeahead-user_v2#location',
    minLength: 0,
    searchOnFocus: true,
     
    dynamic: true,
    delay: 500,
    backdrop: {
        "background-color": "#fff"
    },
    template: function (query, item) {
 
     
 
        return '<span class="row1">' +
          
            '<span class="username">{{username}} </span>' +
            '<span class="id bltClss"  >{{country}}</span>' +
        "</span>"
    },
    emptyTemplate: "<span class='nresults'>no result for <span class=filtrquery> {{query}} </span></span>",
    source: {
        user: {
             
          display: ["username","id"],
            ajax: function (query) {
                return {
                    type: "GET",
                    url:  getUrlh(),
                    path: "data.user",
                    data: {
                        q: "{{query}}"
                    },
                
                }
            }
 
        },
    },
    callback: {
        onClick: function (node, a, item, event) {
		var target = $('#tab-home-srch').find('.active');
		if(item.city_id !=''){ target.find('#locality').val(item.city_id);   }
		if(item.state_id !=''){ target.find('#state').val(item.state_id).change();   }
	 
		     
 
        },
        onCancel:  function (node, a, item, event) {
				var target = $('#tab-home-srch').find('.active');
				 target.find('#locality').val(''); 
				 target.find('#state').val('').change();
		
        }, 
        onSendRequest: function (node, query) {
            console.log('request is sent')
        },
        onReceiveRequest: function (node, query) {
            console.log('request is received')
        }
    },
    debug: true
});
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function convertToNormalNumber(cnumber){
	cnumber = String(cnumber); 
	return parseFloat(cnumber.replace(/,/g, ''));
}
function calculate() {
  //Look up the input and output elements in the document
  var toal_amount = document.getElementById("total_prce_v");
 
  var amount = document.getElementById("total_prce_v");
  var apr = document.getElementById("interest_rate_v");
  var down_payment_percentage = document.getElementById("down_payment_v");
  var years = document.getElementById("loan_period_v");
  var zipcode = '';
  var payment = document.getElementById("payment");
  var total = document.getElementById("total");
  var totalinterest = document.getElementById("totalinterest");
  
  $down_payment_v =   convertToNormalNumber(amount.value)*(convertToNormalNumber(down_payment_percentage.value)/100) ;
				$loan_amount =   convertToNormalNumber(amount.value)-convertToNormalNumber($down_payment_v);
 
// Get the user's input from the input elements.
// Convert interest from a percentage to a decimal, and convert from
// an annual rate to a monthly rate. Convert payment period in years
// to the number of monthly payments.
var principal = parseFloat($loan_amount);
var interest = parseFloat(convertToNormalNumber(apr.value)) / 100 / 12;
var payments = parseFloat(years.value) * 12;
  
// compute the monthly payment figure
var x = Math.pow(1 + interest, payments); //Math.pow computes powers
var monthly = (principal*x*interest)/(x-1);
$('#down_payment_v_t').val(numberWithCommas($down_payment_v));
$('#total_html').html(numberWithCommas(principal.toFixed(0)));
$('#monthly_pay').html(numberWithCommas(monthly.toFixed(0)));
$('#total_prce_v').val(numberWithCommas(convertToNormalNumber(amount.value)));
//$('#down_payment_v_t').val(numberWithCommas(parseFloat(convertToNormalNumber(down_payment_percentage.value))));

return false;
alert(monthly);return false; 
// If the result is a finite number, the user's input was good and
// we have meaningful results to display
if (isFinite(monthly)){
  // Fill in the output fields, rounding to 2 decimal places
  payment.innerHTML = monthly.toFixed(2);
  total.innerHTML = (monthly * payments).toFixed(2);
  totalinterest.innerHTML = ((monthly*payments)-principal).toFixed(2);
  
// Save the user's input so we can restore it the next time they visit
 save(amount.value, apr.value, years.value, zipcode.value);

 // Advertise: find and display local lenders, but ignore network errors
 try { // Catch any errors that occur within these curly braces
 getLenders(amount.value, apr.value, years.value, zipcode.value);
 }
  
  catch(e) { /* And ignore those errors */ }
 // Finally, chart loan balance, and interest and equity payments
 chart(principal, interest, monthly, payments);
 }
 else {
 // Result was Not-a-Number or infinite, which means the input was
 // incomplete or invalid. Clear any previously displayed output.
 payment.innerHTML = ""; // Erase the content of these elements
 total.innerHTML = ""
 totalinterest.innerHTML = "";
 //chart(); // With no arguments, clears the chart
 }
}
// Save the user's input as properties of the localStorage object. Those
// properties will still be there when the user visits in the future
// This storage feature will not work in some browsers (Firefox, e.g.) if you
// run the example from a local file:// URL. It does work over HTTP, however.
 
// Automatically attempt to restore input fields when the document first loads.
 
// Pass the user's input to a server-side script which can (in theory) return
// a list of links to local lenders interested in making loans. This example
// does not actually include a working implementation of such a lender-finding
// service. But if the service existed, this function would work with it.
function getLenders(amount, apr, years, zipcode) { 
}
 function inititalizeInterestSlider(){
		$('input#interest_rate').rangeslider({
    polyfill : false,
    onInit : function() {
    },
    onSlide : function( position, value ) {
       
        $('#interest_rate_v').val( value ).change();;
     
    }
});
	}
	
	
	function initializeDownPAyment(){
			$('input#down_payment').rangeslider({
    polyfill : false,
    onInit : function() {
    },
    onSlide : function( position, value ) {
       
        $('#down_payment_v').val( value ).change();;
         
    }
});
	}
	
   	function setPackage2(k){
		 var selct = $(k).find(':selected');
	 
		var bank_id = selct.attr('data-bank_id');
		var bank_name = selct.attr('data-bank-name');
		$('#bank_id').val(bank_id);
		$('#bnk_name').html(bank_name);
		var data_interest =selct.attr('data-interest');
		var data_downpayment =selct.attr('data-down');
		/*interest change*/
		$('input#interest_rate').rangeslider('destroy');
		$('#interest_rate').val(data_interest);
		$('#interest_rate_v').val(data_interest);
		inititalizeInterestSlider();
		/*interest change end*/
		/*downpayment change*/
		$('input#down_payment').rangeslider('destroy');
		$('#down_payment').val(data_downpayment);
		$('#down_payment_v').val(data_downpayment);
		initializeDownPAyment();
		/*downpayment change end*/
		calculate();
		 
	}
	function setPackage(k){
		$('._25ff1ae0').removeClass('active');
		$(k).find('._25ff1ae0').addClass('active');
		var bank_id = $(k).attr('data-bank_id');
		var bank_name = $(k).attr('data-bank-name');
	 
		$('#bank_id').val(bank_id);
		$('#bnk_name').html(bank_name);
		var data_interest = $(k).attr('data-interest');
		var data_downpayment = $(k).attr('data-down');
		/*interest change*/
		$('input#interest_rate').rangeslider('destroy');
		$('#interest_rate').val(data_interest);
		$('#interest_rate_v').val(data_interest);
		inititalizeInterestSlider();
		/*interest change end*/
		/*downpayment change*/
		$('input#down_payment').rangeslider('destroy');
		$('#down_payment').val(data_downpayment);
		$('#down_payment_v').val(data_downpayment);
		initializeDownPAyment();
		/*downpayment change end*/
		calculate();
		 
	}
 function OpenApplication(){
        $("#myModal6").modal("show"),$("#cn_application").html("loading...");
        $.get(application_form_url+'/bank_id/'+$('#bank_id').val()+'/down_payment/'+$('#down_payment_v_t').val()+'/total_loan/'+$('#total_html').html()+'/loan_period/'+$('#loan_period_v').val()+'/interest_rate/'+$('#interest_rate_v').val(),function(e){$("#cn_application").html(e)})
		}
		function caroselSingle3(){
			var obj = $( ".single-item" ).not( ".slick-initialized.single-item" );
			 
			if(obj.length >= 1){ 
				//console.log(obj.length); 
				$.each(obj,function(){
						var thisp = $(this); 
						var arws = thisp.parent().parent().find('.arws');
						  
						thisp.slick({lazyLoad:"ondemand",dots:false,slidesToShow:1, rtl: isRtl,swipe:true,slidesToScroll:1,appendArrows:arws });
						
						
						thisp.on('beforeChange', function(event, slick, currentSlide, nextSlide){
											if ( currentSlide !== nextSlide ) {
											lazyBgImg( $(slick.$slides.get(nextSlide)) );
											}
											});
					})
				
				};
}
		function caroselSingle2(e,b){
	
	var Obj = $("#"+e).find(".single-item");
	if(Obj != undefined){
	 
	Obj.slick({lazyLoad:"ondemand",dots:!0,slidesToShow:1, rtl: false,slidesToScroll:1,appendArrows:"#"+e+" .arws",appendDots:"#"+e+" .dots"});
	 
	 
	  var s = e;
	  if(b==undefined){ 
		  
		$(window).resize(function(){  $("#"+e).find(".single-item").slick('resize');  });
	  }
	  else{
	 
	  
	  $("#"+s).find(".single-item").on('beforeChange', function(event, slick, currentSlide, nextSlide){
											if ( currentSlide !== nextSlide ) {
											lazyBgImg( $(slick.$slides.get(nextSlide)) );
											}
											});
											
	  }
	}
											 
	    }
	    
	    function openPropertyTypeSale(){
			
		$.typeahead({
    input: '.js-typeahead-game_v1#property_type',
    minLength: 0,
  
     searchOnFocus: true,
    order: "asc",
    hint: false, 
    group: true,
  highlight: true,  maxItemPerGroup: 16,
    dropdownFilter:title_sale,
    order: null,maxItemPerGroup:16,maxItem: 0,
    groupOrder: null,  
    source: src_sale_type,
   callback: {
	        onClick: function (node, a, item, event) { 
				$('.proptypsale').addClass('openValed');
				$('.proptypsale').find('#type_of_s').val(item.id);
        },
         onCancel:  function (node, a, item, event) {
  $('.proptypsale').removeClass('openValed');
        }, 
	
	    
}
     
});
		}
	    function openPropertyTypeRent(){
			
		$.typeahead({
    input: '.js-typeahead-game_v1#property_type_rent',
    minLength: 0,
  
     searchOnFocus: true,
    order: "asc",
    hint: false, 
    group: true,
  highlight: true,  maxItemPerGroup: 16,
    dropdownFilter:title_rent,
    order: null,maxItemPerGroup:16,maxItem: 0,
    groupOrder: null,  
    source: src_rent_type,
   callback: {
	        onClick: function (node, a, item, event) { 
				$('.proptyprent').addClass('openValed');
				$('.proptyprent').find('#type_of_r').val(item.id);
        },
         onCancel:  function (node, a, item, event) {
  $('.proptyprent').removeClass('openValed');
        }, 
	
	    
}
     
});
		}
	    function openPropertyTypeListing(){
			
		$.typeahead({

    input: '.js-typeahead-game_v1#property_type_rent',
    minLength: 0,
  
     searchOnFocus: true,
    order: "asc",
    hint: false, 
    group: true,
  highlight: true,  maxItemPerGroup: 16,
    dropdownFilter:title_rent, 
    order: null,maxItemPerGroup:16,maxItem: 0,
    groupOrder: null,  
    source: src_rent_type,
   callback: {
	        onClick: function (node, a, item, event) { 
				$('.proptyprent').addClass('openValed');
				$('.proptyprent').find('#type_of').val(item.id);
        },
         onCancel:  function (node, a, item, event) {
  $('.proptyprent').removeClass('openValed');
        }, 
	
	    
}
     
});

$('.js-typeahead-game_v1#property_type_rent').val()
		}
function setThisBathroomVal(k){
				var bdVal = $(k).attr('data-value');
				$('.BathCls').find('.btnDefault').removeClass('btnSecondary');
				$(k).addClass('btnSecondary');
				$('#bath_val').val(bdVal).change();;
			}
function setThisBedroomVal(k){
				var bdVal = $(k).attr('data-value');
				$('.bedCls').find('.btnDefault').removeClass('btnSecondary');
				$(k).addClass('btnSecondary');
				$('#bed_val').val(bdVal).change();;
			}
 function propertytypechange(k,e){
																			 e.preventDefault();
																			 e.stopPropagation();
																			 var proptyp_val = $(k).val();
																			 var proptyp = $(k).closest('.proptyp');
																			 proptyp.find('.pbs.category_tt:not(.cat_'+proptyp_val+')').removeClass('opene')
																			 proptyp.find('.pbs.category_tt.cat_'+proptyp_val).toggleClass('opene');
																			 console.log(proptyp_val);
																		 }
 
function openClassAdd(cls){
	$(function(){ $('.'+cls).addClass('opene'); })
}
function propertytypechange1(k,e){
																		  
																			 e.preventDefault();
																			 e.stopPropagation();
																			 var proptyp_val = $(k).val();
																			 var proptyp = $(k).closest('.proptyp');
																			 proptyp.find('.pbs.category_tt:not(.cat_'+proptyp_val+')').removeClass('opene')
																			 proptyp.find('.pbs.category_tt.cat_'+proptyp_val).toggleClass('opene');
																			 console.log(proptyp_val);
																		 }
																		 function search_byAjaxsub(k){
																				mainListUrl = $(k).attr('data-mailistUrl');
																				search_byAjax();
																			 }
function setRent_paid_value(k){
	
	$('#rent_paid').val($(k).val());
	
	}
function search_byAjax11(k){
						   mainListUrl = $(k).attr('data-mainlistUrl');
						   search_byAjax();
					   }
					   function closeOpened(k){
						   $(k).removeClass('opened');
						   console.log('leaved')
					   }
function easyload2Marker(id,hrf){
			 
			  ajax_location = window.location.href ;
			  ajax_title =  document.title ;
			  ajax_body_id =  'listing' ;
			 
				var containerID =  document.getElementById(id);
				$('#'+id).addClass('active-view');
			//	$('body').addClass('ovrflw-bdy');
				var page_url = hrf;
				NProgress.start();
				$.pjax({url: page_url , container:'#'+id,  timeout: 110000 ,scrollTo: false,cache:false   }).complete(function(){	
					NProgress.done(); 
				
					if($('form.recapt').length > 0 ){
										
										onloadCallback() ;
									} 
					
						});
			}
 function toggleClsth(k){
								$(k).toggleClass('openselector'); 
							 }
							 function closetoggleClsth(k){
								$(k).removeClass('openselector'); 
							 }
function fancyvlgroup(){     $('[data-fancybox="vl-group"]').fancybox({thumbs : { autoStart   : true,	  axis: 'x' ,   hideOnClose : true	  },baseClass:"fancybox-custom-layout",infobar:!1,touch:{vertical:!1},buttons:["close","thumbs"],animationEffect:"fade",transitionEffect:"fade",preventCaptionOverlap:!1,idleTime:!1,gutter:0}) ;}
           function openVideoFram(){ $('[data-fancybox="vl-group"]').click(); return false; 
		   }
		   							 function OpenApplication2(k){ 
        $("#myModal3").modal("show"),
        $("#raw_ht_ml").html("loading...");
        
        	var insuranceurl = $(k).attr('data-url');  
          $("#raw_ht_ml").html('<iframe id="ifrm"   class="mframe" ></iframe>'),document.getElementById("ifrm").src=insuranceurl
    
         
		}function closeIFrameD(){$("#ifrm").remove(),$("#myModal3").modal("hide")}
function OpenSignupRequiredNew(k){
	 if(!user_defined){
		 current_val_k = k ; userCase = 'mortgage';
		OpenLogin(k);return false; 
    }else{
		
		var nextclick = $(k).attr('data-nextclick');
		 var post_property = $('#post-property');
		 
		if (typeof post_property != 'undefined') {
			 
			$('#post-property').submit(); 
		}
		if (typeof nextclick === 'undefined') {
			 $('#signin-form').submit();
			
		}
		else{
			 if(nextclick=='1'){
			 setTimeout(function(){ OpenApplication2(k); }, 500);
			 }
			 if(nextclick=='2'){
			 setTimeout(function(){ OpenApplication(k); }, 500);
			 }
				
		}
	}
}

function openFaboxFloorPlan(){
    console.log("fancy");
	 $('[data-fancybox1="normal-group"]').fancybox({thumbs : { autoStart   : true,	  axis: 'x' ,   hideOnClose : true	  },baseClass:"fancybox-custom-layout",infobar:!1,touch:{vertical:!1},buttons:[ 'zoom',"close","thumbs"],animationEffect:"fade",transitionEffect:"fade",preventCaptionOverlap:!1,idleTime:!1,gutter:0,mobile : {    clickContent : "close",    clickSlide : "close"}});
	 $('[data-fancybox1="d-group"]').fancybox({thumbs : { autoStart   : true,	  axis: 'x' ,   hideOnClose : true	  },baseClass:"fancybox-custom-layout",infobar:!1,touch:{vertical:!1},buttons:[ 'zoom',"close","thumbs"],animationEffect:"fade",transitionEffect:"fade",preventCaptionOverlap:!1,idleTime:!1,gutter:0,mobile : {    clickContent : "close",    clickSlide : "close"}});
}
function Setthisinput(k){
		  if($(k).is(':checked')){
			  $('#slickFrs').addClass('hide');
			  $('#slickFrs2').removeClass('hide');
		  }
		  else{
			  $('#slickFrs2').addClass('hide');
			  $('#slickFrs').removeClass('hide');
		  }
	  }
 function florrPlanSlick(){
    if($('#slickFrs2').length=='1'){
		
	  $('#slickFrs2').slick({
  infinite: false,
  slidesToShow: 4,
  rtl:isRtl,
  slidesToScroll: 4,
  	responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			}, 
			 , {
				breakpoint: 767,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			}
			 , {
				breakpoint: 580,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
			]
});
	   
	}
	  $('#slickFrs').slick({
infinite: false,
 
   
    slidesToShow: 4, 
    slidesToScroll: 4,
    variableWidth: false,  
    dots: false,
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 2,
               slidesToScroll: 3,
        }
    }, {
        breakpoint: 650,
        settings: {
          
            slidesToShow: 2,
               slidesToScroll: 3,
        }
    }
    , {
        breakpoint: 380,
        settings: {
          
            slidesToShow: 2,
               slidesToScroll: 2,
        }
    }
    ]
});
	   
 }
function fancyvlgroup2(){     $('[data-fancybox="vl-normal"]').fancybox({thumbs : { autoStart   : true,	  axis: 'x' ,   hideOnClose : true	  },baseClass:"fancybox-custom-layout",infobar:!1,touch:{vertical:!1},buttons:["close","thumbs"],animationEffect:"fade",transitionEffect:"fade",preventCaptionOverlap:!1,idleTime:!1,gutter:0}) ;}
       
 function openVideoFram2(){ $('#vl-normal').click(); return false;		   }
 function openListing(k,e){
	e.preventDefault();var bodyId = $('body').attr('id');
	$('.bttom-menu').find('a').removeClass('active')
	$(k).addClass('active');window.scrollTo(0, 0);
	if(bodyId=='listing'){$("body").addClass("openfilter"); return false; }
	$("body").addClass("openfilter");
	var go_url = $(k).attr('data-url');
	
	easyload(k,e,'mainContainerClass');
}
function openListingMap(k,e){
	 e.preventDefault();
	 var bodyId = $('body').attr('id');
					   
				               $.get(list_view_url,{'val':'map'},function(){
										if(bodyId=='listing'){
										window.location.reload(true);
										}
										else{
										 	easyload(k,e,'mainContainerClass');
										}
									 
								   
								   });
				           
					   }
function openIframemap(){
	$('html').addClass('ifrmaer');
	if(!map_defined){
		map_defined = true; 
	 initMap2(uniqumaplat,uniqumaplng);
	 
var latlng = new google.maps.LatLng(uniqumaplat,uniqumaplng);
placeMarker(latlng);
}
	 
}
function closeMpframe(){
	$('html').removeClass('ifrmaer');
}
function toggleClassOp(k){
							$(k).closest('.navigation').toggleClass('open');
						}
 function fillInAddressn(){
    var place = autocomplete.getPlace();
		var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		var latlng = new google.maps.LatLng(lat,lng);	
 
		$('#latitude').val(lat);
		$('#longitude').val(lng);
		$('#word').val('');
}
function unsetlats(){
		$('#latitude').val('');
		$('#longitude').val('');
		$('#word').val('');
	}
	function search_byAjax23n(){
		 
		 $('#word').val($('#js-typeahead-user_v2').val());
			 
		 search_byAjax();
	}
			 	  function initAutocomplete22() {
 
	var input = document.getElementById('js-typeahead-user_v2');
	var options = { 
	    types: ['geocode'],
	componentRestrictions: {country: cn_code },
	 
	};

 	  autocomplete  = new google.maps.places.Autocomplete(input, options);
 	  autocomplete.addListener('place_changed', fillInAddressn);
 	 
}
	  function nslider2(){
				$(document).ready(function() {   
					  
					   $('.nslider').slick({
  slidesToShow: 1,rtl:isRtl,
  slidesToScroll: 1,dots: false,
  arrows: true,
  cssEase: 'linear',
  asNavFor: '.slider_dots,.property-slider-nav',
   responsive: [
    {
      breakpoint: 768,
      settings: {
       
        arrows: false
      }
    },
					   ]
});

$('.slider_dots').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.nslider,.property-slider-nav',
    arrows: false,rtl:isRtl,
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: '20%',
  });
  $('.slider_dots').on('beforeChange', function(event, slick, currentSlide, nextSlide){
  $(' .slider_navigators').removeClass('prev1');
  if(currentSlide > '0'){ $('#open_pop').addClass('openPopu') };
  
		if(currentSlide<nextSlide){
			console.log(currentSlide);
 
		$('.slider_navigators').eq(currentSlide).addClass('prev1');
		$('.slider_navigators').eq(nextSlide+1).addClass('prev1');
		}
		else if(currentSlide>nextSlide){
			$('.slider_navigators').eq(currentSlide-2).addClass('prev1');
		    $('.slider_navigators').eq(currentSlide).addClass('prev1');
		}
});
 
$('.property-slider-nav').slick({
  slidesToShow: 8,variableWidth: false,
  slidesToScroll: 8,rtl:isRtl,
  asNavFor: '.nslider,.slider_dots',
  dots: false,
  infinite:false,
  centerMode: false,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 8,
        slidesToScroll: 8,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 6,
        slidesToScroll: 6
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  
});
					   
				}); 
					   }
 
function OpenContenContent(){
			$('#txttrim').removeClass('detail-desc');
		}
		function CloseContenContent(){
			$('#txttrim').addClass('detail-desc');
			  $('html,body').animate({
        scrollTop: $("#txttrim").offset().top
    }, 500);
		}
		function checkscriptHeight(){
			if(parseInt($('#txttrim').height()) > 290){
				$('#txttrim').addClass('detail-desc conjusted');
			}
		}
function OpenSignupRequiredNewEmail(k){
	$('#frm_ctnt1').submit();return false; 
	 if(!user_defined){
		 current_val_k = k ; userCase = 'email2';
		OpenLogin(k);return false; 
    }else{
		
	 
			 $('#frm_ctnt1').submit();
			
		 
	}
}
function checkscriptHeight2(){
			if(parseInt($('#txttrim').height()) > 116){
				$('#txttrim').addClass('detail-desc conjusted');
			}
		}
	function	scroId(id){
 
		if(id=='mainContainerClass'){    document.body.scrollTop = 0;    document.documentElement.scrollTop = 0; }
		}
		   function arrowkeynav(){
   document.onkeydown = function (event) {
          
      switch (event.keyCode) {
         case 37:
            $('.nslider').find('.slick-prev').click();
            break;
    
         case 39:
           $('.nslider').find('.slick-next').click();
            break;
        
   }
   }
   }
    function initMapView() {
    var bounds = new google.maps.LatLngBounds();
    var map = new google.maps.Map(document.getElementById("map-load"), {
        zoom: zoom,
        minZoom: 5,
        center: {
            lat:my_latitude2,
            lng:  my_logitude1
        },
        disableDefaultUI: true, // a way to quickly hide all controls
        mapTypeControl: false,
        scaleControl: true,
        zoomControl: true,
        fullScreenControl: false,
        draggable: true,
        gestureHandling: "greedy",
         
    });
    var viewportBox;
    map.addListener('idle', function() {

        var bounds1 = map.getBounds();
        var ctr = bounds1.getCenter() ; 
        var lt = bounds1.getCenter().lat();
        var lg = bounds1.getCenter().lng();
         
        boundsNeLatLng = bounds1.getNorthEast(),
            boundsSwLatLng = bounds1.getSouthWest(),

            boundaries = {
                a: boundsSwLatLng.lat(),
                b: boundsSwLatLng.lng(),
                c: boundsNeLatLng.lat(),
                d: boundsNeLatLng.lng()
            };

        var ne = bounds1.getNorthEast();
        var sw = bounds1.getSouthWest();

        var viewportPoints = [
            ne, new google.maps.LatLng(ne.lat(), sw.lng()),
            sw, new google.maps.LatLng(sw.lat(), ne.lng()), ne
        ];

        if (viewportBox) {

            $('#a').val(boundsSwLatLng.lat());
            $('#b').val(boundsSwLatLng.lng());
            $('#c').val(boundsNeLatLng.lat());
            $('#d').val(boundsNeLatLng.lng());
            $('#lt').val(lt);
            $('#lg').val(lg);
            $('#zoom').val(map.getZoom());
            search_byAjax1();
        } else {
            viewportBox = 1;

        };




    });
    // Create an array of alphabetical characters used to label the markers.
    const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    // Add some markers to the map.
    // Note: The code uses the JavaScript Array.prototype.map() method to
    // create an array of markers based on a given "locations" array.
    // The map() method here has nothing to do with the Google Maps API.

    infowindow = new google.maps.InfoWindow({
        maxWidth: 200,
        disableAutoPan: true
    });




    var marker, i;


    for (i = 0; i < locations.length; i++) {



        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,

        });
        markerData.push(marker);
        bounds.extend(marker.position);

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {


                easyload2Marker('details-page-container', locations[i][5]);
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
                //  marker.set('labelClass', 'dotNewListings typeEmphasize active  noWrap');

            }
        })(marker, i));

        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
            return function() {
               //   infowindow.setOptions({ pixelOffset: self.getInfowindowOffset(map, marker) });
             
                infowindow.setContent(locations[i][0]);
                //infowindow.setOptions({pixelOffset :  getInfowindowOffset(map, marker)});
                infowindow.open(map, marker);
                // infoWindow.setPosition(event.latLng);
                
                //  marker.set('labelClass', 'dotNewListings typeEmphasize active  noWrap');

            }
        })(marker, i));

 //map.fitBounds(bounds);


        google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
            return function() {
                // infowindow.close();
                // marker.set('labelClass', 'dotNewListings');


            }
        })(marker, i));
    if(my_bound){ 
  map.fitBounds(bounds);
    }


    }
    // Add a marker clusterer to manage the markers.
    new MarkerClusterer(map, markerData, {
        imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    });
}
  function getInfowindowOffset(map, marker) {
            var center =  getPixelFromLatLng(map,map.getCenter()),
                point =  getPixelFromLatLng(map,marker.getPosition()),
                quadrant = "",
                offset;
            quadrant += (point.y > center.y) ? "b" : "t";
            quadrant += (point.x < center.x) ? "l" : "r";            
            if (quadrant == "tr") {
                offset = new google.maps.Size(-70, 185);
            } else if (quadrant == "tl") {
                offset = new google.maps.Size(70, 185);
            } else if (quadrant == "br") {
                offset = new google.maps.Size(-70, 20);
            } else if (quadrant == "bl") {
                offset = new google.maps.Size(70, 20);
            }

            return offset;
        } 
           function getPixelFromLatLng(map,latLng) {
            var projection = map.getProjection();          
            var point = projection.fromLatLngToPoint(latLng);
            return point;
        }
function search_byAjax1() {
    var a = document.getElementById("leftColumn");
    formData = $("#frmId :input").serializeArray();
    var e, t = "",
        n = "",
        o = "",
        i = "?";
    $.each(formData, function(a, e) {
        if ("sec1" == e.name) {} else {
            "" != e.value && ("sec" == e.name || ("type_of" == e.name ? t += "Property_" + e.value + "/" : "state" == e.name ? n += e.value + "/" : "locality" == e.name ? o += "Locality_" + e.value + "/" : i += "&" + e.name + "=" + e.value))
        }
    }), e = mainListUrl + t + n + o + i, NProgress.start(), $.pjax({
        url: e + '&pja=1',
        container: a,
        timeout: 11e4,
        cache: !1
    }).complete(function() {
        NProgress.done();

    })
}
function onhoverShowProp(){  /*
    if($('#leftColumn').length=='1'){
       
	  $(".lst-prop").mouseover(function() {
 
		var i = $(this).index();
		var marker = markerData[i];
	 
		 
		var imgsrc =  $(this).find('.listing-item').attr('data-image');
		if(imgsrc===undefined){
			var imgsrc = $(this).find('.cardPhoto img').attr('data-lazy');
		}
		
		var imgalt = $(this).find('.cardPhoto img').attr('alt');
		
		var price = $(this).find('.pri sec_1').text();
		var ad_title = $(this).find('.smartad_title').text();
		var li_title = $(this).find('.smartad_detail').html();
		
		
		var locationHTML = '<div class="cardPhoto backgroundPulse" style="height:80px;width:200px; background-image:url('+imgsrc+') ; background-position:center center;background-size:cover; background-repeat:no-repeat;"> <div class="tagsListContainer"></div></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal"><div><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate">' + price + '</span></div><div data-reactid="61"> <ul class="listInline typeTruncate mvn" data-reactid="62">'+li_title+'</ul></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal"  ><div ><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate" data-reactid="59" style="width:120px;font-size:12px;">'+ad_title+'</span></div></div>';		
		
		
		//console.log(i);
		if(marker && locations[i]) {
		 
			infowindow.setContent(locationHTML);
			infowindow.open(map, marker);
		}        
      });
      
    }*/
}

function checkScrollMpa() {
    currentPage++, offset = (currentPage - 1) * limit, jQuery.ajax(slug + "&offset=" + offset + "&limit=" + limit + "&is_form=1", {
        data: {
            formData: encodeURIComponent($("#frmId").serialize())
        },
        asynchronous: !0,
        evalScripts: !0,
        method: "get",
        beforeSend: function() {
            scroll = !1, loadingDiv.html(loadingHtml)
        },
        success: function(e, o, t) {
            if (loadingDiv.html(""), "1" == e) stopPagination = !1;
            else {
                loadingDiv.html(loadMoreHtml)
                e = JSON.parse(e), $("#suggest_friends_last_id").before(e.dataHtml), caroselSingle3(), onhoverShowProp(), lozad().observe(), scroll = !0
            }
        }
    })
}
function fillInAddresshome() {
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    var latlng = new google.maps.LatLng(lat, lng);
    $('#latitude').val(lat);
    $('#longitude').val(lng);
    $('#word').val(place.address_components[0]['long_name']);
}

function fillInAddresshome2() {
    var place = autocomplete2.getPlace();
    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    var latlng = new google.maps.LatLng(lat, lng);
    $('#latitude2').val(lat);
    $('#longitude2').val(lng);
    $('#word2').val(place.address_components[0]['long_name']);
}

function generateAutocom(k) {
    if (!auto1) {
        auto1 = true;
        initAutocompleteHome();
        console.log('1')
    }
}

function generateAutocom2(k) {
    if (!auto2) {
        auto2 = true;
        initAutocompleteHome2();
        console.log('1')
    }
}

function unsetlatshome(k) {
    $('#latitude').val('');
    $('#longitude').val('');
    $('#word').val($(k).val());
}

function unsetlatshome2(k) {
    $('#latitude2').val('');
    $('#longitude2').val('');
    $('#word2').val($(k).val());
}

function initAutocompleteHome() {

    var input = document.getElementById('js-typeahead-user_v2');
    var options = {
        types: ['geocode'],
        componentRestrictions: {
            country: cn_code
        },

    };

    autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', fillInAddresshome);

}

function initAutocompleteHome2() {

    var input = document.getElementById('js-typeahead-user_v21');
    var options = {
        types: ['geocode'],
        componentRestrictions: {
            country: cn_code
        },

    };

    autocomplete2 = new google.maps.places.Autocomplete(input, options);
    autocomplete2.addListener('place_changed', fillInAddresshome2);

}
function formatState11 (opt) {
    if (!opt.id) {
        return opt.text.toUpperCase();
    } 

    var optimage = $(opt.element).attr('data-image'); 
    console.log(optimage)
    if(!optimage){
       return opt.text.toUpperCase();
    } else {                    
        var $opt = $(
           '<span><img src="' + optimage + '" width="60px" /> ' + opt.text.toUpperCase() + '</span>'
        );
        return $opt;
    }
}
 function mortFns(){
        	$('input#total_prce').rangeslider({
    polyfill : false,
    onInit : function() {
    },
    onSlide : function( position, value ) {
       
        $('#total_prce_v').val( value ).change();;
      
    }
});
	$('input#loan_period').rangeslider({
    polyfill : false,
    onInit : function() {
    },
    onSlide : function( position, value ) {
       
        $('#loan_period_v').val( value ).change();
       
    }
});
$('#spl-select').select2({minimumResultsForSearch: -1,
 dropdownParent: $('#er-sld'),
    templateResult: formatState11,
    templateSelection: formatState11
    
});
initializeDownPAyment();
inititalizeInterestSlider();
    }
function OpenLoginM(e){  $("#myModal3").modal("show"),$("#raw_ht_ml").html('<iframe id="ifrm"   class="mframe" ></iframe>'),document.getElementById("ifrm").src=login_option1; }

function OpenSubmitNew(k,e){
    e.preventDefault();
	 if(!user_defined){
		 current_val_k = k ; userCase = 'submit_property';
		OpenLoginM(k);return false; 
    }else{
		
		 
		location.href =  $(k).attr('href')
		 
	}
}
	 function setAreaUnit(k){
						 var selectedText = $(k).attr('data-value');
						 $('#st_title2').html(selectedText);$('.home-home-type-areauunit').removeClass('opened')
					 }
function openFaboxFloorPlanCLick(){
    var frstObj = $('[data-fancybox1="d-group"]:first');
    if(frstObj.length=='1'){
	    frstObj.click();  return false;
    }
    var frstObj = $('[data-fancybox1="normal-group"]:first');
    if(frstObj.length=='1'){
	    frstObj.click();  return false;
    }
}
   function closeSelect2(k){
             	        
             	         $(k).toggleClass('opened');
             	       }
             	       
function closeReviewPop(e){ $('body').css({'overflow-y':'auto'}), $(".mobile_bottom_filter-review").removeClass("mobile_bottom_filter-review-opened")}
	
function openReviewPop(e) {
	$('body').css({'overflow-y':'hidden'}),
    $(".mobile_bottom_filter-review").addClass("mobile_bottom_filter-review-opened"), $("#emptyResults-review").addClass("hide"), offsetRev = 0, currentPageRev = 1, stopPaginationRev = !0, scrollRev = !1, $("#shortlist_items-review").html(""), checkScrollRev()
}
function checkScrollRev() {
    currentPageRev++, currentPageRev > 2 && (offsetRev = (currentPageRev - 2) * limitRev), jQuery.ajax(slugRev + "?offset=" + offsetRev + "&limit=" + limitRev + "&is_form=1", {
        data: {
            formData: ""
        },
        asynchronous: !0,
        evalScripts: !0,
        method: "get",
        beforeSend: function() {
            scrollRev = !1, loadingDivRev.html(loadingHtmlRev)
        },
        success: function(e, t, i) {
            loadingDivRev.html(""), "1" == e ? ("2" == currentPageRev && $("#emptyResults-review").removeClass("hide"), stopPaginationRev = !1, $("#ldmore-review").html("")) : (e = JSON.parse(e), $("#shortlist_items-review").append(e.dataHtml), $("#emptyResults-review").addClass("hide"), scrollRev = !0, "1" == e.future && $("#ldmore-review").html(loadMoreHtmlRev))
        }
    })
}
function makeunfeatured(k){
		var pr_id = $(k).attr('data-id');;
		  $.jAlert({
        'type': 'confirm',
        'confirmQuestion': un_feat,
         'confirmBtnText': yes_text,
        'denyBtnText': no_text,
        'onConfirm': function(e, btn) {
            e.preventDefault();
            
            var url_load = unfeatured_url + pr_id;
            if (url_load !== undefined) {
                $('.loaderi').html('<div class="cntr"><div class="loaderispin"></div></div><div class="bg"></div>');
                $('.loaderi').addClass('loading');
                $.get(url_load, function(data) {

                    $('.loaderi').html('<div class="contenth">' + data + '</div><div class="bg"></div>');

                })
            }
            return false;
        },
        'onDeny': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            return false;
        }
    });
		
	}
function setValuesFav(e){
    if(typeof(e.total_favourite) !== 'undefined'){
        $(".dataCounter-fav").html(e.total_favourite);
    }    
}
function OpenEmailNew(e){var t=$(e).attr("data-email");if(null!=t){if(!user_defined)return current_val_k=e,userCase="oemail",OpenLogin(e),!1;$(e).removeAttr("onclick");var o= t ;$(e).attr("href","mailto:"+o),$(e).html(o),$(e).click()}}

   function OpenFormClickNewFloorplan(t){if(!user_defined)return current_val_k=t,userCase="email",OpenLogin(t),!1;var i=$(t).attr("data-reactid");if(void 0===i)return!1;$("#myModal2").modal("show"),$("#cn_property").html("loading..."),$.get(propertyUrl+"/id/"+i+"/floor/1",function(t){$("#cn_property").html(t)})}function ajaxSubmitHappenlistfloor(t,i,e,a){e?alert("error"):$.ajax({type:"POST",url:a,data:t.serialize(),success:function(t){var i;t=JSON.parse(t),$("#requestBtn").length>0&&void 0!==(i=$("#requestBtn").attr("data-html"))&&($("#requestBtn").attr("disabled",!1),$("#requestBtn").html(i)),$("#bb2").length>0&&void 0!==(i=$("#bb2").attr("data-html"))&&($("#bb2").attr("disabled",!1),$("#bb2").html(i)),"1"==t.status?($("#topThirdPlacementLeadFormContainer.floor-pp").hide(),$(".rms-data-h.floor-pp").addClass("hide"),$(".success-modal.florr").addClass("visible"),Moveit.put(popGroup,{start:"0%",end:"0%",visibility:0}),Moveit.put(tick,{start:"0%",end:"0%",visibility:0}),Moveit.put(tick2,{start:"0%",end:"0%",visibility:0}),Moveit.put(circle,{start:"0%",end:"0%",visibility:0}),Moveit.animate(circle,{visibility:1,start:"0%",end:"100%",duration:1,delay:0,timing:"ease-out"}),Moveit.animate(tick,{visibility:1,start:"0%",end:"100%",duration:.2,delay:.5,timing:"ease-out"}),Moveit.animate(tick2,{visibility:1,start:"0%",end:"80%",duration:.2,delay:.7,timing:"ease-out"}),Moveit.animate(popGroup,{visibility:1,start:"20%",end:"60%",duration:.2,delay:1,timing:"ease-in"}).animate(popGroup,{visibility:1,start:"100%",end:"100%",duration:.2,delay:1.2,timing:"ease-in-out"})):($("#msg_alert").html(t.msg).show(),setTimeout(function(){$("#msg_alert").hide()},7e3))}})}
   function changemainlisturl(k){
mainListUrl = $(k).attr('data-mailistUrl'); 
var frsh = $(k).attr('data-refresh'); 
if(frsh !== undefined){
	if($('.openfilter').length=='0'){
	  search_byAjax();
		}
	  return false; 
	}
}
function setThisBathroomVal2(k){
				var bdVal = $(k).attr('data-value');
				$('.cVSuZibbath').find('.iBaOPD').removeClass('btnSelected');
				$(k).addClass('btnSelected');
				$('#bath_val').val(bdVal) ;
			}
function setThisBedroomVal2(k){
				var bdVal = $(k).attr('data-value');
				$('.cVSuZibed').find('.iBaOPD').removeClass('btnSelected');
				$(k).addClass('btnSelected');
				  $('#bed_val').val(bdVal) ;
			}
			function opencheckbox(k){
	 
    if($(k).val()=='property-for-sale'){
		$("#rent_paid_zero").prop("checked", true); 
		$('#checkbox-grid-1').removeClass('grid-opened');  
	}
	else{
		var grd_op = $('#checkbox-grid-1' ).hasClass('grid-opened');
		$('#checkbox-grid-1').removeClass('grid-opened');
		if(grd_op){ 
		
			$('#checkbox-grid-1').removeClass('grid-opened'); 
		}else{
		 $('#checkbox-grid-1').addClass('grid-opened');
		}
		}
	 
}
function opencheckbox2(k){
     var id_cat = $(k).attr('data-id');
     var grd_op = $('#checkbox-grid-'+id_cat).hasClass('grid-opened');
 
	 $('.checkbox-grid-property-type').removeClass('grid-opened'); 
    
	 if(grd_op){ 
		
			$('#checkbox-grid-'+id_cat).removeClass('grid-opened'); 
	 }else{
		 $('#checkbox-grid-'+id_cat).addClass('grid-opened'); 
	 }
	 
}
function openDropDown(k){
	var hsClass = $(k).closest('.sectionFilter').hasClass('button_open');
	 $('.sectionFilter').removeClass('button_open');
	 if(hsClass){  $(k).closest('.sectionFilter').removeClass('button_open'); }else{  $(k).closest('.sectionFilter').addClass('button_open');}
	
}
function setMinimum(k){
var minv = $(k).attr('data-val');
if(minv !== undefined){
$('#price-exposed-min').val(minv);
}
}function setMaximum(k){
var maxv = $(k).attr('data-val');
if(maxv !== undefined){
$('#price-exposed-max').val(maxv);
}
}
function eventSrch(){
         $('#selct').select2({minimumResultsForSearch: -1});
		 $('#selct-area').select2({minimumResultsForSearch: -1});
		 $('#selct-city').select2({minimumResultsForSearch: -1});
		 
		$('body').click(function(evt){    
    
       //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
       if($(evt.target).closest('.sectionFilter').length > 0){
          console.log('inside');
          return;             
	  }else{
		  console.log('oustside');
		  $('.sectionFilter').removeClass('button_open')
	  }

      //Do processing of click event here for every element except with id menu_content

});
}
function closerfrm2(e){$("body").removeClass("openfilter");setTimeout(function(){ search_byAjax(); }, 500);;}
function closeFilteronly(){
	$("body").removeClass("openfilter");
}
	function setvalueSort(k){ 
			$('input:radio[name="sort"]').filter('[value="'+$(k).val()+'"]'). attr('checked', true).change();
		}
		function setvalueArea(k){ 
			$('input:radio[name="area_unit"]').filter('[value="'+$(k).val()+'"]'). attr('checked', true).change();
		}
		function setvalueCity(k){ 
		    
		    if($(k).val()==''){
		    	$('.port-city').removeClass('sort-active');
		    }
		    else{
		        	$('.port-city').addClass('sort-active');
		    }
			$('input:radio[name="state"]').filter('[value="'+$(k).val()+'"]'). attr('checked', true).change();
		}
 function getSelectedText(k){
 
     	var setHtml =$(k).attr('data-value');
    	$('#sec_state_html').html(setHtml);  
    	if(	$("body").hasClass("openfilter")){
	    $('#city-button').addClass('filter-button_active-m');
	    $('.port-city').removeClass('button_open')
    	}
    }
    function getSelectedText2(k){
 
     	var setHtml =$(k).attr('data-value');
    	$('#sort_htm').html(setHtml);  
    	if(	$("body").hasClass("openfilter")){
	    $('#srt-sort-btn').addClass('filter-button_active-m');
	    $('.port-sort').removeClass('button_open');
			if($(k).val()!='best-asc'){
					$('.port-sort').addClass('sort-active');
			}
			else{
				$('.port-sort').removeClass('sort-active');
			}
    	}
    }
