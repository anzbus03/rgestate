<!-- Start RG Estate Header -->
<?php $link_url  = '/state/dubai';?>
<?php $link_url = ''; 
$options=  $this->options;
//$tag=  $conntroller->tag;

$currencies = $this->currencies;
$area_units = $this->area_units;
$languages = OptionCommon::systemLanguages(); 
?>
<div class="rg-topbar d-flex align-items-center rg-bg-gray-200 py-2">
        <div class="container">
          <div
            class="rg-topbar-meta d-flex align-items-center justify-content-between"
          >
            <div>
              <ul
                class="rg-social-list rg-topbar-social-list d-flex align-items-center"
              >
                <li>
                  <a
                    href="<?php echo  $options->get('system.common.facebook_url','#');?>"
                    class="rg-wh-20 rounded-circle position-relative d-block"
                  >
                    <svg
                      width="6"
                      height="12"
                      class="rg-fill-blue position-absolute top-50 start-50 translate-middle"
                    >
                      <use xlink:href="<?php echo Yii::App()->apps->getBaseUrl('theme/assets/images/icons.svg#facebook')?>"></use>
                    </svg>
                  </a>
                </li>
                <li>
                  <a
                    href="<?php echo $options->get('system.common.twitter_url','#');?>"
                    class="rg-wh-20 rounded-circle position-relative d-block"
                  >
                    <svg
                      width="11"
                      height="9"
                      class="rg-fill-blue position-absolute top-50 start-50 translate-middle"
                    >
                      <use xlink:href="<?php echo Yii::App()->apps->getBaseUrl('theme/assets/images/icons.svg#twitter')?>"></use>
                    </svg>
                  </a>
                </li>
                <li>
                  <a
                    href="<?php echo  $options->get('system.common.pinterest_url','#');?>"
                    class="rg-wh-20 rounded-circle position-relative d-block"
                  >
                    <svg
                      width="10"
                      height="10"
                      class="rg-fill-blue position-absolute top-50 start-50 translate-middle"
                    >
                      <use
                        xlink:href="<?php echo Yii::App()->apps->getBaseUrl('theme/assets/images/icons.svg#rg-instagram')?>"
                      ></use>
                    </svg>
                  </a>
                </li>
                <li>
                  <a
                    href="<?php echo  $options->get('system.common.google_plus_url','#');?>"
                    class="rg-wh-20 rounded-circle position-relative d-block"
                  >
                    <svg
                      width="10"
                      height="9"
                      class="rg-fill-blue position-absolute top-50 start-50 translate-middle"
                    >
                      <use
                        xlink:href="<?php echo Yii::App()->apps->getBaseUrl('theme/assets/images/icons.svg#rg-linkedin')?>"
                      ></use>
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
  
            <div class="d-flex align-items-center">
              <ul class="navbar-nav flex-row ms-auto mb-2 mb-lg-0 rg-fs-14 rg-fw-500">
                <li class="nav-item">
                  <a class="nav-link rg-fs-13 rg-fw-400" href="<?php echo Yii::app()->createUrl('area-guides'); ?>"><?php echo Yii::app()->tags->getTag('areaguides','Area Guides')?></a>
                </li>  
                <li class="nav-item ps-4">
                  <a class="nav-link rg-fs-13 rg-fw-400" href="<?php echo Yii::app()->createUrl('blog'); ?>"><?php echo Yii::app()->tags->getTag('blog','Blog')?></a>
                </li>
                <li class="nav-item ps-4">
                  <a class="nav-link rg-fs-13 rg-fw-400" href="<?php echo Yii::app()->createUrl('choose-your-option'); ?>"
                    ><?php echo Yii::app()->tags->getTag('submit_enquiry','Submit Inquiry')?></a
                  >
                </li>
                <li class="nav-item ps-4">
                  <a class="nav-link rg-fs-13 rg-fw-400" href="<?php echo Yii::app()->createUrl('contact-us'); ?>"><?php echo Yii::app()->tags->getTag('contact_us','Contact Us')?></a>
                </li>
              </ul>
              <div class="rg-search-content position-relative ms-4">
                <input
                   type="text" required="" value="" maxlength="15" id="property_id" onkeypress="return enterKeyPressed(event)" name="property_id" autocomplete="off"
                  class="form-input rounded-3 w-100 border rg-fs-12 rg-fw-400"
                  placeholder="<?php echo Yii::app()->tags->getTag('reference_id','Reference ID')?>"
                />
                <span class="rg-search-icon" onclick="submitids(this)" id="submitids">
                  <svg width="14" height="14">
                    <use xlink:href="<?php echo Yii::App()->apps->getBaseUrl('theme/assets/images/icons.svg#rg-search')?>"></use>
                  </svg>
                </span>
              </div>
              <div class="rg-topbar-likes ms-3">
                <a href="#" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                  <svg
                    width="16"
                    height="14"
                    class="rg-heart-icon rg-fill-orange"
                  >
                    <use xlink:href="<?php echo Yii::App()->apps->getBaseUrl('theme/assets/images/icons.svg#rg-heart-fill')?>"></use>
                  </svg>
                  
                  <span class="rg-fs-12 rg-fw-500 rg-text-orange"> (<span class=" dataCounter-fav" id="dataCounter" ><?php echo  $this->fav_count;?></span>)</span>
                </a>
              </div>
              <div class="rg-topbar-dropdowns d-flex align-items-center gap-3">
                <div class="dropdown hover-dropdown ms-3">
                  <button
                    class="btn btn bg-transparent rounded-3 border dropdown-toggle px-3 py-1 rg-fs-12 rg-fw-400"
                    type="button"
                    id="hoverDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <?php echo AREANAME;?>
                  </button>
                  <ul class="dropdown-menu p-0" aria-labelledby="hoverDropdown">
                      <?php
						foreach($area_units as $k=>$v){
						    if($k==AREANAME){ continue;}
					?>
                    <li>
                      <a
                        class="dropdown-item py-2 rg-text-dark rg-fs-12 rg-fw-400"
                        href="<?php echo $this->createUrl('site/change_area_unit',array('unit'=>$k)); ?>"
                        ><?php echo $v;?></a
                      >
                    </li>
                    <?php } ?>
                    
                  </ul>
                </div>
                <div class="dropdown hover-dropdown">
                  <button
                    class="btn bg-transparent border rounded-3 dropdown-toggle px-3 py-1 rg-fs-12 rg-fw-400"
                    type="button"
                    id="hoverDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <?php echo SELECT_CURRENCY_TITLE;?>
                  </button>
                  <ul class="dropdown-menu p-0" aria-labelledby="hoverDropdown">
                    <?php
						foreach($currencies as $k=>$v){
						    if($k==SELECTED_CURRENCY){ continue;}
					?>
                    <li>
                      <a
                        class="dropdown-item py-2 rg-text-dark rg-fs-12 rg-fw-400"
                        href="<?php echo $this->createUrl('site/change_currency',array('id'=>$k)); ?>"
                        ><?php echo $v['name'];?></a
                      >
                    </li>
                    <?php } ?>
                    
                  </ul>
                </div>
              </div>
            <?php
    			$ret = defined('RETURN_URL') ?     RETURN_URL   : '' ;
    			foreach($languages as $k=>$v){ 
    			if( $this->language == $k ){ continue; } 
    			?>    
                  <a href="<?php echo $this->createUrl('site/changeLanguage',array('val'=>$k,'ret'=>$ret)) ?>"
                    ><p class="rg-fs-16 rg-fw-600 rg-text-blue ms-3"><?php echo $v; ?></p></a>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
<nav class="navbar navbar-expand-xl bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $this->app->apps->getBaseUrl(); ?>">
            <img src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/logo.svg" alt="RG Estate">
        </a>
        <button class="navbar-toggler ms-5" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="navbarOffcanvasLgLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-uppercase" id="offcanvasNavbarLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body align-items-center">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 rg-fs-14 rg-fw-500">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo Yii::app()->createUrl('property-for-sale').$link_url;?>"><?php echo Yii::app()->tags->getTag('sale','Sale')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('property-for-rent').$link_url;?>"><?php echo Yii::app()->tags->getTag('rent','Rent')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('preleased'); ?>"><?php echo Yii::app()->tags->getTag('preleased','Preleased')?></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('new-development');?>"><?php echo Yii::app()->tags->getTag('new_projects','New Projects')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('business-opportunities');?>"><?php echo Yii::app()->tags->getTag('businesses_for_sale','Business Opportunities')?></a>
                    </li>
                   <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo Yii::app()->tags->getTag('services','Services')?></a>
                      <ul class="dropdown-menu rg-dropdown">
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/project_funding');?>"><?php echo Yii::app()->tags->getTag('project_funding','Project Funding')?></a></li>
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/retail_investments');?>"><?php echo Yii::app()->tags->getTag('retail_investments','Retail Investments')?></a></li>
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/business_funding');?>"><?php echo Yii::app()->tags->getTag('startup_funding','Business Funding')?></a></li>
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/project_development');?>"><?php echo Yii::app()->tags->getTag('project_development','Project Development')?></a></li>
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/project_contracting');?>"><?php echo Yii::app()->tags->getTag('project_contracting','Project Contracting')?></a></li>
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/interior_fitouts');?>"><?php echo Yii::app()->tags->getTag('interior_fitouts','Interior Fitouts')?></a></li>
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/building_maintenance');?>"><?php echo Yii::app()->tags->getTag('building_maintenance','Building Maintenance')?></a></li>
                        <li><a class="dropdown-item" href="<?php echo Yii::app()->createUrl('services/business_buying_selling');?>"><?php echo Yii::app()->tags->getTag('business_buying_&_sell','Business Buying & Selling')?></a></li>
                      </ul>
                    </li>
                </ul>
                <a href="<?php echo Yii::app()->createUrl('choose-your-option'); ?>" class="btn btn-dark"><?php echo Yii::app()->tags->getTag('submit_property','Submit Property')?> <span
                        class="badge rounded-pill rg-fs-11 rg-fw-500 rounded ms-2"><?php echo Yii::app()->tags->getTag('free','Free')?></span></a>
            </div>
        </div>
    </div>
</nav>
<!-- End RG Estate Header -->