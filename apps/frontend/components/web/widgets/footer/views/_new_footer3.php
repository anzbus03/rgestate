<?php $link_url = ''; 
    $options=  $app->options;
?>
<style>
    .remove-propp-shortlis {
    display: none
}

.nofav-text {
    display: block;
    text-align: center;
    padding: 5px 0;
    font-weight: 600;
    font-size: 16px
}

.nofav-img {
    display: block;
    width: 40%;
    margin: auto
}

.mobile_bottom_filter.mobile_bottom_filter-opened {
    right: 0;
    z-index: 911111
}

.mobile_bottom_filter {
    display: block;
    height: 100%;
    background-color: #fff;
    width: 340px;
    position: fixed;
    z-index: 99;
    border-left: 5px solid var(--logo-color);
    top: 0;
    direction: ltr;
    right: -350px;
    transition: all .2s ease-in-out;
    -webkit-transform: translateZ(0)
}

.mobile_bottom_shortlisted_container {
    padding: 10px;
    position: relative;
    display: block!important;
    font-size: .9em;
    box-shadow: 0 0 0 transparent;
    margin-top: 10px
}

.mobile_bottom_shortlisted_container .desktop-title {
    font-size: 1.2em;
    font-weight: 600;
    color: #222;
    display: block;
    margin-bottom: 1em
}

.mobile_bottom_shortlisted_container .listings {
    list-style-type: none;
    padding: 0;
    font-size: .9em;
    color: #667276;
    overflow-y: scroll
}
.strip {
    background-color: #fff;
    display: block;
    position: relative;
    margin-bottom: 16px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    border: 1px solid #e8e9ea;
}
.strip .svg {
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -moz-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
}
.smartad_infoarea, .smartad_title-link {
    line-height: 1.5!important;
    font-size: 15px!important;
}

.smartad_title-link a {
    color: var(--bs-blue);
}

.smartad_infoarea {
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
}
.smartad_infoarea {
    width: 100%;
    padding: 0;
}
smartad_title a {
    color: #333;
    font-weight: 400;
}
#shortlist_items .col-sm-4.lst-prop {
    padding: 0;
    width: 100%
}

#shortlist_items .strip {
    display: flex!important;
    align-items: center;
}

#shortlist_items .strip figure {
    border-radius: 3px 0 0 0;
    margin-bottom: 0;
}

#shortlist_items .strip .wrapper {
    padding: 5px 5px 7px 10px
}

#shortlist_items .strip .wrapper {
    min-width: 70%;
    margin: 0 auto
}

#shortlist_items .smartad_detail {
    font-size: 14px!important;
    line-height: 1.2
}
.strip figure .read_more {
    position: absolute;
    top: 50%;
    left: 0;
    margin-top: -12px;
    -webkit-transform: translateY(10px);
    -moz-transform: translateY(10px);
    -ms-transform: translateY(10px);
    -o-transform: translateY(10px);
    transform: translateY(10px);
    text-align: center;
    opacity: 0;
    visibility: hidden;
    width: 100%;
    -webkit-transition: all .6s;
    transition: all .6s;
    z-index: 2;
}
.strip figure a img {
    width: 100%;
    object-fit: cover;
    display: block;
    width: 100%;
    height: 100%;
}
 #shortlist_items .price-se-2 span,  #shortlist_items .price-se-1 span {
    color: var(--secondary-color)!important;
}
#shortlist_items .sh-mobile {
    display: block
}

#shortlist_items .strip>* {
    font-size: 10px
}

#shortlist_items .smartad_footer {
    position: absolute!important;
    right: 0;
    background: #fff;
    bottom: 0;
    padding: 2px;
    background: #fff;
    border-top: 0;
    width: 67%
}

#shortlist_items .strip figure {
    height: 105px!important
}

#shortlist_items .strip figure {
    min-width: 30%
}

#shortlist_items figure small {
    display: none!important
}

#shortlist_items .remove-propp-shortlis {
    position: absolute;
    display: none;
    right: 3px;
    bottom: 4px;
    font-weight: 400;
    font-size: 12px;
    z-index: 1;
    background: #fff;
    border: 1px solid var(--link-color);
    line-height: 1;
    padding: 5px 10px;
    cursor: pointer
}

#shortlist_items .strip:hover .remove-propp-shortlis {
    display: block!important;
    border: 1px solid var(--link-color);
    color: var(--link-color)
}

