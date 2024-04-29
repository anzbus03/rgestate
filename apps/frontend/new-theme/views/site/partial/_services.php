  <!-- Start RG Estate Services -->
  <section class="rg-services rg-mt-70 text-center rg-outline-btn">
      <div class="container">
          <div class="rg-section-header mx-auto">
              <h1 class="rg-fs-30 rg-text-blue rg-fw-600 text-capitalize mb-5"><?php echo Yii::app()->tags->getTag('trusted_services','Your Trusted Real Estate Agency In Dubai')?></h1>
              <h3 class="rg-fs-16 rg-text-dark rg-fw-400 text-uppercase"><?php echo Yii::app()->tags->getTag('our_services','Our Services')?></h3>
              <!--<h2 class="rg-fs-30 rg-text-blue rg-fw-600 text-capitalize rg-mt-20">our services</h2>-->
              <h4 class="rg-fs-18 text-black rg-fw-500 text-capitalize mt-4"><?php echo Yii::app()->tags->getTag('explore_services','Explore Lucrative Investment Opportunities in Dubai with RGEstate')?></h4>
              <p class="rg-fs-18 rg-sm-fs-14 rg-text-gray-600 rg-fw-400 mt-2"><?php echo Yii::app()->tags->getTag('gateway_services','RGEstate your gateway to unparalleled investment possibilities in the dynamic landscape of Dubai. At RGEstate, we specialize in connecting visionary investors with prime real estate and Investment opportunities that promise exceptional returns.')?></p>
          </div>
          <ul class="rg-services-slider rg-mt-40">
              <li>
                  <div class="rg-service bg-white rg-br-10">
                      <div class="rg-bg-blue rg-wh-64 rounded-circle position-relative mx-auto">
                          <svg width="35" height="35" class="position-absolute top-50 start-50 translate-middle">
                              <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-project-funding"></use>
                          </svg>
                      </div>
                      <h2 class="rg-fs-18 rg-fw-500 text-black mt-4"><?php echo Yii::app()->tags->getTag('project_funding','Project Funding')?></h2>
                      <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12">Secure the financial backbone of your real estate endeavors with our tailored project funding solutions. Access the capital you need to turn your investment visions into reality.</p>
                      <a href="<?php echo Yii::app()->createUrl('services/project_funding'); ?>" class="btn btn-outline-secondary mt-4">Learn More</a>
                  </div>
              </li>
              <li>
                  <div class="rg-service bg-white rg-br-10">
                      <div class="rg-bg-blue rg-wh-64 rounded-circle position-relative mx-auto">
                          <svg width="35" height="35" class="position-absolute top-50 start-50 translate-middle">
                              <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-project-constructing"></use>
                          </svg>
                      </div>
                      <h2 class="rg-fs-18 rg-fw-500 text-black mt-4"><?php echo Yii::app()->tags->getTag('project_contracting','Project Contracting')?></h2>
                      <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12">Streamline your project execution with our reliable contracting solutions. Rely on our network of trusted partners to ensure timely and efficient realization of your investment projects.</p>
                      <a href="<?php echo Yii::app()->createUrl('services/project_contracting'); ?>" class="btn btn-outline-secondary mt-4">Learn More</a>
                  </div>
              </li>
              <li>
                  <div class="rg-service bg-white rg-br-10">
                      <div class="rg-bg-blue rg-wh-64 rounded-circle position-relative mx-auto">
                          <svg width="34" height="35" class="position-absolute top-50 start-50 translate-middle">
                              <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-startup-funding"></use>
                          </svg>
                      </div>
                      <h2 class="rg-fs-18 rg-fw-500 text-black mt-4"><?php echo Yii::app()->tags->getTag('business_funding','Business Funding')?></h2>
                      <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12">Limitless potential in real estate with
                          our comprehensive project funding solutions, propelling your ventures towards success and
                          growth."</p>
                      <a href="<?php echo Yii::app()->createUrl('services/business_funding'); ?>" class="btn btn-outline-secondary mt-4">Learn More</a>
                  </div>
              </li>
              <li>
                  <div class="rg-service bg-white rg-br-10">
                      <div class="rg-bg-blue rg-wh-64 rounded-circle position-relative mx-auto">
                          <svg width="35" height="34" class="position-absolute top-50 start-50 translate-middle">
                              <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-projec-developement"></use>
                          </svg>
                      </div>
                      <h2 class="rg-fs-18 rg-fw-500 text-black mt-4"><?php echo Yii::app()->tags->getTag('project_development','Project Development')?></h2>
                      <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12">Transform ideas into concrete realities through our comprehensive project development services. From concept to completion, we navigate the intricate development process for your success.</p>
                      <a href="<?php echo Yii::app()->createUrl('services/project_development'); ?>" class="btn btn-outline-secondary mt-4">Learn More</a>
                  </div>
              </li>
              <li>
                  <div class="rg-service bg-white rg-br-10">
                      <div class="rg-bg-blue rg-wh-64 rounded-circle position-relative mx-auto">
                          <svg width="39" height="35" class="position-absolute top-50 start-50 translate-middle">
                              <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-interior-fitoutst"></use>
                          </svg>
                      </div>
                      <h2 class="rg-fs-18 rg-fw-500 text-black mt-4"><?php echo Yii::app()->tags->getTag('interior_fitouts','Interior Fitouts')?></h2>
                      <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12">Transform spaces into stunning realities with our expert interior fit-out services. Experience seamless design and execution for spaces that inspire.</p>
                      <a href="<?php echo Yii::app()->createUrl('services/interior_fitouts'); ?>" class="btn btn-outline-secondary mt-4">Learn More</a>
                  </div>
              </li>
              <li>
                  <div class="rg-service bg-white rg-br-10">
                      <div class="rg-bg-blue rg-wh-64 rounded-circle position-relative mx-auto">
                          <svg width="35" height="35" class="position-absolute top-50 start-50 translate-middle">
                              <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-building-maintenance"></use>
                          </svg>
                      </div>
                      <h2 class="rg-fs-18 rg-fw-500 text-black mt-4"><?php echo Yii::app()->tags->getTag('building_maintainence','Building Maintanance')?></h2>
                      <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12">Elevate the value of your real estate assets with our top-notch building maintenance offerings. From routine upkeep to specialized services, we keep your properties at their best.</p>
                      <a href="<?php echo Yii::app()->createUrl('services/building_maintenance'); ?>" class="btn btn-outline-secondary mt-4">Learn More</a>
                  </div>
              </li>
              <li>
                  <div class="rg-service bg-white rg-br-10">
                      <div class="rg-bg-blue rg-wh-64 rounded-circle position-relative mx-auto">
                          <svg width="35" height="35" class="position-absolute top-50 start-50 translate-middle">
                              <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-business"></use>
                          </svg>
                      </div>
                      <h2 class="rg-fs-18 rg-fw-500 text-black mt-4"><?php echo Yii::app()->tags->getTag('business_buy_&_sell','Business Buy & Sell')?></h2>
                      <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12">Navigate the world of business opportunities with confidence. Whether you're looking to buy or sell, our expert guidance maximizes the value of your commercial endeavors.</p>
                      <a href="<?php echo Yii::app()->createUrl('services/business_buying_selling'); ?>" class="btn btn-outline-secondary mt-4">Learn More</a>
                  </div>
              </li>
          </ul>
          
      </div>
  </section>
  <!-- End RG Estate Services -->