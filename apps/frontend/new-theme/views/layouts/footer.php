<?php $link_url = ''; 
    $options=  $this->options;
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
                        <img class="d-block" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/logo.svg" alt="RG Estate">
                    </div>
                    <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-20">
                        <?php echo $this->tag->getTag('fast_growing','RGEstate By Riveria Global Group is a UAE’s professionally managed, fast-growing and leading Real Estate Agency in Dubai, UAE, established in 2008.');?>
                        </p>
                    <ul class="rg-social-list d-flex align-items-center rg-mt-25">
                        <li>
                            <a href="<?php echo  $options->get('system.common.facebook_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="18" height="18"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-facebook"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $options->get('system.common.twitter_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="18" height="18"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-twitter"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo  $options->get('system.common.pinterest_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="16" height="16"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-instagram"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo  $options->get('system.common.google_plus_url','#');?>" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="16" height="15"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-linkedin"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/@RGEstate" class="rg-bg-blue rg-wh-32 rounded-circle position-relative d-block" target="_blank">
                                <svg width="16" height="15"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-youtube"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mt-5 mt-md-0">
                    <h5 class="rg-fs-20 rg-fw-700 rg-text-blue"><?php echo $this->tag->getTag('quick_links','Quick Links');?></h5>
                    <ul class="rg-footer-list mt-5 rg-fs-16 rg-fw-400">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('property-for-sale'); ?>"><?php echo $this->tag->getTag('buy','Buy');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('property-for-rent'); ?>"><?php echo $this->tag->getTag('rent','Rent');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('new-development');?>"><?php echo $this->tag->getTag('new_project','New Projects');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('business-opportunities');?>"><?php echo $this->tag->getTag('businesses_for_sale','Business Opportunities');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('about-us');?>"><?php echo $this->tag->getTag('about_us','About Us');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('contact-us');?>"><?php echo $this->tag->getTag('contact_us','Contact Us');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('advertise-with-us');?>"><?php echo $this->tag->getTag('advertise_with_us','Advertise With Us');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('blog');?>"><?php echo $this->tag->getTag('blog','Blogs');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('our-partners');?>"><?php echo $this->tag->getTag('our_partners','Our Partners');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('careers');?>"><?php echo $this->tag->getTag('careers','Careers');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('sitemap'); ?>"><?php echo $this->tag->getTag('sitemap','Sitemap');?></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mt-5 mt-md-0">
                    <h5 class="rg-fs-20 rg-fw-700 rg-text-blue"><?php echo $this->tag->getTag('our_services','Our Services');?></h5>
                    <ul class="rg-footer-list mt-5 rg-fs-16 rg-fw-400">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('property-for-sale/commercial'); ?>"><?php echo $this->tag->getTag('commercial_real_estate','Commercial Real State');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/retail_investments'); ?>"><?php echo $this->tag->getTag('retail_investments','Retail Investments');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/business_buying_selling'); ?>"><?php echo $this->tag->getTag('business_buying_&_sell','Business Buying & Selling');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/business_funding'); ?>"><?php echo $this->tag->getTag('project_funding','Business Funding');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/project_funding'); ?>"><?php echo $this->tag->getTag('project_funding','Project Funding');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/project_development'); ?>"><?php echo $this->tag->getTag('project_development','Project Development');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/project_contracting'); ?>"><?php echo $this->tag->getTag('project_contracting','Project Contracting');?></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><?php echo $this->tag->getTag('industrial_maintenance','Industrial Maintenance');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/interior-fitouts'); ?>"><?php echo $this->tag->getTag('interior_fitouts','Interior Fitouts');?></a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('services/building_maintenance'); ?>"><?php echo $this->tag->getTag('building_maintenance','Building Maintenance');?></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mt-5 mt-md-0">
                    <h5 class="rg-fs-20 rg-fw-700 rg-text-blue">Address</h5>
                    <ul class="rg-address-list mt-5">
                        <li class="d-flex align-items-start">
                            <div href="#"
                                class="rg-footer-icon rg-bg-blue rg-wh-32 rounded-circle position-relative d-block">
                                <svg width="16" height="20"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-location"></use>
                                </svg>
                            </div>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600">
                                <?php echo $this->tag->getTag('office_location','Office Suite# 1005, Aspect Tower, Business Bay - Dubai UAE P.O. Box 232574');?>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <div href="#"
                                class="rg-footer-icon rg-bg-blue rg-wh-32 rounded-circle position-relative d-block">
                                <svg width="16" height="16"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-phone"></use>
                                </svg>
                            </div>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600"><a href="tel:+971 55 279 2403">+971 55 279 2403</a></span>
                        </li>
                        <li class="d-flex align-items-center">
                            <div href="#"
                                class="rg-footer-icon rg-bg-blue rg-wh-32 rounded-circle position-relative d-block">
                                <svg width="15" height="12"
                                    class="rg-fill-white position-absolute top-50 start-50 translate-middle">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-email1"></use>
                                </svg>
                            </div>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600"><a href="mailto:sales@rgestate.com">sales@rgestate.com</a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="rg-copyright rg-bg-blue text-center rg-mt-40 d-flex align-items-center justify-content-center">
            <p class="rg-fs-14 rg-fw-400 text-white pe-0">
                <?php echo $this->tag->getTag('privacy_pol','RGEstate - Commercial Real Estate Agency in Dubai | 2008 - 2023 &copy; Copyright - All Rights Reserved.');?>
            
            <span><a href="<?php echo Yii::app()->createUrl('terms');?>"><?php echo $this->tag->getTag('terms_of','Terms of Use');?></a> | <a href="<?php echo Yii::app()->createUrl('privacy');?>"><?php echo $this->tag->getTag('privacy_po','Privacy Policy');?></a></span></p>
        </div>
    </footer>
    <!-- START RG LIKES OFFCANVAS -->
    <div
      class="offcanvas offcanvas-end rg-likes-offcanvas"
      tabindex="-1"
      data-bs-scroll="true"
      id="offcanvasRight"
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header">
        <h5
          class="offcanvas-title rg-fs-16 rg-fw-500 rg-text-dark"
          id="offcanvasRightLabel"
        >
          My Favorite Properties
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
        <div class="offcanvas-body">
            <div class="d-none" id="emptyResults" ><img src="<?php echo  $this->app->apps->getBaseUrl('assets/img/love2.png');?>" class="nofav-img">
                <span class="nofav-text"><?php echo $this->tag->getTag('no_favorite_properties','No Favorite Properties');?></span>
            </div>
            <div class="list" style="display: block;">
        		 <div id="lodivScro"></div>
                <ul id="shortlist_items" class="listings drawer-items" style="max-height:calc(100vh - 65px);">
                </ul>
            </div>
            <div id="ldmore"></div>
        </div>
    </div>
    
    
    
    <!-- END RG LIKES OFFCANVAS -->
    <!-- End RG Estate Footer -->
    <script src="https://embed.tawk.to/_s/v4/app/65040be8d34/js/twk-main.js" charset="UTF-8" crossorigin="*"></script>
    <script src="https://embed.tawk.to/_s/v4/app/65040be8d34/js/twk-vendor.js" charset="UTF-8" crossorigin="*"></script>
    <script src="https://embed.tawk.to/_s/v4/app/65040be8d34/js/twk-chunk-vendors.js" charset="UTF-8" crossorigin="*"></script>
    <script src="https://embed.tawk.to/_s/v4/app/65040be8d34/js/twk-chunk-common.js" charset="UTF-8" crossorigin="*"></script>
    <script src="https://embed.tawk.to/_s/v4/app/65040be8d34/js/twk-runtime.js" charset="UTF-8" crossorigin="*"></script>
    <script src="https://embed.tawk.to/_s/v4/app/65040be8d34/js/twk-app.js" charset="UTF-8" crossorigin="*"></script>
    <script async="" src="https://embed.tawk.to/5ba0a9d8c666d426648adbb4/default" charset="UTF-8" crossorigin="*"></script>
    <script async="" charset="UTF-8" src="https://embed.tawk.to/_s/v4/app/65040be8d34/languages/en.js"></script>
  