#shortlist_items .smartad_footer {
    display: none!important
}
</style>
    <!-- Start RG Estate Footer -->
    <footer class="rg-mt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="rg-footer-logo">
                        <img class="d-block" src="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/logo.svg" alt="RG Estate">
                    </div>
                    <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-20">RGEstate By Riveria Global Group is a UAE’s professionally managed, fast-growing and leading Real Estate Agency in Dubai, UAE, established in 2008.</p>
                    <ul class="rg-social-list d-flex align-items-center rg-mt-25">
                        <li>
                            <a href="<?php echo  $options->get('system.common.facebook_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="18" height="18"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-facebook"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $options->get('system.common.twitter_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="18" height="18"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-twitter"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo  $options->get('system.common.pinterest_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="16" height="16"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-instagram"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo  $options->get('system.common.google_plus_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="16" height="15"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-linkedin"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/@RGEstate" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="16" height="15"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-youtube"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="rg-fs-20 rg-fw-700 rg-text-blue">Quick Links</h5>
                    <ul class="rg-footer-list mt-5 rg-fs-16 rg-fw-400">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('property-for-sale'); ?>">Buy</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('property-for-rent'); ?>">Rent</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('new-development');?>">New Project</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('business-opportunities');?>">Business Opportunities</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('about-us');?>">About Us</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('contact-us');?>">Contact Us</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('advertise-with-us');?>">Advertise with us</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('blog');?>">Blogs</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('our-partners');?>">Our Partners</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('careers');?>">Careers</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('sitemap'); ?>">Sitemap</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="rg-fs-20 rg-fw-700 rg-text-blue">Our Services</h5>
                    <ul class="rg-footer-list mt-5 rg-fs-16 rg-fw-400">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('property-for-sale/commercial'); ?>">Commercial Real Estate</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/retail_investments'); ?>">Retail Investments</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/business_buying_selling'); ?>">Business Buying & Selling</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/project_funding'); ?>">Project Funding</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/project_development'); ?>">Project Development</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/project_contracting'); ?>">Project Contracting</a>
                        </li>
                        <li>
                            <a href="#">Industrial Maintenance</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/building_maintenance'); ?>">Building Maintenance</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="rg-fs-20 rg-fw-700 rg-text-blue">Address</h5>
                    <ul class="rg-address-list mt-5">
                        <li class="d-flex align-items-start">
                            <div href="#"
                                class="rg-footer-icon rg-bg-blue rg-wh-32 rounded-circle position-relative d-block">
                                <svg width="16" height="20"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-location"></use>
                                </svg>
                            </div>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600">Office Suite# 1005, Aspect Tower, Business Bay - Dubai UAE
P.O. Box 232574</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <div href="#"
                                class="rg-footer-icon rg-bg-blue rg-wh-32 rounded-circle position-relative d-block">
                                <svg width="16" height="16"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-phone"></use>
                                </svg>
                            </div>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600"><a href="tel:+971 55 279 2403">+971 55 279 2403</a></span>
                        </li>
                        <li class="d-flex align-items-center">
                            <div href="#"
                                class="rg-footer-icon rg-bg-blue rg-wh-32 rounded-circle position-relative d-block">
                                <svg width="15" height="12"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-email1"></use>
                                </svg>
                            </div>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600"><a href="mailto:sales@rgestate.com">sales@rgestate.com</a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="rg-copyright rg-bg-blue text-center rg-mt-40 d-flex align-items-center justify-content-center">
            <p class="rg-fs-14 rg-fw-400 text-white pe-0">RGEstate - Commercial Real Estate Agency in Dubai | 2008 - 2023 &copy; Copyright - All Rights Reserved. <span><a href="<?php echo Yii::app()->createUrl('terms');?>">Terms of Use</a> | <a href="<?php echo Yii::app()->createUrl('privacy');?>">Privacy Policy</a></span></p>
        </div>
<div hidden>
      <style>
         .sidestickyicons .button_icon-style3{ width:20px; height:20px; margin-bottom:5px; }
         html .connect-iconn a {
    
    display: flex;
    text-align: center;
    flex-direction: column;
    justify-content: center;
    align-items: center;    line-height: 1;
}.connect-iconn {
    
    display: flex;
    align-items: center;
    padding: 3px 0px;
}html .openfilter  .search-popup-cntainer-btn1 {
    border: 1px solid #dedede!important;background: #fff; 
}    html .openfilter .splss{ width: 100%; } 
html .openfilter .splss::after {
    content: '';
    border: 1px solid #eee !important;
    width: 200%;
    margin-left: -35px !important;
    display: block;
    margin-right: -35px !important; 
    margin-top: 10px;
}
.slpcls1{    border: 1px solid #fc7d00;
    width: auto;
    display: inline-block;
    padding: 3px 6px;
    border-radius: 4px;
    font-size: 13px;
    line-height: 1;
    font-weight: 300;
    height: auto;}
