<?php $tag = $conntroller->tag; ?>
<footer class="first-footer first">
          
          <div id="footer" class="section-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="footer">
            <div class="row">
              <div class="col-sm-8 footer-left">
                <h4><?php echo $tag->getTag('quick_links','Quick Links');?></h4>
                <ul class="clearfix">
                  <li> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>" ><?php echo $tag->getTag('buy','Buy');?></a> </li>
                  <li> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>RENT_SLUG));?>"  ><?php echo $tag->getTag('rent','Rent');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('listing/index',array('sec'=>'new-development'));?>"><?php echo $tag->getTag('new_projects','New Projects');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('business_listing/index',array('sec'=>'business-for-sale'));?>"><?php echo $tag->getTag('businesses_for_sale','Businesses For Sale');?> </a> </li> 
                  <li> <a title="#" href="<?php echo $app->createUrl('about-us');?>"><?php echo $tag->getTag('about_us','About Us');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('contact/index');?>"><?php echo $tag->getTag('contact_us','Contact Us');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('advertise_interest/index');?>"><?php echo $tag->getTag('advertise_with_us','Advertise with us');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('bloglist/index');?>"><?php echo $tag->getTag('blog','Blogs');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('partners/index');?>"><?php echo $tag->getTag('our_partners','Our Partners');?></a> </li>
                      <li><a href="<?php echo $app->createUrl('careers');?>"><?php echo $tag->getTag('careers','Careers');?></a></li>
                     <li><a href="<?php echo $app->createUrl('sitemap');?>"><?php echo $tag->getTag('sitemap','Sitemap');?></a></li>
                  
                </ul>
              </div>
              <div class="col-sm-4 footer-right">
                 <!-- Button trigger modal -->

            
                <div class="box box-border box-details"  >
                  <h4 style="color:#fff"><?php echo $tag->getTag('contact_us','Contact Us');?></h4>
                  <p class="phone-number" style="color:#fff" dir="ltr"><a href="tel:<?php echo Yii::t('app',$app->options->get('system.common.support_phone','+971 55 279 2403'),array(' '=>''));?>"><?php echo $app->options->get('system.common.support_phone','+971 55 279 2403');?></a></p>
                  <p style="color:#fff"><a href="mailto:<?php echo $app->options->get('system.common.support_email','info@rgestate.com');?>" style="color:#fff !important"><?php echo $app->options->get('system.common.support_email','info@rgestate.com');?></a></p>
                </div>
                <button type="button" class="btn btn-primary sb-btn  " data-toggle="modal" data-target="#exampleModal"><?php echo $tag->getTag('subscribe_to_our_free_newslett','Subscribe to our free newsletter');?></button>

              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="row">
              <div class="col-sm-4 footer-bottom-left">
                <div class="social-icons"> <a href="<?php echo $options->get('system.common.facebook_url','#');?>" class="social-icon social-facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i> </a> <a href="<?php echo $options->get('system.common.twitter_url','#');?>" class="social-icon social-twitter" target="_blank" rel="nofollow"> <i class="fa fa-twitter"> </i> </a> <a href="<?php echo $options->get('system.common.pinterest_url','#');?>" class="social-icon social-instagram" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i> </a> <a href="<?php echo $options->get('system.common.google_plus_url','#');?>" class="social-icon social-youtube" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i> </a> </div>
              </div>
              <div class="col-sm-8 footer-bottom-right">
                <p style="margin-bottom: 5px;color: #fff !important;"><?php echo Yii::t('app',$conntroller->generateCommon('copywrite_name'),array('[YEAR]'=> date('Y'),'{project}'=>$conntroller->project_name));?></p>
                <p class="spfoot"> <a title="#" href="<?php echo $app->createUrl('terms');?>"><?php echo $tag->getTag('terms_of_use','Terms of Use');?></a> | <a title="#" href="<?php echo $app->createUrl('privacy');?>"><?php echo $tag->getTag('privacy_policy','Privacy Policy');?></a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
        <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>SALE_SLUG,'quick'=>'1'));?>" onclick="load_filter(this)"  class="site-block"><h1><?php echo $tag->getTag('buy','Buy');?></h1></a></li>
        <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>RENT_SLUG,'quick'=>'1'));?>" onclick="load_filter(this)"  class="site-block"><h1><?php echo $tag->getTag('rent','Rent');?></h1></a></li>
        <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>'preleased'));?>" onclick="load_filter(this)"  class="site-block"><h1><?php echo $tag->getTag('preleased','Preleased');?></h1></a></li>
         <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('business_listing/filter',array('sec'=>'business-for-sale','quick'=>'1'));?>"  onclick="load_filter(this)"  class="site-block"><h1><?php echo $tag->getTag('businesses_for_sale','Businesses For Sale');?></h1></a></li>
         <li class="col-xs-6 col-sm-4"><a data-href="<?php echo $app->createUrl('listing/filter',array('sec'=>'new-development','quick'=>'1'));?>"  onclick="load_filter(this)"  class="site-block"><h1><?php echo $tag->getTag('new_projects','New Projects');?></h1></a></li>
 
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
  <div class="connect-iconn"> <a href="<?php echo $app->createUrl('site/index');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_home"></use></svg><?php echo $tag->getTag('home','Home');?></a> </div>
  <div class="connect-iconn"> <a href="javascript:void(0)" onclick="<?php echo !defined('ITS_LIST_PAGE') ?'openOptions(this,event)' :'openListing(this,event)';?>" href="javascript:void(0)"><svg viewBox="0 0 15 15" style="color:#fc7d00" class="button_icon-style3"><use xlink:href="#rg_search"></use></svg><?php echo $tag->getTag('search','Search');?></a> </div>
  <div class="connect-iconn  red-center"> <a href="<?php echo $app->createUrl('place_an_ad_no_login/select');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_post"></use></svg><?php echo $tag->getTag('submit','Submit');?> </a> </div>
  <?php
  if(defined('ITS_LIST_PAGE')){
  ?>
   <div class="connect-iconn"> <a href="javascript:void(0)" onclick="setSortOpen()"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_sort"></use></svg><?php echo $tag->getTag('sort','Sort');?></a> </div>

  <?php
  }else{ ?> 
  <div class="connect-iconn"> <a href="<?php echo $app->createUrl('about-us');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_about"></use></svg><?php echo $tag->getTag('about_us','About Us');?></a> </div>
   <?php } ?> 
        <div class="connect-iconn"> <a class="nav-link count-indicator"   id="messageDropdown" style="  " href="javascript:void(0)" onclick="openShortlistPop(this)" style="position:relative;"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_fav"></use></svg><span class="badge header-saved-properties__counter dataCounter-fav" style="bottom:unset;top:15px;" id="dataCounter" ><?php echo $conntroller->fav_count;?></span></a></div>
</div>
 </footer>
