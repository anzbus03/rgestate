<?php $tag = $conntroller->tag; ?>
<footer class="first-footer">
          
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
                  <li> <a title="#" href="<?php echo $app->createUrl('all/business/for-sale');?>"><?php echo $tag->getTag('business_for_sale','Business For Sale');?></a> </li> 
                  <li> <a title="#" href="<?php echo $app->createUrl('about-us');?>"><?php echo $tag->getTag('about_us','About Us');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('contact/index');?>"><?php echo $tag->getTag('contact_us','Contact Us');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('advertise_interest/index');?>"><?php echo $tag->getTag('advertise_with_us','Advertise with us');?></a> </li>
                  <li> <a title="#" href="<?php echo $app->createUrl('bloglist/index');?>"><?php echo $tag->getTag('blog','Blogs');?></a> </li>
                  
                </ul>
              </div>
              <div class="col-sm-4 footer-right">
                <div class="box box-border box-details">
                  <h4 style="color:#fff"><?php echo $tag->getTag('contact_us','Contact Us');?></h4>
                  <p class="phone-number" style="color:#fff" dir="ltr"><a href="tel:<?php echo $app->options->get('system.common.support_phone','+971 55 279 2403');?>"><?php echo $app->options->get('system.common.support_phone','+971 55 279 2403');?></a></p>
                  <p style="color:#fff"><a href="mailto:<?php echo $app->options->get('system.common.support_email','info@rgestate.com');?>" style="color:#fff !important"><?php echo $app->options->get('system.common.support_email','info@rgestate.com');?></a></p>
                </div>
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
}
      </style>
      <svg id="rg_home" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m498.195312 222.695312c-.011718-.011718-.023437-.023437-.035156-.035156l-208.855468-208.847656c-8.902344-8.90625-20.738282-13.8125-33.328126-13.8125-12.589843 0-24.425781 4.902344-33.332031 13.808594l-208.746093 208.742187c-.070313.070313-.140626.144531-.210938.214844-18.28125 18.386719-18.25 48.21875.089844 66.558594 8.378906 8.382812 19.445312 13.238281 31.277344 13.746093.480468.046876.964843.070313 1.453124.070313h8.324219v153.699219c0 30.414062 24.746094 55.160156 55.167969 55.160156h81.710938c8.28125 0 15-6.714844 15-15v-120.5c0-13.878906 11.289062-25.167969 25.167968-25.167969h48.195313c13.878906 0 25.167969 11.289063 25.167969 25.167969v120.5c0 8.285156 6.714843 15 15 15h81.710937c30.421875 0 55.167969-24.746094 55.167969-55.160156v-153.699219h7.71875c12.585937 0 24.421875-4.902344 33.332031-13.808594 18.359375-18.371093 18.367187-48.253906.023437-66.636719zm0 0" fill="currentColor" data-original="currentColor" class=""></path></g></svg>
<svg id="rg_search" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 48 48" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg" id="Line"><path d="m43.21 36.79-8-8a19.08 19.08 0 0 1 -6.41 6.41l8 8a4.48 4.48 0 0 0 6.42 0 4.54 4.54 0 0 0 -.01-6.41z" fill="currentColor" data-original="currentColor" class=""></path><circle cx="19" cy="19" r="17" fill="currentColor" data-original="currentColor" class=""></circle></g></g></svg>
<svg id="rg_post" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg" id="_x33_"><path d="m18 2c2.206 0 4 1.794 4 4v12c0 2.206-1.794 4-4 4h-12c-2.206 0-4-1.794-4-4v-12c0-2.206 1.794-4 4-4zm0-2h-12c-3.314 0-6 2.686-6 6v12c0 3.314 2.686 6 6 6h12c3.314 0 6-2.686 6-6v-12c0-3.314-2.686-6-6-6z" fill="currentColor" data-original="currentColor"></path></g><g xmlns="http://www.w3.org/2000/svg" id="_x32_"><path d="m12 18c-.552 0-1-.447-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10c0 .553-.448 1-1 1z" fill="currentColor" data-original="currentColor"></path></g><g xmlns="http://www.w3.org/2000/svg" id="_x31_"><path d="m6 12c0-.552.447-1 1-1h10c.552 0 1 .448 1 1s-.448 1-1 1h-10c-.553 0-1-.448-1-1z" fill="currentColor" data-original="currentColor"></path></g></g></svg>
<svg  id="rg_about" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 45.999 45.999" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g><path d="M39.264,6.736c-8.982-8.981-23.545-8.982-32.528,0c-8.982,8.982-8.981,23.545,0,32.528c8.982,8.98,23.545,8.981,32.528,0 C48.245,30.281,48.244,15.719,39.264,6.736z M25.999,33c0,1.657-1.343,3-3,3s-3-1.343-3-3V21c0-1.657,1.343-3,3-3s3,1.343,3,3V33z M22.946,15.872c-1.728,0-2.88-1.224-2.844-2.735c-0.036-1.584,1.116-2.771,2.879-2.771c1.764,0,2.88,1.188,2.917,2.771 C25.897,14.648,24.746,15.872,22.946,15.872z" fill="currentColor" data-original="currentColor" class=""></path></g></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g><g xmlns="http://www.w3.org/2000/svg"></g></g></svg>
<svg id="rg_fav" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"  x="0" y="0" viewBox="0 0 511.855 511.855" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m466.186 74.688c-29.498-29.498-68.716-45.743-110.432-45.743-36.894 0-71.836 12.708-99.827 36.051-27.989-23.343-62.933-36.051-99.825-36.051-41.716 0-80.936 16.245-110.433 45.743-60.891 60.891-60.892 159.97 0 220.865l171.249 171.249c10.389 10.387 24.242 16.107 39.01 16.107s28.621-5.721 39.01-16.108l171.248-171.248c60.892-60.894 60.892-159.974 0-220.865z" fill="currentColor" data-original="currentColor" class=""></path></g></svg>
      
  </div>
    <div class="sidestickyicons">
  <div class="connect-iconn"> <a href="<?php echo $app->createUrl('site/index');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_home"></use></svg><?php echo $tag->getTag('home','Home');?></a> </div>
  <div class="connect-iconn"> <a href="javascript:void(0)" onclick="openListing(this,event)" href="<?php echo $app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_search"></use></svg><?php echo $tag->getTag('search','Search');?></a> </div>
  <div class="connect-iconn"> <a href="<?php echo $app->createUrl('place_an_ad_no_login/create');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_post"></use></svg><?php echo $tag->getTag('submit','Submit');?> </a> </div>
  <div class="connect-iconn"> <a href="<?php echo $app->createUrl('about-us');?>"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_about"></use></svg><?php echo $tag->getTag('about_us','About Us');?></a> </div>
        <div class="connect-iconn"> <a class="nav-link count-indicator"   id="messageDropdown" style="  " href="javascript:void(0)" onclick="openShortlistPop(this)" style="position:relative;"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#rg_fav"></use></svg><span class="badge header-saved-properties__counter dataCounter-fav" style="bottom:unset;top:15px;" id="dataCounter" ><?php echo $conntroller->fav_count;?></span></a></div>
</div>
 </footer>