html .openfilter .splss{ display:block; }
.red-center svg{color:red;fill:red;background-color:#fff;    border-radius: 3px;} 
.modules-list {
    position: fixed;
    /* top: 0; */
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    height: 250px;
    padding: 30px;
    z-index: 111111111;
    display: none;
    padding-top: 50px;
    border-top: 2px solid #eee;
}
.opendfltr .modules-list {
 display:flex !important;
}
.openfilter #sechbr label, .hlkFos,.openfilter .nm-fltr .jNhpJt {
    line-height: 1!important;
    height: 20px !important;
    white-space: nowrap;
}.openfilter .contns .pbs{ min-width:unset !important; }
.opendfltr iframe{ display:none; }
 
.opendfltr .cat-selector li button {   padding: 0px 8px;    white-space: nowrap; }
.opendfltr .cat-selector {  display: flex;  flex-direction: row; flex-wrap: nowrap;  overflow-x: scroll; }
html .openfilter .search-popup-cntainer {
    display: block !important;
}html .openfilter .askaan-listbox.spl {
    display: flex;
    padding: 2px;
    border: 0px;
    border-radius: 8px;
}
html .openfilter  .search-popup-cntainer-btn {  width: 100%; }
html .openfilter .askaan-listbox span {  flex: 1;  margin-right: 10px; }
.openfilter .askaan-listbox.spl .search-popup-cntainer-btn {  min-height: 32px;  border-radius: 6px; }
.openfilter .search-popup-cntainer-btn1.active { 
    background-color: var(--secondary-color);
    color: #fff;
    border: 1px solid var(--secondary-color)!important;
}
.openfilter input[type="radio"]:checked + label span {
    font-weight: bold;
    color: var(--secondary-color) !important;
}
.openfilter .price-frm-selct4{ display:none;}
.openfilter .list-item-p-label-button {
    display: none;
}
.openfilter .form-container-list-item::after {
    content: '';
    border: 1px solid #eee !important;
    width: 200%;
    margin-left: -15px !important;
    display: block;
    margin-right: -15px !important; 
    margin-top: 10px;
}
.openfilter   .searrchli {  padding: 0px 15px; }
.openfilter   .row.only-for-mobile-t{ display:flex;     margin: 0px;}
.openfilter   .price-frm-selct{ display:none;}
.openfilter .search-popup-cntainer-wrapper{ min-width:100% !important;}
.openfilter     .port-sort .list-item-p,.openfilter    .port-sort .search-popup-cntainer   { display:none !important; }
.openfilter  form  select{    height: auto;
    border: 1px solid #eee;
    padding: 7px;
    width: 91%;
    border-radius: 8px;
}
html .openfilter .list-item-p-label {
    padding: 0px 0px !important;
}
.openfilter  #frmId  #bet-bt {
   display: block;  
}
html .openfilter .arab-li-1.port-search {
 
    padding: 0px 0px !important; 
}
.fil-mob.bottom-f {
    position: fixed;
    bottom: 0px;
    width: 100%;
    border-top: 1px solid #eee;
    z-index: 111111;
    left: 0px;
    display:none; 
}
html .openfilter .sidestickyicons{ display:none; }
html .openfilter .fil-mob.bottom-f{
        padding: 10px;
    background: #fff;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
}
.fltr-href.fltr-href-find {
    background: var(--secondary-color) !important;
    width: 100% !important;
    text-align: center;
    display: block;padding: 1px 7px;
    font-size: 16px;    align-items: center;    color: #fff !important;
    border-radius: 6px;float: right;
}
.openfilter .fil-mob .child {
    flex: 1;
}.child.totl-rows.reset-frm {
    max-width: 80px;margin-right:15px; 
}
.fltr-href.fltr-href-reset {
    background: rgba(0,0,0,0.5) !important;
    width: 100% !important;
    text-align: center;
    display: block;
    font-size: 16px;
    color:#fff;    border-radius: 6px;
}
.openfilter .new-multiple {
    min-width: unset;
    min-height: unset;
}
 
