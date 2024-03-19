<!-- Start RG Estate Buy/Rent/Sell -->
<section class="rg-buy-rent-sell rg-outline-btn">
    <div class="container">
        <div class="rg-section-header text-center mx-auto">
            <ul
                class="rg-header-list rg-fs-16 rg-text-dark rg-fw-400 text-uppercase d-flex align-items-center justify-content-center">
                <li><?php echo Yii::app()->tags->getTag('buy','Buy')?></li>
                <li><?php echo Yii::app()->tags->getTag('sell','Sell')?></li>
                <li><?php echo Yii::app()->tags->getTag('rent','Rent')?></li>
            </ul>
            <h2 class="rg-fs-30 rg-sm-fs-24 rg-text-blue rg-fw-600 text-capitalize rg-mt-20"><?php echo Yii::app()->tags->getTag('expertise_buy','Expertise in Buying, Selling & Renting Properties')?></h2>
            <p class="rg-fs-18 rg-sm-fs-14 rg-text-gray-600 rg-fw-400 rg-mt-20"><?php echo Yii::app()->tags->getTag('dedicated_partner','RGEstate is your dedicated partner for buying, selling, and renting commercial properties. Unlock a world of investment opportunities as we assist you in making informed decisions that drive success in Dubai\'s dynamic real estate market.')?></p>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="rg-buy-rent-sell-card text-center position-relative rg-mt-50">
                    <div class="rg-bg-blue rg-wh-87 rounded-circle position-relative mx-auto">
                        <svg width="39" height="39" class="position-absolute top-50 start-50 translate-middle">
                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-qualified-agents"></use>
                        </svg>
                    </div>
                    <h2 class="rg-fs-18 rg-fw-500 text-black rg-mt-30"><?php echo Yii::app()->tags->getTag('qualified_agents','Qualified Agents')?></h2>
                    <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12"><?php echo Yii::app()->tags->getTag('seasoned_agents','With deep-rooted expertise in the local real estate market, our seasoned agents offer invaluable insights, ensuring you discover your ideal property at the perfect price.')?></p>
                    <!--<a href="#" class="btn btn-outline-secondary rg-mt-25">Learn More</a>-->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="rg-buy-rent-sell-card text-center position-relative rg-mt-50">
                    <div class="rg-bg-blue rg-wh-87 rounded-circle position-relative mx-auto">
                        <svg width="44" height="45" class="position-absolute top-50 start-50 translate-middle">
                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-excellent-service"></use>
                        </svg>
                    </div>
                    <h2 class="rg-fs-18 rg-fw-500 text-black rg-mt-30"><?php echo Yii::app()->tags->getTag('excellent_service','Excellent Service')?></h2>
                    <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12"><?php echo Yii::app()->tags->getTag('remarkable_customer','We set the bar high with our remarkable customer service, consistently surpassing expectations to fulfill our clients\' requirements and aspirations.')?></p>
                    <!--<a href="#" class="btn btn-outline-secondary rg-mt-25">Learn More</a>-->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="rg-buy-rent-sell-card text-center position-relative rg-mt-50">
                    <div class="rg-bg-blue rg-wh-87 rounded-circle position-relative mx-auto">
                        <svg width="49" height="44" class="position-absolute top-50 start-50 translate-middle">
                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-customer-care"></use>
                        </svg>
                    </div>
                    <h2 class="rg-fs-18 rg-fw-500 text-black rg-mt-30"><?php echo Yii::app()->tags->getTag('customer_care','Customer Care')?></h2>
                    <p class="rg-fs-14 rg-fw-400 rg-text-gray-600 rg-mt-12"><?php echo Yii::app()->tags->getTag('distinct_needs','Our adept team comprehends the significance of attentive listening and personalized care. Count on us to cater to your distinct needs and preferences with unwavering dedication.')?></p>
                    <!--<a href="#" class="btn btn-outline-secondary rg-mt-25">Learn More</a>-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End RG Estate Buy/Rent/Sell -->

<!-- Start RG Estate Interested in selling your home? -->
<section class="rg-selling rg-mt-70">
    <div class="container">
        <div class="rg-selling-card bg-white rg-br-26 overflow-hidden">
            <div class="row align-items-center g-0">
                <div class="col-md-6">
                    <div class="rg-selling-meta rg-section-meta">
                        <h2 class="rg-fs-30 rg-sm-fs-24 rg-fw-500 rg-text-dark"><?php echo Yii::app()->tags->getTag('seeking_agency','Seeking the Right Agency for Your Property?')?></h2>
                        <p class="rg-fs-18 rg-sm-fs-14 rg-fw-300 rg-text-gray-600 mt-4"><?php echo Yii::app()->tags->getTag('seamless_process','Unlock the possibilities of selling, buying and leasing your property with us. Our expert team is ready to guide you through a seamless process, ensuring you achieve the best value for your investment.')?></p>
                        <a href="#" class="btn btn-primary d-inline-flex align-items-center rg-mt-30" data-bs-toggle="modal" data-bs-target="#popupmodal">
                            <span><?php echo Yii::app()->tags->getTag('connect_today','Connect with us today?')?></span>
                            <svg width="15" height="11" class="ms-3">
                                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="d-block w-100 h-100 object-fit-cover"
                        src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/interested-in-selling-your-home.jpg"
                        alt="Interested in selling your home">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End RG Estate Interested in selling your home? -->
