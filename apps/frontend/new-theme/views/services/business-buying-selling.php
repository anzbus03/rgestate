    <!-- Start RG Estate Hero -->
    <section class="rg-page-header">
        <div class="container">
            <div class="rg-page-header-bg rg-business-buying-sell position-relative overflow-hidden rg-business-buying-selling-content">
                <div class="rg-page-header-content position-relative d-flex flex-column justify-content-center z-1">
                    <h1 class="rg-fs-40 rg-fw-600 text-white"><?php echo $this->tag->getTag('businesses_dubai', 'Buying / Selling Businesses in Dubai'); ?></h1>
                    <p class="rg-fs-16 mt-4 rg-text-gray-300">
                    <?php echo $this->tag->getTag('business_premium', 'RGEstate is your premium destination for buying and'); ?> <a href="https://www.rgestate.com/submit/business" class="rg-text-blue"><?php echo $this->tag->getTag('business_premium_2', 'selling businesses in Dubai'); ?></a> . <?php echo $this->tag->getTag('business_premium_3', 'Whether you\'re interested in retail, trading, manufacturing, or any other sector, we offer tailored solutions to meet your unique needs.'); ?></p>
                    <div class="d-block d-md-flex align-items-center rg-mt-30 mb-4">
                        <a href="https://www.rgestate.com/submit/business" class="btn btn-primary d-inline-flex align-items-center me-5 px-5">
                        <?php echo $this->tag->getTag('sell_your_business', 'Sell Your Business'); ?>
                        </a>
                        <a href="https://www.rgestate.com/business-for-sale/dubai/" class="btn btn-outline-light px-5 mt-4 mt-sm-0">
                            <?php echo $this->tag->getTag('explore_business_listing', 'Explore Business Listings'); ?>
                        </a>
                    </div>
                    <div class="rg-breadcrumb mt-4">
                        <nav>
                            <ol class="breadcrumb rg-fs-16 rg-fw-400 mb-0">
                                <li class="breadcrumb-item"><a href="#"><?php echo $this->tag->getTag('home', 'Home'); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo $this->tag->getTag('business_buying_&_sell', 'Business Buying & selling'); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End RG Estate Hero -->

    <!-- Start RG Estate History -->
    <section class="rg-history rg-mt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="rg-static-header position-relative d-flex flex-column justify-content-center">
                        <h2 class="rg-fs-40 rg-fs-sm-26 rg-fw-700 rg-text-blue">
                        <?php echo $this->tag->getTag('business_journey', 'Your Business Journey Starts Here with RGEstate'); ?>
                            
                        </h2>
                        <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">
                            <?php echo $this->tag->getTag('building_maintenance_efficient', 'Buy, Sell, and Grow in Dubai\'s Thriving Business Landscape'); ?>
                        </p>
                    </div>
                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800">
                    <?php echo $this->tag->getTag('business_evolving', 'In the ever-evolving landscape of Dubai\'s business environment, opportunities for businesses for sale abound. Whether you are an aspiring entrepreneur looking to invest in a promising venture or a business owner ready to embark on a new chapter, the process can be both exhilarating and daunting. That\'s where our dedicated team at RGEstate, a division of Riveria Global Group, steps in to offer you a seamless and expert solution in the world of'); ?>    
                    <a href="https://www.rgestate.com/business-for-sale/dubai/" class="rg-text-blue">
                    <?php echo $this->tag->getTag('business_evolving_1', 'businesses for sale in Dubai'); ?>    
                        
                    </a></p>
                    <div class="rg-contact-form rg-br-20 d-block d-lg-none">
                        <h2 class="rg-fs-30 rg-fw-700 text-white"><?php echo $this->tag->getTag('contact_us','Contact Us');?></h2>
                        <div id="contact-message2"></div>  
                        <?php
                            $form = $this->beginWidget('CActiveForm', array(
					       'id' =>'signUpForm2',
        					'action'=>Yii::app()->createUrl('site/contact_popup'),
        					'enableAjaxValidation'=>true,
        							'clientOptions' => array(
        							'validateOnSubmit'=>true,
        							'validateOnChange'=>false,
        							'beforeValidate' => 'js:function(form) {
        				     
        						form.find("#bb2").val("Validating");
        						return true;
        					}',
        					'afterValidate' => 'js:function(form, data, hasError) { 
        							if(hasError) {
        							form.find("#bb2").val("SEND INQUIRY");
        							 
        							return false;
        							}
        							else
        							{
        							form.find("#bb2").val("Please Wait..."); 
        				
        							ajaxSubmitHappenlistmort2(form, data, hasError,"'.Yii::app()->createUrl($this->id.'/send').'"); 
        							}
        							}',
        							),
        					));
        					?>
                                <input type="hidden" name="utm_source" class="utm_source" />
                                <input type="hidden" name="utm_medium" class="utm_medium" />
                                <input type="hidden" name="utm_campaign" class="utm_campaign" />
                                <input type="hidden" name="utm_term" class="utm_term" />
                                <input type="hidden" name="utm_content" class="utm_content" />
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'name',$model->getHtmlOptions('name',array('class'=>'form-input','placeholder'=>$this->tag->getTag('full_name_*','Full Name *')))); ?>
							    	<?php echo $form->error($model, 'name');?>
                                    
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'email',$model->getHtmlOptions('email',array('class'=>'form-input','placeholder'=>$this->tag->getTag('email_*','Email *')))); ?>
							        <?php echo $form->error($model, 'email');?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'phone_false',$model->getHtmlOptions('phone_false',array('id'=>'phone2','class'=>'form-input','placeholder'=>$this->tag->getTag('contact_number_*','Contact Number *')))); ?>
    							    <?php echo $form->error($model, 'phone_false');?>
    							</div>
    							<input type="hidden" name="ContactPopup[type]" value="Business Buying & Selling" >
                                <div class="form-group">
                                    <?php echo $form->textArea($model, 'message',$model->getHtmlOptions('message',array('cols'=>'40','rows'=>'2',
                                    'class'=>'form-input','style'=>'min-height:200px;',
                                    'placeholder'=>$this->tag->getTag('write_your_message','Type your message here')))); ?>
					                <?php echo $form->error($model, 'message');?>
                                    
                                </div>
                                 <input type="submit" id="bb2" class="btn btn-light w-100" value="<?php echo $this->tag->getTag('send','SEND INQUIRY') ?>">
                            <?php $this->endWidget();?>
                    </div>

                    <ul class="rg-static-stats rg-br-10 d-flex flex-column flex-md-row">
                        <li>
                            <span class="rg-fs-50 rg-fw-600 rg-text-blue d-block"><i class="rg-service-counter fst-normal">20</i>+</span>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600 d-block"><?php echo $this->tag->getTag('industry_experience_new','Years of Industry Experience');?></span>
                        </li>
                        <li>
                            <span class="rg-fs-50 rg-fw-600 rg-text-blue d-block"><i class="rg-service-counter fst-normal">50</i>+</span>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600 d-block"><?php echo $this->tag->getTag('working_professionals','Working Professionals');?></span>
                        </li>
                        <li>
                            <span class="rg-fs-50 rg-fw-600 rg-text-blue d-block rg-service-counter"><i class="rg-service-counter fst-normal">100</i>%</span>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600 d-block"><?php echo $this->tag->getTag('satisfied_customers','Satisfied Customers');?></span>
                        </li>
                    </ul>
                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800">
                     <?php echo $this->tag->getTag('business_decades', 'With over two decades of industry experience and a commitment to excellence, our Buying & Selling Businesses service in Dubai is your gateway to the exciting world of entrepreneurship and investment. We understand the intricacies of the Dubai market, its diverse industries, and the legal framework that underpins business transactions. Our mission is to empower individuals and enterprises with the knowledge, guidance, and resources needed to make informed decisions and achieve their business goals.'); ?>
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="rg-contact-form-outer d-none d-lg-block">
                        <div class="rg-contact-form rg-br-20">
                            <h2 class="rg-fs-30 rg-fw-700 text-white"><?php echo $this->tag->getTag('contact_us','Contact Us');?></h2>
                            <div id="contact-message3"></div> 
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
					       'id' =>'signUpForm',
        					'action'=>Yii::app()->createUrl('site/contact_popup'),
        					'enableAjaxValidation'=>true,
        							'clientOptions' => array(
        							'validateOnSubmit'=>true,
        							'validateOnChange'=>false,
        							'beforeValidate' => 'js:function(form) {
        				     
        						form.find("#bb").val("Validating");
        						return true;
        					}',
        					'afterValidate' => 'js:function(form, data, hasError) { 
        							if(hasError) {
        							form.find("#bb").val("SEND INQUIRY");
        							 
        							return false;
        							}
        							else
        							{
        							form.find("#bb").val("Please Wait");  
        				
        							ajaxSubmitHappenlistmort(form, data, hasError,"'.Yii::app()->createUrl($this->id.'/send').'"); 
        							}
        							}',
        							),
        					));
        					?>
                                <input type="hidden" name="utm_source" class="utm_source" />
                                <input type="hidden" name="utm_medium" class="utm_medium" />
                                <input type="hidden" name="utm_campaign" class="utm_campaign" />
                                <input type="hidden" name="utm_term" class="utm_term" />
                                <input type="hidden" name="utm_content" class="utm_content" />
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'name',$model->getHtmlOptions('name',array('class'=>'form-input','placeholder'=>$this->tag->getTag('full_name_*','Full Name *')))); ?>
							    	<?php echo $form->error($model, 'name');?>
                                    
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'email',$model->getHtmlOptions('email',array('class'=>'form-input','placeholder'=>$this->tag->getTag('email_*','Email *')))); ?>
							        <?php echo $form->error($model, 'email');?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'phone_false',$model->getHtmlOptions('phone_false',array('class'=>'form-input','placeholder'=>$this->tag->getTag('contact_number_*','Contact Number *')))); ?>
    							    <?php echo $form->error($model, 'phone_false');?>
    							</div>
    							<input type="hidden" name="ContactPopup[type]" value="Business Buying & Selling" >
                                <div class="form-group">
                                    <?php echo $form->textArea($model, 'message',$model->getHtmlOptions('message',array('cols'=>'40','rows'=>'2',
                                    'class'=>'form-input','style'=>'min-height:200px;',
                                    'placeholder'=>$this->tag->getTag('write_your_message','Type your message here')))); ?>
					                <?php echo $form->error($model, 'message');?>
                                    
                                </div>
                                <div class="checkbox mb-3">
                                    <div class="cf-turnstile" data-sitekey="0x4AAAAAABaczT6sNg53sDRh" data-theme="light"></div>
                                </div>
                                <input type="submit" id="bb" class="btn btn-light w-100" value="<?php echo $this->tag->getTag('send','SEND INQUIRY') ?>">
                            <?php $this->endWidget();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End RG Estate History -->

    <!-- Start RG Estate Vision -->
    <!--<section class="rg-vision rg-mt-70">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-lg-6">-->
    <!--                <div class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                    <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Explore Opportunities to Buy or Sell Your Business in Dubai</h2>-->
    <!--                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-286">Contact Our Team for Personalized Consultation and Assistance</p>-->
    <!--                </div>-->
    <!--                <p class="rg-fs-18 rg-fw-400 rg-text-gray-600">We deliver the fine enjoy in the whole thing actual-->
    <!--                    estate. not handiest can we promote franchises, we also provider the ones franchise owners thru-->
    <!--                    business consulting, marketing, schooling and generation across the globe. the entirety we do is-->
    <!--                    focused on supporting our franchisees enhance how they do commercial enterprise and become more-->
    <!--                    worthwhile.</p>-->
    <!--                <a href="#" class="btn btn-primary d-inline-flex align-items-center">-->
    <!--                    <span>Contact Us</span>-->
    <!--                    <svg width="15" height="11" class="ms-3">-->
    <!--                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow"></use>-->
    <!--                    </svg>-->
    <!--                </a>-->
    <!--            </div>-->
    <!--            <div class="col-lg-6">-->
    <!--                <img class="d-block w-100 rg-br-20 object-fit-cover" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/business-buying-sell -invest-in-your-vision.jpg"-->
    <!--                    alt="Invest in Your Vision">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End RG Estate Vision -->

    <!-- Start RG Estate Join -->
    <section class="rg-join rg-mt-70 rg-consultation-today">
        <div class="container">
            <div
                class="rg-join-bg position-relative d-flex align-items-center justify-content-center rg-br-10 overflow-hidden">
                <div class="position-relative z-1">
                    <h2 class="rg-fs-28 rg-fw-700 text-white mx-auto text-center">
                    <?php echo $this->tag->getTag('business_opportunities', 'Explore Opportunities to Buy or Sell Your Business in Dubai'); ?>
                       
                    </h2>
                    <p class="rg-fs-16 rg-sm-fs-14 rg-fw-400 text-white text-center mt-3">
                    <?php echo $this->tag->getTag('business_personalized', 'Contact Our Team for Personalized Consultation and Assistance'); ?>
                        
                    </p>
                    <ul
                        class="rg-btn-group d-flex flex-column flex-sm-row align-items-center justify-content-center rg-mt-40">
                        <li>
                            <a href="tel:+(971) 55 279 2403" class="btn btn-primary d-inline-flex align-items-center">
                                <svg width="20" height="20" class="rg-fill-white me-2">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-phone"></use>
                                </svg>
                                <span>+(971) 55 279 2403</span>
                            </a>
                        </li>
                        <li class="ms-0 ms-sm-4 mt-4 mt-sm-0">
                            <a href="<?php echo Yii::app()->createUrl('contact-us');?>" class="btn btn-outline-light">  <?php echo $this->tag->getTag('contact_us', 'Contact Us'); ?>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End RG Estate Join -->

    <!-- Start EG Estate Key Terms -->
    <!--<section class="rg-key-terms rg-mt-70">-->
    <!--    <div class="container">-->
    <!--        <div class="rg-key-terms-slider">-->
    <!--            <div class="rg-slider-loop">-->
    <!--                <div class="row align-items-end">-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <img class="d-none d-lg-block w-100 object-fit-cover rg-br-16"-->
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/business-buying-sell-key-terms.jpg" alt="Key Terms">-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <div class="rg-key-terms-meta">-->
    <!--                            <div-->
    <!--                                class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                                <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Key Terms</h2>-->
    <!--                                <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">Understand the positive-->
    <!--                                    impact that secured funding can have on the quality and success</p>-->
    <!--                            </div>-->
    <!--                            <img class="d-block d-lg-none w-100 object-fit-cover rg-br-16"-->
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/business-buying-sell-key-terms.jpg" alt="Key Terms">-->
    <!--                            <div class="rg-key-terms-card position-relative rg-br-16">-->
    <!--                                <h2 class="rg-fs-30 rg-fw-600 text-black">Fueling Growth</h2>-->
    <!--                                <p class="rg-fs-18 rg-mt-30">Ignite exponential growth in your business with our-->
    <!--                                    comprehensive funding solutions, empowering your website design project to reach-->
    <!--                                    new-->
    <!--                                    heights. Our funding resources act as the catalyst that propels your website-->
    <!--                                    design-->
    <!--                                    venture forward, fueling expansion and unlocking untapped potential.</p>-->
    <!--                                <a href="#" class="rg-fs-18 rg-text-blue rg-mt-30 d-inline-block">Learn More</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-slider-loop">-->
    <!--                <div class="row align-items-end">-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <img class="d-none d-lg-block w-100 object-fit-cover rg-br-16"-->
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/business-buying-sell-key-terms.jpg" alt="Key Terms">-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <div class="rg-key-terms-meta">-->
    <!--                            <div-->
    <!--                                class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                                <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Key Terms</h2>-->
    <!--                                <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">Understand the positive-->
    <!--                                    impact that secured funding can have on the quality and success</p>-->
    <!--                            </div>-->
    <!--                            <img class="d-block d-lg-none w-100 object-fit-cover rg-br-16"-->
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/business-buying-sell-key-terms.jpg" alt="Key Terms">-->
    <!--                            <div class="rg-key-terms-card position-relative rg-br-16">-->
    <!--                                <h2 class="rg-fs-30 rg-fw-600 text-black">Fueling Growth</h2>-->
    <!--                                <p class="rg-fs-18 rg-mt-30">Ignite exponential growth in your business with our-->
    <!--                                    comprehensive funding solutions, empowering your website design project to reach-->
    <!--                                    new-->
    <!--                                    heights. Our funding resources act as the catalyst that propels your website-->
    <!--                                    design-->
    <!--                                    venture forward, fueling expansion and unlocking untapped potential.</p>-->
    <!--                                <a href="#" class="rg-fs-18 rg-text-blue rg-mt-30 d-inline-block">Learn More</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-slider-loop">-->
    <!--                <div class="row align-items-end">-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <img class="d-none d-lg-block w-100 object-fit-cover rg-br-16"-->
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/business-buying-sell-key-terms.jpg" alt="Key Terms">-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <div class="rg-key-terms-meta">-->
    <!--                            <div-->
    <!--                                class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                                <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Key Terms</h2>-->
    <!--                                <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">Understand the positive-->
    <!--                                    impact that secured funding can have on the quality and success</p>-->
    <!--                            </div>-->
    <!--                            <img class="d-block d-lg-none w-100 object-fit-cover rg-br-16"-->
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/business-buying-sell-key-terms.jpg" alt="Key Terms">-->
    <!--                            <div class="rg-key-terms-card position-relative rg-br-16">-->
    <!--                                <h2 class="rg-fs-30 rg-fw-600 text-black">Fueling Growth</h2>-->
    <!--                                <p class="rg-fs-18 rg-mt-30">Ignite exponential growth in your business with our-->
    <!--                                    comprehensive funding solutions, empowering your website design project to reach-->
    <!--                                    new-->
    <!--                                    heights. Our funding resources act as the catalyst that propels your website-->
    <!--                                    design-->
    <!--                                    venture forward, fueling expansion and unlocking untapped potential.</p>-->
    <!--                                <a href="#" class="rg-fs-18 rg-text-blue rg-mt-30 d-inline-block">Learn More</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End EG Estate Key Terms -->

    <!-- Start RG Estate We Partner -->
    <section class="rg-we-partner rg-frequently-asked">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="rg-we-partner-left">
                        <h2 class="rg-fs-40 rg-fs-sm-24 rg-fw-700 tex-black">
                            
                            <?php echo $this->tag->getTag('business_faqs', 'FAQs - Buy / Sell Businesses in Dubai'); ?>
                        </h2>
                        <p class="rg-fs-18 tp-bg-gray-600 rg-mt-20"> 
                            <?php echo $this->tag->getTag('business_discover', 'Discover a world of'); ?>
                            <a href="https://www.rgestate.com/business-for-sale/dubai/" class="rg-text-blue">
                                <?php echo $this->tag->getTag('business_discover_1', 'business opportunities in Dubai'); ?>
                            </a> 
                            <?php echo $this->tag->getTag('business_discover_2', 'with our expert guidance. Whether you\'re looking to buy, sell, or invest, we\'re here to assist you every step of the way.'); ?>

                             </p>
                        <a href="<?php echo Yii::app()->createUrl('contact-us');?>" class="btn btn-primary d-inline-flex align-items-center rg-mt-40">
                            <span> <?php echo $this->tag->getTag('contact_us', 'Contact Us'); ?></span>
                            <svg width="15" height="11" class="ms-3">
                                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="rg-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo $this->tag->getTag('business_faq_1', 'What are the key steps involved in buying a business in Dubai?'); ?>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="rg-faqs-list ps-4">
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_1_ans1', 'Identifying a suitable business'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_1_ans2', 'Valuation and due diligence'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_1_ans3', 'Negotiating the terms of the purchase'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_1_ans4', 'Obtaining necessary approvals and licences'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_1_ans5', 'Finalizing the transaction'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php echo $this->tag->getTag('business_faq_2', 'How can I assess the value of a business I want to buy in Dubai?'); ?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="rg-faqs-list ps-4">
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_2_ans1', 'Business financials analysis'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_2_ans2', 'Evaluation of assets and liabilities'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_2_ans3', 'Market research and industry benchmarking'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_2_ans4', 'Future growth potential assessment'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <?php echo $this->tag->getTag('business_faq_3', 'Are there restrictions on foreign ownership of businesses in Dubai?'); ?>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('business_faq_3_ans', 'Yes, certain industries require UAE national ownership or a local sponsor, while others allow 100% foreign ownership in free zones.'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <?php echo $this->tag->getTag('business_faq_4', 'What are the legal requirements for selling a business in Dubai?'); ?>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="rg-faqs-list ps-4">
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_4_ans1', 'Obtain necessary approvals'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_4_ans2', 'Draft a comprehensive sale agreement'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_4_ans3', 'Settle any outstanding debts and obligations'); ?></li>
                                            <li>
                                                <?php echo $this->tag->getTag('business_faq_4_ans4', 'Transfer assets and licences'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false"
                                        aria-controls="collapseFive">
                                        <?php echo $this->tag->getTag('business_faq_5', 'Can I buy an existing business and change its activities or location in Dubai?'); ?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('business_faq_5_ans', 'Yes, it\'s possible, but it may require approval from relevant authorities and updating licences accordingly.'); ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix">
                                        <?php echo $this->tag->getTag('business_faq_6', 'Are there specific taxes associated with buying or selling a business in Dubai?'); ?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('business_faq_6_ans', 'There is no federal income tax in the UAE. However, there may be local taxes or fees associated with specific transactions.'); ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSeven" aria-expanded="false"
                                        aria-controls="collapseSeven">
                                        <?php echo $this->tag->getTag('business_faq_7', 'How long does the process of buying or selling a business usually take in Dubai?'); ?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('business_faq_7_ans', 'The timeline can vary depending on factors like negotiation, approvals, and due diligence. It can take 2 weeks to a few months.'); ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEight" aria-expanded="false"
                                        aria-controls="collapseEight">
                                        <?php echo $this->tag->getTag('business_faq_8', 'Can I get financing to buy a business in Dubai, and what options are available?'); ?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('business_faq_8_ans', 'Yes, financing options include bank loans, angel investors, venture capital, and government support through initiatives like the Dubai SME program.'); ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End RG Estate We Partners -->

    <!-- Start RG Estate Other Services -->
    <!--<section class="rg-services rg-mt-70">-->
    <!--    <div class="container">-->
    <!--        <div class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--            <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Our Other Services</h2>-->
    <!--        </div>-->
    <!--        <div class="rg-services-slider">-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-01.jpg"-->
    <!--                        alt="lobal econmice recovery heatmaps report">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">Global econmice recovery heatmaps report-->
    <!--                    </h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-02.jpg"-->
    <!--                        alt="Understand the global impact on the real estate sector">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">Understand the global impact on the real-->
    <!--                        estate sector</h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-03.jpg" alt="How to declutter and organise -->
    <!--                    your home">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">How to declutter and organise your home-->
    <!--                    </h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-01.jpg"-->
    <!--                        alt="">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">Global econmice recovery heatmaps report-->
    <!--                    </h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End RG Estate Other Services -->