.openfilter .list-item-p {   padding: 5px 0px 0; }
.openfilter .new-select2 {  padding-left: 0px; }
.openfilter .askaan-listbox.spl {  border: 0px; }
.openfilter .searrchli2 .port-sort {  padding-left: 0px;  padding-right: 0px; }
.openfilter .contns { flex-wrap: nowrap;  overflow-x: scroll; }
.openfilter .pr-selector {  justify-content: flex-start;  align-items: flex-start; }
.openfilter .port-sector, .openfilter  .search-popup-cntainer-wrapper,.openfilter  .port-category, .openfilter #frmId .row.only-for-mobile-t {   padding-left: 0px;    padding-right: 0px;padding:0px;  }
.openfilter .reset-a-form  { display:none; }
.img-ldr-sect { display:none; }
.lding.img-ldr-sect { display:block;position:absolute; }
.mddmls h1 { font-size: 16px; margin-bottom: 0px; text-align:center; }.mddmls li{ padding:5px; }
.mddmls li  a{ display:block;border:1px solid #c1c1c1;border-radius: 8px;    height: 50px;    display: flex;
    justify-content: center;
    align-items: center;}
  .modules-list .cls-closebtn1 {
    display: block;
    color: red;
    position: absolute;
    left: 28px;
    width: 25px;
    height: 25px;
    top: 16px;
}
 .openfilter .dropdown-display-label:after,.openfilter .dropdown-display:after {   top: 16px; }
 
 .modules-list2 {
    position: fixed;
    /* top: 0; */
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    height: 93px;
    padding: 30px;
    z-index: 111111111;
    display: none;
    padding-top: 50px;
    border-top: 2px solid #eee;
}
.opendSortfltr .modules-list2 {
 display:flex !important;
}
.modules-list2 .cls-closebtn1 {
    display: block;
    color: red;
    position: absolute;
    left: 28px;
    width: 25px;
    height: 25px;
    top: 16px;
}
#htmlsrt{ display:flex;    flex-wrap: nowrap;    overflow-y: scroll; }
#htmlsrt  .arab-separator_secondary {    border: 1px solid #eee !important;    flex: 1;    white-space: nowrap;    border-radius: 10px;    margin-right: 10px;    padding: 0px 15px !important;    line-height: 1 !important;}
  #htmlsrt  .arab-separator_secondary input { display:none; }
   #htmlsrt  .arab-separator_secondary label { padding-top: 5px; padding-bottom: 5px;line-height:1;  }
      </style>
      <script>
          function load_filter(k){
              isAjaxFrm = true;
               $('.img-ldr-sect').addClass('lding');
              var url_filter = $(k).attr('data-href');
              $("#frmId2 :input").remove();
              $.get(url_filter,function(data){
                    $('body').removeClass('opendfltr')
                  var data = JSON.parse(data);$("body").addClass("openfilter")
                  $('#dropFilter').html(data.html);
                  
              })
          }
      </script>
      <svg  id="rg_sort" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"   x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m16.13 2.06 9.836 11.706c.078.093.012.234-.11.234h-19.712c-.122 0-.188-.141-.11-.234l9.836-11.706c.068-.08.192-.08.26 0z" fill="currentColor" data-original="currentColor"></path><path xmlns="http://www.w3.org/2000/svg" d="m15.87 29.94-9.836-11.706c-.078-.093-.012-.234.11-.234h19.712c.122 0 .188.141.11.234l-9.836 11.706c-.068.08-.192.08-.26 0z" fill="currentColor" data-original="currentColor"></path></g></svg>
      <svg id="rg_home" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m498.195312 222.695312c-.011718-.011718-.023437-.023437-.035156-.035156l-208.855468-208.847656c-8.902344-8.90625-20.738282-13.8125-33.328126-13.8125-12.589843 0-24.425781 4.902344-33.332031 13.808594l-208.746093 208.742187c-.070313.070313-.140626.144531-.210938.214844-18.28125 18.386719-18.25 48.21875.089844 66.558594 8.378906 8.382812 19.445312 13.238281 31.277344 13.746093.480468.046876.964843.070313 1.453124.070313h8.324219v153.699219c0 30.414062 24.746094 55.160156 55.167969 55.160156h81.710938c8.28125 0 15-6.714844 15-15v-120.5c0-13.878906 11.289062-25.167969 25.167968-25.167969h48.195313c13.878906 0 25.167969 11.289063 25.167969 25.167969v120.5c0 8.285156 6.714843 15 15 15h81.710937c30.421875 0 55.167969-24.746094 55.167969-55.160156v-153.699219h7.71875c12.585937 0 24.421875-4.902344 33.332031-13.808594 18.359375-18.371093 18.367187-48.253906.023437-66.636719zm0 0" fill="currentColor" data-original="currentColor" class=""></path></g></svg>
