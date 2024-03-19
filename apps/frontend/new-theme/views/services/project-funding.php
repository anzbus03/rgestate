    <!-- Start RG Estate Hero -->
    <section class="rg-page-header">
        <div class="container">
            <div class="rg-page-header-bg rg-project-funding position-relative overflow-hidden">
                <div class="rg-page-header-content position-relative d-flex flex-column justify-content-center z-1">
                    <h1 class="rg-fs-40 rg-fw-600 text-white"><?php echo $this->tag->getTag('project_funding_heading','Project Funding in Dubai');?></h1>
                    <p class="rg-fs-16 mt-4 rg-text-gray-300">
                        <?php echo $this->tag->getTag('secure_project_fun','Secure the financial foundation for your real estate endeavors in Dubai through our expert Project Funding services. RGEstate by Riveria Global Group is your partner for tailored funding solutions and accelerated project growth.');?>
                    </p>
                    
                    <div class="rg-breadcrumb mt-4">
                        <nav>
                            <ol class="breadcrumb rg-fs-16 rg-fw-400 mb-0">
                                <li class="breadcrumb-item"><a href="#"><?php echo $this->tag->getTag('home','Home');?></a></li>
                                <li class="breadcrumb-item active"><?php echo $this->tag->getTag('project_funding','Project Funding');?></li>
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
                        <h2 class="rg-fs-40 rg-fs-sm-26 rg-fw-700 rg-text-blue"><?php echo $this->tag->getTag('project_funding_sol','Project Funding Solutions in Dubai: Empowering Your Real Estate Ventures');?></h2>
                        <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420"><?php echo $this->tag->getTag('project_funding_trusted_partne','Your Trusted Partner for Dubai Real Estate Project Funding');?></p>
                    </div>
                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800">
                        <?php echo $this->tag->getTag('project_funding_division','At RGEstate, a division of Riveria Global Group, we recognize the significance of adequate financial backing in the world of real estate. Our comprehensive Project Funding services are meticulously designed to provide tailored financial solutions that empower individuals and businesses in Dubai to embark on their real estate ventures confidently.');?>
                    </p>
                
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
    							<input type="hidden" name="ContactPopup[type]" value="Project Funding" >
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
                        <?php echo $this->tag->getTag('deep_root','With our deep-rooted expertise in the local market and a commitment to excellence, we aim to be your strategic partner in transforming your real estate aspirations into a successful reality. Discover how our Project Funding services can accelerate the growth of your projects, enhance profitability, and unlock the full potential of your real estate endeavors.');?>
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
    							<input type="hidden" name="ContactPopup[type]" value="Project Funding" >
                                <div class="form-group">
                                    <?php echo $form->textArea($model, 'message',$model->getHtmlOptions('message',array('cols'=>'40','rows'=>'2',
                                    'class'=>'form-input','style'=>'min-height:200px;',
                                    'placeholder'=>$this->tag->getTag('write_your_message','Type your message here')))); ?>
					                <?php echo $form->error($model, 'message');?>
                                    
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
    <!--                    <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Empower Your Vision with Tailored Project Funding Solutions</h2>-->
    <!--                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-286">Schedule a Consultation Today and Ignite Your Real Estate Projects</p>-->
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
    <!--                <img class="d-block w-100 rg-br-20 object-fit-cover" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/project-funding-invest-in-your-vision.jpg"-->
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
                    <h2 class="rg-fs-28 rg-fw-700 text-white mx-auto text-center"><?php echo $this->tag->getTag('empower_project_funding','Empower Your Vision with Tailored Project Funding Solutions');?></h2>
                    <p class="rg-fs-16 rg-sm-fs-14 rg-fw-400 text-white text-center mt-3"><?php echo $this->tag->getTag('schedule_project_funding','Schedule a Consultation Today and Ignite Your Real Estate Projects');?></p>
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
                            <a href="<?php echo Yii::app()->createUrl('contact-us');?>" class="btn btn-outline-light"><?php echo $this->tag->getTag('contact_us','Contact Us');?></a>
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
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
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
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
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
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
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
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
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
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
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
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
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
                        <h2 class="rg-fs-40 rg-fs-sm-24 rg-fw-700 text-black">
                            <?php echo $this->tag->getTag('frequently_funding','Frequently Asked Questions about Project Funding');?>
                        </h2>
                        <p class="rg-fs-18 tp-bg-gray-600 rg-mt-20">
                            <?php echo $this->tag->getTag('review_funding','Explore the answers to some of the most commonly asked questions regarding our Project Funding services. We\'re here to provide clarity and insight as you navigate the funding process for your real estate ventures in Dubai. If you have additional questions, feel free to reach out to our team for personalized assistance.');?>
                            
                        </p>
                        <a href="<?php echo Yii::app()->createUrl('contact-us');?>" class="btn btn-primary d-inline-flex align-items-center rg-mt-40">
                            <span>Contact Us</span>
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
                                        <?php echo $this->tag->getTag('eligible_funding','What types of real estate projects are eligible for funding?');?>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('eligible_funding_answer','Our Project Funding services cater to a wide range of projects, including residential, commercial, and mixed-use developments. Whether you\'re planning a luxury residence or a thriving business complex, we\'re here to discuss your funding needs.');?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php echo $this->tag->getTag('funding_approval','How long does the funding approval process usually take?');?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('funding_approval_answer','The timeline for funding approval can vary based on factors such as project complexity and documentation. However, we prioritize efficiency and aim to provide timely evaluations and approvals to help you get your projects off the ground swiftly.');?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <?php echo $this->tag->getTag('collateral_funding','Is collateral required for project funding?');?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('collateral_funding_answer','Collateral requirements can vary based on the specifics of your project and the financial analysis. Our experienced team will guide you through this aspect during the consultation, ensuring transparency in the process.');?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <?php echo $this->tag->getTag('small_funding','Can startups or small businesses apply for project funding?');?>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('small_funding_answer','Absolutely, we welcome projects of all scales, including startups and small businesses. Our tailored solutions are designed to accommodate the unique funding needs of various enterprises.');?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false"
                                        aria-controls="collapseFive">
                                        <?php echo $this->tag->getTag('terms_funding','How do you determine the terms of funding?');?>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('terms_funding_answer','Our funding terms are determined through a thorough assessment of your project\'s financial feasibility, market dynamics, and risk factors. This ensures that the terms are aligned with your project\'s goals and market conditions.');?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix">
                                        <?php echo $this->tag->getTag('stand_funding','What makes RGEstate\'s funding services stand out?');?>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                         <?php echo $this->tag->getTag('stand_funding_answer','RGEstate stands out for its deep market expertise, transparent communication, and client-centric approach. Our tailored funding solutions and our commitment to excellence make us a preferred choice for Dubai\'s real estate funding needs.');?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSeven" aria-expanded="false"
                                        aria-controls="collapseSeven">
                                        <?php echo $this->tag->getTag('ongoing_support','Do you provide ongoing support after funding is approved?');?>
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('ongoing_support_answer','Absolutely, our support doesn\'t end with funding approval. We provide ongoing assistance, including project evaluation, financial guidance, and ensuring your project\'s alignment with funding goals.');?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEight" aria-expanded="false"
                                        aria-controls="collapseEight">
                                        <?php echo $this->tag->getTag('ongoing_support','How do I initiate the project funding process with RGEstate?');?>
                                        
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('ongoing_support_answer','To get started, simply reach out to us through our contact channels. We\'ll guide you through the initial steps, including a consultation where we\'ll discuss your project\'s details and funding requirements. From there, we\'ll work together to make your real estate vision a reality.');?>
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