<svg id="rg_search" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 48 48" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg" id="Line"><path d="m43.21 36.79-8-8a19.08 19.08 0 0 1 -6.41 6.41l8 8a4.48 4.48 0 0 0 6.42 0 4.54 4.54 0 0 0 -.01-6.41z" fill="currentColor" data-original="currentColor" class=""></path><circle cx="19" cy="19" r="17" fill="currentColor" data-original="currentColor" class=""></circle></g></g></svg>
 <svg id="rg_post" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"   x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" clip-rule="evenodd" d="m5 2h14c1.6569 0 3 1.34315 3 3v14c0 1.6569-1.3431 3-3 3h-14c-1.65685 0-3-1.3431-3-3v-14c0-1.65685 1.34315-3 3-3zm8 11h4c.5523 0 1-.4477 1-1s-.4477-1-1-1h-4v-4c0-.55228-.4477-1-1-1s-1 .44772-1 1v4h-4c-.55228 0-1 .4477-1 1s.44772 1 1 1h4v4c0 .5523.4477 1 1 1s1-.4477 1-1z" fill="currentColor" fill-rule="evenodd" data-original="currentColor" class=""></path></g></svg>
<svg  id="rg_about" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 45.999 45.999" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g><path d="M39.264,6.736c-8.982-8.981-23.545-8.982-32.528,0c-8.982,8.982-8.981,23.545,0,32.528c8.982,8.98,23.545,8.981,32.528,0 C48.245,30.281,48.244,15.719,39.264,6.736z M25.999,33c0,1.657-1.343,3-3,3s-3-1.343-3-3V21c0-1.657,1.343-3,3-3s3,1.343,3,3V33z M22.946,15.872c-1.728,0-2.88-1.224-2.844-2.735c-0.036-1.584,1.116-2.771,2.879-2.771c1.764,0,2.88,1.188,2.917,2.771 C25.897,14.648,24.746,15.872,22.946,15.872z" fill="currentColor" data-original="currentColor" class=""></path></g></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g></g></svg>
<svg id="rg_fav" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 511.855 511.855" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m466.186 74.688c-29.498-29.498-68.716-45.743-110.432-45.743-36.894 0-71.836 12.708-99.827 36.051-27.989-23.343-62.933-36.051-99.825-36.051-41.716 0-80.936 16.245-110.433 45.743-60.891 60.891-60.892 159.97 0 220.865l171.249 171.249c10.389 10.387 24.242 16.107 39.01 16.107s28.621-5.721 39.01-16.108l171.248-171.248c60.892-60.894 60.892-159.974 0-220.865z" fill="currentColor" data-original="currentColor" class=""></path></g></svg>
         <svg id="cls-close1" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"   x="0" y="0" viewBox="0 0 311 311.07733" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m16.035156 311.078125c-4.097656 0-8.195312-1.558594-11.308594-4.695313-6.25-6.25-6.25-16.382812 0-22.632812l279.0625-279.0625c6.25-6.25 16.382813-6.25 22.632813 0s6.25 16.382812 0 22.636719l-279.058594 279.058593c-3.136719 3.117188-7.234375 4.695313-11.328125 4.695313zm0 0" fill="currentColor" data-original="currentColor" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m295.117188 311.078125c-4.097657 0-8.191407-1.558594-11.308594-4.695313l-279.082032-279.058593c-6.25-6.253907-6.25-16.386719 0-22.636719s16.382813-6.25 22.636719 0l279.058594 279.0625c6.25 6.25 6.25 16.382812 0 22.632812-3.136719 3.117188-7.230469 4.695313-11.304687 4.695313zm0 0" fill="currentColor" data-original="currentColor" class=""></path></g></svg>
 
  </div>
	<div class="" id="dropFilter" ></div>
  <div class="modules-list">
  <a href="javascript:void(0)" class="cls-closebtn1"  onclick="updateOpenClose1()"><svg viewBox="0 0 70.098 53.605" ><use xlink:href="#cls-close1"></use></svg></a>
  <ul class="row mddmls ">
        <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>SALE_SLUG,'quick'=>'1'));?>" onclick="load_filter(this)"  class="site-block"><h4>Buy</h4></a></li>
        <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>RENT_SLUG,'quick'=>'1'));?>" onclick="load_filter(this)"  class="site-block"><h4>Rent</h4></a></li>
        <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>'preleased'));?>" onclick="load_filter(this)"  class="site-block"><h4>Preleased</h4></a></li>
         <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('business_listing/filter',array('sec'=>'business-opportunities','quick'=>'1'));?>"  onclick="load_filter(this)"  class="site-block"><h4>Business Opportunities</h4></a></li>
         <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>'new-development','quick'=>'1'));?>"  onclick="load_filter(this)"  class="site-block"><h4>New Projects</h4></a></li>
 
		</ul>
		<div class="img-ldr-sect text-center"><img src="<?php echo $app->apps->getBaseUrl('assets/img/ajaxloder1.svg');?>"></div>
	
  </div>
   <div class="modules-list2">
  <a href="javascript:void(0)" class="cls-closebtn1"  onclick="setSortClose()"><svg viewBox="0 0 70.098 53.605" ><use xlink:href="#cls-close1"></use></svg></a>
  <ul class="row mddmls " id="htmlsrt">
     
		</ul>
	 
  </div>
  
  <script>
  var isAjaxFrm = false;
      function openOptions(){
           $('.img-ldr-sect').removeClass('lding');
            $('body').addClass('opendfltr')
      }
      function updateOpenClose1(){
           $('body').removeClass('opendfltr')
      }
      function setSortOpen(){
           $('body').addClass('opendSortfltr');
           var htmlSort = $('.port-sort').find('.search-popup-cntainer-wrapper').html();
           $('#htmlsrt').html(htmlSort)
      }
       function setSortClose(){
           $('body').removeClass('opendSortfltr')
      }
  </script>
    <div class="sidestickyicons">
  <div class="connect-iconn"> <a href="<?php echo $app->createUrl('site/index');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_home"></use></svg>Home</a> </div>
  <div class="connect-iconn"> <a href="javascript:void(0)" onclick="<?php echo !defined('ITS_LIST_PAGE') ?'openOptions(this,event)' :'openListing(this,event)';?>" href="javascript:void(0)"><svg viewBox="0 0 15 15" style="color:#fc7d00" class="button_icon-style3"><use xlink:href="#rg_search"></use></svg>Search</a> </div>
  <div class="connect-iconn  red-center"> <a href="<?php echo $app->createUrl('place_an_ad_no_login/select');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_post"></use></svg>Submit </a> </div>
  <?php
  if(defined('ITS_LIST_PAGE')){
  ?>
   <div class="connect-iconn"> <a href="javascript:void(0)" onclick="setSortOpen()"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_sort"></use></svg>Sort</a> </div>

  <?php
  }else{ ?> 
  <div class="connect-iconn"> <a href="<?php echo $app->createUrl('about-us');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_about"></use></svg>About Us</a> </div>
   <?php } ?> 
        <div class="connect-iconn"> <a class="nav-link count-indicator"   id="messageDropdown" style="  " href="javascript:void(0)" onclick="openShortlistPop(this)" style="position:relative;"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_fav"></use></svg><span class="badge header-saved-properties__counter dataCounter-fav" style="bottom:unset;top:15px;" id="dataCounter" ><?php echo $conntroller->fav_count;?></span></a></div>
</div>
    </footer>
     <script>
          function load_filter(k){
              isAjaxFrm = true;
               $('.img-ldr-sect').addClass('lding');
              var url_filter = $(k).attr('data-href');
              $("#frmId2 :input").remove();
              $.get(url_filter,function(data){
                    $('body').removeClass('opendfltr')
                  var data = JSON.parse(data);$("body").addClass("openfilter")
                  $('#dropFilter').html(data.html);
                  
              })
          }
      </script>
     <script>
  var isAjaxFrm = false;
      function openOptions(){
           $('.img-ldr-sect').removeClass('lding');
            $('body').addClass('opendfltr')
      }
      function updateOpenClose1(){
           $('body').removeClass('opendfltr')
      }
      function setSortOpen(){
           $('body').addClass('opendSortfltr');
           var htmlSort = $('.port-sort').find('.search-popup-cntainer-wrapper').html();
           $('#htmlsrt').html(htmlSort)
      }
       function setSortClose(){
           $('body').removeClass('opendSortfltr')
      }
  </script>